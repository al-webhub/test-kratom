<script>
import { useArticleStore } from '~/store/article';

export default {
  async setup() {
    const { t, locale } = useI18n({useScope: 'local'}) 
    const articleStore = useArticleStore()

    const query = computed(() => {
      return {
        per_page: 12, 
        lang: locale.value
      }
    })


    const breadcrumbs = [
      {
        name: t('crumbs.home'),
        item: useToLocalePath()('/')
      },{
        name: t('crumbs.guidebook'),
        item: useToLocalePath()('/guidebook')
      }
    ]

    useCrumbs().setCrumbs(breadcrumbs)

    useSchemaOrg([
      defineBreadcrumb({
        itemListElement: breadcrumbs
      }),
    ])

    await useAsyncData('articles', () => articleStore.getAll(query.value, true))

    return {
      articleStore,
      query,
      t
    }
  },

  data() {
    return {
      isLoading: false
    }
  },

  computed: {
    articles() {
      return this.articleStore?.all;
    },
    
    meta() {
      return this.articleStore?.meta;
    },

    page() {
      return {
        title: this.t('title'),
        seo_text: this.t('seo_text')
      }
    }
  },

  methods: {
    async loadmoreHandler() {
      this.isLoading = true

      const query = {
        ...this.query,
        page: this.meta.current_page + 1
      }
      await this.articleStore?.getAll(query, false).finally(() => {
        this.isLoading = false
      })
    }
  },
}
</script>

<style src="assets/scss/pages/guidebook.scss" lang="sass" scoped />

<template>
  <div>
    <section class="wrapper">
      <div class="container">
          
        <h1 class="main-caption main-caption-align">{{ page.title }}</h1>

        <nuxt-link to="/guidebook/gdfgdfg">Error Error</nuxt-link>

        <ul v-if="articles && articles.length" class="article__list">
          <guidebook-card
            v-for="(article, index) in articles"
            :key="article.id"
            :article="article"
          >
          </guidebook-card>
        </ul>

        <button
          v-if="meta && meta.current_page !== meta.last_page"
          @click="loadmoreHandler()"
          :class="{loading: isLoading}"
          :aria-label="$t('button.show_more')"
          class="main-button"
          type="button"
        >
          <span class="text">{{ $t('button.show_more') }}</span>
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


<i18n>
  {
    "en": {
      "title": "Guidebook",
      "seo_text": "Our unique articles are written by several people. In general, they are our regular customers, who are fond of ethnobotany and chemistry. Some of them are just kratom admirers. The new articles are going to appear on a regular basis. We have a lot of interesting information for you to know. As far as we are not English native speakers, the translation of the articles takes some time. We will do the best for you not just to enjoy the effects of kratom intaking, but also to receive the qualitative information about kratom itself.",
    },
    "ru": {
      "title": "Журнал",
      "seo_text": "",
    }
  }
</i18n>