<script>
import { useAuthStore } from '~/store/auth';

export default {
  setup() {
    const authStore = useAuthStore()

    return {
      authStore,
    }
  },

  data() {
    return {}
  },

  computed: {
    isActive() {
      return this.authStore.showLogInPassword
    },

    user() {
      return this.authStore.getUser
    },

    errors() {
      return this.authStore.getErrors
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
    },

    async loginHandler() {
      useLogin()()
    }
  }
}
</script>

<style src="./password.scss" lang="sass" scoped />

<template>
  <popup-layout-simple :is-active="isActive" @close="closeHandler">
    <template v-slot:title>
      {{ $t('title.password') }}
    </template>
    <template v-slot:content>
      <div class="popup__body">

        <form-password
          v-model="user.password"
          :placeholder="$t('form.Password')"
          :errors="errors.password"
        >
        </form-password>

        <button @click="loginHandler" class="main-button primary small">
          <span class="text">{{ $t('button.Log_In') }}</span>
        </button>

      </div>
    </template>

    <template v-slot:footer>
      <div class="popup__footer__navigation">
        <button @click="openLogInEmailHandler" type="button" class="button-nav">{{ $t('button.Back') }}</button>
        <button @click="openChangePasswordHandler" type="button" class="button-nav">{{ $t('button.Forgot_Password') }}</button>
      </div>
    </template>

  </popup-layout-simple>
</template>