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
    },

    size: {
      type: String,
      default: 'small'
    },

    canClose: {
      type: Boolean,
      default: true
    }
  },

  methods: {
    closeHandler() {
      if(this.canClose)
        this.$emit('close')
    }
  }
}
</script>

<style src="./simple.scss" lang="sass" scoped />

<template>
  <popup-layout-wrapper :size="size" :is-active="isActive">
    <div>
      <button v-if="canClose" @click="closeHandler" type="button" class="close__popup">
        <img src="~assets/svg-icons/close.svg" class="icon" />
      </button>

      <p class="popup-caption">
        <!-- TITLE SLOT -->
        <slot name="title"></slot>
      </p>

      <p class="content">
        <!-- CONTENT SLOT -->
        <slot name="content"></slot>
      </p>

      <footer class="footer">
        <!-- FOOTER SLOT -->
        <slot name="footer"></slot>
      </footer>
    </div>
  </popup-layout-wrapper>
</template>