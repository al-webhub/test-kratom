<script>
export default {
  computed: {
    menu() {
      return useMenu().menu
    },
  },

  methods: {
    closeHandler() {
      console.log('CLOSE')
      this.$emit('close')
    }
  }
}
</script>

<style src="./menu-mobile.scss" lang="scss" scoped />

<template>
  <div class="menu-wrapper">
    <ul class="nav">
      <li v-for="li in menu" :key="li.id"  class="nav-item">
        <NuxtLink :to="localePath(li.link)" @click="closeHandler" :prefetch="false" class="nav-link">{{ li.name }}</NuxtLink>
      </li>
    </ul>
  </div>
</template>