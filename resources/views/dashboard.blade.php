@extends('layouts.app')

@section('title')
    Welcome: {{$user->username}}
@endsection

@section('content')
    <div class="flex justify-center">
        <div class="w-3/5 lg:w-5/12 flex flex-col items-center md:flex-row">
            <div class="w-2/5 md:w-3/5 md:px-6">
                <img src="{{$user->image ? 
                asset('profiles') . '/' . $user->image : 
                asset('img/usuario.svg') }}" alt="User Image" class="rounded-full "/>
            </div>
            <div class="lg:w-6/12 px-5 flex flex-col items-center 
             md:justify-center md:items-start pt-7">

                <div class="flex items-center gap-2 mb-3">
                    <p class="text-gray-800 text-2xl">{{ $user->username }}</p>

                    @auth
                        @if ($user->id === auth()->user()->id)
                            <a href="{{route('profile.index')}}" 
                                class="text-gray-600 hover:text-gray-700 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                    <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                    <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                </svg>  
                            </a>
                        @else
                            
                        @endif
                    @endauth
                </div>

                <p class="text-gray-700 text-sm mb-3 font-bold">
                    {{$user->posts->count()}}
                    <span class="font-normal">Post</span>
                </p>
                <p class="text-gray-700 text-sm mb-3 font-bold">
                    {{$user->followers->count()}}
                    <span class="font-normal"> @choice('Follower|Followers', $user->followers->count())</span>
                </p>
                <p class="text-gray-700 text-sm mb-3 font-bold">
                    {{$user->followings->count()}}
                    <span class="font-normal">Followed</span>
                </p>

                @auth
                    @if ($user->id !== auth()->user()->id)
                        @if (!$user->following(auth()->user()))
                        
                            <form action="{{route('users.follow', $user)}}" method="POST">
                                @csrf
                                <input
                                    type="submit"
                                    class="bg-blue-800 text-white uppercase rounded-lg px-2 py-1 text-sm font-bold cursor-pointer"
                                    value="Follow"
                                />
                            </form>
                        @else
                            <form action="{{route('users.unfollow', $user)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input
                                    type="submit"
                                    class="bg-red-800 text-white uppercase rounded-lg px-2 py-1 text-sm font-bold cursor-pointer"
                                    value="Unfollow"
                                />
                            </form>
                        @endif
                    @endif
                @endauth

            </div>
        </div>
    </div>

    <section class="container mx-auto mt-10">
        <h2 class="text-3xl text-center font-black my-10">Posts</h2>
        <x-list-post :posts="$posts"/>
    </section>
@endsection