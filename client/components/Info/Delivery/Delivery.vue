<script setup>
  import {useAppStore} from '~/store/app'

  const { locale } = useI18n({useScope: 'local'})
  const appStore = useAppStore()

  const deliveryTimes = computed(() => {
    return appStore.deliveryTimes(locale.value)
  })

  const deliveryMethods = computed(() => {
    return appStore.deliveryMethods(locale.value)
  })
</script>

<style src="./delivery.scss" lang="scss" scoped />

<template>
  <div class="wrapper">

    <div class="title">
      <img src="~assets/svg-icons/calendar.svg" class="icon" />
      {{ $t('delivery.we_have_several') }}
    </div>
    
    <ul v-if="deliveryTimes" class="items">
      <li v-for="(item, index) in deliveryTimes" :key="index" class="item">
        <div class="item__name">{{ item }}</div>
      </li>
    </ul>


    <div class="title">
      <img src="~assets/svg-icons/promo/track.svg" class="icon" />
      {{ $t('delivery.we_have_several') }}
    </div>

    <ul v-if="deliveryMethods" class="items">
      <li v-for="(item, index) in deliveryMethods" :key="index" class="item">
        <div class="item__name">{{ item }}</div>
      </li>
    </ul>

    <p>{{ $t('delivery.The_Dispatch_takes') }}</p>

    <div class="title mb-10">
      <img src="~assets/svg-icons/user.svg" class="icon scale-90" />
      {{ $t('delivery.Anonymous_delivery') }}
    </div>
    
    <p>{{ $t('delivery.Concerning_safety') }}</p>
    <p>{{ $t('delivery.So_you_may') }}</p>

  </div>
</template>