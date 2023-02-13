<script setup>
  import { useModalStore } from '~/store/modal';

  defineProps({
    size: {
      type: String,
      default: 'small'
    }
  })

  const closeHandler = () => {
    useModalStore().closeAll()
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