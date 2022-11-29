<script>
export default {
  props: {
    modification: {
      type: Object
    }
  },

  methods: {
    deleteFromCart(arg1, arg2) {

    }
  }
}
</script>

<style src="./tiny.scss" lang="sass" scoped />

<template>
  <li class="popup-noty-cart__item">
    <a :href="modification.product_link" class="popup-noty-cart__img">
      <img
        :src="modification.product_image"
        :alt="modification.product_name"
        :title="modification.product_name"
      >
    </a>
    <div class="popup-noty-cart__info">
      <p class="name"> 
        <a :href="modification.product_link">{{ modification.product_name }}</a>
      </p>
      <p class="info">
        <span class="weight">{{ modification.name }}</span>
        <span>x</span>
        <span class="calc">{{ modification.amount }}</span>
      </p>
      <div class="info__footer">
        <p class="price"> USD <span>{{ modification.price }}</span></p>
        <button class="delete-button" @click="deleteFromCart(key, modification.id)">
          <img src="~assets/svg-icons/delete.svg" class="icon" />
        </button>
      </div>
    </div>
  </li>
</template>