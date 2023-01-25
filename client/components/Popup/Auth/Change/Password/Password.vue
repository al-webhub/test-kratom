<script>
import { useAuthStore } from '~/store/auth';

export default {
  setup() {
    const authStore = useAuthStore()
    const { t } = useI18n({useScope: 'local'}) 

    return {
      authStore,
      t
    }
  },

  data() {
    return {
      password: '',
      password_confirmation: '',
      errors: {
        password: null,
        password_confirmation: null
      },
    }
  },

  computed: {
    user() {
      return this.authStore.getUser
    },

    errors() {
      return this.authStore.getErrors
    },

    rules() { 
      return [
        {
          uid: 1,
          label: this.$t('form.Min_8_characters'),
          validated: this.password.length >= 8
        },{
          uid: 2,
          label: this.$t('form.1_Letter'),
          validated: false
        },{
          uid: 3,
          label: this.$t('form.1_Number'),
          validated: false
        }
      ]
    },

    isActive() {
      return this.authStore.showChangePassword
    },

    isDisabled() {
      return !this.password.length || !this.password_confirmation.length
    }
  },

  methods: {
    backHandler() {
      this.closeHandler()
      this.authStore.open('logInPassword')
    },

    closeHandler() {
      return this.authStore.close('changePassword')
    }
  }
}
</script>

<style src="./password.scss" lang="sass" scoped />

<template>
  <popup-layout-simple :is-active="isActive" @close="closeHandler">
    <template v-slot:title>
      {{ $t('title.set_new_password') }}
    </template>
    <template v-slot:content>
      <div>
        <div class="popup__header">
          <p class="email" v-if="user">{{ t('for', {email: user.email}) }}</p>
          <ul class="popup-check__list">
            <li 
              v-for="rule in rules"
              :key="rule.id"
              :class="{active: rule.validated}"
              class="popup-check__item"
            >
              <span class="decor">
                <img src="~assets/svg-icons/check.svg" class="icon" />
              </span>
              <span class="text">{{ rule.label }}</span>
            </li>
          </ul>
        </div>

        <div class="popup__body">

          <form-password
            v-model="password"
            :placeholder="$t('form.New_Password')"
            :errors="errors.password"
            class="form-component"
          >
          </form-password>

          <form-password
            v-model="password_confirmation"
            :placeholder="$t('form.Password')"
            :errors="errors.password_confirmation"
            class="form-component"
          >
          </form-password>

          <button :class="{disabled: isDisabled}" class="main-button primary small">
              <span class="text">{{ $t('button.set_new_password') }}</span>
          </button>
        </div>
      </div>
    </template>
    <template v-slot:footer>
      <div class="footer">
        <button @click="backHandler" type="button" class="back-btn">{{ $t('button.Back') }}</button>
      </div>
    </template>
  </popup-layout-simple>
</template>

<i18n>
  {
    "en": {
      "for" : "for {email}",
    },
    "ru": {
      "for" : "для {email}",
    }
  }
</i18n>