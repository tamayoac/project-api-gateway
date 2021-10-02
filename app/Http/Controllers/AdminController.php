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

        $users = User::whereHas('roles', function($q) {
            $q->where('role_id', 2);
        })->get();

        $users->load('applications');

        return view('admin.users.index', [
            'users' => $users
        ]); 
    }
}
