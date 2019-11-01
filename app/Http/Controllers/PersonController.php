<?php

namespace App\Http\Controllers;

use App\Person;
use App\Repositories\AppRepositoryImpl;


class PersonController extends BaseAPIController
{
    /**
     * @var UserController
     */
    protected $userController;
    public function __construct(AppRepositoryImpl $appRepository,UserController $userController)
    {
        $this->appRepository = $appRepository;
        $this->model = new Person();
        $this->userController = $userController;
    }






    public function index()
    {
//        $data = $this->appRepository->getAll($this->model);
        $data = Person::with('OrderServices')->with('services')->get();

        return $this->response($data);
    }




    public function store()
    {
        $user =$this->userController->store()['data'];
        \request()->request->add(['created_by' => auth()->id(),'user_id' => $user->id]);
        return parent::store();
    }
    public function update($id)
    {
        \request()->request->add(['updated_by' => auth()->id()]);
        return parent::update($id);
    }
    protected function validationRules()
    {
        return [
            'name'=>['required'],
            'image'=>['image'],
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
