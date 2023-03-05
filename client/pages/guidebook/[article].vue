<script setup>
  import { useArticleStore } from '~/store/article';

  const { t, locale } = useI18n({useScope: 'local'})
  const route = useRoute()
  const articleStore = useArticleStore()

  const articles = ref([])

  // COMPUTED
  const slug = computed(() => route?.params?.article)

  const article = computed(() => {
    return articleStore.article
  })

  const photo = computed(() => {
    if(article.value.image) 
      return '/server/' + article.value.image
    else
      return null
  })

  // METHODS
  const setCrumbs = (article) => {
    const breadcrumbs = [
      {
        name: t('crumbs.home'),
        item: useToLocalePath()('/')
      },{
        name: t('crumbs.guidebook'),
        item: useToLocalePath()('/guidebook')
      },{
        name: article.value?.title,
        item: useToLocalePath()('/guidebook/' + article.value?.slug)
      }
    ]

    useCrumbs().setCrumbs(breadcrumbs)

    useSchemaOrg([
      defineBreadcrumb({
        itemListElement: breadcrumbs
      }),
    ])
  }

  const getRelatives = (id) => {
    useLazyAsyncData('articles', () => articleStore.getRandom({
        id: id, 
        lang: locale.value
      })
    ).then((res) => {
      if(res.data.value)
        articles.value = res.data.value
    })
  }

  // HOOKES
  await useAsyncData('article', () => articleStore.getOne(slug.value))
    .then(({data: article, error}) => {
      if(article && article.value) {
        setCrumbs(article)
        getRelatives(article.value.id)
      }
      
      if(error && error.value) {
        throw createError({statusCode: 404, message: 'Page Not Found'})
      }
    })
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