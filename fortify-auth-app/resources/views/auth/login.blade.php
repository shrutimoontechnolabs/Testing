{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"  autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
 
        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

    </form>
</x-guest-layout> --}}


@extends('layouts.mylogin')

@section('title', 'Sign In')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="login-card card-block auth-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf
               
                <div class="auth-box">
                    <div class="row m-b-20">
                        <div class="col-md-4">
                            <h3 class="text-center txt-primary">Sign In</h3>
                        </div>
                        <div class="col-md-9">
                            <p class="text-inverse m-t-25 text-left">
                                Don't have an account? <a href="{{ route('register') }}">Register</a> here for free!
                            </p>
                        </div>
                    </div>
                    
                    <p class="text-inverse b-b-default text-left p-b-5">Sign in with your regular account</p>
                    <!-- Email -->
                    <div class="input-group">
                        <input type="email" name="email" class="form-control" placeholder="Username" >
                    </div>    
                        <div>
                        @error('email')
                        <span class=" text-left text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                    
                    <!-- Password -->
                    <div class="input-group">
                        <input type="password" name="password" class="form-control" placeholder="Password" >
                    </div>   
                        @error('password')
                        <span class="text-danger text">{{ $message }}</span>
                        @enderror
                    
                    <!-- Remember Me -->
                    <div class="row m-t-25 text-left">
                        <div class="col-sm-6 col-xs-12">
                            <div class="checkbox-fade fade-in-primary">
                                <label>
                                    <input type="checkbox" name="remember">
                                    <span class="cr">
                                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                    </span>
                                    <span class="text-inverse">Remember me</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12 forgot-phone text-right">
                            <a href="{{ route('password.request') }}" class="text-right f-w-600 text-inverse">
                                Forget Password?
                            </a>
                        </div>
                    </div>
                    <!-- Submit -->
                    <div class="row m-t-30">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-md btn-block waves-effect">
                                LOGIN
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
