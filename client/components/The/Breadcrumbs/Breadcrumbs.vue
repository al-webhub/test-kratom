<script setup>
  const crumbs = computed(() => {
    return useCrumbs()?.items?.value
  })
</script>

<style src="./breadcrumbs.scss" lang="sass" scoped />

<template>
  <section class="breadcrumbs">
    <div class="container">
      <ul class="list">
        <li
          v-for="(crumb, index) in crumbs"
          :key="crumb"
          class="item"
        >
          <NuxtLink :to="localePath(crumb.link)" class="breadcrumbs__link">{{ crumb.name }}</NuxtLink>
        </li>
      </ul>
    </div>
  </section>
</template>