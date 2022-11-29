<script>
export default {
  props: {
    isActive: {
      type: Boolean,
      default: false
    }
  }
}
</script>

<style src="./wrapper.scss" lang="sass" scoped />

<template>
  <section :class="{active: isActive}" class="popup popup-logout">
    <slot />
  </section>
</template>