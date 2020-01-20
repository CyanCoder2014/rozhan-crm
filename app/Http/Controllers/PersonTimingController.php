<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonTimingRequest;
use App\PersonTiming;
use App\Repositories\AppRepositoryImpl;
use App\VacationDate;
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

        $data = $this->edit($request->casts() , $id);
        return $this->response($data,$data['message']??null,$data['status']??200);
    }


    public function store(PersonTimingRequest $request,$person_id)
    {

        if($request->description == true){

            $data = [];
            for ($i = 0; $i <= 30; $i++){

                if (date('w', strtotime($request->castsforDays($i)['date']))  != '5' && !VacationDate::where('date',$request->castsforDays($i)['date'])->first() )
                    $data[] = $this->add($request->castsforDays($i));
            }

        }else{
            $data = $this->add($request->casts());

        }
        return $this->response($data);
    }

    public function destroy($person_id,$id)
    {
        $data = $this->appRepository->delete( $id, $this->model);
        return '';
    }


    public function add($parametes)
    {
        $priviouses= $this->model::where('date',$parametes['date'])->where('person_id',$parametes['person_id'])->get();
        foreach ($priviouses as $privious)
        {
            if ((strTimeToInt($privious->start)<= strTimeToInt($parametes['start']) && strTimeToInt($privious->end)> strTimeToInt($parametes['start'])) ||
                (strTimeToInt($privious->start)< strTimeToInt($parametes['end']) && strTimeToInt($privious->end) >= strTimeToInt($parametes['end']))
                )
            {
                $privious->fill($parametes);
                $privious->save();
                return $privious;
            }
        }
        return $this->appRepository->add($parametes,$this->model);

    }
    public function edit($parametes,$id)
    {
        $priviouses= $this->model::where('id','!=',$id)->where('date',$parametes['date'])->get();
        foreach ($priviouses as $privious)
        {
            if ((strTimeToInt($privious->start)<= strTimeToInt($parametes['start']) && strTimeToInt($privious->end)> strTimeToInt($parametes['start'])) ||
                (strTimeToInt($privious->start)< strTimeToInt($parametes['end']) && strTimeToInt($privious->end) >= strTimeToInt($parametes['end']))
                )
            {

                return array('data'=>null,'message'=>'با رکورد دیگری تداخل دارد','status'=>400);
            }
        }
        return $this->appRepository->edit($parametes,$id,$this->model);

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
