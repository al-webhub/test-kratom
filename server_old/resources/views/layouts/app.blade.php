@php
	$languages = array_diff_key(config('backpack.crud.locales'), config('backpack.crud.executed_locales'));
	$hreflangs = get_hreflands();
	//dd(Session::all());
@endphp

<!DOCTYPE html>
<html dir="ltr" lang="en" class="@yield('html_class')">
<head>
<meta charset="UTF-8">

@if(!empty(\Request::all()) )
<meta name="robots" content="noindex, follow" />
@endif


<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('meta_title')</title>
<meta name="description" content="@yield('meta_description')">

<link rel="canonical" href="{{ Request::url() }}" />

@hasSection('hreflang')
	@yield('hreflang')
@else
	@foreach($hreflangs as $iso => $url)
		<link rel="alternate" hreflang="{{ $iso }}" href="{{ url($url) }}"/>
	@endforeach
@endif

<link href="{{ url('/image/favicon/favicon-16x16.png') }}" rel="icon" type="image/icon">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700;900&display=swap" rel="preload" as="style">

<link href="{{ url('/packages/noty/noty.css') }}" rel="preload" as="style">
<!--<link href="{{ url('/css/main.css') }}" rel="preload" as="style">
-->


<!--
<link href="{{ url('/packages/noty/noty.css') }}" rel="preload">
<noscript><link rel="stylesheet" href="{{ url('/packages/noty/noty.css') }}"></noscript>
<link href="{{ url('/css/main.css') }}" rel="preload">
<noscript><link rel="stylesheet" href="{{ url('/css/main.css') }}"></noscript>
-->

<!--
<link href="../fonts/Impact.ttf" rel="preload" as="font" type="font/ttf" crossorigin>
<link href="../fonts/Montserrat-Regular.ttf" rel="preload"  as="font" type="font/ttf" crossorigin>
<link href="../fonts/Montserrat-Medium.ttf" rel="preload" as="font" type="font/ttf" crossorigin>
<link href="../fonts/Montserrat-Bold.ttf" rel="preload" as="font" type="font/ttf" crossorigin>
<link href="../fonts/Montserrat-Black.ttf" rel="preload" as="font" type="font/ttf" crossorigin>
<link href="../fonts/icomoon.ttf" rel="preload" as="font" type="font/ttf" crossorigin>
-->

<script>
	

var font1 = new FontFace("icomoon", "url(/fonts/icomoon.ttf)", {
  style: 'normal', weight: 'normal'
});

font1.load().then(function() {
  document.fonts.add(font1);
//   document.body.style.fontFamily = "icomoon";
});


var font2 = new FontFace("Impact", "url(/fonts/Impact.ttf)", {
  style: 'normal', weight: 'normal'
});

font2.load().then(function() {
  document.fonts.add(font2);
//   document.body.style.fontFamily = "Impact";
});
	
// var font3 = new FontFace("Montserrat", "url(../fonts/Montserrat-Regular.ttf)", {
//   style: 'normal', weight: '400'
// });

// font3.load().then(function() {
//   document.fonts.add(font3);
//   document.body.style.fontFamily = "Montserrat";
// });
	
// var font4 = new FontFace("Montserrat", "url(../fonts/Montserrat-Medium.ttf)", {
//   style: 'normal', weight: '500'
// });

// font4.load().then(function() {
//   document.fonts.add(font4);
//   document.body.style.fontFamily = "Montserrat";
// });
	
// var font5 = new FontFace("Montserrat", "url(../fonts/Montserrat-Bold.ttf)", {
//   style: 'normal', weight: '700'
// });

// font5.load().then(function() {
//   document.fonts.add(font5);
//   document.body.style.fontFamily = "Montserrat";
// });
	
// var font6 = new FontFace("Montserrat", "url(../fonts/Montserrat-Black.ttf)", {
//   style: 'normal', weight: '900'
// });

// font6.load().then(function() {
//   document.fonts.add(font5);
//   document.body.style.fontFamily = "Montserrat";
// });

</script>

