<?php


namespace App\Repositories;


use App\PersonService;

class PersonServicesRepository
{
//    public function add($parameters, $model)
//    {
//        $output=[];
//        foreach ($parameters['services'] as $service){
//            $service['person_id'] = $parameters['person_id'];
//            $output[] = parent::add($service, $model);
//        }
//        return $output;
//    }
    public function edit($parameters, $person_id)
    {
        $personServices = PersonService::where('person_id',$person_id)->get();
        $output=[];
        foreach ($parameters['services']??[] as $service){
            if ($personServices->count() > 0){
                $model = $personServices->shift();
                $model->updated_by = auth()->id();
            }
            else{
                $model = new PersonService();
                $model->created_by = auth()->id();
            }
            $model->fill($service);
            $model->person_id = $parameters['person_id'];
            $model->save();
            $output[] = $model;
        }
        if ($personServices->count() > 0)
            PersonService::whereIn('id',$personServices->pluck('id'))->delete();
        return $output;
    }

}