<?php

namespace App\Repositories\Interfaces;



use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface AppRepository
{


//    public function searchAndFilter();
//    public function filter();
    public function getAll( $model);
    public function getPaginated($num = 20, $page = 1,  $model);
    public function getById($id,  $model);
    public function add(Request $request,  $model);
    public function addArray();
    public function edit(Request $request, $id,  $model);
    public function editArray();
    public function delete($id,  $model);
    public function deleteArray();
    public function changeType();
    public function changeState();
    public function changeFields();


}
