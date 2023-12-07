<?php

namespace App\Http\Controllers;

use App\Helpers\Constants;
use App\Helpers\HttpHandler;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Repositories\Auth\AuthRepositoryContract;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function __construct(protected AuthRepositoryContract $repository)
    {
    }

    /**
     * @param RegistrationRequest $request
     * @return JsonResponse
     */
    public function registration(RegistrationRequest $request): JsonResponse
    {
        if ($this->repository->register($request->all())) {
            return HttpHandler::successMessage('Registration done successfully.', 201);
        }

        return HttpHandler::errorMessage(Constants::SOMETHING_WENT_WRONG);
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $requestData =$request->only('email', 'password');;

        if (!$token = auth()->attempt($requestData)) {
            return HttpHandler::errorMessage('Invalid email or password', 422);
        }

        return HttpHandler::successResponse($this->respondWithToken($token)->original);
    }

    /**
     * Get the token array structure for login.
     * @param string $token
     * @return JsonResponse
     */
    protected function respondWithToken(string $token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
