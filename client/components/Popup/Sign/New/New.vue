<template>
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
</template>