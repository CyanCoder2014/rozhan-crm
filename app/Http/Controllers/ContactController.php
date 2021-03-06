<?php

namespace App\Http\Controllers;


use App\Contact;
use App\ContactTag;
use App\CTag;
use App\Order;
use App\Person;
use App\Repositories\Interfaces\AppRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Services\UploadFileService\UploadImageService;
use App\Services\UserScoreService\UserScoreService;
use App\User;
use App\UserProfile;
use function GuzzleHttp\Psr7\str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ContactController extends BaseAPIController
{
    /**
     * @var RoleRepository
     */
    protected $ContactRepository;
    protected $contact;

    protected $userRepository;
    protected $scoreService;

    protected $imageService;

    /**
     * @var UserRepository
     */

    public function __construct(AppRepository $appRepository,UserRepository $userRepository,UserScoreService $scoreService, UploadImageService $imageService)
    {
        $this->appRepository = $appRepository;
        $this->model = new Contact();

        $this->person = new Person();
        $this->userRepository = $userRepository;
        $this->scoreService =$scoreService;

        $this->imageService =$imageService;

    }

    public function list()
    {
        return $this->model->select('id','first_name', 'last_name')->get();
    }

    public function index()
    {
//        return $this->model->orderBy('id', 'desc')->paginate();
//        $data =  parent::dataTables(,,);
        $columns =['first_name','user_id', 'last_name', 'mobile', 'email', 'tell','personal_code'];
        $search_column=['first_name','user_id', 'last_name', 'mobile', 'email', 'tell','personal_code'];
        $with=['user','userProfile'];
        if (!$search_column)
            $search_column = $columns;
        if ( \request()->input('showdata') ) {
            return $this->model->orderBy('created_at', 'desc')->get();
        }
        $length = \request()->input('length',15);
        $column = \request()->input('column');
        $order = \request()->input('order','desc');
        $search_input = \request()->input('search');
        $query = $this->model->select(array_merge($columns,['id','created_at']))
            ->orderBy($columns[$column]??'id',$order);
        if ($with)
            $query->with($with)->doesnthave('user.person');
        if ($search_input) {
            $query->where(function($query) use ($search_input,$search_column) {

                foreach ($search_column as $key => $column)
                    if ($key == array_key_first($search_column))
                        $query->where($column, 'like', '%' . $search_input . '%');
                    else
                        $query->orWhere($column, 'like', '%' . $search_input . '%');
//                    ->orWhere('mobile', 'like', '%' . $search_input . '%')
//                    ->orWhere('email', 'like', '%' . $search_input . '%')
//                    ->orWhere('tell', 'like', '%' . $search_input . '%');
//                    ->orWhere('created_at', 'like', '%' . $search_input . '%');
            });
        }
        $data = $query->paginate($length);
        $data->getCollection()->transform(function ($value) {
            $value->score = 0;
            if ($value->user)
            $value->score = $this->scoreService->getScore($value->user);
            return $value;
        });
        return $data;
        return parent::index(); // TODO: Change the autogenerated stub
    }


    public function show($id)
    {
        $data = Contact::where('id',$id)
            ->with(['user.orders','user.orders.OrderServices','user.orders.OrderServices.person','user.orders.OrderServices.service','user','group','tags','reviews'])
            ->first();
        $data->score = $this->scoreService->getScore($data->user);
        return $this->response($data);
    }


    public function store()
    {


        request()->validate([
            ////////// user validation ////////////////
            'first_name'=>['required'],
            'last_name'=>['required'],
//            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', 'string', 'min:8', 'unique:contacts', 'unique:users'],
//            'password' => ['required', 'string', 'min:8']
]);
        $user =$this->userRepository->add(\request());
        \request()->request->add(['created_by' => auth()->id(),'user_id' => $user->id]);
        \request()->validate($this->validationRules(),$this->validationMessages(),$this->validationAttributes());
        $data = $this->appRepository->add(\request()->all() , $this->model);
        $data->personal_code = generateRandomString(abs(6-strlen((string)$data->id)),'0123456789').$data->id;
        $data->save();
        $this->assignTags($data,\request()->tags);


        $userProfile = new UserProfile();
        $userProfile->contact_id = $data->id;
        $userProfile->save();

        return $this->response($data);
    }

    public function update($id)
    {
        $contact = Contact::findOrFail($id);

        \request()->validate($this->validationRules(),$this->validationMessages(),$this->validationAttributes());

        $parameters = \request()->all();
        if(\request()->hasFile('image'))
            $parameters['image'] = $this->imageService->upload('image')->resize(100,100)->getFileAddress();

        $parameters['personal_code'] = generateRandomString(abs(6-strlen((string)$contact->user_id)),'0123456789').$contact->user_id;

        $user =$this->userRepository->update(\request(),$contact->user_id);
        $data = $this->appRepository->edit($parameters, $id,$this->model);
        if ($user->person)
            $this->appRepository->edit(\request()->all() , $user->person->id, new Person());
        $this->DeleteTags($id);
        $this->assignTags($data,\request()->tags);
        return $this->response($data);
    }


    protected function validationRules()
    {
        return [

            'first_name'=>['string','required'],
            'last_name'=>['string','required'],
            'mobile'=>['string','required'],
            'group_id'=>['nullable','exists:contact_groups,id'],
//            'personal_code'=>['nullable','unique:contacts'],
//            'email'=>['string','required'],
//            'image'=>['image'],



        ];
    }


    public function destroy($id){

        $contact = Contact::findOrFail($id);

        $rndDeleted ='--'.generateRandomString(abs(4),'0123456789');
        $contact->mobile = ($contact->mobile??'') .$rndDeleted;
        $contact->email = ($contact->email??'') .$rndDeleted;
        $contact->save();

        $user = $contact->user()->update([
            'mobile' => ($contact->user()->mobile??'') .$rndDeleted,
            'email' => ($contact->user()->email??'') .$rndDeleted,
        ]);

        $contact->delete();

        return '';
    }


    public  function assignTags($contact,$tags)
    {
        $contactTags=[];
        foreach ($tags??[] as $tag){
            $tag_id = CTag::FindOrCreate($tag);
            $contactTags[]=[
               'tag_id' => $tag_id,
               'contact_id' => $contact->id,
            ];
        }
        return ContactTag::insert($contactTags);
    }
    public  function DeleteTags($contact_id)
    {

        return ContactTag::where('contact_id',$contact_id)->delete();
    }

    public function FindByNumber($number)
    {
        $contact =Contact::where('mobile',"LIKE",'%'.$number.'%')->first();
        if (!$contact)
            $contact =Contact::where('tell',"LIKE",'%'.$number.'%')->first();

        return $this->response($contact);

    }
    public function UsedDiscount($id)
    {
        $contact = Contact::findOrFail($id);
        return Order::whereHas('discount')->where('user_id',$contact->user_id)->with(['discount','discount.services','discount.products'])->paginate();
    }












    function import(Request $request)
    {
        $this->validate($request, [
            'file'  => 'required|mimes:xls,xlsx'
        ]);

        $path = $request->file('file')->getRealPath();

        $data = Excel::load($path)->get();

        if($data->count() > 0)
        {
           $this->addContact($data);
        }
        return $this->response($data);

    }







    function addContact($data){

        foreach($data->toArray() as $key => $value)
        {
            $insert_data[] = array(
                'first_name'  => $value['first_name']??null,
                'last_name'   => $value['last_name']??null,
                'mobile'   => $value['mobile']??'0000000000',
                'email'    => $value['email']??null,
                'state'  => 1,
            );
        }

        if(!empty($insert_data))
        {
            foreach ($data as $row){

                if(!empty($row->mobile) && empty(User::where('mobile', $row->mobile)->first())
                ){
                    $user =$this->userRepository->add($row);

                    Contact::create([
                        'first_name'  => $row->first_name??null,
                        'last_name'   => $row->last_name??null,
                        'mobile'   => $row->mobile??'0000000000',
                        'tell'   => $row->tell??null,
                        'email'    => $row->email??null,
                        'state'  => 1,
                        'created_by'  => auth()->id(),
                        'user_id' => $user->id
                    ]);
                }
            }
        }
    }




}
