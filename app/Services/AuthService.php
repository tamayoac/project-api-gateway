<?php

namespace App\Services;

use App\Traits\ConsumeExternalService;

class AuthService
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.passport.login_endpoint');
        $this->clientId = config('services.passport.client_id');
        $this->clienetSecret = config('services.passport.client_secret');
    }
    public function login($loginData)
    {
        $data = array(
            'grant_type' => 'password',
            'client_id' =>  $this->clientId,
            'client_secret' =>  $this->clienetSecret,
            'username' => $loginData['username'],
            'password' => $loginData['password'],
        );

        return $this->performRequest('POST', "/oauth/token", $data);
    }
}
