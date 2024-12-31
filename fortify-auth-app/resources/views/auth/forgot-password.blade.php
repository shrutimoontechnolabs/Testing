{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

@extends('layouts.boxlayout')

@section('title', 'Forgot Your Password')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="login-card card-block auth-body">
            <div class="auth-box">
                <h3 class="text-left">You forgot your Password? </h3>
                                        <h3 class="text-left">Don't worry.</h3>
                <div class="mb-4 text-left" style="color: #1F4172; font-size: 16px;">
                    {{ __('Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4 text-left" style="color: green" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icofont icofont-email"></i></span>
                        <x-text-input id="email" class="block mt-1 w-full form-control" type="email" name="email" :value="old('email')"  autofocus placeholder="enter your email address"  />
                    </div>
                    <div><x-input-error :messages="$errors->get('email')" class="mt-2 text-left text-dark" /></div>
                    <div class="row m-t-25">
                        <div class="col-md-12 text-center">
                            <!-- Button with theme styling -->
                            <x-primary-button class="btn btn-primary btn-block">
                                {{ __('Email Password Reset Link') }}
                            </x-primary-button>
                        </div>
                    </div>
                </form>

                {{-- <div class="row m-t-25">
                    <div class="col-md-12 text-center">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <button type="submit" class="btn btn-secondary btn-block">
                                {{ __('Back to Login') }}
                            </button>
                        </form>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>
@endsection

