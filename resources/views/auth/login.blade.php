@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 h-screen flex items-center justify-center">
    <div class="w-full max-w-md">
        <div class="bg-white shadow-md rounded-lg">
            <div class="bg-gray-800 text-white text-center py-4 rounded-t-lg">
                <h2 class="text-xl font-semibold">{{ __('Login') }}</h2>
            </div>

            <div class="p-6">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-left">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="mt-1 block w-full border-gray-300 rounded-md p-2 shadow-sm @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 text-left">{{ __('Password') }}</label>
                        <input id="password" type="password" class="mt-1 block w-full border-gray-300 rounded-md p-2 shadow-sm @error('password') border-red-500 @enderror" name="password" required autocomplete="current-password">
                        @error('email')
                        <span class="text-red-500 text-sm mt-1">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        @error('password')
                            <span class="text-red-500 text-sm mt-1">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <div class="flex items-center">
                            <input class="form-check-input h-4 w-4 text-blue-600 transition duration-150 ease-in-out" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="ml-2 block text-gray-900" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-blue-600 text-white py-2 px-4 w-full rounded-md hover:bg-blue-700">
                            {{ __('Login') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
