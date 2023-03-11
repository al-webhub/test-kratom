<script setup>
  import { useModalStore } from '~/store/modal';

  const props = defineProps({
    size: {
      type: String,
      default: 'small'
    },
    canClose: {
      type: Boolean,
      default: true
    }
  })

  const closeHandler = () => {
    if(props.canClose)
      useModalStore().closeAll()
  }
</script>

<style src="./wrapper.scss" lang="sass" scoped />

<template>
  <div @click.self="closeHandler" clickable class="popup-wrapper">
    <section :class="size" class="popup">
      <slot />
    </section>
  </div>
</template>