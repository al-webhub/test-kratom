<script setup>
  import { useModalStore } from '~/store/modal';
  import { useAuthStore } from '~/store/auth';

  // COMPUTED
  const googleImage = computed(() => {
    return 'url(' + googleIcon + ')';
  })

  // HANDLERS
  const closeHandler = () => {
    useModalStore().close('signInSocial')
  }

  const openSignInEmailHandler = () => {
    useModalStore().open('signInEmail')
  }

  const openLogInEmailHandler = () => {
    useModalStore().open('logInEmail')
  }

  const googleHandler = () => {
    closeHandler()
    useAuthStore().google()
  }
</script>

<style src="./social.scss" lang="sass" scoped />

<template>
  <popup-layout-simple @close="closeHandler">
    <template v-slot:title>
      {{ $t('title.sign_up') }}
    </template>
    
    <template v-slot:content>
      <div>
        <button @click="googleHandler" clickable class="main-button main-button-social-popup">
          <nuxt-img
            src="/images/google-icon.png"
            sizes = "mobile:17px"
            format = "webp"
            quality = "80"
            fit="contain"
            loading = "lazy"
            class="google-icon"
          ></nuxt-img>
          <span class="text">{{ $t('button.continue_with_google') }}</span>
        </button>
        
        <button @click="openSignInEmailHandler" clickable class="main-button main-button-social-popup">
          <img src="~assets/svg-icons/mail.svg" class="icon"/>
          <span class="text">{{ $t('button.sign_up_with_email') }}</span>
        </button>
      </div>
    </template>

    <template v-slot:footer>
      <button @click="openLogInEmailHandler" clickable type="button" class="a-link">{{ $t('button.Log_In') }}</button>
    </template>
  </popup-layout-simple>
</template>