@stack('styles')
<style>
	body {
	  background-color: #2e2e2e;
	}
    .preloader {
        position: fixed;
        display: flex;
        justify-content: center;
        align-items: center;
        top: 0;
        left: 0;
        z-index: 100;
        height: 100%;
        width: 100%;
        background-color: #000000;
        overflow: hidden;
        animation-delay: 1s;
        opacity: 1;
        transition: opacity .4s, width .4s 1.4s, height .4s 1.4s;
    }
    .preloader.hide {
        opacity: 0;
        width: 0px;
        height: 0px;
    }
    .main-button-color,
    .main-button,
    .slider-button {
        -webkit-mask-image: -webkit-radial-gradient(white, black);
        -webkit-backface-visibility: hidden;
        -moz-backface-visibility: hidden;
        -webkit-transform: translate3d(0, 0, 0);
        -moz-transform: translate3d(0, 0, 0)
    }
</style>
</head>
<body itemscope="" itemtype="https://schema.org/WebPage">


<div class="preloader">
	<video width="500" height="400" autoplay loop>
    	<source src="/video/preloader.mp4" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>
	</video>
</div> 


<div id="app">
@include('layouts.header')

@yield('content')

@include('layouts.footer')
</div>


<script>  
/*
function ReLoadImages(){
    let images = document.querySelectorAll('img[data-lazysrc]');
    let imagesbg = document.querySelectorAll('.js-img-bg');
    images.forEach(function(image) {
	    let url = image.getAttribute('data-lazysrc');
	    image.setAttribute('src', url);
	});
    imagesbg.forEach(function(image) {
	    let urlBg = image.getAttribute('data-lazysrc');
	    image.setAttribute('style', `background-image: url(${urlBg})`);
	});
}
*/

	
    window.addEventListener("load", function(event) {
	    document.querySelectorAll('.preloader')[0].classList.add('hide');
/*
	    setTimeout(function(){
	    	ReLoadImages();
	    }, 1);
*/
	});

</script>

<div class="overlay"></div>
<div class="button-to-top">
    <button class="to-top">
        <span class="icon-arrow-right"></span>
    </button>
</div>
<section class="popup popup-logout" data-target="logout">
    <button type="button" class="close__popup js-close">
        <span class="icon-close"></span>
    </button>
    <p class="popup-caption">{{ __('text.logout') }}</p>
    <p>{{ __('text.want_to_logout') }}</p>
    <div class="wrapper">
        <button class="button-only-text js-close">
            <span class="text">{{ __('text.cancel') }}</span>
        </button>
        <a href="{{ url('logout') }}" class="main-button main-button-small main-button-profile">
            <span class="text">{{ __('text.yes') }}</span>
        </a>
    </div>
</section>
<section class="popup popup-registration-social" data-target="registration-social">
    <button type="button" class="close__popup js-close">
        <span class="icon-close"></span>
    </button>
    <p class="popup-caption">{{ __('text.sign_up') }}</p>
    <div class="popup__body">
        <a href="{{ url('login/google') }}" class="main-button main-button-social-popup">
            <span class="icon" style="background-image:url({{url('/img/google-icon.png')}})"></span>
            <span class="text">{{ __('text.continue_with_google') }}</span>
        </a>
        {{--
        <a href="{{ url('login/facebook') }}" class="main-button main-button-social-popup">
            <span class="icon" style="background-image:url({{url('/img/fb-icon.png')}})"></span>
            <span class="text">continue with facebook</span>
        </a>
        --}}
        <button class="main-button main-button-social-popup js-button" data-target="registration">
            <span class="icon icon-message"></span>
            <span class="text">{{ __('text.sign_up_with_email') }}</span>
        </button>
    </div>
    <button type="button" class="button-enter js-button" data-target="log-in">{{ __('text.Log_In') }}</button>
