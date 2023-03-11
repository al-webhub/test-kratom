<script setup>
  import { useAppPersistStore } from '~/store/appPersist'

  const { t, locale } = useI18n({useScope: 'local'})

  const notHandler = () => {
    let url = ''

    switch(locale) {
      case 'ru':
        url = 'https://ru.wikipedia.org/wiki/%D0%9A%D1%80%D0%B0%D1%82%D0%BE%D0%BC'
        break;
      case 'en':
        url = "https://en.wikipedia.org/wiki/Mitragyna_speciosa"
        break;
      default:
        url = 'https://en.wikipedia.org/wiki/Mitragyna_speciosa'
        break;
    }

    navigateTo(url, { external: true })
  }

  const yesHandler = () => {
    useAppPersistStore().close('adult') 
  }
</script>

<style src="./adult.scss" lang="sass" scoped />

<template>
  <popup-layout-simple @close="closeHandler" :can-close="false">
    <template v-slot:title>
      {{ t('you_must') }}
    </template>
    <template v-slot:content>
      {{ t('you_must_2') }}
    </template>
    <template v-slot:footer>
      <button @click="notHandler" clickable class="button-only-text btn">
        <span class="text">{{ t('no') }}</span>
      </button>
      <button @click="yesHandler" clickable class="main-button small btn">
        <span class="text">{{ t('i_am_18') }}</span>
      </button>    
    </template>
  </popup-layout-simple>
</template>

<i18n>
  {
    en: {
      you_must: "You must be 18+ to visit our webshop",
      you_must_2: "You must be at least eighteen years old to view this content. Are you over eighteen?",
      no: "No, I am not",
      i_am_18: "I am 18+",
    },

    ru: {
      you_must: "Контент 18+",
      you_must_2: "Вам должно быть не менее восемнадцати лет, чтобы смотреть этот контент. Вам исполнилось восемнадцать лет?",
      no: "Нет",
      i_am_18: "Мне 18+",
    }
  }
</i18n>