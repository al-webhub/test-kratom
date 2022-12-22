<script>
import { useProductStore } from '~/store/product';
import { useReviewStore } from '~/store/review';
import { useBannerStore } from '~/store/banner';
import { useArticleStore } from '~/store/article';

export default {
  setup() {
    definePageMeta({
      breadcrumbsIsActive: false
    })

    const productStore = useProductStore()
    const reviewStore = useReviewStore()
    const bannerStore = useBannerStore()
    const articleStore = useArticleStore()

    bannerStore.$reset()
    reviewStore.$reset()
    articleStore.$reset()

    return {
      productStore,
      reviewStore,
      bannerStore,
      articleStore
    }
  },

  data() {
    return {
      page: {
        h1: 'KRATOM TEA FOR SALE',
        seo_text: `
        Green Maeng Da is the most famous and common species. Green Maeng Da combines the beneficial properties of white and red kratom species. Its properties contain a surge of energy, tonic effect, anesthesia, improving the quality of sleep, mental activity.

Red Maeng Da. This variety of kratom powder got its name due to the crimson pigment in the petioles and veins on the back of the leaf. Red Maeng Da kratom gives a boost of energy, but at the same time reduces stress. In this variety, the effect of euphoria is less pronounced.

White Maeng Da - is the result of combining the best qualities of natural and artificial varieties. Bred to reveal the best properties of the variety Kratom White. Maeng Da possesses the characteristics of excellent energetic. But at the same time, it has mild sedative and analgesic properties. Commonly, many sellers offer much more than 3 types of powder to attract new customers with the available variety of goods range. In spite the range is offered, alas customers face low quality and fake products.
        `
      }
    }
  },

  computed: {
    banner() {
      console.log('BANNER', this.bannerStore?.banner);
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

    lang() {
      return this.$i18n.locale;
    }
  },
  
  methods: {
    async getBanner() {
      await this.bannerStore?.getOne(1)
    },

    async getProducts() {
      await this.productStore?.getAll({per_page: 8})
    },

    async getReviews() {
      await this.reviewStore?.getAll({per_page: 8})
    },

    async getArticles() {
      await this.articleStore?.getAll({per_page: 4, lang: this.lang})
    }
  },

  async created() {
    await useAsyncData('banner', () => this.getBanner())
    await useAsyncData('products', () => this.getProducts())
    await useAsyncData('reviews', () => this.getReviews())
    await useAsyncData('articles', () => this.getArticles())
  }
}
</script>

<style src="assets/scss/pages/home.scss" lang="sass" scoped />

<template>
<div>
  <!-- MAIN SLIDER -->
  <simple-decorator
    :settings="{title: {posX: 'right', posY: 'bottom'}, figure: {posX: 'right', showTill: 'desktop'}}"
    :is-figure="true"
  >
    <section-main-slider v-if="banner && banner.items.length" :banners="banner.items"></section-main-slider>
  </simple-decorator> 

  <section-products-slider :products="products" class="section"></section-products-slider>
  
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
  
  <section-articles v-if="articles && articles.length" :articles="articles" class="section"></section-articles>

  <section-client-reviews v-if="reviews && reviews.length" :reviews="reviews" class="section"></section-client-reviews>

  <section-seo :title="page.h1" :text="page.seo_text" class="section"></section-seo>

  <section-write-us></section-write-us>
</div>
</template>