<script>
import { useArticleStore } from '~/store/article';
export default {
  setup() {
    const articleStore = useArticleStore()

    articleStore.$reset()

    return {
      articleStore
    }
  },

  data() {
    return {
    }
  },

  computed: {
    article() {
      return this.articleStore?.article;
    },

    articles() {
      return this.articleStore?.all;
    },

    lang() {
      return this.$i18n.locale;
    },

    slug() {
      return this.$route.params.article
    }
  },

  methods: {
    async getArticles(data) {
      const query = data? data : {
        per_page: 4, 
        lang: this.lang
      };

      await this.articleStore?.getAll(query)
    },

    async getArticle() {
      await this.articleStore?.getOne(this.slug)
    },
  },

  async created() {
    await useAsyncData('articles', () => this.getArticles())
    await useAsyncData('article', () => this.getArticle())
  }
}
</script>

<style src="assets/scss/pages/article.scss" lang="sass" scoped />

<template>
  <section class="wrapper">

    <div v-if="article" class="inner container">

      <div class="hero-img">
        <img 
          :src="article.image" 
          :title="article.title" 
          :alt="article.title"
        />
      </div>

      <div class="content">
        <h1 class="main-caption main-caption-align">{{ article.title }}</h1>
        
        <div class="narrow" v-html="article.content"></div>

        <simple-more-btn
          :link="'/guidebook'"
          :text="$t('text.back_to_all_articles')"
          :is-reverse="true"
        >
        </simple-more-btn>
      </div>
        
    </div>

    <div v-if="articles && articles.length" class="similar container"> 
      <p class="caption">{{ $t('text.similar_articles') }}</p>

      <ul class="grid">
        <guidebook-card
          v-for="article in articles"
          :key="article.id"
          :article="article"
        >
        </guidebook-card>
      </ul>
    </div>

  </section>
</template>