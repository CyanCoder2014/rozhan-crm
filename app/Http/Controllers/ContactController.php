<?php

namespace App\Http\Controllers;


use App\Contact;
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
    /**
     * @var UserRepository
     */

    public function __construct(AppRepository $appRepository)
    {
        $this->appRepository = $appRepository;
        $this->model = new Contact();
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
