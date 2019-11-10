<?php

namespace App\Http\Controllers;

use App\Product;
use App\Repositories\AppRepositoryImpl;

class ProductController extends BaseAPIController
{
    public function __construct(AppRepositoryImpl $appRepository)
    {
        $this->appRepository = $appRepository;
        $this->model = new Product();
    }


    public function index()
    {
        $data = Product::with('productCategory')->get();
        return $this->response($data);
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
//            'parent_id'=>['nullable','exists:products,id'],
            'product_categories_id'=>['required','exists:product_categories,id'],
            'title'=>['string','required'],
//            'image'=>['image'],
//            'type'=>[],
//            'star'=>[],
//            'state'=>[],
        ];
    }
}
