<?php

namespace App\Http\Controllers;

use App\Product;
use App\Repositories\AppRepositoryImpl;
use App\Services\UploadFileService\UploadImageService;

class ProductController extends BaseAPIController
{
    protected  $imageService;
    public function __construct(AppRepositoryImpl $appRepository,UploadImageService $imageService)
    {
        $this->appRepository = $appRepository;
        $this->model = new Product();
        $this->imageService = $imageService;
    }


    public function index()
    {
        $data = parent::dataTables(
            ['product_id', 'product_category_id', 'title', 'image', 'description', 'initial_amount', 'remaining_number', 'blocked_number', 'price', 'predicted_price', 'default_discount', 'tax', 'min_time', 'max_time', 'type', 'star', 'state','score'],
            ['title', 'description',],
            ['productCategory']
        );
        $data->getCollection()->transform(function ($value) {
            $value->notAvailable = $value->notAvailable()->sum('amount');
            $value->Buyed = $value->Buyed()->sum('amount');
            return $value;
        });
//        $data = Product::with('productCategory')->paginate();
        return $data;
//        return $this->response($data);
    }

    public function list()
    {
        $data = $this->model::select('id','title', 'description','remaining_number', 'price', 'type',  'image','state')->paginate(1000);
//        foreach ($data as $row)
//        {
//            $row->notAvailable = $row->notAvailable()->sum('amount');
//            $row->Buyed = $row->Buyed()->sum('amount');
//
//        }
        return $data;

    }
    public function show($id)
    {
        $row =  Product::with('productCategory')->findOrFail($id);
        $row->notAvailable = $row->notAvailable()->sum('amount');
        $row->Buyed = $row->Buyed()->sum('amount');
        return $row;
    }

    public function store()
    {
        \request()->validate($this->validationRules(),$this->validationMessages(),$this->validationAttributes());

        \request()->request->add(['created_by' => auth()->id()]);
        $parameters = \request()->all();
        if(\request()->hasFile('image'))
            $parameters['image'] = $this->imageService->upload('image')->resize(100,100)->getFileAddress();



        $data = $this->appRepository->add( $parameters,$this->model);
        return $this->response($data);
    }



    public function update($id)
    {
        \request()->validate($this->validationRules(),$this->validationMessages(),$this->validationAttributes());

        \request()->request->add(['updated_by' => auth()->id()]);
        $parameters = \request()->all();
        if(\request()->hasFile('image'))
            $parameters['image'] = $this->imageService->upload('image')->resize(100,100)->getFileAddress();

        $data = $this->appRepository->edit( $parameters, $id,$this->model);
        return $this->response($data);
    }




    protected function validationRules()
    {
        return [
//            'parent_id'=>['nullable','exists:products,id'],
            'product_category_id'=>['required'],
            'title'=>['string','required'],
//            'image'=>['image'],
//            'type'=>[],
//            'star'=>[],
//            'state'=>[],
        ];
    }
}
