<?php

namespace App\Http\Controllers;

use App\Repositories\AppRepositoryImpl;
use App\Service;

class ServiceController extends BaseAPIController
{
    public function __construct(AppRepositoryImpl $appRepository)
    {
        $this->appRepository = $appRepository;
        $this->model = new Service();
    }


    public function list()
    {
        return $this->model::select('id','title')->get();
    }
    public function index()
    {
        $data = Service::with('serviceCategory')->with('persons')->paginate();
        return $data;
        return $this->response($data);
    }


    public function store()
    {
        // if(\request()->hasFile('image'))
        //  dd(true);
        \request()->request->add(['created_by' => auth()->id()]);
        return parent::store();
    }


    public function update($id)
    {
        \request()->request->add(['updated_by' => auth()->id()]);
        return parent::update($id);
    }


    protected function validationRules()
    {
        return [
            'parent_id'=>['nullable','exists:services,id'],
            'service_categories_id'=>['required','exists:service_categories,id'],
            'title'=>['string','required'],
//            'image'=>['image'],
            'description'=>[],
            'initial_number'=>[],
            'remaining_number'=>[],
            'blocked_number'=>[],
            'reserved'=>[],
            'price'=>['required','integer'],
            'default_discount'=>['nullable','integer'],
            'tax'=>['required','integer'],
            'min_time'=>['nullable','integer'],
            'max_time'=>['required','integer'],
            'type'=>[],
            'star'=>[],
            'state'=>[],
        ];
    }
}
