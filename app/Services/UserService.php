<?php

namespace App\Services;

use App\Traits\ConsumeExternalService;

class UserService
{
    use ConsumeExternalService;
    
    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.users.base_uri');
    }
}