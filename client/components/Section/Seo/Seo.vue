<script>
export default {
  props: {
    title: {
      type: String
    },
    text: {
      type: String
    }
  }
}
</script>

<style src="./seo.scss" lang="sass" scoped />

<template>
  <section v-if="title || text" class="seo-block seo-block-main">
    <div class="seo-block__wrapper container">
      <h1 v-if="title" class="main-caption">{{ title }}</h1>
      <div v-if="text" class="seo-block__container" v-html="text"></div>
    </div>
  </section>
</template>