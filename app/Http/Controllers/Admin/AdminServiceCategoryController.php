<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAPIController;
use App\Http\Requests\ServiceCategoryRequest;
use App\Repositories\AppRepositoryImpl;
use App\ServiceCategory;
use Illuminate\Http\Request;

class AdminServiceCategoryController extends BaseAPIController
{
    public function __construct(AppRepositoryImpl $appRepository)
    {
        $this->appRepository = $appRepository;
        $this->model = new ServiceCategory();
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
            'parent_id'=>['nullable','exists:service_categories,id'],
            'title'=>['string','required'],
            'image'=>['image'],
            'description'=>[],
            'number'=>[],
            'star'=>[],
            'type'=>[],
            'state'=>[],
        ];
    }
}
