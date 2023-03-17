<script setup>
  import { useRegisterMock } from '~/composables/mockups/useRegisterMock';
  const { t } = useI18n({useScope: 'local'})

  const emit = defineEmits(['loginLinkHandler'])

  const errors = ref(null)
  const isLoading = ref(false)
  const user = ref({...useRegisterMock()})

  // METHOD
  const registerHandler = () => {
    isLoading.value = true

    useRegister()(user.value)
      .then(() => {
        user.value = {...useRegisterMock()}
      })
      .catch((er) => {
        errors.value = er
      })
      .finally(() => {
        isLoading.value = false
      })
  }

  // HANDLERS
  const loginLinkHandler = () => {
    emit('loginLinkHandler')
  }
</script>

<style src="./register.scss" lang="scss" scoped />

<template>
  <div>
    <form-text
      v-model="user.firstname"
      :placeholder="$t('form.first_name')"
      :error="errors?.firstname"
      required
      class="form-component"
    >
    </form-text>

    <form-text
      v-model="user.lastname"
      :placeholder="$t('form.Last_name')"
      :error="errors?.lastname"
      class="form-component"
    >
    </form-text>

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

    <form-password
      v-model="user.password_confirmation"
      :placeholder="$t('form.Confirm_Password')"
      :error="errors?.password_confirmation"
      required
      class="form-component"
    >
    </form-password>

    <form-p-c
      :user="user"
      :errors="errors"
    ></form-p-c>
      
    <button @click="registerHandler" :class="{loading: isLoading}" clickable class="main-button primary">
      <span class="text">{{ $t('button.sign_up') }}</span>
    </button>

    <div class="already__wrapper">
      <p>{{ t('Already_have_account') }}</p>
      <button
        @click="loginLinkHandler"
        clickable
        class="button-enter a-link"
      >
        {{ $t('button.Log_In') }}
      </button>
    </div>
  </div>
</template>

<i18n>
  {
    "en": {
      "Already_have_account": "Already have account?",
    },
    "ru": {
      "Already_have_account": "Уже есть аккаунт?",
    }
  }
</i18n>