<template>
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
</template>