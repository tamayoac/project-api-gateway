<?php

namespace App\Http\Controllers\Admin;

use App\Models\Application;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::with('users')->get();

        return view('admin.applications.index', [
            'applications' => $applications
        ]);
    }
    public function show(Application $application)
    {
        return view('admin.applications.show');
    }
}
