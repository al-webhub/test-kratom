<script setup>
  import { useModalStore } from '~/store/modal';

  const { t } = useI18n({useScope: 'local'})

  const closeHandler = () => {
    useModalStore().close('logOut')
  }

  const logoutHandler = () => {
    useLogout()('/').finally(() => {
      closeHandler()
    })
  }
</script>

<style src="./out.scss" lang="sass" scoped />

<template>
  <popup-layout-simple @close="closeHandler">
    <template v-slot:title>
      {{ $t('title.logout') }}
    </template>
    <template v-slot:content>
      {{ t('want_to_logout') }}
    </template>
    <template v-slot:footer>
      <div class="footer-inner">
        <button @click="closeHandler" clickable class="button-only-text">
            <span class="text">{{ $t('button.cancel') }}</span>
        </button>
        <button @click="logoutHandler" clickable class="main-button small">
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