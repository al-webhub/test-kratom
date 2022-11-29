<script>
export default {
  data() {
    return {
      isActive: false
    }
  },

  methods: {
    closeHandler() {
      this.isActive = false
    }
  }
}
</script>

<style src="./social.scss" lang="sass" scoped />

<template>
<!-- <section class="popup popup-registration-social" data-target="registration-social">
  <button type="button" class="close__popup js-close">
      <span class="icon-close"></span>
  </button>
  <p class="popup-caption">{{ $t('text.sign_up') }}</p>
  <div class="popup__body">
      <a href="{{ url('login/google') }}" class="main-button main-button-social-popup">
          <span class="icon" style="background-image:url({{url('/img/google-icon.png')}})"></span>
          <span class="text">{{ $t('text.continue_with_google') }}</span>
      </a>
      <a href="{{ url('login/facebook') }}" class="main-button main-button-social-popup">
          <span class="icon" style="background-image:url({{url('/img/fb-icon.png')}})"></span>
          <span class="text">continue with facebook</span>
      </a>
      <button class="main-button main-button-social-popup js-button" data-target="registration">
          <span class="icon icon-message"></span>
          <span class="text">{{ $t('text.sign_up_with_email') }}</span>
      </button>
  </div>
  <button type="button" class="button-enter js-button" data-target="log-in">{{ $t('text.Log_In') }}</button>
</section> -->

<popup-layout-simple :is-active="isActive" @close="closeHandler">
    <template v-slot:title>
      {{ $t('text.sign_up') }}
    </template>
    <template v-slot:content>
      <a href="'login/google" class="main-button main-button-social-popup">
          <span class="icon" :style="{backgroundImage: 'url(' + '/img/google-icon.png' + ')' }"></span>
          <span class="text">{{ $t('text.continue_with_google') }}</span>
      </a>
      <!-- <a href="{{ url('login/facebook') }}" class="main-button main-button-social-popup">
          <span class="icon" style="background-image:url({{url('/img/fb-icon.png')}})"></span>
          <span class="text">continue with facebook</span>
      </a> -->
      <button class="main-button main-button-social-popup">
          <span class="icon icon-message"></span>
          <span class="text">{{ $t('text.sign_up_with_email') }}</span>
      </button>
    </template>
    <template v-slot:footer>
      <button type="button" class="button-enter">{{ $t('text.Log_In') }}</button>
    </template>
  </popup-layout-simple>
</template>