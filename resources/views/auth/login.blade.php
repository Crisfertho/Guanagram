@extends('layouts.app')

@section('title')
   Login to Guanagram.
@endsection

@section('content')

    <div class="md:flex md:justify-center gap-8 md:items-center"> 
        <div class="lg:w-100 md:w-7/12 p-4">
            <img src="{{ asset ('img/logoGuana.webp') }}" alt="Image User Login" 
            class="rounded-lg w-50 h-50">
        </div> 
        <div class=" lg:w-4/12 md:w-6/12 bg-white p-3 shadow-2xl rounded-2xl">
            
            @if(session('status'))
                <div class="alert alert-success text-sm font-bold bg-green-500 text-white p-4 rounded mb-2 flex">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                      </svg>                      
                    {{ session('status') }}
                </div>
            @endif
            
            <form method="POST" action="{{ route('login') }}">
                @csrf

                @if (session('message'))
                    <p class="bg-red-700 text-white my-2 rounded-md p-1 
                    text-center">{{session('message')}}</p>
                @endif

                <div class="mb-3">
                    <label for="login" class="mb-2 block uppercase text-gray-600 font-bold">
                        Email or Username
                    </label>
                    <input
                        id="login"
                        name="login"
                        type="text"
                        placeholder="Your Email or Username"
                        class="border p-2 w-full rounded-md @error('login') border-red-600 @enderror"
                        value="{{ old('login') }}"
                    />
                    @error('login')
                    <p class="bg-red-700 text-white my-2 rounded-md p-1 
                    text-center">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="mb-2 block uppercase text-gray-600 font-bold">
                        Password
                    </label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        placeholder="Your Password"
                        class="border p-2 w-full rounded-md @error('password') border-red-600 @enderror"
                    />
                    @error('password')
                    <p class="bg-red-700 text-white my-2 rounded-md p-1 
                    text-center">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <input type="checkbox" name="remember">
                    <label class="text-gray-700 text-sm font-bold">
                        Keep me logged in
                    </label>
                </div>

                <input
                    type="submit"
                    value="Login"
                    class="bg-sky-700 hover:bg-sky-900 transition-colors cursor-pointer
                    uppercase font-bold w-full p-2 text-white rounded-lg"
                />
            </form>
        </div> 

    </div>
    
@endsection