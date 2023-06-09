<script>
import {useAppStore} from '~/store/app'
import { useAuthStore } from '~/store/auth';

export default {
  setup() {
    const { locale } = useI18n()
    const appStore = useAppStore()
    const authStore = useAuthStore()

    const payments = computed(() => {
      return appStore.payments(locale.value)
    })

    return {
      payments,
      authStore
    }
  },

  data() {
    return {
      privatePolicy: null,
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
    },
    isLoading: {
      type: Boolean,
      default: false
    }
  },

  computed: {
    canConfirm() {
      return this.order.payment && this.privatePolicy
    },
    bonuses() {
      return this.order.bonusesUsed
    },
    isAuth() {
      return this.authStore.isAuth
    },
  },

  methods: {
    confirmHandler() {
      this.$emit('confirm')
    }
  },
}
</script>

<style src="./../checkout.scss" lang="sass" scoped />
<style src="./payment.scss" lang="sass" scoped />

<template>
  <li :class="{active:isActive}" class="checkout__item">
      
    <div class="checkout__item__header">
      <p class="calc">3/3</p>
      <p class="caption">{{ $t('payment.payment') }}</p>
    </div>

    <div class="checkout__item__body">
      <ul class="list">

        <li
          v-for="(method, index) in payments"
          :key="index"
          class="item"
        >
          <form-radio v-model="order.payment" :value="method.name" :key="index" name="payment">
            <div class="radio-slot">
              <nuxt-img
                :src="method.image"
                sizes = "mobile:100px"
                format = "webp"
                quality = "90"
                loading = "lazy"
                class="image"
              >
              </nuxt-img>
              <div class="name">{{ method.name }}</div>
            </div>
          </form-radio>
        </li>

        <li class="item">
          <form-radio v-model="order.payment" value="another" name="payment">
            <div class="radio-slot">
              <p class="name">{{ $t('payment.another') }}</p>
            </div>
          </form-radio>
        </li>

      </ul>

      <template v-if="bonuses && isAuth">
        <div class="check-bonuse">
          <p class="type">{{ $t('payment.bonuses_used') }}</p>
          <p class="description">USD {{ bonuses }}</p>
        </div>
        <button class="check-bonuse__button" clickable>{{ $t('payment.change_bonus_amount') }}</button>
      </template>
    </div>

    <div class="footer">
      <form-checkbox v-model="privatePolicy" value="privatePolicy" class="policy">
        <p class="privat-policy-text">
          {{ $t('messages.i_agreed_with') }} 
          <NuxtLink :to="localePath('/privacy')" clickable>{{ $t('title.Privacy_Policy') }}</NuxtLink>
        </p>
      </form-checkbox>
      
      <button @click="confirmHandler" :class="{disabled: !canConfirm, loading: isLoading}" clickable class="main-button primary">
        <span class="text">{{ $t('button.confirm_order') }}</span>
      </button>
    </div>

  </li>
</template>