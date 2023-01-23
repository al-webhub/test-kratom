<script>
export default {
  data() {
    return {

    }
  },

  props: {
    isActive: {
      type: Boolean,
      default: false
    }
  },

  computed: {
    menu() {
      return useMenu().menu
    }
  }
}
</script>

<style src="./menu-mobile.scss" lang="scss" scoped />

<template>
  <transition name="fade-in">
    <div v-if="isActive" class="menu-wrapper">
      <ul class="nav">
        <li v-for="(li, index) in menu" :key="li.id"  class="nav-item">
          <NuxtLink :to="localePath(li.link)"  class="nav-link">{{ li.name }}</NuxtLink>
        </li>
      </ul>
    </div>
  </transition>
</template>