</section>
<form autocomplete="off" method="POST" action="{{ route('login') }}" enctype="multipart/form-data">
    @csrf
    <section class="popup popup-login" data-target="log-in">
        <button type="button" class="close__popup js-close">
            <span class="icon-close"></span>
        </button>
        <p class="popup-caption">{{ __('text.Log_In') }}</p>
        <div class="popup__body">
            <label class="input__wrapper js-input-wrapper @error('email') error @enderror">
                <input type="email" name="email" value="{{ old('email') }}" class="main-input js-input">
                <span class="custome-placeholder__wrapper">
                    <span class="custome-placeholder__before"></span>
                    <span class="custome-placeholder__text">
                        <span class="inner-text">{{ __('text.Email') }}</span>
                    </span>
                    <span class="custome-placeholder__after"></span>
                </span>
                @error('email')
                    <span class="input-error-text">{{ $message }}</span>
                @enderror
            </label>
            <button type="button" class="main-button-color main-button-color-popup js-button" data-target="password">
                <span class="text">{{ __('text.next') }}</span>
            </button>
        </div>
        <div class="popup__footer">
            <div class="popup__footer__sing-up">
                <p>{{ __('text.Don_have_any_account') }}</p>
                <button type="button" class="button-enter js-button" data-target="registration">{{ __('text.Sign_Up') }}</button>
            </div>
        </div>
    </section>
    <section class="popup popup-password" data-target="password">
        <button type="button" class="close__popup js-close">
            <span class="icon-close"></span>
        </button>
        <p class="popup-caption">{{ __('text.hello') }}</p>
        <div class="popup__body">
            <label class="input__wrapper js-input-wrapper @error('password') error @enderror">
                <input type="password" name="password" class="main-input js-input">
                <span class="custome-placeholder__wrapper">
                    <span class="custome-placeholder__before"></span>
                    <span class="custome-placeholder__text">
                        <span class="inner-text">{{ __('text.Password') }}</span>
                    </span>
                    <span class="custome-placeholder__after"></span>
                </span>
                @error('password')
                    <span class="input-error-text">{{ $message }}</span>
                @enderror
                <button type="button" class="show-password">
                    <span class="icon-show-pass"></span>
                </button>
            </label>
            <button class="main-button-color main-button-color-popup">
                <span class="text">{{ __('text.Log_In') }}</span>
            </button>
        </div>
        <div class="popup__footer">
            <div class="popup__footer__navigation">
                <button type="button" class="button-nav js-button" data-target="log-in">{{ __('text.Back') }}</button>
                <button type="button" class="button-nav js-button" data-target="change-pass">{{ __('text.Forgot_Password') }}</button>
            </div>
        </div>
    </section>
</form>
<form action="{{ url('account/changePassword') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
      @csrf
    <section class="popup popup-change-pass" data-target="change-pass">
        <button type="button" class="close__popup js-close">
            <span class="icon-close"></span>
        </button>
        <p class="popup-caption">{{ __('text.set_new_password') }}</p>
        <div class="popup__header">
            <p class="email">{{ __('text.for') }} <span> @if($user){{ $user->email }}@endif</span></p>
            <ul class="popup-check__list">
                <li class="popup-check__item js-check-pass-item" data-target="min-value">
                    <span class="decor">
                        <soan class="icon-active"></soan>
                    </span>
                    <span class="text">{{ __('text.Min_8_characters') }}</span>
                </li>
                <li class="popup-check__item js-check-pass-item" data-target="letter">
                    <span class="decor">
                        <soan class="icon-active"></soan>
                    </span>
                    <span class="text">{{ __('text.1_Letter') }}</span>
                </li>
                <li class="popup-check__item js-check-pass-item" data-target="number">
                    <span class="decor">
                        <soan class="icon-active"></soan>
                    </span>
                    <span class="text">{{ __('text.1_Number') }}</span>
                </li>
            </ul>
        </div>
        <div class="popup__body">
            <label class="input__wrapper js-input-wrapper">
                <input type="password" class="main-input js-input js-password" name="password">
                <span class="custome-placeholder__wrapper">
                    <span class="custome-placeholder__before"></span>
                    <span class="custome-placeholder__text">
                        <span class="inner-text">{{ __('text.New_Password') }}</span>
                    </span>
                    <span class="custome-placeholder__after"></span>
                </span>
                <button type="button" class="show-password">
                    <span class="icon-show-pass"></span>
                </button>
            </label>
            <label class="input__wrapper js-input-wrapper disabled">
                <input type="password" class="main-input js-input js-password-confirm" name="password_confirmation">
                <span class="custome-placeholder__wrapper">
                    <span class="custome-placeholder__before"></span>
                    <span class="custome-placeholder__text">
                        <span class="inner-text">{{ __('text.Confirm_Password') }}</span>
                    </span>
                    <span class="custome-placeholder__after"></span>
                </span>
                <button type="button" class="show-password">
                    <span class="icon-show-pass"></span>
                </button>
            </label>
            <button class="main-button-color main-button-color-popup disabled js-pass-button">
                <span class="text">{{ __('text.set_new_password') }}</span>
            </button>
        </div>
    </section>
