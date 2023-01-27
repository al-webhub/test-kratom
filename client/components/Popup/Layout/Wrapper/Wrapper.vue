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
    isActive: {
      type: Boolean,
      default: false
    },

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
  <transition name="fade-in">
    <div v-if="isActive" @click.self="closeHandler" class="popup-wrapper">
      <section :class="size" class="popup">
        <slot />
      </section>
    </div>
  </transition>
</template>