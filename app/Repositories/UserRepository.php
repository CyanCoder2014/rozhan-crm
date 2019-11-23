<?php

namespace App\Repositories;


use App\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    /**
     * @var User
     */
    protected $model;

    // Constructor to bind model to repo
    public function __construct(User $model)
    {
        $this->model = $model;
    }



    public function add($request){

        if(empty($request->password)){
            $password = $request->mobile;
        }else{
            $password = $request->password;
        }

        if(empty($request->name) || empty($request->family)){
            $name = $request->first_name.' '.$request->last_name;
        }else{
            $name = $request->name.' '.$request->family;
        }


//        if(empty($request->email)){
//            $email = $request->mobile;
//        }else{
//            $email = $request->email;
//        }



        return User::create([
            'name'=>$name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => Hash::make($password),
        ]);
    }



public function existsWithEmail(string $email): bool
    {
        return $this->model::where('email', $email)->exists();
    }

    public function find(int $id): ?User
    {
        return $this->model::find($id);
    }



    public function list()
    {
        return $this->model::select('id', 'name', 'email', 'mobile')->get();
    }


}
