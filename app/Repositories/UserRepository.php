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
        return User::create([
            'name'=> $request->name.' '.$request->family,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password),
        ]);
    }

    public function existsWithEmail(string $email): bool
    {
//        return $this->model::where('email', $email)->exists();
        return $this->model->where('email', $email)->exists();
    }
}
