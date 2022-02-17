@extends('layouts.main')

@section('title', 'Users')

@section('content')
<div class="py-2 max-w-3xl mx-auto my-3">
    <a class="bg-gradient-to-r from-green-400 to-blue-500 text-white px-3 py-1 rounded-sm" href="{{route('users.index')}}">Back</a>
</div>
<div class="bg-white shadow p-5 max-w-3xl mx-auto z-10">
    <div class="flex flex-col">
        <div>
            <label for="">Name</label>
            {{$user->name}}
        </div>
        <div>
            <label for="">Email</label>
            {{$user->email}}</div>
        <div>
            <label for="">Account Created: </label>
            {{\Carbon\Carbon::parse($user->created_at)->format('l jS \of F Y h:i:s A')}}</div>
        <div>{{$user->applications->first()->name}}</div>
    </div>
</div>

@stop