<script>
export default {
  props: {
    modification: {
      type: Object
    }
  },

  computed: {
    photo() {
      if(this.modification?.image?.src)
        return '/server/' + this.modification?.image?.src
      else
        return null
    }
  },

  methods: {
    deleteHandler() {
      this.$emit('delete')
    }
  }
}
</script>

<style src="./tiny.scss" lang="sass" scoped />

<template>
  <li class="popup-noty-cart__item">
    <NuxtLink :to="localePath('/' + modification.slug)" class="img-link">
      <nuxt-img
        v-if="photo"
        :src="photo"
        :alt="modification.image?.alt"
        :title="modification.image?.title"
        :class="modification.image?.size"
        sizes = "mobile:128px desktop:128px"
        format = "webp"
        quality = "40"
        loading = "lazy"
        class="image"
      >
      </nuxt-img>
    </NuxtLink>
    <div class="popup-noty-cart__info">
      <p class="name"> 
        <NuxtLink :to="localePath('/' + modification.slug)">{{ modification.name }}</NuxtLink>
      </p>
      <p class="info">
        <span class="weight">{{ modification.short_name }}</span>
        <span>x</span>
        <span class="calc">{{ modification.amount }}</span>
      </p>
      <div class="info__footer">
        <p class="price"> USD <span>{{ modification.price }}</span></p>
        <button class="delete-button" @click="deleteHandler">
          <img src="~assets/svg-icons/delete.svg" class="icon" />
        </button>
      </div>
    </div>
  </li>
</template>