<script setup>
  import {useAppStore} from '~/store/app'

  const { locale } = useI18n({useScope: 'local'})
  const appStore = useAppStore()

  const payments = computed(() => {
    return appStore.payments(locale.value)
  })
</script>

<style src="./payment.scss" lang="scss" scoped />

<template>
  <div class="wrapper">
    <div class="title">
      <img src="~assets/svg-icons/card.svg" class="icon" />
      {{ $t('payment.payment_options') }}
    </div>
    
    <ul class="items">
      <li v-for="(item, index) in payments" :key="index" class="item">
        <NuxtPicture v-if="item" :src="item.image" class="item__image"></NuxtPicture>
        <div class="item__name">{{ item.name }}</div>
      </li>
      <li class="item">
        <div class="item__name">{{ $t('payment.another') }}</div>
      </li>
    </ul>

    <p>{{ $t('payment.There_are_lots') }}</p>

  </div>
</template>