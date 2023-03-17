<script setup>
  import { useAuthStore } from '~/store/auth';
  import { useModalStore } from '~/store/modal';

  const isLoading = ref(false)

  // COMPUTED
  const user = computed(() => {
    return useAuthStore().getLogin
  })

  const canNext = computed(() => {
    return user && user.value && user.value.password && user.value.password.length > 5 
  })

  // HANDLERS
  const closeHandler = () => {
    useModalStore().close('logInPassword')
  }

  const openChangePasswordHandler = () => {
    useModalStore().open('changePassword')
  }

  const openLogInEmailHandler = () => {
    useModalStore().open('logInEmail')
  }

  const loginHandler = () => {
    isLoading.value = true

    useLogin()(user.value)
      .then(() => {
        useAuthStore().resetLoginForm()
        closeHandler()
      }).finally(() => {
        isLoading.value = false
      })
  }
</script>

<style src="./password.scss" lang="sass" scoped />

<template>
  <popup-layout-simple @close="closeHandler">
    <template v-slot:title>
      {{ $t('title.password') }}
    </template>
    <template v-slot:content>
      <div class="popup__body">

        <form-password
          v-model="user.password"
          :placeholder="$t('form.Password')"
        >
        </form-password>

        <button
          @click="loginHandler"
          :class="{loading: isLoading, disabled: !canNext}"
          clickable
          class="main-button primary small"
        >
          <span class="text">{{ $t('button.Log_In') }}</span>
        </button>

      </div>
    </template>

    <template v-slot:footer>
      <div class="popup__footer__navigation">
        <button @click="openLogInEmailHandler" clickable type="button" class="button-nav">{{ $t('button.Back') }}</button>
        <button @click="openChangePasswordHandler" clickable type="button" class="button-nav">{{ $t('button.Forgot_Password') }}</button>
      </div>
    </template>

  </popup-layout-simple>
</template>