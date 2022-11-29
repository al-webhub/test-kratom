<script>
export default {
  data() {
    return {
      isActive: false
    }
  },

  methods: {
    closeHandler() {
      this.isActive = false
    }
  }
}
</script>

<style src="./adult.scss" lang="sass" scoped />

<template>
  <popup-layout-simple :is-active="isActive" @close="closeHandler">
    <template v-slot:title>
      You must be 18+ to visit our webshop
    </template>
    <template v-slot:content>
      You must be at least eighteen years old to view this content. Are you over eighteen?
    </template>
    <template v-slot:footer>
      <a href="https://www.google.com/search?q=relaxation" class="button-only-text js-close">
        <span class="text">No, I am not</span>
      </a>
      <a href="/18" class="main-button main-button-small main-button-profile">
        <span class="text">I am 18+</span>
      </a>    
    </template>
  </popup-layout-simple>
</template>