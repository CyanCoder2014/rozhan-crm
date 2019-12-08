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
