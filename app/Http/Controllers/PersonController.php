<?php

namespace App\Http\Controllers;

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
//        $data = $this->appRepository->getAll($this->model);
        $data = Person::with('OrderServices')->with('services')->paginate();

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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8']]);
        \request()->validate($this->validationRules(),$this->validationMessages(),$this->validationAttributes());
        $user =$this->userRepository->add(\request());
        \request()->request->add(['created_by' => auth()->id(),'user_id' => $user->id]);

        $parameters = \request()->all();
        if(\request()->hasFile('image'))
            $parameters['image'] = $this->imageService->upload('image')->resize(100,100)->getFileAddress();

        $data = $this->appRepository->add( $parameters,$this->model);
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

        $parameters = \request()->all();
        if(\request()->hasFile('image'))
            $parameters['image'] = $this->imageService->upload('image')->resize(100,100)->getFileAddress();


        \request()->request->add(['updated_by' => auth()->id()]);

        $data = $this->appRepository->edit( $parameters, $id,$this->model);
        return $this->response($data);
    }


    protected function validationRules()
    {
        return [
            ////////// person validation //////////////
            'image'=>['nullable','image'],
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
