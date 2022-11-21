<script>
import payDeliveryImg from 'assets/images/pay-delivery.png'

export default {
  data() {
    return {
      page: {
        h1: '',
        title: 'PAY/DELIVERY INFORMATION',
        payment_info_title: 'PAYMENT',
        payment_info: `You can pay in any way convenient for you, if this method is not in the proposed options, please contact us.

We would like to inform you at once that there are different delivery ways with the same result – your order will be brought home. You must pay the delivery additionally. As soon as you choose a delivery way, we are going to inform you about its price`,
        delivery_times_title: 'DELIVERY TIMES',
        delivery_times: 'If you have the possibility to wait for 2 or 3 weeks, you may choose the cheapest delivery way. It is going to cost about $5-10 (depending on your location).',
        delivery_method_title: 'DELIVERY METHOD',
        delivery_method: 'Dispatch takes place from the Czech Republic, the further your delivery address, the more expensive the delivery will cost. We will inform you of the exact details after placing the order'

      },
      payments: [
        {
          id: 1,
          name: 'KIWI',
          image: null
        },{
          id: 1,
          name: 'TINKOFF',
          image: null
        }
      ],
      deliveries: [
        {
          id: 1,
          name: '7 to 28 days',
          price: 0
        },{
          id: 2,
          name: 'from 3 to 21 days (Europe)',
          price: 0
        }
      ],
      deliveryTypes: [
        {
          id: 1,
          name: 'Fedex'
        },{
          id: 2,
          name: 'Fedex'
        }
      ]
    }
  },

  computed: {
    payDeliveryBg() {
      return 'url(' + payDeliveryImg + ')'
    }
  }

}
</script>

<style src="assets/scss/pages/pay-delivery.scss" lang="sass" scoped />

<template>
<section class="pay-delivery">
    <div class="pay-deliver__wrapper container">
        <div class="general-decor-figure"></div>
        <div class="general-decor-text">kratom helper</div>
        
        <h1 class="main-caption main-caption-align">{{ page.h1 || page.title  }}</h1>

        <ul class="pay-delivery__list">

            <li class="pay-delivery__item">
                <div class="general-decor-caption">
                    <div :style="{backgroundImage: payDeliveryBg}" class="img js-img-bg"></div>
                </div>

                <h2 class="main-caption-l">{{ page.payment_info_title }}</h2>

                <ul class="delivery__list delivery__list-payment">
                    <li 
                      v-for="(payment, index) in payments"
                      :key="payment.id"
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
                        <p class="text">{{ $t('text.Another_Payment_Method') }}</p>
                    </li>
                </ul>

                <div v-html="page.payment_info"></div>
            </li>

            <li class="pay-delivery__item">
                <div class="general-decor-caption">
                    <div :style="{backgroundImage: payDeliveryBg}" class="img delivery-times-img js-img-bg"></div>
                </div>

                <h2 class="main-caption-l">{{ page.delivery_times_title }}</h2>
                
                <ul class="delivery__list delivery__list-option">
                  <li
                    v-for="(delivery, index) in deliveries"
                    :key="delivery.id"
                    class="delivery__item"
                  >
                      <p>
                        {{ delivery.name }} 
                        <span v-if="delivery.price">({{ $t('text.from') }} $ {{ delivery.price }})</span>
                      </p>
                  </li>
                </ul>
                
                <div v-html="page.delivery_times"></div>
            </li>

            <li class="pay-delivery__item">
                <div class="general-decor-caption">
                    <div :style="{backgroundImage: payDeliveryBg}" class="img delivery-method-img js-img-bg"></div>
                </div>

                <h2 class="main-caption-l">{{ page.delivery_method_title }}</h2>
                <ul class="delivery__list delivery__list-deliver">
                  <li
                    v-for="(delivery, index) in deliveryTypes"
                    :key="delivery.id"
                    class="delivery__item"
                  >
                    <p>{{ delivery.name }}</p>
                  </li>
                </ul>
                <div v-html="page.delivery_method"></div>
            </li>
        </ul>
    </div>
</section>

<section-write-us></section-write-us>
</template>