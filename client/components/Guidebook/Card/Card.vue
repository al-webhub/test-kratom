<script>
export default {
  data() {
    return {}
  },

  props: {
    article: {
      type: Object
    }
  }
}
</script>

<style src="./card.scss" lang="sass" scoped />

<template>
  <li class="article">
      
    <div class="image">
        <img :src="article.image" :alt="article.title" :title="article.title">
    </div>
    
    <p class="caption">{{ article.title }}</p>

    <div class="text" v-html="article.excerpt"></div>
    
    <simple-more-btn :link="'/guidebook/' + article.slug"></simple-more-btn>
    
  </li>
</template>