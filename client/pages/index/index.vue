<script setup>
  import { useModalStore } from '~/store/modal';
  import { useProductStore } from '~/store/product';
  import { useReviewStore } from '~/store/review';
  import { useBannerStore } from '~/store/banner';
  import { useArticleStore } from '~/store/article';

  definePageMeta({
    breadcrumbsIsActive: false
  })

  const { t, locale } = useI18n({useScope: 'local'})

  // DATA
  const products = ref([])
  const reviews = ref([])

  // COMPUTED
  const isModalChooseKratomActive = computed(() => {
    return useModalStore().show('chooseKratom')
  })

  const page = computed(() => {
    return {
      h1: t('h1'),
      seo_text: t('seo_text')
    }
  })

  const banner = computed(() => {
    return useBannerStore().banner
  })

  // const reviews = computed(() => {
  //   return useReviewStore().all
  // })

  const articles = computed(() => {
    return useArticleStore().all
  })

  // METHODS
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

  await useLazyAsyncData('banners', () => useBannerStore().getOne('main-banner'))
  const { pending: productsPending, data: productsData } = useLazyAsyncData('home_products', () => useProductStore().getAll({per_page: 8, category_slug: 'kratom'}))
  const { pending: reviewsPending, data: reviewsData } =  useLazyAsyncData('home_reviews', () => useReviewStore().getAll({per_page: 8}))
  await useLazyAsyncData('articles', () => useArticleStore().getAll({per_page: 4, lang: locale.value}))
  
  setSeo()

  watch(productsData, (data) => {
    if(data && data.length)
      products.value = data
  }, { immediate: true })

  watch(reviewsData, (data) => {
    if(data && data.length)
      reviews.value = data
  }, { immediate: true })

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
    <section-main-slider v-if="banner && banner.items && banner.items.length" :banners="banner.items"></section-main-slider>
  </simple-decorator> 

  <DelayHydration>
    <lazy-section-products-slider v-if="!productsPending" :products="products" class="section"></lazy-section-products-slider>
  </DelayHydration>
  
  <!-- ABOUT US -->
  <DelayHydration>
    <lazy-simple-decorator 
      :settings="{title: {posX: 'left'}, figure: {posX: 'right', showTill: 'mobile'}}"
      class="section"
    >
      <section-about-us></section-about-us>
    </lazy-simple-decorator>
  </DelayHydration>

  <DelayHydration>
    <lazy-section-choose-kratom v-if="!$device.isMobile"  class="section choose-kratom-section"></lazy-section-choose-kratom>
  </DelayHydration>
  
  <!-- OUR ADVANTAGES -->
  <simple-decorator
    :settings="{title: {posX: 'right'}, figure: {posX: 'right', showTill: 'mobile'}}"
    :is-figure="true"
    class="section"
  >
    <section-our-advantages></section-our-advantages>
  </simple-decorator>
  
  <DelayHydration>
    <lazy-section-articles v-if="articles && articles.length" :articles="articles" class="section"></lazy-section-articles>
  </DelayHydration>

  <DelayHydration>
    <lazy-section-client-reviews v-if="!reviewsPending" :reviews="reviews" class="section"></lazy-section-client-reviews>
  </DelayHydration>

  <section-seo :title="page.h1" :text="page.seo_text" class="section"></section-seo>

  <DelayHydration>
    <lazy-section-write-us></lazy-section-write-us>
  </DelayHydration>

  <DelayHydration>
    <transition name="fade-in">
      <lazy-popup-choose-kratom v-if="isModalChooseKratomActive"></lazy-popup-choose-kratom>
    </transition>
  </DelayHydration>
</div>
</template>