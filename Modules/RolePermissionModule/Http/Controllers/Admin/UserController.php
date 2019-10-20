<?php

namespace Modules\RolePermissionModule\Http\Controllers\Admin;

use App\ChatConnection;
use App\ChatUserData;
use App\Contents\Course;
use App\Contents\CourseComment;
use App\Contents\Event;
use App\Contents\File;
use App\Contents\Forum;
use App\Contents\ForumCat;
use App\Contents\ForumComment;
use App\Contents\ForumPost;
use App\Contents\Post;
use App\Contents\PostComment;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use App\UserActivity;
use App\UserEdu;
use App\UserProfile;
use App\UserSkill;
use App\UserWork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index()
    {
        $users = User::has('roles')->with('roles')->orderby('id','desc')->paginate(25);

        return view('rolepermissionmodule::admin.user.index',['users'=>$users]);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'roles' =>'required|array',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'mobile' => 'required|string|digits:11|unique:users'
        ]);
        $user = new User();

        $user->name = $request->firstname;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->status    =  '1';
        $user->save();
        $user->syncRoles($request->roles);
        return back()->with('message', 'عملیات شما با موفقیت انجام شد ');
    }
    public function update(Request $request, $id)
    {
        if ($id != 1 )// cannot edit super admin
        {
            $this->validate($request,[
                'roles' =>'required|array'
            ]);
            $user_ = User::find($id);
            $user_->syncRoles($request->roles);
        }

        return back()->with('message', 'عملیات شما با موفقیت انجام شد ');
    }




}
