<script>
export default {
  data() {
    return {
      isActive: false,
      email: '',
      errors: {
        email: null
      }
    }
  },

  methods: {
    closeHandler() {
      this.isActive = false
    }
  }
}
</script>

<style src="./email.scss" lang="sass" scoped />

<template>
  <popup-layout-simple :is-active="isActive" @close="closeHandler">
    <template v-slot:title>
      {{ $t('text.Log_In') }}
    </template>
    <template v-slot:content>
      <div class="popup__body">

        <form-text
          v-model="email"
          :placeholder="$t('text.Email')"
          :errors="errors.email"
        >
        </form-text>

        <button type="button" class="main-button-color main-button-color-popup">
            <span class="text">{{ $t('text.next') }}</span>
        </button>
      </div>
    </template>
    <template v-slot:footer>
      <div class="popup__footer__sing-up">
        <p>{{ $t('text.Don_have_any_account') }}</p>
        <button type="button" class="button-enter">{{ $t('text.Sign_Up') }}</button>
      </div>
    </template>
  </popup-layout-simple>
</template>