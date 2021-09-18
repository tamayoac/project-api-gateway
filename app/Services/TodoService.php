<?php

namespace App\Services;

use App\Traits\ConsumeExternalService;

class TodoService
{
    use ConsumeExternalService;
    
    public $baseUri;

    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.todos.base_uri');
        $this->secret = config('services.todos.secret');
    }
    public function fetchTodos($user)
    {
        return $this->performRequest('GET', "/todos/{$user}");
    }
    public function createTodos($todos, $user)
    {
        return $this->performRequest('POST', "/todos/${user}", $todos);
    } 
    public function fetchTodo($todo)
    {
        return $this->performRequest('GET', "/todos/{$todo}");
    }
    public function updateTodo($data, $todo)
    {
        return $this->performRequest('PUT', "/todos/{$todo}", $data);
    }
    public function destroyTodo($todo)
    {
        return $this->performRequest('DELETE', "/todos/{$todo}");
    }
}