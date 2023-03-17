@extends('layouts.app')

@section('meta_title', 'Register | Kratomhelper')
@section('meta_description', __('seo.page_description', ['title' => 'Register']))

@section('content')

    <div class="registration container-maxwidth ">
        <div class="registration__wrapper general-container">
            <form autocomplete="off" method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="registration__form">
                @csrf
                <input type="hidden" name="referrer_id">
                <div class="registration__tabs">
                    <a href="{{ url('login') }}" class="registrarion__link">Login</a>
                    <a href="#" class="registrarion__link active">Register</a>
                </div>
<!--
                <h4 class="socila-caption">Enter with</h4>
                <div class="social-login">
                    <a href="{{ url('login/facebook') }}" data-loading-text="Loading" class="btn btn-primary" tooltip="Register with Facebook" title="Register with Facebook"><i class="icon-facebook"></i></a>
                    <button type="button" onclick="social_auth.instagram(this)" data-loading-text="Loading" class="btn btn-primary" tooltip="Register with Instagram" title="Register with Instagram"><i class="icon-instagrem"></i></button>
                </div>
-->
                <div class="registration-inputs__wrapper">
                    <label class="input__wrapper @error('name') error @enderror">
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="First Name">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </label>
                    <label class="input__wrapper @error('lastname') error @enderror">
                        <input type="text" name="lastname" value="{{ old('lastname') }}" placeholder="Last Name">
                        @error('lastname')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </label>
                    <label class="input__wrapper @error('email') error @enderror">
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Email">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </label>
                    <p class="text-for-pocial select-caption">Preferred communication</p>
                    <div class="select__wrapper">
                        <select name="extras[communication]" class="form-control" required>
                            <option value=""> --- Please Select --- </option>
                            <option value="Viber">Viber</option>
                            <option value="WhatsApp">WhatsApp</option>
                            <option value="Skype">Skype</option>
                            <option value="Telegram">Telegram</option>
                            <option value="Facebook">Facebook</option>
                            <option value="Instagram">Instagram</option>
                        </select>
                    </div>
                    <p class="text-for-pocial">Please write your telephone number, your login or another reference, corresponding to the connection way you prefer (which you have chosen above)</p>
                    <label class="input__wrapper">
                        <input type="text" name="extras[communication_number]" placeholder="Please enter your phone number (Viber, WhatsApp, etc.)  or name (Skype, Facebook,  etc.)" required>
                    </label>
                    <label class="input__wrapper @error('password') error @enderror">
                        <input type="password" name="password" placeholder="Password">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </label>
                    <label class="input__wrapper">
                        <input type="password" name="password_confirmation" placeholder="Password Confirm">
                    </label>
                    <div class="registration-sub">
                        <p class="text-bold">Subscribe</p>
                        <div class="regist-radio">
                            <label class="radio__wrapper">
                                <input type="radio" name="subscription" value="1">
                                <span class="custome-radio"></span>
                                <span>Yes</span>
                            </label>
                            <label class="radio__wrapper">
                                <input type="radio" name="subscription" value="0" checked>
                                <span class="custome-radio"></span>
                                <span>No</span>
                            </label>
                        </div>
                    </div>
                    <div class="registrarion-policy">
                        <label class="policy__wrapper">
                            <input type="checkbox" required>
                            <span class="custome-checkbox"></span>
                            <span>I read and agreed with <a href="{{ url('privacy') }}">Privacy Policy</a></span>
                        </label>
                    </div>
                </div>
                <button class="bnt-orang" type="submit">Continue</button>
            </form>
            <span class="b-top"></span><span class="b-right"></span><span class="b-bottom"></span><span class="b-left"></span>
        </div>
        
    </div>

@endsection

@push('scripts')
<script>
  document.addEventListener( "DOMContentLoaded", function() {
    document.querySelector('input[name="referrer_id"]').value = localStorage.getItem('kratom_ref_id');
  });
</script>
<script src="{{ url('js/app.js') }}"></script>
@endpush