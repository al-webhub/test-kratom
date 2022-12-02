<script>
export default {
  data() {
    return {
      isActive: false,
      password: '',
      password_confirmation: '',
      user: {
        email: 'flomaster@gmail.com'
      },
      errors: {
        password: null,
        password_confirmation: null
      },
    }
  },

  computed: {
    rules() { 
      return [
        {
          uid: 1,
          label: this.$t('text.Min_8_characters'),
          validated: this.password.length >= 8
        },{
          uid: 2,
          label: this.$t('text.1_Letter'),
          validated: false
        },{
          uid: 3,
          label: this.$t('text.1_Number'),
          validated: false
        }
      ]
    }
  },

  methods: {
    closeHandler() {
      this.isActive = false
    }
  }
}
</script>

<style src="./password.scss" lang="sass" scoped />

<template>
  <popup-layout-simple :is-active="isActive" @close="closeHandler">
    <template v-slot:title>
      {{ $t('text.set_new_password') }}
    </template>
    <template v-slot:content>

      <div class="popup__header">
        <p class="email">{{ $t('text.for') }} <span v-if="user">{{ user.email }}</span></p>
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
          :placeholder="$t('text.New_Password')"
          :errors="errors.password"
          class="form-component"
        >
        </form-password>

        <form-password
          v-model="password_confirmation"
          :placeholder="$t('text.Password')"
          :errors="errors.password_confirmation"
          class="form-component"
        >
        </form-password>

        <button class="main-button-color main-button-color-popup disabled js-pass-button">
            <span class="text">{{ $t('text.set_new_password') }}</span>
        </button>
      </div>
    </template>
    <!-- <template v-slot:footer>
      <div class="popup__footer__navigation">
        <button type="button" class="button-nav">{{ $t('text.Back') }}</button>
        <button type="button" class="button-nav">{{ $t('text.Forgot_Password') }}</button>
      </div>
    </template> -->
  </popup-layout-simple>
</template>