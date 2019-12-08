<?php

namespace App\Http\Controllers;

use App\Product;
use App\Repositories\AppRepositoryImpl;
use App\ScoreGifts;
use App\Service;
use Illuminate\Http\Request;

class ScoreGiftsController  extends BaseAPIController
{
    public function __construct(AppRepositoryImpl $appRepository)
    {
        $this->appRepository = $appRepository;
        $this->model = new ScoreGifts();
    }
    public function list()
    {
        return $this->model::select('id','title')->get();
    }
    public function index()
    {
        $data = $this->model::paginate();
        $data->getCollection()->transform(function ($value) {
            if($value->reference_type == Service::class)
                $value->service = $value->reference()->first();
            if($value->reference_type == Product::class)
                $value->product = $value->reference()->first();
            return $value;
        });
        return $data;
    }
    public function store()
    {
        if (\request('product_id'))
            \request()->request->add(['reference_type'=>Product::class,'reference_id' => \request('product_id')]);
        if (\request('service_id'))
            \request()->request->add(['reference_type'=>Service::class,'reference_id' => \request('service_id')]);
        return parent::store();
    }
    public function update($id)
    {
        if (\request('product_id'))
            \request()->request->add(['reference_type'=>Product::class,'reference_id' => \request('product_id')]);
        if (\request('service_id'))
            \request()->request->add(['reference_type'=>Service::class,'reference_id' => \request('service_id')]);
        return parent::update($id);
    }

    public function show($id)
    {
        $data = $this->model::findOrFail($id);
        if($data->reference_type == Service::class)
            $data->service = $data->reference()->first();
        if($data->reference_type == Product::class)
            $data->product = $data->reference()->first();
        return $this->response($data);

    }
    protected function validationRules(){
        return [
            'score'=>['required','integer'],
            'product_id'=>['required_without:service_id', 'exists:products,id'],
            'service_id'=>['required_without:product_id', 'exists:services,id'],
        ];
    }
    protected function validationAttributes(){
        return [];
    }
    protected function validationMessages(){
        return [];
    }
}
