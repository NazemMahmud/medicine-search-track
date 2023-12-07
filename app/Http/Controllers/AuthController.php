<?php

namespace App\Http\Controllers;

use App\Helpers\Constants;
use App\Helpers\HttpHandler;
//use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Repositories\Auth\AuthRepositoryContract;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function __construct(protected AuthRepositoryContract $repository)
    {
    }

    public function registration(RegistrationRequest $request): JsonResponse
    {
        if ($this->repository->register($request->all())) {
            return HttpHandler::successMessage('Registration done successfully.', 201);
        }

        return HttpHandler::errorMessage(Constants::SOMETHING_WENT_WRONG);
    }


}
