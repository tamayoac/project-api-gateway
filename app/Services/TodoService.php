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
    public function fetchTodo($todo, $user)
    {
        return $this->performRequest('GET', "/todos/{$user}/{$todo}");
    }
    public function updateTodo($data, $todo, $user)
    {
        return $this->performRequest('PUT', "/todos/{$user}/{$todo}", $data);
    }
    public function destroyTodo($todo, $user)
    {
        return $this->performRequest('DELETE', "/todos/{$user}/{$todo}");
    }
    public function updateStatus($todo, $user)
    {
        return $this->performRequest('GET', "/todos/{$user}/{$todo}");
    }
}
