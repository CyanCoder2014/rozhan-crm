<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Person;
use App\Repositories\AppRepositoryImpl;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseAPIController
{

    protected $userRepository;


    public function __construct(AppRepositoryImpl $appRepository,UserRepository $userRepository)
    {
        $this->appRepository = $appRepository;
        $this->userRepository = $userRepository;
        $this->model = new User();
    }


    public function list()
    {
        return $this->model->select('id','name')->get();
    }

    public function getCurrentUser(){

        $user = Auth::user();
        $contact = Contact::where('user_id', Auth::id())->first();
        $person = Person::where('user_id', Auth::id())->first();

        $data = ['user' => $user, 'contact' => $contact, 'person' =>  $person];

        return $this->response($data);

    }
    public function show($id)
    {
        $data = User::with('contact','person')->findOrFail($id);
        return $this->response($data);
    }




    public function update($id)
    {
        \request()->validate($this->validationRules(),$this->validationMessages(),$this->validationAttributes());

//        $data =$this->userRepository->update(\request(),$id);


            $user = User::findOrFail($id);
            $user->password =  Hash::make(\request()->password);
            $user->mobile =  \request()->mobile;
            $user->email =  \request()->email;
            $user->name = \request()->name;
            $user->save();


        return $this->response($user);
    }





    public function getCurrentUserUnreadedNotification(Request $request){

        $contact = Contact::where('user_id', Auth::id())->first();
        if ($contact)
        {
            if (!$request->date_from && !$request->date_to)
                return $contact->unreadNotifications()->paginate();
            $notifications = $contact->notifications();
            if (validate_jalili($request->date_from))
                $notifications->whereDate('created_at','>=',to_georgian_date($request->date_from));
            if (validate_jalili($request->date_to))
                $notifications->whereDate('created_at','<=',to_georgian_date($request->date_to));

            return $notifications->paginate();


        }

        return $this->response([],'کاربر اطلاعات تماس ندارد',400);

    }
    public function readNotification(Request $request){

        $contact = Contact::where('user_id', Auth::id())->first();
        if ($contact)
        {
            if (is_array($request->id))
                $contact->unreadNotifications()->whereIn('id',$request->id)->update(['read_at' => now()]);
            else
                $contact->unreadNotifications()->where('id',$request->id)->update(['read_at' => now()]);

            return $this->response([],'success',200);
        }

        return $this->response([],'کاربر اطلاعات تماس ندارد',400);

    }





    protected function validationRules()
    {
        return [
            'name'=>['required'],
//            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', 'string', 'min:10', 'max:11', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }
}
