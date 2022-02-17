<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Requests\LoginFormValidation;

class LoginController extends Controller
{
    use ApiResponser;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginFormValidation $request)
    {

        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = auth()->user();

            if ($user->checkClientApp($request->header('Application')) && $user->hasRole("Client")) {
                $token = $user->createToken($user->email . '_' . now());
                $expire = $token->token->expires_at->diffInSeconds(Carbon::now());

                return $this->validResponse([
                    "access_token" => $token->accessToken,
                    "expires_in" => $expire
                ]);
            } else {
                return $this->errorResponse("Unauthorized", 401);
            }
        }
        return $this->errorResponse("Invalid Username or Password", 400);
        // $response = $this->authService->login($request);

        // return $this->validResponse($response);
    }
    public function logout()
    {
        auth()->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });
        return $this->validResponse([
            "message" => "Successfully Logout"
        ]);
    }
    public function generateAccessToken($user)
    {
        return $user->createToken($user->email . '_' . now())->accessToken;
    }
}
