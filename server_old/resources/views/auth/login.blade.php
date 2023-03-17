@extends('layouts.app')

@section('meta_title', 'Login | Kratomhelper')
@section('meta_description', __('seo.page_description', ['title' => 'Login']))

@section('content')

<div class="registration container-maxwidth ">
    <div class="registration__wrapper general-container">
        <form autocomplete="off" method="POST" action="{{ route('login') }}" enctype="multipart/form-data" class="registration__form ">
        @csrf
            <div class="registration__tabs ">
                <a href="#" class="registrarion__link active">Login</a>
                <a href="{{ route('register') }}" class="registrarion__link">Register</a>
            </div>
<!--
            <h4 class="socila-caption">Enter with</h4>
            <div class="social-login">
                <a href="{{ url('login/facebook') }}" data-loading-text="Loading" class="btn btn-primary" tooltip="Register with Facebook" title="Register with Facebook"><i class="icon-facebook"></i></a>
            </div>
-->
            <div class="registration-inputs__wrapper">
                <label class="input__wrapper @error('email') error @enderror">
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email">
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </label>
                <label class="input__wrapper @error('password') error @enderror">
                    <input type="password" name="password" placeholder="Password">
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </label>
            </div>
            <button class="bnt-orang" type="submit">Login</button>
            <a class="forgotten" href="{{ route('password.request') }}">Forgotten Password</a>
        </form>
        <span class="b-top"></span><span class="b-right"></span><span class="b-bottom"></span><span class="b-left"></span>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ url('js/app.js') }}"></script>
@endpush