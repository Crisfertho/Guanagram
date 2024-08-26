@extends('layouts.app')

@section('title')
    Create a Post
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('content')
    @vite('resources/js/app.js')
    <div class="md:flex md:items-center m-10">
        <div class="md:w-1/2 px-8">
            <form action="{{route('images.store')}}" method="POST" enctype="multipart/form-data" 
            id="dropzone" class="dropzone border-dashed border-2 w-full h-96 
            rounded flex flex-col justify-center items-center">
            @csrf
            </form>
        </div>

        <div class="md:w-1/2 p-4 bg-white shadow-2xl rounded-2xl mt-6 md:mt-0">
            <form action="{{ route('posts.store') }}" method="POST" novalidate>
                @csrf
                <div class="mb-3">
                    <label for="title" class="mb-2 block uppercase text-gray-600 font-bold">
                        Title
                    </label>
                    <input
                        id="title"
                        name="title"
                        type="text"
                        placeholder="Post Title"
                        class="border p-2 w-full rounded-md @error('title') border-red-600 @enderror"
                        value="{{ old('title') }}"
                    />
                    @error('title')
                        <p class="bg-red-700 text-white my-2 rounded-md p-1 
                        text-center">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="mb-2 block uppercase text-gray-600 font-bold">
                        Description
                    </label>
                    <textarea
                        id="description"
                        name="description"
                        placeholder="Post Description"
                        class="border p-2 w-full rounded-md @error('description') border-red-600 @enderror"
                    >{{ old('description') }}</textarea>
                    @error('description')
                        <p class="bg-red-700 text-white my-2 rounded-md p-1 
                        text-center">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <input
                        name="image"
                        type="hidden"
                        value="{{old('image')}}"
                    />
                    @error('image')
                        <p class="bg-red-700 text-white my-2 rounded-md p-1 
                        text-center">{{$message}}</p>
                    @enderror
                </div>

                <input
                    type="submit"
                 value="Create Post"
                 class="bg-sky-700 hover:bg-sky-900 transition-colors cursor-pointer
                    uppercase font-bold w-full p-2 text-white rounded-lg"
                />
            </form>    
        </div>
    </div>
@endsection