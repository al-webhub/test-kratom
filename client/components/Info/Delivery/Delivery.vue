<script>
export default {

  data() {
    return {
      deliveriesData: null
    }
  },

  methods: {
    async getDeliveries() {
      return await useDeliveries().then((res) => {
        this.deliveriesData = res.value
      })
    },
  },

  async created() {
    await this.getDeliveries()
  }
}
</script>

<style src="./delivery.scss" lang="scss" scoped />

<template>
  <div class="wrapper">

    <div class="title">
      <img src="~assets/svg-icons/calendar.svg" class="icon" />
      {{ $t('delivery.we_have_several') }}
    </div>
    
    <ul v-if="deliveriesData && deliveriesData.times" class="items">
      <li v-for="(item, index) in deliveriesData.times" :key="index" class="item">
        <div class="item__name">{{ item }}</div>
      </li>
    </ul>


    <div class="title">
      <img src="~assets/svg-icons/promo/track.svg" class="icon" />
      {{ $t('delivery.we_have_several') }}
    </div>

    <ul v-if="deliveriesData && deliveriesData.methods" class="items">
      <li v-for="(item, index) in deliveriesData.methods" :key="index" class="item">
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