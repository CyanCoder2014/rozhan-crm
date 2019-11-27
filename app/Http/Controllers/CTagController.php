<?php

namespace App\Http\Controllers;

use App\CTag;
use App\Repositories\AppRepositoryImpl;
use Illuminate\Http\Request;

class CTagController extends BaseAPIController
{
    public function __construct(AppRepositoryImpl $appRepository)
    {
        $this->appRepository = $appRepository;
        $this->model = new CTag();
    }
    public function index()
    {
        return $this->model::paginate();
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
