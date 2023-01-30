<script>
import {useAppStore} from '~/store/app'

export default {
  setup() {
    const { t, locale } = useI18n({useScope: 'local'})
    const appStore = useAppStore()

    const payments = computed(() => {
      return appStore.payments(locale.value)
    })

    const deliveryTimes = computed(() => {
      return appStore.deliveryTimes(locale.value)
    })

    const deliveryMethods = computed(() => {
      return appStore.deliveryMethods(locale.value)
    })

    return {
      t,
      payments,
      deliveryTimes,
      deliveryMethods
    }
  },

  data() {
    return {}
  },

  computed: {

    page() {
      return {
        h1: this.t('pay_delivery_info'),
        title: this.t('pay_delivery_info'),
        payment_info_title: this.$t('payment.payment'),
        payment_info: this.$t('payment.info'),
        delivery_times_title: this.$t('delivery.delivery_time'),
        delivery_times: this.$t('delivery.delivery_time_info'),
        delivery_method_title: this.$t('delivery.delivery_method'),
        delivery_method: this.$t('delivery.The_Dispatch_takes')
      }
    }
  },

  methods: {
    setCrumbs() {
      useCrumbs().setCrumbs([
          {
            name: this.$t('crumbs.home'),
            link: '/'
          },{
            name: this.$t('crumbs.pay_delivery'),
            link: '/pay_delivery'
          }
      ])
    },

  },

  async created() {
    this.setCrumbs()
  }

}
</script>

<style src="assets/scss/pages/pay-delivery.scss" lang="sass" scoped />

<template>
<div>
<section class="pay-delivery">
    <div class="pay-deliver__wrapper container">
        <!-- <div class="general-decor-figure"></div>
        <div class="general-decor-text">kratom helper</div> -->
        
        <h1 class="main-caption main-caption-align">{{ page.h1 || page.title  }}</h1>

        <ul class="pay-delivery__list">

            <li class="pay-delivery__item">
                <div class="general-decor-caption">
                  <img src="~assets/svg-icons/promo/wallet.svg" class="icon" />
                </div>

                <h2 class="main-caption-l">{{ page.payment_info_title }}</h2>

                <ul v-if="payments" class="delivery__list delivery__list-payment">
                    <li 
                      v-for="(payment, index) in payments"
                      :key="index"
                      class="delivery__item"
                    >
                      <div 
                        v-if="payment.image"
                        :style="{backgroundImage: 'url(' + payment.image + ')'}"
                        class="delivery__item__img" 
                      >
                      </div>
                        
                      <p class="text">{{ payment.name }}</p>
                    </li>

                    <li class="delivery__item">
                        <p class="text">{{ $t('payment.another') }}</p>
                    </li>
                </ul>

                <div v-html="page.payment_info"></div>
            </li>

            <li class="pay-delivery__item">
                <div class="general-decor-caption">
                  <img src="~assets/svg-icons/promo/clock.svg" class="icon" />
                </div>

                <h2 class="main-caption-l">{{ page.delivery_times_title }}</h2>
                
                <ul v-if="deliveryTimes" class="delivery__list delivery__list-option">
                  <li
                    v-for="(delivery, index) in deliveryTimes"
                    :key="index"
                    class="delivery__item"
                  >
                      <p>
                        {{ delivery }} 
                      </p>
                  </li>
                </ul>
                
                <div v-html="page.delivery_times"></div>
            </li>

            <li class="pay-delivery__item">
                <div class="general-decor-caption">
                  <img src="~assets/svg-icons/promo/track.svg" class="icon" />
                </div>

                <h2 class="main-caption-l">{{ page.delivery_method_title }}</h2>
                <ul  v-if="deliveryMethods" class="delivery__list delivery__list-deliver">
                  <li
                    v-for="(delivery, index) in deliveryMethods"
                    :key="index"
                    class="delivery__item"
                  >
                    <p>{{ delivery }}</p>
                  </li>
                </ul>
                <div v-html="page.delivery_method"></div>
            </li>
        </ul>
    </div>
</section>

<section-write-us></section-write-us>
</div>
</template>

<i18n>
  {
    "en": {
      "pay_delivery_info": "pay/delivery information",
    },
    "ru": {
      "pay_delivery_info": "Информация об оплате/доставке",
    }
  }
</i18n>