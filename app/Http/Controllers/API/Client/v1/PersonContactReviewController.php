<?php


namespace App\Http\Controllers\API\Client\v1;


use App\Contact;
use App\ContactReview;
use App\Http\Controllers\ContactReviewController;
use App\Http\Requests\ContactReviewRequest;
use Illuminate\Validation\ValidationException;

class PersonContactReviewController extends ContactReviewController
{
    public function PersonCustomers()
    {
        $user = auth()->user();
        if (!$user->person)
            ValidationException::withMessages(['person' => 'شما جزو پرسنل نیستید']);
        return Contact::whereIn('id',$user->person->CustomerContactIds())->get();

    }
    public function index($contact)
    {
        $user = auth()->user();
        if (!$user->person)
            ValidationException::withMessages(['person' => 'شما جزو پرسنل نیستید']);
        if (!in_array($contact,$user->person->CustomerContactIds()))
            ValidationException::withMessages(['person' => 'این کاربر جزو مشتریان شما نیست']);

        return parent::index($contact);
    }

    public function store(ContactReviewRequest $request, $contact)
    {
        $user = auth()->user();
        if (!$user->person)
            ValidationException::withMessages(['person' => 'شما جزو پرسنل نیستید']);
        if (!in_array($contact,$user->person->CustomerContactIds()))
            ValidationException::withMessages(['person' => 'این کاربر جزو مشتریان شما نیست']);
        return parent::store($request, $contact);
    }

    public function update(ContactReviewRequest $request, $contact, $id)
    {
        $user = auth()->user();
        if (!$user->person)
            ValidationException::withMessages(['person' => 'شما جزو پرسنل نیستید']);
        if (!in_array($contact,$user->person->CustomerContactIds()))
            ValidationException::withMessages(['person' => 'این کاربر جزو مشتریان شما نیست']);
        return parent::update($request, $contact, $id);
    }

    public function destroy($id,$contact)
    {
        $user = auth()->user();
        if (!$user->person)
            ValidationException::withMessages(['person' => 'شما جزو پرسنل نیستید']);
        if (!in_array($contact,$user->person->CustomerContactIds()))
            ValidationException::withMessages(['person' => 'این کاربر جزو مشتریان شما نیست']);
        return parent::destroy($id,$contact);
    }

}