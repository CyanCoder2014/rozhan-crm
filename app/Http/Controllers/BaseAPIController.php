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

    protected $appRepository;
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


    public function update(Request $request, $id)
    {

        $data = $this->appRepository->edit($request , $id, $this->model);
        return $this->response($data);
    }


    public function store(Request $request)
    {
        $data = $this->appRepository->add($request , $this->model);
        return $this->response($data);
    }

    public function destroy($id)
    {
        $data = $this->appRepository->delete( $id, $this->model);
        return '';
    }


}
