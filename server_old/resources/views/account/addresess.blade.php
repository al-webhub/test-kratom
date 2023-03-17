@section('breadcrumbs', Breadcrumbs::render('accountPage', __('text.Shipping_address')))

@extends('account.layouts.app')

@section('account')
<div class="profile__info">
    <p class="profile__info__caption">{{ __('text.Shipping_address') }}</p>
    <div class="profile__address">
        <form action="{{ url('/account/addresess') }}" method="POST" enctype="multipart/form-data" class="profile__form">
	        @csrf
            <div class="profile__form__header">
                <label class="input__wrapper input__wrapper-checkbox">
                    <input type="checkbox" class="input-checkbox" name="address_details[is_default]" value="1" {{ isset($user->usermeta->address_details['is_default']) && $user->usermeta->address_details['is_default']? 'checked': '' }} >
                    <span class="custome-checkbox">
                        <span class="icon-active"></span>
                    </span>
                    <p class="text">{{ __('text.Use_the_addresses') }}</p>
                </label>
            </div>
            <div class="profile__form__body">
                <div class="input__wrapper js-input-wrapper js-drop-item general-drop">
                    <input type="text" class="main-input js-input js-drop-input js-drop-button" readonly="" required="required" name="address_details[country]" value="{{ $user->usermeta->addressDetails['country'] }}"> 
                    <span class="custome-placeholder__wrapper">
                        <span class="custome-placeholder__before"></span>
                        <span class="custome-placeholder__text">
                            <span class="inner-text">{{ __('text.Country_Region') }}<span>*</span></span>
                        </span>
                        <span class="custome-placeholder__after"></span>
                    </span>
                    <span class="icon-drop"></span>
                    <div class="general-drop__list">
                        <div class="general-drop__item general-drop__item-select">
                            <div class="text">{{ __('text.Please_select') }}</div>
                        </div>
                        @foreach(__('countries') as $country)
                        <div class="general-drop__item js-drop-contains {{ $user->usermeta->addressDetails['country'] ==  $country? 'active': ''}}">
                            <span class="icon-active"></span>
                            <div class="text">{{ $country }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <label class="input__wrapper js-input-wrapper">
                    <input type="text" class="main-input js-input" name="address_details[street]" value="{{ $user->usermeta->addressDetails['street'] }}">
                    <span class="custome-placeholder__wrapper">
                        <span class="custome-placeholder__before"></span>
                        <span class="custome-placeholder__text">
                            <span class="inner-text">{{ __('text.Street_Number') }}</span>
                        </span>
                        <span class="custome-placeholder__after"></span>
                    </span>
                </label>
                <label class="input__wrapper js-input-wrapper">
                    <input type="text" class="main-input js-input" name="address_details[apartment]" value="{{ $user->usermeta->addressDetails['apartment'] }}">
                    <span class="custome-placeholder__wrapper">
                        <span class="custome-placeholder__before"></span>
                        <span class="custome-placeholder__text">
                            <span class="inner-text">{{ __('text.Apartment_house_flat') }}</span>
                        </span>
                        <span class="custome-placeholder__after"></span>
                    </span>
                </label>
                <label class="input__wrapper js-input-wrapper">
                    <input type="text" class="main-input js-input" required="required" name="address_details[city]" value="{{ $user->usermeta->addressDetails['city'] }}">
                    <span class="custome-placeholder__wrapper">
                        <span class="custome-placeholder__before"></span>
                        <span class="custome-placeholder__text">
                            <span class="inner-text">{{ __('text.Town_City') }}<span>*</span></span>
                        </span>
                        <span class="custome-placeholder__after"></span>
                    </span>
                </label>
                <label class="input__wrapper js-input-wrapper">
                    <input type="text" class="main-input js-input" required="" name="address_details[state]" value="{{ $user->usermeta->addressDetails['state'] }}">
                    <span class="custome-placeholder__wrapper">
                        <span class="custome-placeholder__before"></span>
                        <span class="custome-placeholder__text">
                            <span class="inner-text">{{ __('text.State') }}</span>
                        </span>
                        <span class="custome-placeholder__after"></span>
                    </span>
                </label>
                <label class="input__wrapper js-input-wrapper">
                    <input type="text" class="main-input js-input" name="address_details[zip]" value="{{ $user->usermeta->addressDetails['zip'] }}">
                    <span class="custome-placeholder__wrapper">
                        <span class="custome-placeholder__before"></span>
                        <span class="custome-placeholder__text">
                            <span class="inner-text">{{ __('text.ZIP') }}</span>
                        </span>
                        <span class="custome-placeholder__after"></span>
                    </span>
                </label>
                <label class="input__wrapper input__wrapper_100 js-input-wrapper">
                    <textarea type="text" class="main-textarea js-input" name="address_details[comment]">{{ $user->usermeta->addressDetails['comment'] ?? '' }}</textarea>
                    <span class="custome-placeholder__wrapper">
                        <span class="custome-placeholder__before"></span>
                        <span class="custome-placeholder__text">
                            <span class="inner-text">{{ __('text.Specify_or_write') }}</span>
                        </span>
                        <span class="custome-placeholder__after"></span>
                    </span>
                </label>
            </div>
            <div class="profile__form__footer">
                <button class="main-button main-button-small main-button-profile">
                    <span class="text">{{ __('text.save_address') }}</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
@push('styles')
	<link href="{{ url('/css/csspages/profile.css?v='.config('settings.cache_v')) }}" rel="preload" as="style">
	<style>
		.profile__form__body .input__wrapper.input__wrapper_100 {
			width: 100%;
			margin-bottom: 20px;
		}
		.main-textarea {
			padding: 12px 20px;
			height: 100px;
		}
		.main-textarea + .custome-placeholder__wrapper .custome-placeholder__text {
			width: calc(100% - 40px);
		}
		.main-textarea + .custome-placeholder__wrapper .custome-placeholder__text .inner-text{
			top: 20%;
		}
	</style>
@endpush

@push('scripts')
<script src="{{ url('js/app.js?v='.config('settings.cache_v')) }}"></script>
<script src="{{ url('js/jspages/native/profile.js?v='.config('settings.cache_v')) }}"></script>
@endpush