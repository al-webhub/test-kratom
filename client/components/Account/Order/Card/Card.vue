<script>
export default {
  data() {
    return {
      isActive: false
    }
  },

  props: {
    order: {
      type: Object
    }
  },

  methods: {
    toggleHandler() {
      this.isActive = !this.isActive
    }
  }
}
</script>

<style src="./card.scss" lang="sass" scoped />

<template>
  <div :class="{active: isActive}" class="order-history__container">
    <ul class="order-history__list">
        <li class="order-history__item order-history-position-num">
            <p class="type">№</p>
            <p class="description">{{ order.code }}</p>
        </li>
        <li class="order-history__item order-history-position-date">
            <p class="type">{{ $t('text.Order_date') }}</p>
            <p class="description">{{ order.created_at }}</p> 
        </li>
        <li class="order-history__item order-history-position-recipient">
            <p class="type">{{ $t('text.Recipient') }}</p>
            <p class="description">{{ order.info.payment || '–' }}</p> 
        </li>
        <li class="order-history__item order-history-position-total">
            <p class="type">{{ $t('text.Total') }}</p>
            <p v-if="order.price" class="description">USD $ {{ order.price }}</p> 
        </li>
        <li class="order-history__item order-history__status order-history-position-status">
            <p class="type">{{ $t('text.Status') }}</p>
            <p class="description" v-html="order.statusString">
            </p>
        </li>
        <li class="order-history__item order-history__button order-history-position-details">
            <p class="type">{{ $t('text.Details') }}</p>
            <button @click="toggleHandler" class="button-details js-drop-button">
                <span class="icon-drop"></span>
            </button>
        </li>
        <li class="order-history__item order-history__item-general-button order-history-position-button">
            <a :href="'/order/' + order.id + '/clone'" class="main-button main-button-small main-button-confirm">
                <span class="text">{{ $t('text.repeat_order') }}</span>
            </a>
            <button class="button-details js-drop-button button-details-mobile">
                <span class="icon-drop"></span>
            </button>
        </li>
    </ul>

    <div class="order-details">
        <div class="order-details__order order-details__item">
            <p class="order-details__caption">{{ $t('text.your_order') }}</p>

            <ul class="order-details__list">
              <template v-for="product in order.info.products">
                <template v-for="modification in product" :key="modification.id">
                  <li class="order-details__order__item">
                    <div class="order-details__preview">
                      <div class="order-details__preview__img">
                        <a :href="modification.product_link">
                          <img :src="modification.product_image" >
                        </a>
                      </div>
                      <div class="order-details__preview__descrip">
                        <p class="order-details__preview__name">
                          <a :href="modification.product_link">
                            {{ modification.product_name }}
                          </a>
                        </p>
                        <div class="wrapper">
                          <p class="order-details__preview__weight">
                            {{ modification.name }} <span>x</span>{{ modification.amount }}
                          </p>
                          <p class="order-details__preview__price">
                            USD {{ modification.price * modification.amount }}
                          </p>
                        </div>
                      </div>
                    </div>
                  </li>
                </template>
              </template>
            </ul>

        </div>

        <div class="order-details__shipping order-details__item">
            <p class="order-details__caption">{{ $t('text.Shipping_address') }}</p>
            <p class="text">{{ order.info.address_details }}</p>
        </div>

        <div class="order-details__delivery order-details__item">
            <p class="order-details__caption">{{ $t('text.Delivery_time') }}</p>
            <p class="text">{{ order.info.delivery }}</p>
        </div>

        <div class="order-details__payment order-details__item">
            <p class="order-details__caption">{{ $t('text.Payment_Method') }}</p>
            <p class="text">{{ order.info.payment || $t('text.Another_Payment_Method') }}</p>
        </div>
    </div>
  </div>
</template>