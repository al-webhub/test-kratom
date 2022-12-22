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
      page: {
        h1: 'Guidebook',
        seo_text: 'SEO TEXT'
      },
    }
  },

  computed: {
    articles() {
      return this.articleStore?.all;
    },
    
    meta() {
      return this.articleStore?.meta;
    },

    lang() {
      return this.$i18n.locale;
    }
  },

  methods: {
    async getArticles(data) {
      const query = data? data : {
        per_page: 12, 
        lang: this.lang
      };

      await this.articleStore?.getAll(query)
    },

    async loadmoreHandler() {
      await this.getArticles({per_page: 12, lang: this.lang, page: this.meta.current_page + 1})
    }
  },

  async created() {
    await useAsyncData('articles', () => this.getArticles())
  }
}
</script>

<style src="assets/scss/pages/guidebook.scss" lang="sass" scoped />

<template>
  <div>
    <section class="wrapper">
      <div class="container">
          
        <h1 class="main-caption main-caption-align">{{ page.h1 || page.title }}</h1>

        <ul v-if="articles && articles.length" class="article__list">
          <guidebook-card
            v-for="(article, index) in articles"
            :key="article.id"
            :article="article"
          >
          </guidebook-card>
        </ul>

        <button class="main-button" @click="loadmoreHandler()" v-if="meta && meta.current_page !== meta.last_page">
          <span class="text">{{ $t('text.show_more') }}</span>
        </button>
        
        <section-seo
          v-if="page.seo_text"
          :text="page.seo_text"
          class="seo"
        >
        </section-seo>

      </div>
    </section>

    <section-write-us></section-write-us>
  </div>

</template>