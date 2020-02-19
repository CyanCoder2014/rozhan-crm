<?php


namespace App\Repositories;


use App\ContactReview;
use Illuminate\Validation\ValidationException;

class ContactReviewRepository
{
    public function add($parameter)
    {

        $user = auth()->user();
//        if (!$user->person)
//            ValidationException::withMessages(['person' => 'شما جزو پرسنل نیستید']);
        $parameter['created_by'] = $user->id;
//        $parameter['person_id'] = $user->person->id;

        return ContactReview::create($parameter);
    }
    public function edit($parameter,ContactReview $contactReview)
    {
        $parameter['created_by'] = auth()->id();
        return $contactReview->update($parameter);
    }
    public function delete($id, ContactReview $contactReview)
    {
////        return $contactReview->delete();
//
//        $data =  ContactReview::findOrFail($id);
//        $data->delete();
    }

}