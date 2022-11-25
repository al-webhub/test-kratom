<script>
export default {
  data() {
    return {}
  },

  props: {
    articles: {
      type: Array,
      required: true
    }
  }
}
</script>

<style src="./articles.scss" lang="sass" scoped />

<template>
  <section class="container">
    <h2 class="main-caption">{{ $t('text.articles') }}</h2>
      
    <ul class="list">
        <guidebook-card
          v-for="(article, index) in articles"
          :key="article.id"
          :article="article"
        >
        </guidebook-card>
    </ul>
    
    <a href="guidebook" class="main-button">
        <span class="text">{{ $t('text.go_guidebook') }}</span>
    </a>
  </section>
</template>