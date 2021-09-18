@extends('layouts.main')

@section('title', 'Users')

@section('content')
   
    <div class="bg-white shadow p-5 w-1/2 left-0 right-0 mx-auto mt-6">
        <div class="px-5 text-lg font-semibold uppercase">
            Users ({{$users->count()}})
        </div>
        @foreach ($users as $user)
            <div class="bg-gradient-to-r from-green-400 to-blue-500 rounded-sm shadow-sm m-4 p-3">
                <div class="flex justify-between">
                    <div class="text-white">{{$user->name}}</div>
                    <div class="text-white"></div>
                </div>
            </div>
        @endforeach
    </div>
 
@stop