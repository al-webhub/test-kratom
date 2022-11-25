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

    <div class="text" v-html="article.short_desc"></div>
    
    <simple-more-btn :link="article.link"></simple-more-btn>
    
  </li>
</template>