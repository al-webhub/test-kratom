<script>
export default {
  setup() {
    const { t } = useI18n({useScope: 'local'})
    return {t}
  },

  data() {
    return {
      isActive: false
    }
  },

  props: {
    order: {
      type: Object
    },

    isLoading: {
      type: Boolean,
      default : false
    }
  },

  methods: {
    toggleHandler() {
      this.isActive = !this.isActive
    },

    repeatHandler() {
      this.$emit('repeat', this.order.id)
    },

    getImageSrc(product) {
      if(!product?.image?.src)
        return '/';
      
      return `/server/${product.image.src}`;
    }
  },

  computed: {
    address() {
      return Object.keys(this.order.info.address).reduce((carry, key) => {
        return carry + (carry !== ''? ', ': '') + this.order.info.address[key]
      }, '')
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
            <p class="type">{{ t('Order_date') }}</p>
            <p class="description">{{ $d(order.created_at, 'long') }}</p> 
        </li>
        <li class="order-history__item order-history-position-recipient">
            <p class="type">{{ t('Recipient') }}</p>
            <p class="description">{{ order.user?.name || '–' }}</p> 
        </li>
        <li class="order-history__item order-history-position-total">
            <p class="type">{{ t('Total') }}</p>
            <p v-if="order.price" class="description">$ {{ order.price }}</p> 
        </li>
        <li class="order-history__item order-history__status order-history-position-status">
            <p class="type">{{ t('Status') }}</p>
            <p class="description" v-html="order.status">
            </p>
        </li>
        <li class="order-history__item order-history__button order-history-position-details">
            <p class="type">{{ t('Details') }}</p>
            <button @click="toggleHandler" clickable class="button-details">
              <img src="~assets/svg-icons/arrow-simple.svg" class="icon icon-drop" />
            </button>
        </li>
        <li class="order-history__item order-history__item-general-button order-history-position-button">
            <button @click="repeatHandler" :class="{loading: isLoading}" clickable class="main-button small primary-color">
                <span class="text">{{ $t('button.repeat_order') }}</span>
            </button>
            <button @click="toggleHandler" clickable  class="button-details button-details-mobile">
              <img src="~assets/svg-icons/arrow-simple.svg" class="icon icon-drop" />
            </button>
        </li>
    </ul>

    <div class="order-details">
        <div class="order-details__order order-details__item">
            <p class="order-details__caption">{{ t('your_order') }}</p>

            <ul class="order-details__list">
              <li v-for="product in order.info.products" :key="product.id" class="order-details__order__item">
                <div class="order-details__preview">
                  <div class="order-details__preview__img">
                    <NuxtLink :to="localePath('/' + product.slug)" clickable>
                      <nuxt-img
                        :src="getImageSrc(product)"
                        :alt="product.name"
                        sizes = "mobile:70px"
                        format = "webp"
                        quality = "40"
                        loading = "lazy"
                        class="image"
                      >
                      </nuxt-img>
                    </NuxtLink>
                  </div>
                  <div class="order-details__preview__descrip">
                    <p class="order-details__preview__name">
                      <NuxtLink :to="localePath('/' + product.slug)" clickable>
                        {{ product.name }}
                      </NuxtLink>
                    </p>
                    <div class="wrapper">
                      <p class="order-details__preview__weight">
                        {{ product.short_name }} <span>x</span>{{ product.amount }}
                      </p>
                      <p class="order-details__preview__price">
                        USD {{ product.price * product.amount }}
                      </p>
                    </div>
                  </div>
                </div>
              </li>
            </ul>

        </div>

        <div class="order-details__shipping order-details__item">
            <p class="order-details__caption">{{ t('Shipping_address') }}</p>
            <p class="text">{{ address }}</p>
        </div>

        <div class="order-details__delivery order-details__item">
            <p class="order-details__caption">{{ t('Delivery') }}</p>
            <p class="text">{{ order.info.delivery }}</p>
        </div>

        <div class="order-details__payment order-details__item">
            <p class="order-details__caption">{{ t('Payment_Method') }}</p>
            <p class="text">{{ order.info.payment }}</p>
        </div>
    </div>
  </div>
</template>
<i18n>
  {
    "en": {
      "your_order": "Your order",
      "Shipping_address": "Shipping address",
      "Delivery": "Delivery method",
      "Payment_Method": "Payment method",
      "Order_date" : "Order date",
      "Recipient" : "Recipient",
      "Total" : "Price",
      "Status" : "Status",
      "Details" : "Details",
    },
    "ru": {
      "your_order": "Ваш заказ",
      "Shipping_address": "Адреса доставки",
      "Delivery": "Служба доставки",
      "Payment_Method": "Метод оплаты",
      "Order_date" : "Дата заказа",
      "Recipient" : "Получатель",
      "Total" : "Сумма",
      "Status" : "Статус",
      "Details" : "Подробности",
    }
  }
</i18n>