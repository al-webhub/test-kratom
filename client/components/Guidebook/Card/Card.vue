<script>
export default {
  data() {
    return {}
  },

  props: {
    article: {
      type: Object
    }
  },

  computed: {
    photo() {
      if(this.article.image) 
        return '/server/' + this.article.image
      else
        return null
    }
  }
}
</script>

<style src="./card.scss" lang="sass" scoped />

<template>
  <li class="article">
      
    <div class="image">
        <nuxt-img
          v-if="photo"
          :src = "photo"
          :alt="article.title"
          :title="article.title"
          sizes = "mobile:100vw tablet:300px"
          format = "webp"
          quality = "30"
          loading = "lazy"
          class="cover"
          provider="ipx"
        >
        </nuxt-img>
    </div>
    
    <p class="caption">{{ article.title }}</p>

    <div class="text" v-html="article.excerpt"></div>
    
    <simple-more-btn :link="'/guidebook/' + article.slug"></simple-more-btn>
    
  </li>
</template>