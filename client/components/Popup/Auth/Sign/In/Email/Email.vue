<script>
import { useAuthStore } from '~/store/auth';

export default {
  setup() {
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
      return this.authStore.close('signInEmail')
    },

    openLogInEmailHandler() {
      return this.authStore.open('logInEmail')
    },

    registerHandler() {
      useRegister()()
    }
  }
}
</script>

<style src="./email.scss" lang="sass" scoped />

<template>

<popup-layout-simple @close="closeHandler">
    <template v-slot:title>
      {{ $t('title.sign_up') }}
    </template>
    <template v-slot:content>
      <div class="popup__body">
        <form-text
          v-model="user.firstname"
          :placeholder="$t('form.first_name')"
          :error="errors.firstname"
          required
          class="form-component"
        >
        </form-text>

        <form-text
          v-model="user.lastname"
          :placeholder="$t('form.Last_name')"
          :error="errors.lastname"
          class="form-component"
        >
        </form-text>


        <form-text
          v-model="user.email"
          placeholder="Email"
          :error="errors.email"
          required
          class="form-component"
        >
        </form-text>

        <form-p-c
          :user="user"
          :errors="errors"
        ></form-p-c>

        <form-password
          v-model="user.password"
          :placeholder="$t('form.Password')"
          :error="errors.password"
          required
          class="form-component"
        >
        </form-password>

        <form-password
          v-model="user.password_confirmation"
          :placeholder="$t('form.Confirm_Password')"
          :error="errors.password_confirmation"
          required
          class="form-component"
        >
        </form-password>

        <div class="checkout__item__policy">
          <label class="input__wrapper input__wrapper-checkbox">
            <input type="checkbox" value="1" required="required" class="input-checkbox"> 
            <span class="custome-checkbox"><span class="icon-active"></span></span> 
            <span>
              {{ $t('auth.i_agreed_with') }}&nbsp;
              <NuxtLink :to="localePath('/privacy')" class="a-link" target="_blade">{{ $t('title.Privacy_Policy') }}</NuxtLink>
            </span>
          </label>
        </div>
            
        <!-- //Добавил пароль, в макете его небыло -->
        <button @click="registerHandler" class="main-button primary small">
            <span class="text">{{ $t('button.sign_up') }}</span>
        </button>

        <div class="popup__footer">
            <div class="popup__footer__sing-up">
                <p>{{ t('Already_have_account') }}</p>
                &nbsp;
                <button @click="openLogInEmailHandler" type="button" class="a-link">{{ $t('button.Log_In') }}</button>
            </div>
        </div>

      </div>
    </template>
    <template v-slot:footer>

    </template>
  </popup-layout-simple>
</template>

<i18n>
  {
    "en": {
      "Already_have_account" : "Already have an account?",
    },
    "ru": {
      "Already_have_account" : "Уже есть аккаунт?",
    }
  }
</i18n>