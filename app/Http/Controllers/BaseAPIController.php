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

    public function dataTables(array $columns,array $search_column=null,array $with=null,array $withColumn=null)
    {
        if (!$search_column)
            $search_column = $columns;
        if ( \request()->input('showdata') ) {
            return $this->model::orderBy('created_at', 'desc')->get();
        }
        $length = \request()->input('length',15);
        $column = \request()->input('column');
        $order = \request()->input('order','desc');
        $search_input = \request()->input('search');
        $query = $this->model::select(array_merge($columns,['id','created_at']))
            ->orderBy($columns[$column]??'id',$order);
        if ($with)
            $query->with($with);
        if ($search_input) {
            $query->where(function($query) use ($search_input,$search_column) {

                foreach ($search_column as $key => $column)
                    if ($key == array_key_first($search_column))
                        $query->where($column, 'like', '%' . $search_input . '%');
                    else
                        $query->orWhere($column, 'like', '%' . $search_input . '%');
//                    ->orWhere('mobile', 'like', '%' . $search_input . '%')
//                    ->orWhere('email', 'like', '%' . $search_input . '%')
//                    ->orWhere('tell', 'like', '%' . $search_input . '%');
//                    ->orWhere('created_at', 'like', '%' . $search_input . '%');
            });
        }
        $data = $query->paginate($length);
        return $data;
        return  $this->response($data);
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
