<script>
export default {

  data() {
    return {
      paymentsData: null
    }
  },
  
  methods: {
    async getPayments() {
      return await usePayments().then((res) => {
        this.paymentsData = res.value
      })
    },
  },

  async created() {
    await this.getPayments()
  }
}
</script>

<style src="./payment.scss" lang="scss" scoped />

<template>
  <div class="wrapper">
    <div class="title">
      <img src="~assets/svg-icons/card.svg" class="icon" />
      {{ $t('payment.payment_options') }}
    </div>
    
    <ul class="items">
      <li v-for="(item, index) in paymentsData" :key="index" class="item">
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