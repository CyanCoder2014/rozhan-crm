<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonServiceRequest;
use App\PersonService;
use App\Repositories\PersonServicesRepository;
use Illuminate\Http\Request;

class PersonServicesController extends Controller
{

    protected $appRepository;
    protected $model;


    public function __construct(PersonServicesRepository $appRepository )
    {
        $this->appRepository = $appRepository;
        $this->model = new PersonService();

    }





    public function index($person_id)
    {
        $data = PersonService::where('person_id',$person_id)->get();
        return $this->response($data);
    }


//    public function show($person_id,$id)
//    {
//        $data = $this->appRepository->getById($id,$this->model);
//        return $this->response($data);
//    }

    public function update(PersonServiceRequest $request,$person_id)
    {

        $data = $this->appRepository->edit($request->all() , $person_id);
        return $this->response($data);
    }


    public function store(PersonServiceRequest $request,$person_id)
    {
        $data = $this->appRepository->edit($request->all(),$person_id);
        return $this->response($data);
    }

}
