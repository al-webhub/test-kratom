<script>
import { useProductStore } from '~/store/product';
import { useReviewStore } from '~/store/review';
import { useBannerStore } from '~/store/banner';
import { useArticleStore } from '~/store/article';

export default {
  async setup() {
    definePageMeta({
      breadcrumbsIsActive: false
    })

    const { t, locale } = useI18n({useScope: 'local'})

    const productStore = useProductStore()
    const reviewStore = useReviewStore()
    const bannerStore = useBannerStore()
    const articleStore = useArticleStore()

    await useAsyncData('banners', () => bannerStore.getOne('main-banner'))
    await useAsyncData('products', () => productStore.getAll({per_page: 8, category_slug: 'kratom'}))
    await useAsyncData('reviews', () => reviewStore.getAll({per_page: 8}))
    await useAsyncData('articles', () => articleStore.getAll({per_page: 4, lang: locale.value}))


    const setSeo = () => {
      useHead({
        title: t('seo.title'),
        meta: [
          {
            name: 'description',
            content: t('seo.description')
          },
        ],
      })
    }

    setSeo()

    return {
      productStore,
      reviewStore,
      bannerStore,
      articleStore,
      t
    }
  },

  data() {
    return {}
  },

  computed: {
    page() {
      return {
        h1: this.t('h1'),
        seo_text: this.t('seo_text')
      }
    },

    banner() {
      return this.bannerStore?.banner;
    },

    products() {
      return this.productStore?.all;
    },

    reviews() {
      return this.reviewStore?.all;
    },

    articles() {
      return this.articleStore?.all;
    },
  },

}
</script>

<style src="assets/scss/pages/home.scss" lang="sass" scoped />

<i18n src="./messages.json"></i18n>

<template>
<div class="home-wrapper">
  <!-- MAIN SLIDER -->
  <simple-decorator
    :settings="{title: {posX: 'right', posY: 'bottom'}, figure: {posX: 'right', showTill: 'desktop'}}"
    :is-figure="true"
  >
    <section-main-slider :banners="banner.items"></section-main-slider>
  </simple-decorator> 

  <lazy-section-products-slider :products="products" class="section"></lazy-section-products-slider>
  
  <!-- ABOUT US -->
  <simple-decorator 
    :settings="{title: {posX: 'left'}, figure: {posX: 'right', showTill: 'mobile'}}"
    class="section"
  >
    <section-about-us></section-about-us>
  </simple-decorator>

  <section-choose-kratom  class="section"></section-choose-kratom>
  
  <!-- OUR ADVANTAGES -->
  <simple-decorator
    :settings="{title: {posX: 'right'}, figure: {posX: 'right', showTill: 'mobile'}}"
    :is-figure="true"
    class="section"
  >
    <section-our-advantages></section-our-advantages>
  </simple-decorator>
  
  <lazy-section-articles v-if="articles && articles.length" :articles="articles" class="section"></lazy-section-articles>

  <lazy-section-client-reviews v-if="reviews && reviews.length" :reviews="reviews" class="section"></lazy-section-client-reviews>

  <section-seo :title="page.h1" :text="page.seo_text" class="section"></section-seo>

  <section-write-us></section-write-us>

  <lazy-popup-choose-kratom></lazy-popup-choose-kratom>
</div>
</template>