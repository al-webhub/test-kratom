<script>
export default {
  data() {
    return {
      selectedDelivery: null,
      deliveryTimes: [
        {
          id: 1,
          name: 'POST 1',
          price: 10
        },{
          id: 2,
          name: 'POST 2',
          price: 7
        },{
          id: 3,
          name: 'POST 3',
          price: 15
        }
      ],
      deliveryTypes: [
        {
          id: 1,
          name: 'DCH'
        },{
          id: 2,
          name: 'Nova Poshta'
        }
      ],
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
    }
  }
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
          <p class="caption">{{ $t('text.shipping') }}</p>
      </div>

      <div class="checkout__item__body">
          <p class="checkout-caption">{{ $t('text.desired_delivery') }}</p>
          
          <ul class="delivery__list">
            <li 
              v-for="method in deliveryTimes"
              :key="method.id"
              class="delivery__item"
            >
              <label class="input__wrapper input__wrapper-radio">
                <input v-model="order.delivery" :value="method.name" type="radio" class="input-radio" name="delivery">
                <span class="custome-radio"></span>
                <p class="delivery__label">
                  {{ method.name }} 
                  <span class="delivery__price">({{ $t('text.from') }} ${{ method.price }})</span>
                </p>
              </label>
            </li>
          </ul>

          <p class="checkout-caption">{{ $t('text.Shipping_address') }}</p>
          
          <div class="checkout__item__address">
            <form-select
              v-model="order.address.country"
              :placeholder="$t('text.Country_Region')"
              :values="countries"
              required
              class="form-component"
            >
            </form-select>

            <form-text
              v-model="order.address.city"
              :placeholder="$t('text.Town_City')"
              required
              class="form-component"
            >
            </form-text>

            <form-text
              v-model="order.address.state"
              :placeholder="$t('text.State')"
              class="form-component"
            >
            </form-text>

            <form-text
              v-model="order.address.street"
              :placeholder="$t('text.Street_Number')"
              class="form-component"
            >
            </form-text>

            <form-text
              v-model="order.address.apartment"
              :placeholder="$t('text.Apartment_house_flat')"
              class="form-component"
            >
            </form-text>

            <form-text
              v-model="order.address.zip"
              :placeholder="$t('text.ZIP')"
              class="form-component"
            >
            </form-text>
          </div>

          <!-- FOOTER -->
          <div class="chckout__item__shipping-info">
            <p class="caption">{{ $t('text.We_deliver') }}:</p>
            
            <ul class="delivery__list delivery__list-deliver">
              <li 
                v-for="delivery in deliveryTypes"
                :key="delivery.id"
                class="delivery__item">
                  <p>{{ delivery.name }}</p>
              </li>
            </ul>

            <p>{{ $t('text.The_Dispatch_takes') }}</p>

            <div class="checkout__item__anonympus">
              <p class="checkout-caption">{{ $t('text.Anonymous_delivery') }}</p>
              <p>{{ $t('text.Concerning_safety') }}</p>
              <p>{{ $t('text.So_you_may') }}</p>
            </div>
          </div>

      </div>
  </li>
</template>