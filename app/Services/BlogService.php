<?php

namespace App\Services;

use App\Traits\ConsumeExternalService;

class BlogService
{
    use ConsumeExternalService;
    
    public $baseUri;

    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.blogs.base_uri');
    }
    public function fetchBlogs()
    {
        return $this->performRequest('GET', "/blogs");
    }
    public function createBlogs($blogs)
    {
        return $this->performRequest('POST', "/blogs/", $blogs);
    }
}