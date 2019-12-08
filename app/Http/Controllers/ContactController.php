<?php

namespace App\Http\Controllers;


use App\Contact;
use App\ContactTag;
use App\CTag;
use App\Person;
use App\Repositories\Interfaces\AppRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Services\UserScoreService\UserScoreService;
use App\User;
use Illuminate\Http\Request;

class ContactController extends BaseAPIController
{
    /**
     * @var RoleRepository
     */
    protected $ContactRepository;
    protected $contact;

    protected $userRepository;
    protected $scoreService;

    /**
     * @var UserRepository
     */

    public function __construct(AppRepository $appRepository,UserRepository $userRepository,UserScoreService $scoreService)
    {
        $this->appRepository = $appRepository;
        $this->model = new Contact();

        $this->person = new Person();
        $this->userRepository = $userRepository;
        $this->scoreService =$scoreService;
    }

    public function list()
    {
        return $this->model::select('id','first_name', 'last_name')->get();
    }

    public function index()
    {
        return $this->model::paginate();
    }


    public function show($id)
    {
        $data = Contact::where('id',$id)
            ->with(['user.orders','user.orders.OrderServices','user.orders.OrderServices.person','user.orders.OrderServices.service','user','group','tags'])
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
            'mobile' => ['required', 'string', 'digits:11', 'unique:users'],
//            'password' => ['required', 'string', 'min:8']
]);
        $user =$this->userRepository->add(\request());
        \request()->request->add(['created_by' => auth()->id(),'user_id' => $user->id]);
        \request()->validate($this->validationRules(),$this->validationMessages(),$this->validationAttributes());
        $data = $this->appRepository->add(\request()->all() , $this->model);
        $this->assignTags($data,\request()->tags);
        return $this->response($data);
    }

    public function update($id)
    {
        \request()->validate($this->validationRules(),$this->validationMessages(),$this->validationAttributes());
        $data = $this->appRepository->edit(\request()->all() , $id, $this->model);
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
//            'email'=>['string','required'],
//            'image'=>['image'],



        ];
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

}
