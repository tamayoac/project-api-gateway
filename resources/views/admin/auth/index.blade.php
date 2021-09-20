@extends('layouts.main')

@section('content')
    <div class="flex justify-center items-center">
        <div class="bg-gradient-to-r from-green-400 to-blue-500 h-1/3 top-0 w-screen absolute "></div>
       
        <form action="{{route('login')}}" method="POST" class="w-full bg-white shadow-md rounded left-0 right-0 px-8 pt-6 pb-8 mb-4 mt-44 z-10 max-w-lg">
            @csrf
            <div class="font-bold text-2xl uppercase text-blue-400 pb-8 w-full">Administrator</div>
            @if(session('success'))
                <div class="text-red-500 text-xs w-full px">{{session('success')}}</div>
            @endif
            <input placeholder="username" 
                class="{{$errors->has('email') ? 'border-red-500' : ''}} appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline bg-white" 
                type="text"
                name="email"
                >
            @error('email')
                <div class="text-xs text-red-500 mb-3">{{$message}}</div>
            @enderror()
            
            <input placeholder="password" 
                    class="{{$errors->has('password') ? 'border-red-500' : ''}} appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline bg-white" 
                    type="password"
                    name="password"
                    >
            @error('password')
                <p class="text-xs text-red-500 mb-3">{{$message}}</p>
            @enderror()
           
            <button type="submit" 
                    class="w-full bg-gradient-to-r from-green-400 to-blue-500 px-2 py-2 text-white rounded-sm">
                    Login
            </button>
        </form>
    </div>
@endsection()