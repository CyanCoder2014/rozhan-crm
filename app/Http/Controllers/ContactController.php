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







}