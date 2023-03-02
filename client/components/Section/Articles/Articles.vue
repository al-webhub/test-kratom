<script>
export default {
  setup() {
    const { t } = useI18n({
      useScope: 'local'
    }) 

    return {
      t
    }
  },
  
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
    <h2 class="main-caption">{{ t('articles') }}</h2>
      
    <ul class="list">
        <guidebook-card
          v-for="(article, index) in articles"
          :key="article.id"
          :article="article"
        >
        </guidebook-card>
    </ul>
    
    <NuxtLink :to="localePath('/guidebook')" :aria-label="$t('button.go_guidebook')" class="main-button" >
      <span class="text">{{ $t('button.go_guidebook') }}</span>
    </NuxtLink>
  </section>
</template>

<i18n>
  {
    "en": {
      "articles": "Articles"
    },
    "ru": {
      "articles": "Статьи"
    }
  }
</i18n>