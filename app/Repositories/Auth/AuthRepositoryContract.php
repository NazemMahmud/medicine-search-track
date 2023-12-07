<?php

namespace App\Repositories\Auth;

interface AuthRepositoryContract {
    public function register(array $data): mixed;
}
