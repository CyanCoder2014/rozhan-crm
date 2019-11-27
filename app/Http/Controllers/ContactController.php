<?php

namespace App\Http\Controllers;


use App\Contact;
use App\Person;
use App\Repositories\Interfaces\AppRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;

class ContactController extends BaseAPIController
{
    /**
     * @var RoleRepository
     */
    protected $ContactRepository;
    protected $contact;

    protected $userRepository;

    /**
     * @var UserRepository
     */

    public function __construct(AppRepository $appRepository,UserRepository $userRepository)
    {
        $this->appRepository = $appRepository;
        $this->model = new Contact();

        $this->person = new Person();
        $this->userRepository = $userRepository;
    }

    public function list()
    {
        return $this->model::select('id','first_name', 'last_name')->get();
    }

    public function index()
    {
        return $this->model::paginate();
    }


    public function show($id)
    {
        $data = Contact::where('id',$id)
            ->with(['user.orders','user.orders.OrderServices','user.orders.OrderServices.person','user.orders.OrderServices.service','user'])
            ->first();
        return $this->response($data);
    }


    public function store()
    {


        request()->validate([
            ////////// user validation ////////////////
            'first_name'=>['required'],
            'last_name'=>['required'],
//            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', 'string', 'digits:11', 'unique:users'],
//            'password' => ['required', 'string', 'min:8']
]);
        $user =$this->userRepository->add(\request());
        \request()->request->add(['created_by' => auth()->id(),'user_id' => $user->id]);
        return parent::store();
    }





    protected function validationRules()
    {
        return [

            'first_name'=>['string','required'],
            'last_name'=>['string','required'],
            'mobile'=>['string','required'],
//            'email'=>['string','required'],
//            'image'=>['image'],



        ];
    }




}
