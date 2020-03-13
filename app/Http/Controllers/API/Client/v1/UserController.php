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
use App\Services\UploadFileService\UploadImageService;
use App\Services\UserScoreService\UserScoreService;
use App\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    protected $imageService;
    protected $scoreService;

    public function __construct(
        UserRepository $userRepository,
        RoleRepository $roleRepository,
        UploadImageService $imageService,
        UserScoreService $scoreService
    )
    {
        $this->roleRepository = $roleRepository;
        $this->userRepository = $userRepository;
        $this->imageService =$imageService;
        $this->scoreService =$scoreService;


    }


    public function authUser()
    {
        $data = Contact::where('user_id',auth()->id())
            ->with(['user.orders','user.orders.OrderServices','user.orders.OrderServices.person','user.orders.OrderServices.service','user'])
            ->first();
        $data->score = $this->scoreService->getScore($data->user);
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
        $parameters = $request->all();
        if(\request()->hasFile('image'))
            $parameters['image'] = $this->imageService->upload('image')->resize(100,100)->getFileAddress();
        $data->fill($parameters);
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
}
