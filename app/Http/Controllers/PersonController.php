<?php

namespace App\Http\Controllers;

use App\Person;
use App\Repositories\AppRepositoryImpl;
use App\Repositories\UserRepository;


class PersonController extends BaseAPIController
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * PersonController constructor.
     * @param AppRepositoryImpl $appRepository
     * @param UserRepository $userRepository
     */
    public function __construct(AppRepositoryImpl $appRepository,UserRepository $userRepository)
    {
        $this->appRepository = $appRepository;
        $this->model = new Person();
        $this->userRepository = $userRepository;
    }






    public function index()
    {
//        $data = $this->appRepository->getAll($this->model);
        $data = Person::with('OrderServices')->with('services')->get();

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
        $user =$this->userRepository->add(\request());
        \request()->request->add(['created_by' => auth()->id(),'user_id' => $user->id]);
        return parent::store();
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
        \request()->request->add(['updated_by' => auth()->id()]);
        return parent::update($id);
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
