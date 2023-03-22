<script setup>
  const props = defineProps({
    timeout: {
      type: Number,
      default: 3000
    }
  })
  
  const {noties} = useNoty()

  const messages = computed(() => {
    return noties.value
  })

</script>

<style src="./noty.scss" lang="scss" scoped />

<template>
  <div class="wrapper">
    <transition-group name="move-x">
      <div
        v-for="(message, index) in messages"
        :key="index"
        class="noty"
      >
        <div v-html="message" class="message"></div>
      </div>
    </transition-group>
  </div>
</template>