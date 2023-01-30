<script>
import { useCartStore } from '~/store/cart';
import {useFeedbackStore} from '~/store/feedback'

export default {
  setup() {
    const { t } = useI18n({useScope: 'local'})
    const feedbackStore = useFeedbackStore()
    const cartStore = useCartStore()

    return {
      cartStore,
      feedbackStore,
      t
    }
  },

  data() {
    return {
      order: {
        name: null,
        phone: null,
        text: null
      },
    }
  },

  computed: {
    isActive() {
      return this.cartStore.buy1IsShow
    },

    errors() {
      return this.feedbackStore.errors
    },

    product() {
      return this.cartStore.buy1Product
    }
  },

  methods: {
    closeHandler() {
      return this.cartStore.toggleBuy1()
    },

    async createHandler() {
      try {
        await this.feedbackStore.createFeedback({
          ...this.order,
          extras: {
            product: this.product
          }
        }).then((res) => {
          useNoty().setNoty(this.$t('noty.1click_success'))
          this.closeHandler()
          this.order.name = null
          this.order.phone = null
          this.order.text = null
        })
      }catch(e) {
          useNoty().setNoty(this.$t('noty.1click_fail'))
      }      
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

        <form-text
          v-model="order.name"
          :placeholder="$t('form.first_name')"
          :error="errors?.name"
          class="form-item"
        >
        </form-text>

        <form-text
          v-model="order.phone"
          :placeholder="$t('form.phone')"
          :error="errors?.phone"
          class="form-item"
        >
        </form-text>

        <form-textarea
          v-model="order.text"
          :placeholder="$t('form.your_comment')"
          :error="errors?.text"
          class="form-item"
        >
        </form-textarea>
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