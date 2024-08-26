@extends('layouts.app')

@section('title')
    Edit Profile: {{auth()->user()->username}}
@endsection

@section('content')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-4">
            <form method="POST" action="{{route('profile.store')}}" 
                enctype="multipart/form-data" class="mt-6 md:mt-0">
                @csrf
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
                        value="{{auth()->user()->username}}"
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
                        type="text"
                        placeholder="Your Email"
                        class="border p-2 w-full rounded-md @error('email') border-red-600 @enderror"
                        value="{{ auth()->user()->email }}"
                        />
                    @error('email')
                    <p class="bg-red-700 text-white my-2 rounded-md p-1 
                    text-center">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="mb-2 block uppercase text-gray-600 font-bold">
                        Profile Image
                    </label>
                    <input
                        id="image"
                        name="image"
                        type="file"
                        class="border p-2 w-full rounded-md"
                        value=""
                        accept=".jpg, .png, .jpeg"
                    />
                </div>

                <div class="mb-3">
                   <label for="change_password" class="mb-2 block uppercase text-gray-600 font-bold">
                        Change Password
                    </label>
                    <input type="checkbox" 
                        id="change_password" 
                        name="change_password" 
                        class="mr-2"
                        {{ old('change_password') ? 'checked' : '' }}
                    />
                    
                </div>
                
                <div id="password_fields" style="display: {{ old('change_password') ? 'block' : 'none'  }};">
                    <div class="mb-3">
                        <label for="oldpassword" class="mb-2 block uppercase text-gray-600 font-bold">
                            Current Password
                        </label>
                        <input
                            id="oldpassword"
                            name="oldpassword"
                            type="password"
                            placeholder="Enter your current password"
                            class="border p-2 w-full rounded-md @error('oldpassword') border-red-600 @enderror"
                            />
                            @error('oldpassword')
                            <p class="bg-red-700 text-white my-2 rounded-md p-1 text-center">{{$message}}</p>
                            @enderror
                    </div>
                
                    <div class="mb-3">
                        <label for="password" class="mb-2 block uppercase text-gray-600 font-bold">
                            New Password
                        </label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            placeholder="Enter your new password"
                            class="border p-2 w-full rounded-md @error('password') border-red-600 @enderror"
                        />
                        @error('password')
                        <p class="bg-red-700 text-white my-2 rounded-md p-1 text-center">{{$message}}</p>
                        @enderror
                    </div>
                
                    <div class="mb-3">
                        <label for="password_confirmation" class="mb-2 block uppercase text-gray-600 font-bold">
                            Confirm New Password
                        </label>
                        <input
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            placeholder="Confirm your new password"
                            class="border p-2 w-full rounded-md @error('password_confirmation') border-red-600 @enderror"
                            />
                            @error('password_confirmation')
                            <p class="bg-red-700 text-white my-2 rounded-md p-1 text-center">{{$message}}</p>
                            @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password_confirm" class="mb-2 block uppercase text-gray-600 font-bold">
                        Confirm Password (Required)
                    </label>
                    <input
                        id="password_confirm"
                        name="password_confirm"
                        type="password"
                        placeholder="Confirm your password to Save Changes"
                        class="border p-2 w-full rounded-md @error('password_confirm') border-red-600 @enderror"
                    />
                    @error('password_confirm')
                    <p class="bg-red-700 text-white my-2 rounded-md p-1 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <input
                    type="submit"
                    value="Save"
                    class="bg-sky-700 hover:bg-sky-900 transition-colors cursor-pointer
                    uppercase font-bold w-1/3 mx-auto block p-2 text-white rounded-lg"
                />

                <script>
                    document.getElementById('change_password').addEventListener('change', function() {
                        const passwordFields = document.getElementById('password_fields');
                        passwordFields.style.display = this.checked ? 'block' : 'none';
                    });
                </script>
                
            </form>
        </div>
    </div>
@endsection