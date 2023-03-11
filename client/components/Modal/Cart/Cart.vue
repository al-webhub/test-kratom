<script setup>
  import { useCartStore } from '~/store/cart';
  import { useModalStore } from '~/store/modal';

  const { t } = useI18n({useScope: 'local'})

  // COMPUTEDS
  const cart = computed(() => {
    return useCartStore().cart
  })
  
  const cartLength = computed(() => {
    return Object.keys(cart.value).length
  })

  const total = computed(() => {
    return cart.value.reduce(
      (carry, item) => carry + item.price * item.amount, 
      0
    ).toFixed(2)
  })

  // HANDLER METHODS
  const closeHandler = () => {
    useModalStore().close('cart')
  }

  const deleteHandler = async (product) => {
    await useCartStore().remove(product.id).then(() => {
      useNoty().setNoty(t('noty.product_remove_from_cart', {product: product.name}), 2000)
    }).finally(() => {
      if(!cartLength.value)
        closeHandler()
    })
  }
</script>

<style src="../../Popup/popup.scss" lang="less" scoped />
<style src="./cart.scss" lang="postcss" scoped />

<template>
  <section class="popup-noty-cart">
      
    <div class="popup-noty-cart__header">
      <simple-more-btn :text="$t('button.Back')" @click="closeHandler" is-reverse></simple-more-btn>
      <p class="main-caption">{{ $t('title.cart') }}</p>
    </div>

    <template v-if="cartLength">
      
      <div class="popup-noty-cart__body">
        <ul class="popup-noty-cart__list">
          <checkout-product-tiny
            v-for="product in cart"
            :modification="product"
            :key="product.id"
            @delete="deleteHandler(product)"
          >
          </checkout-product-tiny>
        </ul>
      </div>

      <div class="popup-noty-cart__footer js-drop-item">
        <button class="popup-noty-cart__open-button js-drop-button"></button>
        <div class="total__wrapper">
          <div class="total__item total__item-general">
            <p class="type">{{ $t('label.subtotal') }}</p>
            <p class="description">usd {{ total }}</p>
          </div>
        </div>
        
        <NuxtLink :to="localePath('/checkout')" :prefetch="false" @click="closeHandler" clickable class="main-button primary btn">
          <span class="text">{{ $t('button.checkout') }}</span>
        </NuxtLink>
        
        <NuxtLink :to="localePath('/shop')" :prefetch="false" @click="closeHandler" clickable class="main-button btn">
          <span class="text">{{ $t('button.edit') }}</span>
        </NuxtLink>

      </div>
    </template>

    <p class="popup-noty__empty" v-else>{{ $t('messages.cart_is_empty') }}</p>
  </section>
</template>