<!-- <script setup>
  import { useAuthStore } from '~/store/auth';

  const authStore = useAuthStore()

  async function submit(){
    await $fetch('/api/login', {
        method: 'GET'
    }).then(res => console.log(res));
  }

</script> -->
<script>
import { useAuthStore } from '~/store/auth';

export default {
  async setup() {
    const authStore = useAuthStore()
    // const {data: resp} = await useFetch('http://localhost:8888/api/login')

    // console.log('RESP', resp)

    return {
      authStore
    }
  },

  data() {
    return {
      email: '',
      errors: {
        email: null
      }
    }
  },

  computed: {
    isActive() {
      return this.authStore.showLogInEmail
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

    async login() {
      // const sunc = await fetch('http://localhost:8888/sanctum/csrf-cookie');

      // console.log('sunc', sunc)

      // const response = await fetch('http://localhost:8888/api/login', {
      //   method: 'GET',
      //   headers: {
      //     'Content-Type': 'application/x-www-form-urlencoded'
      //   },
      // }).then((resp) => console.log(resp.json()))

      // const answ = await response;
      // console.log('response', answ);
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

        <button @click="submit" type="button" class="main-button-color main-button-color-popup">
            <span class="text">{{ $t('text.next') }}</span>
        </button>

        <!-- <button @click="openLogInPasswordHandler" type="button" class="main-button-color main-button-color-popup">
            <span class="text">{{ $t('text.next') }}</span>
        </button> -->
      </div>
    </template>

    <template v-slot:footer>
      <div class="popup__footer__sing-up">
        <p>{{ $t('text.Don_have_any_account') }}</p>
        <button @click="openSignInSocialHandler" type="button" class="button-enter">{{ $t('text.Sign_Up') }}</button>
      </div>
    </template>
  </popup-layout-simple>
</template>