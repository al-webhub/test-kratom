<script>
import { useAuthStore } from '~/store/auth';

export default {
  async setup() {
    const authStore = useAuthStore()

    return {
      authStore
    }
  },

  props: {
    size: {
      type: String,
      default: 'small'
    }
  },

  methods: {
    closeHandler() {
      this.authStore.closeAll()
    }
  }
}
</script>

<style src="./wrapper.scss" lang="sass" scoped />

<template>
  <div @click.self="closeHandler" class="popup-wrapper">
    <section :class="size" class="popup">
      <slot />
    </section>
  </div>
</template>