<template>
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
</template>