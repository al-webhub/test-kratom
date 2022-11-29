<template>
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
</template>