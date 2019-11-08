<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Person;
use App\Repositories\AppRepositoryImpl;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends BaseAPIController
{
    public function __construct(AppRepositoryImpl $appRepository)
    {
        $this->appRepository = $appRepository;
        $this->model = new User();
    }



    public function getCurrentUser(){

        $user = Auth::user();
        $contact = Contact::where('user_id', Auth::id())->first();
        $person = Person::where('user_id', Auth::id())->first();

        $data = ['user' => $user, 'contact' => $contact, 'person' =>  $person];

        return $this->response($data);

    }





    protected function validationRules()
    {
        return [
            'name'=>['required'],
//            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', 'string', 'min:10', 'max:11', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }
}
