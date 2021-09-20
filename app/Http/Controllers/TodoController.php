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
    public function index()
    {
        $user = auth()->user()->id;
       
        $response = $this->todoService->fetchTodos($user);

        return $this->successResponse($response);
    }
    public function store(Request $request )
    {   
        $user = auth()->user()->id;

        $response = $this->todoService->createTodos($request->all(), $user);

        return $this->successResponse($response, Response::HTTP_CREATED);
    }
    public function show($todo)
    {
        $user = auth()->user()->id;

        return $this->successResponse($this->todoService->fetchTodo($todo, $user));
    }
    public function update(Request $request, $todo)
    {
        $user = auth()->user()->id;

        return $this->successResponse($this->todoService->updateTodo($request->all(), $todo, $user));
    }
    public function destory($todo)
    {
        $user = auth()->user()->id;

        return $this->successResponse($this->todoService->destroyTodo($todo, $user));
    }
}
