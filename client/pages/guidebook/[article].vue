<script>
import { useArticleStore } from '~/store/article';

export default {
  async setup() {
    const { t, locale } = useI18n({useScope: 'local'})
    const route = useRoute()
    const slug = computed(() => route?.params?.article)

    const articleStore = useArticleStore()

    const article = computed(() => {
      return articleStore.article
    })
 
    const articles = computed(() => {
      return articleStore.all
    })

    await useAsyncData('article', () => articleStore.getOne(slug.value).catch((e) => {
      throw createError({ statusCode: 404, statusMessage: 'Page Not Found' })
    }))

    await useAsyncData('articles', () => articleStore.getAll({
        per_page: 4, 
        lang: locale.value
    }, true))

    return {
      article,
      articles,
      t
    }
  },

  data() {
    return {
    }
  },

  computed: {
    photo() {
      if(this.article.image) 
        return '/server/' + this.article.image
      else
        return null
    }
  },

  methods: {
    setCrumbs() {
      useCrumbs().setCrumbs([
          {
            name: this.$t('crumbs.home'),
            link: '/'
          },{
            name: this.$t('crumbs.guidebook'),
            link: '/guidebook'
          },{
            name: this.article?.title,
            link: '/guidebook/' + this.article?.slug
          }
      ])
    },
  },

  created() {
    this.setCrumbs()
  }
}
</script>

<style src="assets/scss/pages/article.scss" lang="sass" scoped />

<template>
  <section class="wrapper">

    <div v-if="article" class="inner container">

      <div class="hero-img">
        <nuxt-img
          v-if="photo"
          :src="photo" 
          :title="article.title" 
          :alt="article.title"
          sizes = "mobile:100vw desktop:100vw"
          format = "webp"
          quality = "70"
          loading = "lazy"
        >
        </nuxt-img>
      </div>

      <div class="content narrow">
        <h1 class="main-caption main-caption-align">{{ article.title }}</h1>
        
        <div class="rich-text" v-html="article.content"></div>

        <simple-more-btn
          :link="'/guidebook'"
          :text="t('back_to_all_articles')"
          :is-reverse="true"
        >
        </simple-more-btn>
      </div>
        
    </div>

    <div v-if="articles && articles.length" class="similar container"> 
      <p class="caption">{{ t('similar_articles') }}</p>

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

<i18n>
  {
    "en": {
      "back_to_all_articles" : "back to all articles",
      "similar_articles" : "similar articles",
    },
    "ru": {
      "back_to_all_articles" : "вернуться ко всем статьям",
      "similar_articles" : "похожие статьи",
    }
  }
</i18n>