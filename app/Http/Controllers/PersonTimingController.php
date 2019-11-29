<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonTimingRequest;
use App\PersonTiming;
use App\Repositories\AppRepositoryImpl;
use Carbon\Carbon;
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
        $data = PersonTiming::where('person_id',$person_id)->orderBy('date', 'desc')->paginate();

        $data = $this->format_date($data);

        return $data;
//        return $this->response($data);
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

        if($request->description == true){

            for ($i = 0; $i <= 30; $i++){

                if (date('w', strtotime($request->castsforDays($i)['date']))  != '5' )
                $data = $this->appRepository->add($request->castsforDays($i),$this->model);
            }

        }else{
            $data = $this->appRepository->add($request->casts(),$this->model);

        }
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
