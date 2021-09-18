<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Services\TodoService;
use Illuminate\Http\Response;

class TodoController extends Controller
{
    use ApiResponser;

    public $todoService;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }
    public function index(Request $request)
    {
        $user = $request->user()->id;

       

        $response = $this->todoService->fetchTodos($user);

        return $this->successResponse($response);
    }
    public function store(Request $request )
    {   
        $user = $request->user()->id;

        $response = $this->todoService->createTodos($request->all(), $user);

        return $this->successResponse($response, Response::HTTP_CREATED);
    }
    public function show($todo)
    {
        return $this->successResponse($this->todoService->fetchTodo($todo));
    }
    public function update(Request $request, $todo)
    {
        return $this->successResponse($this->todoService->updateTodo($request->all(), $todo));
    }
    public function destory($todo)
    {
        return $this->successResponse($this->todoService->destroyTodo($todo));
    }
}
