<template>
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
</template>