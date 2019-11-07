<?php

namespace App\Http\Controllers;


use App\Contact;
use App\Person;
use App\Repositories\Interfaces\AppRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
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

    /**
     * @var UserRepository
     */

    public function __construct(AppRepository $appRepository,UserRepository $userRepository)
    {
        $this->appRepository = $appRepository;
        $this->model = new Contact();

        $this->person = new Person();
        $this->userRepository = $userRepository;
    }


    public function store()
    {
        request()->validate([
            ////////// user validation ////////////////
//            'name'=>['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', 'string', 'max:255', 'unique:users'],
//            'password' => ['required', 'string', 'min:8']
]);
        $user =$this->userRepository->add(\request());
        \request()->request->add(['created_by' => auth()->id(),'user_id' => $user->id]);
        return parent::store();
    }





    protected function validationRules()
    {
        return [

            'first_name'=>['string','required'],
            'last_name'=>['string','required'],
            'mobile'=>['string','required'],
            'email'=>['string','required'],
//            'image'=>['image'],


        ];
    }




}
