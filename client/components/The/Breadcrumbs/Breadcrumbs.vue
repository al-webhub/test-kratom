<script setup>
  const crumbs = computed(() => {
    return useCrumbs().items.value
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
          <NuxtLink
            v-if="index + 1 !== crumbs.length"
            :to="crumb.item"
            :prefetch="false"
            class="breadcrumbs__link"
          >
            {{ crumb.name }}
          </NuxtLink>
          <span v-else class="breadcrumbs__link">{{ crumb.name }}</span>
        </li>
      </ul>
    </div>
  </section>
</template>