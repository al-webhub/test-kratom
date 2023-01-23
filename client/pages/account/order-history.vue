<script>
import { useOrderStore } from '~/store/order';

export default {
  setup() {
    const { t } = useI18n({useScope: 'local'})

    definePageMeta({
      layout: 'account',
      middleware: 'auth',
    })

    const orderStore = useOrderStore()
    orderStore.$reset()

    useAccount().setTitle(t('title.order_history'))

    return {
      orderStore,
      t
    }
  },

  data(){
    return {
      user: {
        usermeta: {
          address_details: {
            is_default: true,
            country: null,
            street: null,
            apartment: null,
            city: null,
            state: null,
            zip: null,
            comment: null
          }
        }
      },
    }
  },

  computed: {
    
    orders() {
      return this.orderStore?.orders;
    },

    ordersMeta() {
      return this.orderStore?.ordersMeta;
    },
  },


  methods: {

    setCrumbs() {
      useCrumbs().setCrumbs([
          {
            name: this.$t('crumbs.home'),
            link: '/'
          },{
            name: this.$t('crumbs.account'),
            link: '/account'
          },{
            name: this.$t('crumbs.order_history'),
            link: '/account/order-history'
          }
      ])
    },

    async getOrders() {
      await this.orderStore?.getOrders()
    },
    
    async loadmoreOrdersHandler() {
      const params = {
        page: this.ordersMeta.current_page + 1
      }

      await this.orderStore?.getOrders(params)
    },
  },

  async created() {
    await useAsyncData('orders', () => this.getOrders())

    this.setCrumbs()
  }
}
</script>

<style src="assets/scss/pages/account/order-history.scss" lang="sass" scoped />

<template>
  <div>
    <div class="profile__order-history">
        
      <div class="order-history__header">
        <p class="order-history__name order-history-position-num">№</p>
        <p class="order-history__name order-history-position-date">{{ t('Order_date') }}</p>
        <p class="order-history__name order-history-position-recipient">{{ t('Recipient') }}</p>
        <p class="order-history__name order-history-position-total">{{ t('Total') }}</p>
        <p class="order-history__name order-history-position-status">{{ t('Status') }}</p>
        <p class="order-history__name order-history-position-details">{{ t('Details') }}</p>
        <p class="order-history-position-button"></p>
      </div>
      
      <template v-if="orders && orders.length">
        <account-order-card
          v-for="order in orders"
          :key="order.id"
          :order="order"
        >
        </account-order-card>
      </template>

    </div>

    <div v-if="!orders || !orders.length" class="profile__order-history">
      {{ t('any_previous_orders') }}
    </div>
  </div>
</template>

<i18n>
  {
    "en": {
      "order_history": "Order history",
      "any_previous_orders" : "You have not made any previous orders!",
      "Order_date" : "Order date",
      "Recipient" : "Recipient",
      "Total" : "Price",
      "Status" : "Status",
      "Details" : "Details",
    },
    "ru": {
      "order_history": "Order history",
      "any_previous_orders" : "Вы не сделали никаких предыдущих заказов!",
      "Order_date" : "Дата заказа",
      "Recipient" : "Получатель",
      "Total" : "Сумма",
      "Status" : "Статус",
      "Details" : "Подробности",
    }
  }
</i18n>