{{-- <x-guest-layout>
    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ request()->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', request()->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

@extends('layouts.boxlayout')


@section('title', 'Reset Your Password')


@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="login-card card-block auth-body">
            <div class="auth-box">
                <h3 class="text-left">Reset your Password? </h3>
                <div class="mb-4 text-left" style="color: #1F4172; font-size: 16px;">
                    {{ __('Just let us know your new password and we will allow you to sign in again.') }}
                </div>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
            
                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ request()->route('token') }}">
            
                    <!-- Email Address -->
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icofont icofont-email"></i></span>
                        <x-text-input id="email" class="block mt-1 w-full form-control" type="email" name="email" :value="old('email')"  autofocus autocomplete="username" placeholder="Enter Your Email" />
                    </div>
                    <div><x-input-error :messages="$errors->get('email')" class="mt-2 text-left text-danger" /></div>
            
                    <!-- Password -->
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icofont icofont-lock"></i></span>
                        <x-text-input id="password" class="block mt-1 w-full form-control" type="password" name="password"  autocomplete="new-password" placeholder="Enter Your Password" />
                    </div>
                    <div><x-input-error :messages="$errors->get('password')" class="mt-2 text-left text-danger" /></div>
            
                    <!-- Confirm Password -->
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icofont icofont-key"></i></span>
                        <x-text-input id="password_confirmation" class="block mt-1 w-full form-control"
                                            type="password"
                                            name="password_confirmation"  autocomplete="new-password" placeholder="Enter Confirm Password"/>
        
                    </div>
                    <div> <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-left text-danger" /></div>
            
                    <div class="flex items-center justify-end  mt-4">
                        <x-primary-button class="btn btn-primary btn-block">
                            {{ __('Reset Password') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection