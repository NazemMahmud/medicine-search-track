<?php

namespace App\Repositories\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthRepositoryEloquent implements AuthRepositoryContract {

    public function __construct(protected User $model)
    {
    }

    /**
     * New user register
     *
     * @param array $data
     * @return mixed
     */
    public function register(array $data): mixed
    {
        return $this->model::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }
}
