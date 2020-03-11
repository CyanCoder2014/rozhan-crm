<?php

namespace App\Http\Controllers;

use App\Repositories\AppRepositoryImpl;
use App\Service;
use App\Services\UploadFileService\UploadImageService;

class ServiceController extends BaseAPIController
{
    protected $imageService;
    public function __construct(AppRepositoryImpl $appRepository,UploadImageService $imageService)
    {
        $this->appRepository = $appRepository;
        $this->model = new Service();
        $this->imageService =$imageService;
    }


    public function list()
    {
        return $this->model->select('id','title')->orderBy('id', 'desc')->get();
    }
    public function index()
    {
        return parent::dataTables(
            ['parent_id', 'service_categories_id', 'title', 'image', 'description', 'initial_number', 'remaining_number', 'blocked_number', 'reserved', 'price', 'predicted_price', 'default_discount', 'tax', 'min_time', 'max_time', 'type', 'star', 'state','score',],
            ['title', 'description'],
            ['persons','serviceCategory']
        );
        $data = Service::with('serviceCategory')->with('persons')->orderBy('id', 'desc')->orderBy('service_categories_id', 'desc')->paginate();
        return $data;
        return $this->response($data);
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
