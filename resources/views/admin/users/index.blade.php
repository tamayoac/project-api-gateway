@extends('layouts.main')

@section('title', 'Users')

@section('content')

<div class="bg-white shadow p-5 max-w-3xl mx-auto mt-6 z-10">
    <div class="flex justify-between items-center px-5 ">
        <div class="text-lg font-semibold uppercase">
            Users ({{$users->count()}})
        </div>
        <input type="text" placeholder="search" class="appearance-none border rounded w-42 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white">
    </div>
    
    @foreach ($users as $user)
        <div class="bg-gradient-to-r from-green-400 to-blue-500 rounded-sm shadow-sm m-4 p-3">
            <div class="flex justify-between">
                <div class="text-white">{{$user->name}}</div>
                <div class="text-white">
                    <i class="fas fa-envelope px-3"></i>
                    <i class="fas fa-eye"></i>
                </div>
            </div>
        </div>
    @endforeach
</div>

 
@stop