<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function index()
    {
        abort_if(!Auth::user(), 403);

        $users = User::whereHas('roles', function ($q) {
            $q->where('role_id', 2);
        })->get();

        $users->load('applications');

        return view('admin.users.index', [
            'users' => $users
        ]);
    }
    public function show(User $user)
    {
        return view('admin.users.show', [
            'user' => $user
        ]);
    }
    public function dashboard()
    {

        $users = User::whereHas('roles', function ($q) {
            $q->where('role_id', 2);
        })->with('applications')->get();

        $applications = Application::withCount(['users'])->get();

        $application_list = [];
        $users_count = [];
        foreach ($applications->toArray() as $application) {

            $application_list[] = $application['name'];
            $users_count[] = $application['users_count'];
        }

        return view('admin.dashboard.index', [
            'users' => $users,
            'applications' => $applications,
            'users_count' => $users_count,
            'application_list' => $application_list
        ]);
    }
}
