<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Services\BlogService;
use Illuminate\Http\Response;

class BlogController extends Controller
{
    use ApiResponser;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }
    public function index()
    {
        $response = $this->blogService->fetchBlogs();

        return $this->successResponse($response);
    }
    public function store(Request $request)
    {

        $response = $this->blogService->createBlogs($request->all(), "");

        return $this->successResponse($response, Response::HTTP_CREATED);
    }
}
