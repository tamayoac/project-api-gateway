<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        abort_if(!Auth::user(), 403);
        
        $users = User::all();

        return view('admin.users.index', [
            'users' => $users
        ]); 
    }
}
