<script setup>
  import { useOrderStore } from '~/store/order';
  import { useCartStore } from '~/store/cart';

  const { t } = useI18n({useScope: 'local'})

  useAccount().setTitle(t('title.order_history'))

  definePageMeta({
    layout: 'account',
    middleware: ['auth', 'profile-pc-data'],
  })


  // DATA
  const isLoading = ref(false)

  // COMPUTED
  const orders = computed(() => {
    return useOrderStore().orders;
  })

  const ordersMeta = computed(() => {
    return useOrderStore().ordersMeta;
  })

  // METHODS
  const getOrders = async () => {
    await useOrderStore().getOrders()
  }

  const setCrumbs = () => {
    useCrumbs().setCrumbs([
        {
          name: t('crumbs.home'),
          item: '/'
        },{
          name: t('crumbs.account'),
          item: '/account/order-history'
        },{
          name: t('crumbs.order_history'),
          item: '/account/order-history'
        }
    ])
  }
  
  // HANDLERS
  const loadmoreOrdersHandler = async() => {
    const params = {
      page: ordersMeta.value.current_page + 1
    }

    await useOrderStore().getOrders(params, false)
  }

  const repeatHandler = async(id) => {
    isLoading.value = true

    await useCartStore().copyOrder(id).then((order) => {
      useOrderStore().unshiftOrder(order)
      useNoty().setNoty(t('noty.order_success', {code: order.code}))
    }).catch((e) => {
      useNoty().setNoty(t('noty.order_fail'))
    }).finally(() => {
      isLoading.value = false
    })
  }

  // HOOKES
  await useAsyncData('orders', () => getOrders())
  setCrumbs()
</script>

<style src="./order-history.scss" lang="sass" scoped />
<i18n src="./messages.json"></i18n>

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
          :is-loading="isLoading"
          @repeat="repeatHandler"
        >
        </account-order-card>
      </template>

      <div
        v-if="ordersMeta.last_page != ordersMeta.current_page"
        @click="loadmoreOrdersHandler"
        style="text-align:center; cursor:pointer;padding:10px"
        clickable
      >
        {{ $t('button.show_more') }}
      </div>
    </div>

    <div v-if="!orders || !orders.length" class="profile__order-history">
      {{ t('any_previous_orders') }}
    </div>
  </div>
</template>