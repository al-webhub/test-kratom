@section('breadcrumbs', Breadcrumbs::render('accountPage', __('text.account_settings')))

@extends('account.layouts.app')

@section('account')
<div class="profile__info">
    <p class="profile__info__caption">{{ __('text.account_settings') }}</p>
    <div class="profile__address">
        <form action="{{ url('account/edit') }}" method="post" enctype="multipart/form-data" class="profile__form">
            @csrf
            <div class="profile__form__body">
                <label class="input__wrapper js-input-wrapper">
                    <input type="text" class="main-input js-input" name="firstname" required="" value="{{ $user->usermeta->firstname }}">
                    <span class="custome-placeholder__wrapper">
                        <span class="custome-placeholder__before"></span>
                        <span class="custome-placeholder__text">
                            <span class="inner-text">{{ __('text.First_name') }}</span>
                        </span>
                        <span class="custome-placeholder__after"></span>
                    </span>
                </label>
                <label class="input__wrapper js-input-wrapper">
                    <input name="lastname" type="text" class="main-input js-input" value="{{ $user->usermeta->lastname }}">
                    <span class="custome-placeholder__wrapper">
                        <span class="custome-placeholder__before"></span>
                        <span class="custome-placeholder__text">
                            <span class="inner-text">{{ __('text.Last_name') }}</span>
                        </span>
                        <span class="custome-placeholder__after"></span>
                    </span>
                </label>
                <label class="input__wrapper js-input-wrapper">
                    <input type="email" name="email" value="{{ $user->email }}" class="main-input js-input" required="" >
                    <span class="custome-placeholder__wrapper">
                        <span class="custome-placeholder__before"></span>
                        <span class="custome-placeholder__text">
                            <span class="inner-text">Email <span>*</span></span>
                        </span>
                        <span class="custome-placeholder__after"></span>
                    </span>
                </label>
                <label class="input__wrapper js-input-wrapper">
                    <input type="tel" class="main-input js-input" name="telephone" value="{{ $user->usermeta->telephone }}">
                    <span class="custome-placeholder__wrapper">
                        <span class="custome-placeholder__before"></span>
                        <span class="custome-placeholder__text">
                            <span class="inner-text">{{ __('text.International_phone') }}</span>
                        </span>
                        <span class="custome-placeholder__after"></span>
                    </span>
                </label>
                <div class="input__wrapper js-input-wrapper js-drop-item general-drop">
                    <input type="text" class="main-input js-input js-drop-input js-drop-button" readonly="" required="" name="extras[communication]" v-model="selectedCommunication"> 
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
                        <div class="general-drop__item js-drop-contains" v-for="(communication, key) in communications" @click="selectedCommunication = communication" >
                            <span class="icon-active"></span>
                            <div class="text" >@{{ communication }}</div>
                        </div>
                    </div>
                </div>
                
                <label class="input__wrapper js-input-wrapper" :class="{disabled: !selectedCommunication}">
                    <input type="text" class="main-input js-input" required="" name="extras[communication_number]" value="{{ $user->usermeta->extras['communication_number'] ?? '' }}">
                    <span class="custome-placeholder__wrapper">
                        <span class="custome-placeholder__before"></span>
                        <span class="custome-placeholder__text">
                            <span class="inner-text">@{{ selectedCommunication }} {{ __('text.account') }} <span>*</span></span>
                        </span>
                        <span class="custome-placeholder__after"></span>
                    </span>
                </label>
                
                <div style="margin:0 0 30px 0">
                    <p style="font-size: 14px; line-height: 150%;">{{ __('text.Please_write_your') }}</p>
                </div>
            </div>
            <div class="profile__form__footer">
                <button type="button" class="button-only-text js-button" data-target="change-pass">
                    <span class="text">{{ __('text.Change_password') }}</span>
                </button>
                <button class="main-button main-button-small main-button-profile">
                    <span class="text">{{ __('text.save_address') }}</span>
                </button>
            </div>
        </form>
    </div>
</div>          
@endsection
@push('styles')
	<link href="{{ url('/css/csspages/profile.css') }}" rel="preload" as="style">
@endpush
@push('scripts')
<script>
	var dataExtras = @json($user->usermeta->extras); 
</script>
<script src="{{ url('js/account/edit.js') }}"></script>
<script src="{{ url('js/jspages/native/profile.js') }}"></script>
@endpush