@extends('layouts.app')

@section('title', 'MNSL')

@section('body')
<div class="d-flex" id="wrapper">
    <div id="page-content-wrapper">
        @auth
        <div class="w-full bg-white bg-opacity-0 shadow-sm z-10">
            <div class="flex flex-col max-w-screen-xl px-4 mx-auto md:items-center md:justify-between md:flex-row md:px-6 lg:px-8">
                <div class="p-4 flex flex-row items-center justify-between">
                    <a href="#" class="text-lg font-semibold tracking-widest text-black uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">Administrator</a>
                    <button class="md:hidden rounded-lg focus:outline-none focus:shadow-outline">
                    <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                        <path x-show="!open" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                        <path x-show="open" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    </button>
                </div>
                <nav class="flex-col flex-grow pb-4 md:pb-0 md:flex md:justify-end md:flex-row">
                    <a href="/users" class="px-4 py-2 mt-2 text-sm font-semibold text-black rounded-sm hover:bg-blue-500 hover:text-white uppercase">Users</p>
                    <a href="/logout" class="px-4 py-2 mt-2 text-sm font-semibold rounded-sm hover:bg-blue-500 hover:text-white uppercase">Logout</a>
                </nav>
            </div>
          </div>
        @endauth()
        <div class="container-fluid">
        
            @yield('content')
            
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
   
</script>
@endsection