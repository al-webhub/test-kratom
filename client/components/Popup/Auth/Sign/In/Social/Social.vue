<script>
import googleIcon from 'assets/images/google-icon.png';
import { useAuthStore } from '~/store/auth';

export default {
  setup() {
    const authStore = useAuthStore()

    return {
      authStore
    }
  },

  data() {
    return {
    }
  },

  computed: {
    googleImage() {
      return 'url(' + googleIcon + ')';
    },

    isActive() {
      return this.authStore.showSignInSocial
    }
  },

  methods: {
    closeHandler() {
      return this.authStore.close('signInSocial')
    },

    openSignInEmailHandler() {
      return this.authStore.open('signInEmail')
    },

    openLogInEmailHandler() {
      return this.authStore.open('logInEmail')
    }
  }
}
</script>

<style src="./social.scss" lang="sass" scoped />

<template>
  <popup-layout-simple :is-active="isActive" @close="closeHandler">
    <template v-slot:title>
      {{ $t('text.sign_up') }}
    </template>
    <template v-slot:content>
      <a href="'login/google" class="main-button main-button-social-popup">
          <span :style="{backgroundImage: googleImage }" class="google-icon"></span>
          <span class="text">{{ $t('text.continue_with_google') }}</span>
      </a>
      
      <button @click="openSignInEmailHandler" class="main-button main-button-social-popup">
          <img src="~assets/svg-icons/mail.svg" class="icon"/>
          <span class="text">{{ $t('text.sign_up_with_email') }}</span>
      </button>

    </template>
    <template v-slot:footer>
      <button @click="openLogInEmailHandler" type="button" class="button-enter">{{ $t('text.Log_In') }}</button>
    </template>
  </popup-layout-simple>
</template>