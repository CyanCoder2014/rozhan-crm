<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Person;
use App\Repositories\AppRepositoryImpl;
use App\Repositories\UserRepository;
use App\Services\UploadFileService\UploadImageService;


class PersonController extends BaseAPIController
{
    /**
     * @var UserRepository
     */
    protected $userRepository;
    protected  $imageService;

    /**
     * PersonController constructor.
     * @param AppRepositoryImpl $appRepository
     * @param UserRepository $userRepository
     */

    public function __construct(AppRepositoryImpl $appRepository,UserRepository $userRepository,UploadImageService $imageService)
    {
        $this->appRepository = $appRepository;
        $this->model = new Person();
        $this->userRepository = $userRepository;
        $this->imageService = $imageService;

    }


//    public function index()
//    {
//        return parent::dataTables(['name', 'family', 'score'],null,['OrderServices','services']);
//    }




    public function index()
    {
        return parent::dataTables(
            ['user_id', 'name', 'image', 'family', 'description', 'min_time', 'score', 'star', 'type', 'state'],
            ['name',  'family', 'description', 'min_time'],
            ['OrderServices','services']
        );
//        $data = $this->appRepository->getAll($this->model);
        $data = Person::with('OrderServices')->with('services')->orderBy('id', 'desc')->paginate();

        return $this->response($data);
    }
    public function show($id)
    {
        $data = $this->model::with('user.contact','user')->findOrFail($id);
        return $this->response($data);
    }

    /**
     *
     * @bodyParam  name [] required
     * @bodyParam  email  ['string','email','max:255','unique:users'] required
     * @bodyParam  mobile  ['string','max:255','unique:users'] required
     * @bodyParam  password  ['string','min:8'] required
     * @bodyParam  image ['nullable','image']
     * @bodyParam  family [] required
     * @bodyParam  description []
     * @bodyParam  min_time []
     * @bodyParam  score []
     * @bodyParam  star []
     * @bodyParam  type []
     * @bodyParam  state []
     *
     * @response 200 {
     * "data": {
     * "name": "",
     * "family": "",
     * "created_by": {id},
     * "user_id": {id},
     * "updated_at": {date},
     * "created_at": {date},
     * "id": {id}
     * },
     * "message": null
     * }
     */
    public function store()
    {
        request()->validate([
            ////////// user validation ////////////////
            'name'=>['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:contacts'],
            'mobile' => ['required', 'string', 'max:255', 'unique:contacts'],
            'password' => ['required', 'string', 'min:8']]);
        \request()->validate($this->validationRules(),$this->validationMessages(),$this->validationAttributes());
        $user =$this->userRepository->add(\request());
        \request()->request->add(['created_by' => auth()->id(),'user_id' => $user->id]);
        \request()->request->add(['first_name' => request('name')]);
        \request()->request->add(['last_name' => request('family')]);

        $parameters = \request()->all();
        if(\request()->hasFile('image'))
            $parameters['image'] = $this->imageService->upload('image')->resize(100,100)->getFileAddress();

        $data = $this->appRepository->add( $parameters,$this->model);
        $this->appRepository->add($parameters , new Contact());
        return $this->response($data);
    }



    /**
     *
     * @bodyParam  name [] required
     * @bodyParam  image ['nullable','image']
     * @bodyParam  family [] required
     * @bodyParam  description []
     * @bodyParam  min_time []
     * @bodyParam  score []
     * @bodyParam  star []
     * @bodyParam  type []
     * @bodyParam  state []
     *
     * @response 200 {
     * "data": {
     * "name": "",
     * "family": "",
     * "created_by": {id},
     * "user_id": {id},
     * "updated_at": {date},
     * "created_at": {date},
     * "id": {id}
     * },
     * "message": null
     * }
     */

    public function update($id)
    {
        \request()->validate($this->validationRules(),$this->validationMessages(),$this->validationAttributes());

        \request()->request->add(['first_name' => request('name')]);
        \request()->request->add(['last_name' => request('family')]);
        \request()->request->add(['updated_by' => auth()->id()]);

        $parameters = \request()->all();
        if(\request()->hasFile('image'))
            $parameters['image'] = $this->imageService->upload('image')->resize(100,100)->getFileAddress();

        $person = Person::findOrFail($id);
        $user =$this->userRepository->update(\request(),$person->user->id);

        if ($person->user->contact)
        $this->appRepository->edit($parameters ,$person->user->contact->id, new Contact());


        $data = $this->appRepository->edit( $parameters, $id,$this->model);
        return $this->response($data);
    }


    protected function validationRules()
    {
        return [
            ////////// person validation //////////////
//            'image'=>['nullable','image'],
            'name'=>['required'],
            'family'=>['required'],
            'description'=>[],
            'min_time'=>[],
            'score'=>[],
            'star'=>[],
            'type'=>[],
            'state'=>[],
            
        ];
    }
}
