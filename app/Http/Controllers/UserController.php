<?php

namespace App\Http\Controllers;

use App\Repositories\AppRepositoryImpl;
use App\User;
use Illuminate\Http\Request;

class UserController extends BaseAPIController
{
    public function __construct(AppRepositoryImpl $appRepository)
    {
        $this->appRepository = $appRepository;
        $this->model = new User();
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
