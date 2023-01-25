<script>
import { useCartStore } from '~/store/cart';

export default {
  setup() {
    const { t } = useI18n({useScope: 'local'})
    const cartStore = useCartStore()

    return {
      cartStore,
      t
    }
  },

  data() {
    return {
      order: {
        name: null,
        text: null
      },
    }
  },

  computed: {
    isActive() {
      return this.cartStore.buy1IsShow
    },
  },

  methods: {
    closeHandler() {
      return this.cartStore.toggleBuy1()
    },

    async createHandler() {
      
    },
  }
}
</script>

<style src="./1-click.scss" lang="sass" scoped />

<template>
  <popup-layout-simple :is-active="isActive" @close="closeHandler">
    <template v-slot:title>
      {{ t('buy-1-click') }}
    </template>

    <template v-slot:content>
      <div>
        <p class="form-item">{{ t('leave_your_contacts') }}</p>

        <form-text v-model="order.name" :placeholder="$t('form.first_name')" class="form-item"></form-text>

        <form-text v-model="order.name" :placeholder="$t('form.first_name')" class="form-item"></form-text>

        <form-textarea v-model="order.text" :placeholder="$t('form.your_review')" class="form-item"></form-textarea>
      </div>
    </template>

    <template v-slot:footer>
      <button class="main-button primary small btn" @click="createHandler()">
        <span class="text">{{ $t('button.post') }}</span>
      </button>
    </template>

  </popup-layout-simple>
</template>

<i18n>
  {
    en: {
      "buy-1-click": "buy now with 1-click",
      "leave_your_contacts": "Leave your contacts and we will contact you shortly"
    },

    ru: {
      "buy-1-click": "Купить в 1 клик",
      "leave_your_contacts": "Оставьте свои контакты, и мы свяжемся с вами в ближайшее время"
    }
  }
</i18n>