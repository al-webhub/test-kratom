<script>
export default {
  data() {
    return {
      page: {
        h1: 'Guidebook',
        seo_text: 'SEO TEXT'
      },

      articles: {
        data: [
          {
            id: 1,
            title: 'BUY KRATOM IN SOUTH CAROLIN',
            image: null,
            short_desc: 'There is so much disinformation regarding Kratom products and their legality over the USA. It might be caused generally by the undefined status of the plant. Some believe',
            link: '/'
          },{
            id: 2,
            title: 'BUY KRATOM IN SOUTH CAROLIN',
            image: null,
            short_desc: 'There is so much disinformation regarding Kratom products and their legality over the USA. It might be caused generally by the undefined status of the plant. Some believe',
            link: '/'
          },{
            id: 3,
            title: 'BUY KRATOM IN SOUTH CAROLIN',
            image: null,
            short_desc: 'There is so much disinformation regarding Kratom products and their legality over the USA. It might be caused generally by the undefined status of the plant. Some believe',
            link: '/'
          }
        ],
        current_page: 1
      }
    }
  },

  methods: {
    loadmore() {

    }
  }
}
</script>

<style src="assets/scss/pages/guidebook.scss" lang="sass" scoped />

<template>
<section class="gidebook">
    <div class="gidebook__wrapper container">
        <div class="general-decor-figure"></div>
        
        <h1 class="main-caption main-caption-align">{{ page.h1 || page.title }}</h1>

        <div class="article__position">
            <ul class="article__list article__list-gidebook">
                <guidebook-card
                  v-for="(article, index) in articles.data"
                  :key="article.id"
                  :article="article"
                >
                </guidebook-card>
            </ul>
        </div>

        <button class="main-button" @click="loadmore()" v-if="articles.current_page != articles.last_page">
            <span class="text">{{ $t('text.show_more') }}</span>
        </button>
        
        <div v-if="page.seo_text" class="gidebook__text" v-html="page.seo_text"></div>

    </div>
</section>

<section-write-us></section-write-us>

</template>