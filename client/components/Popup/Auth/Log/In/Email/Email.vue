<script>
import { useAuthStore } from '~/store/auth';

export default {
  async setup() {
    const { t } = useI18n({useScope: 'local'}) 
    const authStore = useAuthStore()

    return {
      authStore,
      t
    }
  },

  data() {
    return {}
  },

  computed: {
    user() {
      return this.authStore.getUser
    },

    errors() {
      return this.authStore.getErrors
    }
  },

  methods: {
    closeHandler() {
      return this.authStore.close('logInEmail')
    },

    openLogInPasswordHandler() {
      return this.authStore.open('logInPassword')
    },

    openSignInSocialHandler() {
      return this.authStore.open('signInSocial')
    },
  }
}
</script>

<style src="./email.scss" lang="sass" scoped />

<template>
  <popup-layout-simple @close="closeHandler">
    <template v-slot:title>
      {{ $t('title.log_in') }}
    </template>

    <template v-slot:content>
      <div class="popup__body">

        <form-text
          v-model="user.email"
          :placeholder="$t('form.email')"
          :errors="errors.email"
        >
        </form-text>

        <button @click="openLogInPasswordHandler" type="button" class="main-button primary-color small">
            <span class="text">{{ $t('button.next') }}</span>
        </button>
      </div>
    </template>

    <template v-slot:footer>
      <div class="popup__footer__sing-up">
        <p>{{ t('Don_have_any_account') }}</p>&nbsp;
        <button @click="openSignInSocialHandler" type="button" class="a-link">{{ $t('button.sign_up') }}</button>
      </div>
    </template>

  </popup-layout-simple>
</template>

<i18n>
  {
    "en": {
      "Don_have_any_account" : "Don’t have any account?",
    },
    "ru": {
      "Don_have_any_account" : "У вас нет аккаунта?",
    }
  }
</i18n>