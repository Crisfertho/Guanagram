@extends('layouts.app')

@section('title')
    {{$post->title}}
@endsection

@section('content')
    <div class="container md:flex justify-center">
        <div class="lg:w-5/12 md:w-1/2 sm:w-auto mx-4">
            <img src="{{asset('uploads'). '/' . $post->image}}" alt="Post Image {{$post->title}}" class="rounded-lg">
            
            <div class="p-2 flex items-center gap-1 text-gray-200">
                @auth
                    <livewire:like-post :post="$post" />
                @endauth
            </div>

            <div>
                <p class="mt-1 text-white font-bold">
                    {{$post -> description}}
                </p>
                <p class="font-bold text-gray-200">{{$post->user->username}}</p>
                <p class="text-sm text-gray-300" >
                    {{$post->created_at->diffForHumans()}}
                </p>
            </div>

            @auth
                @if($post->user_id === auth()->user()->id)
                 <form method="POST" action="{{route('posts.destroy', $post)}}">
                    @method('DELETE')
                    @csrf
                    <button 
                        type="submit" 
                        class="bg-red-700 hover:bg-red-800 p-2 rounded text-white font-bold my-2 cursor-pointer flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                        Delete Post
                     </button>
                 </form>
                 @endif
            @endauth
        </div>

        <div class="md:w-1/2 mx-4">
            <div class="shadow bg-white p-4 mb-3 rounded-lg">

                @auth

                <p class="text-lg font-bold text-center mb-3">
                    Add a new comment
                </p>

                @if (session('message'))
                    <div class="bg-green-500 p-2 rounded-lg mb-4 text-white font-bold">
                        {{session('message')}}
                    </div>
                @endif

                <form action="{{ route('comments.store', ['post' => $post,'user' => $user]) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="comment" class="mb-2 block text-gray-600 font-bold">
                            Add a Comment
                        </label>
                        <textarea
                            id="comment"
                            name="comment"
                            placeholder="Write a comment"
                            class="border p-2 w-full rounded-md @error('comment') border-red-600 @enderror"
                        ></textarea>
                        @error('comment')
                            <p class="bg-red-700 text-white my-2 rounded-md p-1 
                            text-center">{{$message}}</p>
                        @enderror
                    </div>

                    <input
                        type="submit"
                         value="Comment"
                         class="bg-sky-700 hover:bg-sky-900 transition-colors cursor-pointer
                        uppercase font-bold w-full p-2 text-white rounded-lg"
                    />
                </form>
                @endauth

                <div class="bg-white shadow mb-3 max-h-96 overflow-y-scroll mt-5">
                    @if ($post->comments->count())
                        @foreach ( $post->comments as $comment )
                            <div class="p-3 border-gray-300 border-b">
                                <a href="{{route('posts.index',$comment->user)}}" class="font-bold">
                                    {{$comment->user->username}}
                                </a>
                                <p>{{$comment->comment}}</p>
                                <p class="text-sm text-gray-500">
                                    {{$comment->created_at->diffForHumans()}}
                                </p>
                            </div>
                        @endforeach

                    @else
                        <p class="p-6 text-center">No Hay Comentarios Aún</p>
                    @endif
                </div>

            </div>  
        </div>
    </div>
@endsection