</form>
<form autocomplete="off" method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="registration__form">
    @csrf
    <input type="hidden" name="referrer_id" value="{{ $ref_id }}">
    <section class="popup popup-registration" data-target="registration">
        <button type="button" class="close__popup js-close">
            <span class="icon-close"></span>
        </button>
        <p class="popup-caption">{{ __('text.Sign_Up') }}</p>
        <div class="popup__body">
            <label class="input__wrapper js-input-wrapper @error('name') error @enderror">
                <input type="text" class="main-input js-input" name="name" value="{{ old('name') }}" require>
                <span class="custome-placeholder__wrapper">
                    <span class="custome-placeholder__before"></span>
                    <span class="custome-placeholder__text">
                        <span class="inner-text">{{ __('text.First_name') }}<span>*</span></span>
                    </span>
                    <span class="custome-placeholder__after"></span>
                </span>
                @error('name')
                    <span class="input-error-text">{{ $message }}</span>
                @enderror
            </label>
            <label class="input__wrapper js-input-wrapper @error('lastname') error @enderror">
                <input type="text" class="main-input js-input" name="lastname" value="{{ old('lastname') }}">
                <span class="custome-placeholder__wrapper">
                    <span class="custome-placeholder__before"></span>
                    <span class="custome-placeholder__text">
                        <span class="inner-text">{{ __('text.Last_name') }}</span>
                    </span>
                    <span class="custome-placeholder__after"></span>
                </span>
                @error('lastname')
                    <span class="input-error-text">{{ $message }}</span>
                @enderror
            </label>
            <label class="input__wrapper js-input-wrapper @error('email') error @enderror">
                <input type="email" class="main-input js-input" value="{{ old('email') }}" name="email">
                <span class="custome-placeholder__wrapper">
                    <span class="custome-placeholder__before"></span>
                    <span class="custome-placeholder__text">
                        <span class="inner-text">{{ __('text.Email') }} <span>*</span></span>
                    </span>
                    <span class="custome-placeholder__after"></span>
                </span>
                @error('email')
                    <span class="input-error-text">{{ $message }}</span>
                @enderror
            </label>
            <div class="input__wrapper js-input-wrapper js-drop-item general-drop">
                <input type="text" name="extras[communication]" class="main-input js-input js-drop-input js-drop-button" readonly require> 
                <span class="custome-placeholder__wrapper">
                    <span class="custome-placeholder__before"></span>
                    <span class="custome-placeholder__text">
                        <span class="inner-text">{{ __('text.Preferred_communication') }}<span>*</span></span>
                    </span>
                    <span class="custome-placeholder__after"></span>
                </span>
                <span class="icon-drop"></span>
                <div class="general-drop__list">
                    <div class="general-drop__item general-drop__item-select">
                        <div class="text">{{ __('text.Please_select') }}</div>
                    </div>
                    <div class="general-drop__item js-drop-contains">
                        <span class="icon-active"></span>
                        <div class="text">Viber</div>
                    </div>
                    <div class="general-drop__item js-drop-contains">
                        <span class="icon-active"></span>
                        <div class="text">WhatsApp</div>
                    </div>
                    <div class="general-drop__item js-drop-contains">
                        <span class="icon-active"></span>
                        <div class="text">Skype</div>
                    </div>
                    <div class="general-drop__item js-drop-contains">
                        <span class="icon-active"></span>
                        <div class="text">Telegram</div>
                    </div>
                    <div class="general-drop__item js-drop-contains">
                        <span class="icon-active"></span>
                        <div class="text">Facebook</div>
                    </div>
                    <div class="general-drop__item js-drop-contains">
                        <span class="icon-active"></span>
                        <div class="text">Instagram</div>
                    </div>
                </div>
            </div>
            <label class="input__wrapper js-input-wrapper">
                <input type="text" class="main-input js-input" name="extras[communication_number]">
                <span class="custome-placeholder__wrapper">
                    <span class="custome-placeholder__before"></span>
                    <span class="custome-placeholder__text">
                        <span class="inner-text">{{ __('text.Account/full_number/link') }}<span>*</span></span>
                        <!-- Можно так placeholder оставить, он слишком длинный и ломает красивую обвотку? ^ -->
                        <!-- Preferred communication account/full number/link -->
                    </span>
                    <span class="custome-placeholder__after"></span>
                </span>
            </label>
            <div style="margin:30px 0">
                <p style="font-size: 14px; line-height: 150%;">{{ __('text.Please_write_your') }}</p>
            </div>
            <!-- Добавил пароль, в макете его небыло -->
            <label class="input__wrapper js-input-wrapper @error('password') error @enderror">
                <input type="password" name="password" class="main-input js-input">
                <span class="custome-placeholder__wrapper">
                    <span class="custome-placeholder__before"></span>
                    <span class="custome-placeholder__text">
                        <span class="inner-text">{{ __('text.Password') }} <span>*</span></span>
                    </span>
                    <span class="custome-placeholder__after"></span>
                </span>
                @error('password')
                    <span class="input-error-text">{{ $message }}</span>
                @enderror
            </label>
            <label class="input__wrapper js-input-wrapper">
                <input type="password" name="password_confirmation" class="main-input js-input">
                <span class="custome-placeholder__wrapper">
                    <span class="custome-placeholder__before"></span>
                    <span class="custome-placeholder__text">
                        <span class="inner-text">{{ __('text.Confirm_Password') }} <span>*</span></span>
                    </span>
                    <span class="custome-placeholder__after"></span>
                </span>
            </label>
            <div class="checkout__item__policy">
	            <label class="input__wrapper input__wrapper-checkbox">
	            	<input type="checkbox" value="1" required="required" class="input-checkbox"> 
	            	<span class="custome-checkbox"><span class="icon-active"></span></span> 
	            	<span>{{ __('text.I_agreed_with') }} <a href="{{ url('/privacy') }}" target="_blade">{{ __('text.Privacy_Policy') }}</a></span>
	            </label>
	        </div>
            
            <!-- //Добавил пароль, в макете его небыло -->
            <button class="main-button-color main-button-color-popup">
                <span class="text">{{ __('text.Sign_Up') }}</span>
            </button>
            <div class="popup__footer">
                <div class="popup__footer__sing-up">
                    <p>{{ __('text.Already_have_account') }}</p>
                    <button type="button" class="button-enter js-button" data-target="registration-social">{{ __('text.Log_In') }}</button>
                </div>
            </div>
        </div>
    </section>
