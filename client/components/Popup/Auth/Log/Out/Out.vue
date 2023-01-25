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
    return {
      isActive: false
    }
  },

  computed: {
    isActive() {
      return this.authStore.showLogOut
    },
  },

  methods: {
    closeHandler() {
      this.authStore.close('logOut')
    },

    logoutHandler() {
      useLogout()('/')
      this.closeHandler()
    }
  }
}
</script>

<style src="./out.scss" lang="sass" scoped />

<template>
  <popup-layout-simple :is-active="isActive" @close="closeHandler">
    <template v-slot:title>
      {{ $t('title.logout') }}
    </template>
    <template v-slot:content>
      {{ t('want_to_logout') }}
    </template>
    <template v-slot:footer>
      <div>
        <button @click="closeHandler" class="button-only-text">
            <span class="text">{{ $t('button.cancel') }}</span>
        </button>
        <button @click="logoutHandler" class="main-button small">
          <span class="text">{{ $t('button.yes') }}</span>
        </button> 
      </div>
    </template>
  </popup-layout-simple>
</template>

<i18n>
  {
    "en": {
      "want_to_logout" : "Are you sure you want to logout?",
    },
    "ru": {
      "want_to_logout" : "Вы действительно хотите выйти?",
    }
  }
</i18n>