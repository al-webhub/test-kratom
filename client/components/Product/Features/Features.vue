<script>
export default {
  props: {
    features: {
      type: [Array, Object]
    }
  }
}
</script>

<style src="./features.scss" lang="scss" scoped />


<template>
  <ul class="features">
    <li v-for="feature in features" :key="feature.id" class="item">
      <div class="name">{{ feature.name }}</div>
      <div class="line"></div>
      <div class="value">
        <NuxtLink :to="localePath(`/shop/${feature.slug}`)" clickable class="link">{{ feature.value }}</NuxtLink>
      </div>
    </li>
  </ul>
</template>