<script setup>
  import { useLoginMock } from '~/composables/mockups/useLoginMock';

  const errors = ref(null)
  const isLoading = ref(false)
  const user = ref({...useLoginMock()})

  // METHODS
  const loginHandler = async () => {
    isLoading.value = true

    useLogin()(user.value)
      .then(() => {
        user.value = {...useLoginMock()}
      })
      .catch((er) => {
        errors.value = er
      })
      .finally(() => {
        isLoading.value = false
      })
  }

</script>

<style src="./login.scss" lang="scss" scoped />

<template>
  <div>
    <form-text
      v-model="user.email"
      placeholder="Email"
      :error="errors?.email"
      required
      class="form-component"
    >
    </form-text>

    <form-password
      v-model="user.password"
      :placeholder="$t('form.Password')"
      :error="errors?.password"
      required
      class="form-component"
    >
    </form-password>

    <div class="forgot__wrapper">
      <button clickable class="forgot-btn">{{ $t('button.Forgot_Password') }}</button>
    </div>

    <button @click="loginHandler" :class="{loading: isLoading}" clickable class="main-button primary">
      <span class="text">{{ $t('button.Log_In') }}</span>
    </button>
  </div>
</template>