</form>
<section class="popup popup-check-email" data-target="check-email">
    <button type="button" class="close__popup js-close">
        <span class="icon-close"></span>
    </button>
    <div class="popup__body">
        <div class="popup-check-email__icon">
            <span class="icon-message"></span>
        </div>
        <p class="popup-check__text">{{ __('text.Check_your_mail') }} 😊</p>
    </div>
    <div class="popup__footer">
        <div class="popup-check-email__info">
            <p>{{ __('text.Didn_email') }}</p>
            <button class="button-nav">{{ __('text.Click_here') }}</button>
        </div>
    </div>
</section>
<section class="popup popup-check-money" data-target="check-mony">
    <button type="button" class="close__popup js-close">
        <span class="icon-close"></span>
    </button>
    <div class="popup__body">
        <div class="popup-check-email__icon">
            <span class="icon-referral"></span>
        </div>
        <p class="popup-check__text">{{ __('text.Text_money') }} 😊</p>
    </div>
</section>
@php
	$strings = [
		'add_to_cart' => __('text.add_to_cart'),
		'stimulation' => __('text.stimulation'),
		'relaxation' => __('text.relaxation'),
		'euphoria' => __('text.euphoria'),
		'info' => __('text.info'),
		'cancel' => __('text.cancel'),
		'reviews' => __('text.reviews'),
		'feedback_and_earn' => __('text.feedback_and_earn'),
		'first_of_all' => __('text.first_of_all'),
		'leave_incognito_for' => __('text.leave_incognito_for', ['first' => "<span>$1</span>", 'second' => "<span>$2</span>"]),
		'your_reviews' => __('text.your_reviews'),
		'post' => __('text.post'),
		'post_incognito' => __('text.post_incognito'),
		'reply' => __('text.reply'),
		'load_more_reviews' => __('text.load_more_reviews'),
		'no_reviews' => __('text.no_reviews'),
		'show_more' => __('text.show_more'),
		'currency' => config('aimix.currency.'.Session::get('lang'), 'USD')
	];
