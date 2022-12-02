<script>
definePageMeta({
  layout: "account",
});

export default {

  layout: 'account',

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
      orders: [
        {
          id: 1,
          code: '134564',
          created_at: '10.10.2022',
          info: {
            payment: 'Bitcoin',
            address_details: 'pr. Tura',
            delivery: 'Nova Poshta',
            products: [
              [
                {
                  id: 1,
                  name: '500 gr',
                  product_link: '/',
                  product_image: null,
                  product_name: 'Kratom Maeng',
                  price: 12.00,
                  amount: 2,
                }
              ],
              [
                {
                  id: 1,
                  name: '500 gr',
                  product_link: '/',
                  product_image: null,
                  product_name: 'Kratom Maeng',
                  price: 12.00,
                  amount: 2,
                }
              ]
            ]
          },
          price: 500.50,
          statusString: 'Done',
        }
      ]
    }
  },
}
</script>

<style src="assets/scss/pages/account/order-history.scss" lang="sass" scoped />

<template>
    <div v-if="orders" class="profile__order-history">
        
      <div class="order-history__header">
        <p class="order-history__name order-history-position-num">№</p>
        <p class="order-history__name order-history-position-date">{{ $t('text.Order_date') }}</p>
        <p class="order-history__name order-history-position-recipient">{{ $t('text.Recipient') }}</p>
        <p class="order-history__name order-history-position-total">{{ $t('text.Total') }}</p>
        <p class="order-history__name order-history-position-status">{{ $t('text.Status') }}</p>
        <p class="order-history__name order-history-position-details">{{ $t('text.Details') }}</p>
        <p class="order-history-position-button"></p>
      </div>
      
      <account-order-card
        v-for="order in orders"
        :key="order.id"
        :order="order"
      >
      </account-order-card>

    </div>

    <div v-else class="profile__order-history">
      {{ $t('text.any_previous_orders') }}
    </div>
</template>