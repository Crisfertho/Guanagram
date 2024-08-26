@extends('layouts.app')

@section('title')
    Register on Guanagram.
@endsection

@section('content')

    <div class="md:flex md:justify-center gap-8 md:items-center"> 
        <div class="relative lg:w-4/12 md:w-7/12 p-2">
            <h1 class="absolute top-2 left-0 w-full text-center mb-2 font-black text-3xl"> Guanagram </h1>
            <img src="{{ asset ('img/register.webp') }}" alt="Image User Register" 
            class="rounded-lg ">
        </div> 
        <div class=" lg:w-4/12 md:w-6/12 bg-white p-3 shadow-2xl rounded-2xl">
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="mb-2 block uppercase text-gray-600 font-bold">
                        Name
                    </label>
                    <input
                        id="name"
                        name="name"
                        type="text"
                        placeholder="Your Name"
                        class="border p-2 w-full rounded-md @error('name') border-red-600 @enderror"
                        value="{{ old('name') }}"
                    />
                    @error('name')
                        <p class="bg-red-700 text-white my-2 rounded-md p-1 
                        text-center">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="username" class="mb-2 block uppercase text-gray-600 font-bold">
                        Username
                    </label>
                    <input
                        id="username"
                        name="username"
                        type="text"
                        placeholder="Your Username"
                        class="border p-2 w-full rounded-md @error('username') border-red-600 @enderror"
                        value="{{ old('username') }}"
                    />
                    @error('username')
                        <p class="bg-red-700 text-white my-2 rounded-md p-1 
                        text-center">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="mb-2 block uppercase text-gray-600 font-bold">
                        Email
                    </label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        placeholder="Your Email"
                        class="border p-2 w-full rounded-md @error('email') border-red-600 @enderror"
                        value="{{ old('email') }}"
                    />
                    @error('email')
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
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-600 font-bold">
                        Password
                    </label>
                    <input
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        placeholder="Repeat Your Password"
                        class="border p-2 w-full rounded-md"
                    />
                </div>

                <input
                    type="submit"
                    value="Create Account"
                    class="bg-sky-700 hover:bg-sky-900 transition-colors cursor-pointer
                    uppercase font-bold w-full p-2 text-white rounded-lg"
                />
            </form>
        </div> 

    </div>
    
@endsection