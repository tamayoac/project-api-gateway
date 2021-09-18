<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use ApiResponser;

    public function login(Request $request)
    {
        $http = new \GuzzleHttp\Client;
        
        try {
          
            $response = $http->post(config('services.passport.login_endpoint'), [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' =>  config('services.passport.client_id'),
                    'client_secret' => config('services.passport.client_secret'),
                    'username' => $request->username,
                    'password' => $request->password,
                    'scope' => '*',
                ]
            ]);
           
            return $this->validResponse(json_decode($response->getBody(), true));

        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
           
            if($e->getCode() === 400) {
                return $this->errorResponse([
                    "message" => "Please enter a username or a password."
                ],$e->getCode());
            } elseif($e->getCode() === 401) {
                return $this->errorResponse([
                    "message"=>"Incorrect Credentials. Please try again."
                ], $e->getCode());
            }
            return $this->errorResponse([
                "message" => "Something went wrong on the server."
            ], $e->getCode());
        }
    }
}
