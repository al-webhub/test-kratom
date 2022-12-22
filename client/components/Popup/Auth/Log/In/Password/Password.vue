<script>
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
      password: '',
      errors: {
        password: null
      }
    }
  },

  computed: {
    isActive() {
      return this.authStore.showLogInPassword
    }
  },

  methods: {
    closeHandler() {
      return this.authStore.close('logInPassword')
    },

    openChangePasswordHandler() {
      return this.authStore.open('changePassword')
    },

    openLogInEmailHandler() {
      return this.authStore.open('logInEmail')
    }
  }
}
</script>

<style src="./password.scss" lang="sass" scoped />

<template>
  <popup-layout-simple :is-active="isActive" @close="closeHandler">
    <template v-slot:title>
      {{ $t('text.Password') }}
    </template>
    <template v-slot:content>
      <div class="popup__body">

        <form-password
          v-model="password"
          :placeholder="$t('text.Password')"
          :errors="errors.password"
        >
        </form-password>

        <button class="main-button-color main-button-color-popup">
          <span class="text">{{ $t('text.Log_In') }}</span>
        </button>
      </div>
    </template>
    <template v-slot:footer>
      <div class="popup__footer__navigation">
        <button @click="openLogInEmailHandler" type="button" class="button-nav">{{ $t('text.Back') }}</button>
        <button @click="openChangePasswordHandler" type="button" class="button-nav">{{ $t('text.Forgot_Password') }}</button>
      </div>
    </template>
  </popup-layout-simple>
</template>