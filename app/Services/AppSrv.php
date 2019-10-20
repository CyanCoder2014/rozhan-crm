<?php

namespace App\Repositories;



use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface AppSrv
{


//    public function searchAndFilter();
//    public function filter();
    public function getAll();
    public function getPaginated($num = 20, $page = 1);
    public function getById($id);
    public function add(Request $request);
    public function addArray();
    public function edit(Request $request, $id);
    public function editArray();
    public function delete($id);
    public function deleteArray();
    public function changeType();
    public function changeState();
    public function changeFields();


}
