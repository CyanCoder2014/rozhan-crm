<?php

namespace App\Http\Controllers;

use App\ContactGroup;
use App\Repositories\AppRepositoryImpl;
use Illuminate\Http\Request;

class ContactGroupController extends BaseAPIController
{
    public function __construct(AppRepositoryImpl $appRepository)
    {
        $this->appRepository = $appRepository;
        $this->model = new ContactGroup();
    }
    public function index()
    {
        return parent::dataTables(
            ['title']
        );
        return $this->model->orderBy('id', 'desc')->paginate();
    }

    public function list()
    {
        return $this->model::select('id','title')->get();
    }
    protected function validationRules(){
        return [
            'title'=>['required','string'],
        ];
    }
    protected function validationAttributes(){
        return [];
    }
    protected function validationMessages(){
        return [];
    }
}
