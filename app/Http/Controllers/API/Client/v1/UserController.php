<?php

namespace App\Http\Controllers\API\Client\v1;


use App\Contact;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\ContactUpdateRequest;
use App\Http\Requests\Client\User\RegisterRequest;
use App\Http\Requests\Client\User\ResetPassword;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Services\CreateUser\CreateUser;
use App\Services\CreateUser\ValueObjects\CreateUserValueObject;
use App\User;
use http\Env\Request;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * @var RoleRepository
     */
    protected $roleRepository;
    /**
     * @var UserRepository
     */
    protected $userRepository;

    public function __construct(
        UserRepository $userRepository,
        RoleRepository $roleRepository
    )
    {
        $this->roleRepository = $roleRepository;
        $this->userRepository = $userRepository;
    }





    public function authUser()
    {
        $data = Contact::where('user_id',auth()->id())
            ->with(['user.orders','user.orders.OrderServices','user.orders.OrderServices.person','user.orders.OrderServices.service','user'])
            ->first();
        return $this->response($data);
    }

    public function updateContact(ContactUpdateRequest $request)
    {
        $data = Contact::where('user_id',auth()->id())
            ->with(['user.orders','user.orders.OrderServices','user.orders.OrderServices.person','user.orders.OrderServices.service','user'])
            ->first();
        if (!$data)
        {
            $data = new Contact();
            $data->user_id = auth()->id();

        }
        $data->fill($request->all());
        $data->save();
        return $this->response($data);
    }



    public function register(RegisterRequest $request, CreateUser $createUser)
    {
        $data = $request->all();

        $valueObject = new CreateUserValueObject();
        $valueObject->setName($data['name'])
            ->setEmail($data['email'])
            ->setPassword($data['password']);

        $user = $createUser->create($valueObject);
        event(new Registered($user));

        $credentials = $request->all(['email', 'password']);

        $token = auth('api')->attempt($credentials);

        return response()->json([
            'message' => 'User is registered successfully',
            'token'   => $token,
            'type'    => 'bearer',
            'expires' => auth('api')->factory()->getTTL() * 60, // time to expiration
        ]);
    }

    public function resetPassword(ResetPassword $request)
    {
        $data = $request->all();

        $user = $request->user();

        $user->password = Hash::make($data['password']);

        $user->save();

        event(new PasswordReset($user));

        auth('api')->invalidate();

        return response()->json([
            'message' => 'User password is changed'
        ]);
    }
}
