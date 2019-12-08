<?php

namespace App\Http\Controllers;


use App\ProductCategory;
use App\Repositories\AppRepositoryImpl;

class ProductCategoryController extends BaseAPIController
{
    public function __construct(AppRepositoryImpl $appRepository)
    {
        $this->appRepository = $appRepository;
        $this->model = new ProductCategory();
    }

    public function index()
    {
        return $this->model::paginate();
    }

    public function list()
    {
        return $this->model::select('id','title')->get();
    }
    public function store()
    {
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
//            'parent_id'=>['nullable','exists:product_categories,id'],
            'title'=>['string','required'],
//            'image'=>['image'],
//            'description'=>[],
//            'number'=>[],
//            'star'=>[],
//            'type'=>[],
//            'state'=>[],
        ];
    }
}
