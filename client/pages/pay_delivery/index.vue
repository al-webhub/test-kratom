<script setup>
  import {useAppStore} from '~/store/app'

  const { t, locale } = useI18n({useScope: 'local'})
  const appStore = useAppStore()

  //  COMPUTED
  const payments = computed(() => {
    return appStore.payments(locale.value)
  })

  const deliveryTimes = computed(() => {
    return appStore.deliveryTimes(locale.value)
  })

  const deliveryMethods = computed(() => {
    return appStore.deliveryMethods(locale.value)
  })

  const page = computed(() => {
    return {
      h1: t('pay_delivery_info'),
      title: t('pay_delivery_info'),
      payment_info_title: t('payment.payment'),
      payment_info: t('payment.info'),
      delivery_times_title: t('delivery.delivery_time'),
      delivery_times: t('delivery.delivery_time_info'),
      delivery_method_title: t('delivery.delivery_method'),
      delivery_method: t('delivery.The_Dispatch_takes')
    }
  })

  const breadcrumbs = [
    {
      name: t('crumbs.home'),
      item: useToLocalePath()('/')
    },{
      name: t('crumbs.pay_delivery'),
      item: useToLocalePath()('/pay_delivery')
    }
  ]

  useCrumbs().setCrumbs(breadcrumbs)

  useSchemaOrg([
    defineBreadcrumb({
      itemListElement: breadcrumbs
    }),
  ])
</script>

<style src="./pay-delivery.scss" lang="sass" scoped />

<template>
<div>
  <simple-decor :title-amount="0">
    <section class="pay-delivery">
        <div class="pay-deliver__wrapper container">
            
            <h1 class="main-caption main-caption-align">{{ page.h1 || page.title  }}</h1>

            <ul class="pay-delivery__list">

                <li class="pay-delivery__item">
                    <div class="decor-rect">
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
                    <div class="decor-rect">
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
                    <div class="decor-rect">
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
  </simple-decor>
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