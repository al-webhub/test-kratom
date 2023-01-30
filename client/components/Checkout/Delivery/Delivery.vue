<script>
import {useAppStore} from '~/store/app'

export default {
  setup() {
    const { t, locale } = useI18n({useScope: 'local'})
    const appStore = useAppStore()

    const deliveryTimes = computed(() => {
      return appStore.deliveryTimes(locale.value)
    })

    const deliveryMethods = computed(() => {
      return appStore.deliveryMethods(locale.value)
    })

    return {
      t,
      deliveryTimes,
      deliveryMethods
    }
  },

  data() {
    return {
      selectedDelivery: null,
      user: {
        usermeta: {
          addressDetails: {
            country: '',
            city: 'city',
            state: 'state',
            street: '',
            apartment: '',
            zip: ''
          }
        }
      },
      address: {
        country: null,
        city: null,
        state: null,
        street: null,
        apartment: null,
        zip: null
      },
      countries: [
        'Украина',
        'Чехия'
      ]
    }
  },

  props: {
    isActive: {
      type: Boolean,
      default: false
    },
    order: {
      type: Object
    },
    errors: {
      type: Object
    }
  },
}
</script>

<style src="./../checkout.scss" lang="sass" scoped />
<style src="./delivery.scss" lang="sass" scoped />

<template>
  <li class="checkout__item" :class="{active:isActive}">
      
      <div class="checkout__item__noty">
          <p>{{ $t('text.Please_complete') }}</p>
      </div>
      
      <div class="checkout__item__header">
          <p class="calc">2/3</p>
          <p class="caption">{{ t('shipping') }}</p>
      </div>

      <div class="checkout__item__body">
          <h6 class="checkout-caption">{{ t('desired_delivery') }}</h6>
          
          <ul v-if="deliveryTimes" class="delivery__list fr1">
            <li 
              v-for="(method, index) in deliveryTimes"
              :key="index"
              class="delivery__item"
            >
              <form-radio v-model="order.delivery" :value="method" name="delivery">
                <p class="delivery__label">
                  {{ method }} 
                  <!-- <span class="delivery__price">({{ $t('text.from') }} ${{ method.price }})</span> -->
                </p>
              </form-radio>
            </li>
          </ul>

          <h6 class="checkout-caption">{{ t('Shipping_address') }}</h6>
          
          <div class="checkout__item__address">
            <form-select
              v-model="order.address.country"
              :placeholder="$t('form.Country_Region')"
              :values="countries"
              :error="errors?.address?.country"
              required
              class="form-component"
            >
            </form-select>

            <form-text
              v-model="order.address.city"
              :placeholder="$t('form.Town_City')"
              :error="errors?.address?.city"
              required
              class="form-component"
            >
            </form-text>

            <form-text
              v-model="order.address.state"
              :placeholder="$t('form.State')"
              :error="errors?.address?.state"
              class="form-component"
            >
            </form-text>

            <form-text
              v-model="order.address.street"
              :placeholder="$t('form.Street_Number')"
              :error="errors?.address?.street"
              class="form-component"
            >
            </form-text>

            <form-text
              v-model="order.address.apartment"
              :placeholder="$t('form.Apartment_house_flat')"
              :error="errors?.address?.apartment"
              class="form-component"
            >
            </form-text>

            <form-text
              v-model="order.address.zip"
              :placeholder="$t('form.ZIP')"
              :error="errors?.address?.zip"
              class="form-component"
            >
            </form-text>
          </div>

          <!-- FOOTER -->
          <div class="chckout__item__shipping-info">
            <h6 class="checkout-caption">{{ t('We_deliver') }}:</h6>
            
            <div v-if="deliveryMethods" class="delivery__list list">
              <div 
                v-for="(delivery, index) in deliveryMethods"
                :key="index"
                class="delivery__item">
                  <p>{{ delivery }}</p>
              </div>
            </div>

            <p>{{ $t('delivery.The_Dispatch_takes') }}</p>

            <div class="checkout__item__anonympus">
              <h6 class="checkout-caption">{{ $t('delivery.Anonymous_delivery') }}</h6>
              <p>{{ $t('delivery.Concerning_safety') }}</p>
              <p>{{ $t('delivery.So_you_may') }}</p>
            </div>
          </div>

      </div>
  </li>
</template>

<i18n>
  {
    "en": {
      "shipping" : "shipping",
      "desired_delivery" : "Choose your desired delivery time",
      "Shipping_address": "Shipping address",
      "We_deliver" : "We deliver",
    },
    "ru": {
      "shipping" : "Доставка",
      "desired_delivery" : "Выберите желаемое время доставки",
      "Shipping_address": "Адреса доставки",
      "We_deliver" : "Мы доставляем",
    }
  }
</i18n>