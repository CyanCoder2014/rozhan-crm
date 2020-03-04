<?php

namespace App\Http\Controllers\API\Admin\v1;


use App\Contact;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\CreateRequest;
use App\Repositories\AppRepositoryImpl;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Services\CreateUser\CreateUser;
use App\Services\CreateUser\ValueObjects\CreateUserValueObject;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $userRepository;
    protected $appRepository;


    public function __construct(UserRepository $userRepository,AppRepositoryImpl $appRepository)
    {
        $this->userRepository = $userRepository;
        $this->appRepository = $appRepository;
    }



    public function list()
    {
        $users = $this->userRepository->list();

        return response()->json([
            'status' => true,
            'data'   => $users
        ]);
    }



    public function create(CreateRequest $request, CreateUser $createUser)
    {
        \request()->request->add(['first_name' => request('name')]);
        $data = $request->all();

        $valueObject = new CreateUserValueObject();
        $valueObject->setName($data['name'])
            ->setEmail($data['email'])
            ->setPassword($data['password']);

        $user = $createUser->create($valueObject);
        $data['user_id'] = $user->id;
        $this->appRepository->add($data , new Contact());

        return response()->json([
            'status'  => true,
            'result'  => $user,
            'message' => 'User is created successfully!'
        ]);
    }


    public function destroy($id)
    {
        if ($id == 1)
            abort(404);

        $user = User::find($id);
        $user->delete();

        $contact = Contact::where('user_id',$id);
        $contact->delete();


        return '';

    }




    public function update(Request $request, $id)
    {
//        \request()->request->add(['first_name' => request('name')]);
//        $data = $request->all();
//
//        $valueObject = new CreateUserValueObject();
//        $valueObject->setName($data['name'])
//            ->setEmail($data['email'])
//            ->setPassword($data['password']);

//        $order = User::findOrFail($id);
//        if($order == null)
//            return ['message' =>'User is not existed'];
//
//
//        $user = $createUser->create($valueObject);
//        $data['user_id'] = $user->id;
//        $this->appRepository->add($data , new Contact());
//
//        $order->name = $request;
//        $order->email = $request;
//        $order->mobile = $request;
//        $order->pasword = $request;
//        $order->save();

        $user =$this->userRepository->update(\request(),$id);


        return response()->json([
            'status'  => true,
            'result'  => $user,
            'message' => 'User is updated successfully!'
        ]);
    }



}
