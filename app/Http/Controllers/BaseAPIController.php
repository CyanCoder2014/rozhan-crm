<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Http\Requests\Client\User\RegisterRequest;
use App\Http\Requests\Client\User\ResetPassword;
use App\Repositories\Interfaces\AppRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BaseAPIController extends Controller
{
    /**
     * @var AppRepository
     */
    protected  $appRepository;
    protected $model;




    public function index()
    {
        $data = $this->appRepository->getAll($this->model);
        return $this->response($data);
    }


    public function show($id)
    {
        $data = $this->appRepository->getById($id, $this->model);
        return $this->response($data);
    }


    public function update($id)
    {
        \request()->validate($this->validationRules(),$this->validationMessages(),$this->validationAttributes());

        $data = $this->appRepository->edit(\request()->all() , $id, $this->model);
        return $this->response($data);
    }


    public function store()
    {
        \request()->validate($this->validationRules(),$this->validationMessages(),$this->validationAttributes());

        $data = $this->appRepository->add(\request()->all() , $this->model);
        return $this->response($data);
    }

    public function destroy($id)
    {
        $data = $this->appRepository->delete( $id, $this->model);
        return '';
    }

    protected function validationRules(){
        return [];
    }
    protected function validationAttributes(){
        return [];
    }
    protected function validationMessages(){
        return [];
    }


}
