<script setup>
  import { useAuthStore } from '~/store/auth';
  import { useModalStore } from '~/store/modal';

  const { t } = useI18n({useScope: 'local'})

  // COMPUTED
  const user = computed(() => {
    return useAuthStore().getLogin
  })

  const canNext = computed(() => {
    return user && user.value && user.value.email && user.value.email.length > 5 
  })

  // HANDLERS
  const closeHandler = () => {
    useModalStore().close('logInEmail')
  }

  const openLogInPasswordHandler = () => {
    useModalStore().open('logInPassword')
  }

  const openSignInSocialHandler = () => {
    useModalStore().open('signInSocial')
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
        >
        </form-text>

        <button
          @click="openLogInPasswordHandler"
          :class="{disabled: !canNext}"
          clickable
          type="button"
          class="main-button primary-color small"
        >
          <span class="text">{{ $t('button.next') }}</span>
        </button>
      </div>
    </template>

    <template v-slot:footer>
      <div class="popup__footer__sing-up">
        <p>{{ t('Don_have_any_account') }}</p>&nbsp;
        <button
          @click="openSignInSocialHandler"
          clickable
          type="button"
          class="a-link"
        >
          {{ $t('button.sign_up') }}
        </button>
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