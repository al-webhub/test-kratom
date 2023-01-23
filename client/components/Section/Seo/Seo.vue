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
  <section v-if="title || text" class="wrapper">
    <div class="container">
      <h1 v-if="title" class="main-caption">{{ title }}</h1>
      <div v-if="text" class="text rich-text" v-html="text"></div>
    </div>
  </section>
</template>