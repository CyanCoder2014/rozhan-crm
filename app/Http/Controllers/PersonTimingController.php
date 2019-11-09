<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonTimingRequest;
use App\PersonTiming;
use App\Repositories\AppRepositoryImpl;
use Illuminate\Http\Request;

class PersonTimingController extends Controller
{

    protected $appRepository;
    protected $model;


    public function __construct(AppRepositoryImpl $appRepository )
    {
        $this->appRepository = $appRepository;
        $this->model = new PersonTiming();

    }





    public function index($person_id)
    {
        $data = PersonTiming::where('person_id',$person_id)->get();

        $data = $this->format_date($data);

        return $this->response($data);
    }


    public function show($person_id,$id)
    {
        $data = $this->appRepository->getById($id,$this->model);
        return $this->response($data);
    }


    public function update(PersonTimingRequest $request,$person_id, $id)
    {

        $data = $this->appRepository->edit($request->casts() , $id, $this->model);
        return $this->response($data);
    }


    public function store(PersonTimingRequest $request,$person_id)
    {
        $data = $this->appRepository->add($request->casts(),$this->model);
        return $this->response($data);
    }

    public function destroy($person_id,$id)
    {
        $data = $this->appRepository->delete( $id, $this->model);
        return '';
    }



    public function format_date($data)
    {
        foreach ($data as $item){
            $item['date']= to_jalali_no_time($item['date']);
            $item['start']= format_time($item['start']);
            $item['end']= format_time($item['end']);
        }
        return $data;
    }
}
