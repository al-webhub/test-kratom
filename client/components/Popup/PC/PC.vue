<script setup>
  import { useModalStore } from '~/store/modal'
  import { useProfileStore } from '~/store/profile'

  const { t, locale } = useI18n({useScope: 'local'})

  const profile = computed(() => {
    return useProfileStore().profile
  })

  const errors = ref({
    communication: '',
    communication_number: ''
  })

  const redirectTo = computed(() => {
    return useModalStore().data('pc')
  })

  const close = () => {
    useModalStore().close('pc')
  }

  const logoutHandler = () => {
    useLogout()('/').finally(() => {
      close()
    })
  }

  const saveHandler = () => {
    useProfileStore().updateProfile().then((data) => {
      useNoty().setNoty(t('noty.update_success'))
      close()
      navigateTo(redirectTo.value)
    }).catch((data) => {
      useNoty().setNoty(t('noty.update_fail'))
      errors.value = data
    })
  }

  // HOOK
  await useAsyncData('profile', () => useProfileStore().getProfile())

</script>

<style src="./pc.scss" lang="sass" scoped />

<template>
  <popup-layout-simple :can-close="false">
    <template v-slot:title>
      {{ t('title') }}
    </template>
    <template v-slot:content>
      <div>
        <p class="desc">{{ t('desc') }}</p>
        <form-p-c
          :user="profile"
          :errors="errors"
        >
        </form-p-c>
      </div>
    </template>
    <template v-slot:footer>
      <button @click="logoutHandler" clickable class="main-button small btn">
        <span class="text">{{ t('button.logout') }}</span>
      </button>    
      <button @click="saveHandler"  clickable class="main-button primary-color small btn">
        <span class="text">{{ t('button.save') }}</span>
      </button>    
    </template>
  </popup-layout-simple>
</template>

<i18n>
  {
    en: {
      title: "Fill in the key data",
      desc: "Please setup your preferred method of communication so that we can serve you correctly.",
    },

    ru: {
      title: "Заполните ключевые данные",
      desc: "Укажите предпочитаемый способ коммуникации, чтобы бы могли корректно обслуживать вас.",
    }
  }
</i18n>