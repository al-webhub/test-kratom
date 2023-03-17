@extends('layouts.app')
@section('content')
<main>
	@yield('breadcrumbs')
	<section class="profile">
	    <div class="profile__wrapper container">
	        <div class="general-decor-figure"></div>
            <div class="profile__header-wrapper">
                <div class="profile__header-wrapper__container">
                    <h2 class="main-caption main-caption-align">{{ __('text.hello') }}, <span>{{ $user->usermeta->firstname }}</span></h2>
                    @if($balance)
                    	<p class="profile__header__bonus">{{ __('text.your_bonus_balance') }}: <span>USD {{ $balance }}</span></p>
                    @endif
                </div>
                <div class="profile__main-info">
                    <div class="profile__img" style="background-image:url({{ $user->usermeta->photo? $user->usermeta->photo: url('/img/profile.png') }})"></div>
                    <p class="profile__email">{{ $user->email }}</p>
                </div>
            </div>

	        <div class="profile__container">
	            
	            @include('account.layouts.sidebar')
	            
	            @yield('account')
	        </div>
	    </div>
	</section>
	@include('layouts.modules.sub')
</main>
@endsection


