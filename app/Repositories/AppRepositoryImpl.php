<?php

namespace App\Repositories;



use App\Repositories\Interfaces\AppRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AppRepositoryImpl implements AppRepository
{
    /**
     * @var Role
     */
    protected $model;

    // Constructor to bind model to repo
//    public function __construct(Model $model)
//    {
//        $this->model = $model;
//    }




//    public function searchAndFilter(){}
//    public function filter(){}


    public function getAll( $model)
    {
        return  $model->all();

    }


    public function getPaginated($num = 20, $page = 1,  $model)
    {
        return  $model->paginate($num);

    }


    public function getById($id,  $model)
    {
        return $model->where('id', $id)->first();
    }


    public function add($parameters,  $model)
    {
        $data =  $model->create($parameters);
        return $data;
    }


    public function addArray(){}


    public function edit($parameters, $id,  $model)
    {
        $data =  $model->findOrFail($id);
        $data->update($parameters);

        return $data;
    }


    public function editArray(){}


    public function delete($id,  $model)
    {
        $data =  $model->findOrFail($id);
        $data->delete();

        return '';
    }


    public function deleteArray(){}
    public function changeType(){}
    public function changeState(){}
    public function changeFields(){}
}
