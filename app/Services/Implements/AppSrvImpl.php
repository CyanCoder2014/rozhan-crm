<?php

namespace App\Repositories;



use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AppSrvImpl implements AppSrv
{
    /**
     * @var Role
     */
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Model $model)
    {
        $this->model = $model;
    }




//    public function searchAndFilter(){}
//    public function filter(){}


    public function getAll()
    {
        return Model::all();

    }


    public function getPaginated($num = 20, $page = 1)
    {
        return Model::paginate();

    }


    public function getById($id)
    {
        return $this->model->where('id', $id)->first();
    }


    public function add(Request $request)
    {
        $company = Model::create($request->all());
        return $company;
    }


    public function addArray(){}


    public function edit(Request $request, $id)
    {
        $company = Model::findOrFail($id);
        $company->update($request->all());

        return $company;
    }


    public function editArray(){}


    public function delete($id)
    {
        $company = Model::findOrFail($id);
        $company->delete();

        return '';
    }


    public function deleteArray(){}
    public function changeType(){}
    public function changeState(){}
    public function changeFields(){}
}