@endphp
<script>
  var cart = @json($cart);
  var cartErrorMessage = 'Cart is empty';
  var strings = @json($strings);
</script> 

<!-- <script async src="{{ url('/packages/noty/noty.min.js') }}" type="text/javascript"></script> -->
<!-- <script async src="{{ url('/js/main.js') }}" type="text/javascript"></script> -->

<script>
!function(e,t){"object"==typeof exports&&"object"==typeof module?module.exports=t():"function"==typeof define&&define.amd?define([],t):"object"==typeof exports?exports.sal=t():e.sal=t()}(this,function(){return function(e){function t(r){if(n[r])return n[r].exports;var o=n[r]={i:r,l:!1,exports:{}};return e[r].call(o.exports,o,o.exports,t),o.l=!0,o.exports}var n={};return t.m=e,t.c=n,t.d=function(e,n,r){t.o(e,n)||Object.defineProperty(e,n,{configurable:!1,enumerable:!0,get:r})},t.n=function(e){var n=e&&e.__esModule?function(){return e.default}:function(){return e};return t.d(n,"a",n),n},t.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},t.p="dist/",t(t.s=0)}([function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var r=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var r in n)Object.prototype.hasOwnProperty.call(n,r)&&(e[r]=n[r])}return e};n(1);var o={rootMargin:"0% 50%",threshold:.5,animateClassName:"sal-animate",disabledClassName:"sal-disabled",selector:"[data-sal]",once:!0,disabled:!1},s=[],a=null,i=function(e){return e.classList.add(o.animateClassName)},l=function(e){return e.classList.remove(o.animateClassName)},c=function(e){return e.classList.contains(o.animateClassName)},u=function(){document.body.classList.remove(o.disabledClassName)},d=function(){document.body.classList.add(o.disabledClassName)},f=function(){return o.disabled||"function"==typeof o.disabled&&o.disabled()},b=function(e,t){e.forEach(function(e){e.intersectionRatio>=o.threshold?(i(e.target),o.once&&t.unobserve(e.target)):o.once||l(e.target)})},m=function(){d(),a.disconnect(),a=null},p=function(){u(),a=new IntersectionObserver(b,{rootMargin:o.rootMargin,threshold:o.threshold}),s=[].filter.call(document.querySelectorAll(o.selector),function(e){return!c(e,o.animateClassName)}),s.forEach(function(e){return a.observe(e)})},h=function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:o;if(e!==o&&(o=r({},o,e)),!window.IntersectionObserver)throw d(),Error("\n      Your browser does not support IntersectionObserver!\n      Get a polyfill from here:\n      https://github.com/w3c/IntersectionObserver/tree/master/polyfill\n    ");return f()?d():p(),{elements:s,disable:m,enable:p}};t.default=h},function(e,t){}]).default});
</script>

@stack('scripts')

<script>
window.addEventListener("load", function(event) {
	@if($ref_id)
	    localStorage.setItem('kratom_ref_id', {{ $ref_id }});
	@endif
	
	@if(\Auth::user() || session('localstorage_remove_ref'))
	    localStorage.removeItem('kratom_ref_id');
	@endif
	
	@if(session('message') && session('type'))
	  noty("{{ session('type') }}", "{{ session('message') }}");
	@endif
	
	@if(session('status'))
	  noty("success", "{{ session('status') }}");
	@endif
	
	@if($errors->any())
	  noty("error", "{{ __('main.form_error') }}");
	@endif
	
	// update
    if(window.location.hash == '#login') {
        document.querySelector('.popup-login').classList.add('active');
        document.querySelector('.overlay').classList.add('active');
        document.querySelector('html').classList.add('overflow');
    }
    // /update

    document.querySelectorAll('link[rel=preload]').forEach(function(item) {
        item.rel = 'stylesheet';
    });
})
	
function noty(type, message){
  new Noty({
    type: type,
    theme: 'push_notification__item',
    text: '<span class="text">' + message + '</span>',
    timeout: 5000,
    container: '.push_notification__list'
  }).show();
}
</script>

<!-- Google Tag Manager -->
<script async type="text/javascript" src="https://www.google-analytics.com/analytics.js"></script>
<script async src="https://www.googletagmanager.com/gtm.js?id=GTM-NRHQJCB"></script>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NRHQJCB');</script>
<!-- End Google Tag Manager -->
</body>
</html>