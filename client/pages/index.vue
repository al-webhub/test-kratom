<script>
import bannerImg1 from 'assets/images/main-banner-img-1.png';
import bannerImg2 from 'assets/images/main-banner-img-2.png';
import bannerImg3 from 'assets/images/main-banner-3.png';

export default {
  data() {
    return {
      products: [
        {
          id: 1,
          name: '123123',
          image: null,
          link: '/porduct',
          excerpt: '3123123123',
          stimulation: 3,
          relaxation: 4,
          euphoria: 5,
          modifications: [
            {
              id: 1,
              name: '50',
              price: 10
            },{
              id: 2,
              name: '100',
              price: 15
            },{
              id: 3,
              name: '150',
              price: 20
            }
          ]
        },
        {
          id: 2,
          name: '123123',
          image: null,
          link: '/porduct',
          excerpt: '3123123123',
          stimulation: 2,
          relaxation: 3,
          euphoria: 2,
          modifications: [
            {
              id: 1,
              name: '50',
              price: 10
            },{
              id: 2,
              name: '100',
              price: 15
            },{
              id: 3,
              name: '150',
              price: 20
            }
          ]
        }
      ],
      banners: [
        {
          id: 1,
          image: '',
          badImage: bannerImg1,
          desc: 'Natural product used to improve the quality of life,  mental and physiological health',
          short_desc: 'kratom leaves',
          title: 'shop now',
          link: '/'
        },{
          id: 2,
          image: '',
          badImage: bannerImg2,
          desc: 'Natural product used to improve the quality of life,  mental and physiological health',
          short_desc: 'kratom leaves',
          title: 'shop now',
          link: '/'
        },{
          id: 3,
          image: '',
          badImage: bannerImg3,
          desc: 'Natural product used to improve the quality of life,  mental and physiological health',
          short_desc: 'kratom leaves',
          title: 'shop now',
          link: '/'
        }
      ],
      articles: [
        {
          id: 1,
          title: 'KRATOM TABLETS AND PILLS - BU',
          short_desc: 'Everyone evaluates the comfort and convenience of the environments we spend our lives. It is the feature we expect to meet in all the things we deal with, be it various supplements',
          image: null,
          link: '/'
        },
        {
          id: 2,
          title: 'IS KRATOM LEGAL?',
          short_desc: 'Everyone evaluates the comfort and convenience of the environments we spend our lives. It is the feature we expect to meet in all the things we deal with, be it various supplements',
          image: null,
          link: '/'
        },
        {
          id: 3,
          title: 'ALL ABOUT KRATOM',
          short_desc: 'Everyone evaluates the comfort and convenience of the environments we spend our lives. It is the feature we expect to meet in all the things we deal with, be it various supplements',
          image: null,
          link: '/'
        },
        {
          id: 4,
          title: 'ALL ABOUT KRATOM',
          short_desc: 'Everyone evaluates the comfort and convenience of the environments we spend our lives. It is the feature we expect to meet in all the things we deal with, be it various supplements',
          image: null,
          link: '/'
        }
      ],
      reviews: [
        {
          id: 1,
          photo: null,
          name: 'Petep Pan',
          text: 'В первую очередь отдельная благодарность сотрудникам магазина,отличная командная работа,а что касается самого'
        },
        {
          id: 2,
          photo: null,
          name: 'Petep Pan',
          text: 'В первую очередь отдельная благодарность сотрудникам магазина,отличная командная работа,а что касается самого'
        },
        {
          id: 3,
          photo: null,
          name: 'Petep Pan',
          text: 'В первую очередь отдельная благодарность сотрудникам магазина,отличная командная работа,а что касается самого'
        },
        {
          id: 4,
          photo: null,
          name: 'Petep Pan',
          text: 'В первую очередь отдельная благодарность сотрудникам магазина,отличная командная работа,а что касается самого'
        }
      ],
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
  methods: {
  }
}
</script>

<style src="assets/scss/pages/home.scss" lang="sass" scoped />

<template>

  <!-- MAIN SLIDER -->
  <simple-decorator
    :settings="{title: {pos: 'right'}, figure: {pos: 'right', showTill: 'desktop'}}"
    :is-figure="true"
  >
    <section-main-slider :banners="banners"></section-main-slider>
  </simple-decorator> 

  <section-products-slider :products="products"></section-products-slider>
  
  <!-- ABOUT US -->
  <simple-decorator 
    :settings="{title: {pos: 'left'}, figure: {pos: 'right', showTill: 'mobile'}}"
    class="section"
  >
    <section-about-us></section-about-us>
  </simple-decorator>

  <section-choose-kratom></section-choose-kratom>
  
  <!-- OUR ADVANTAGES -->
  <simple-decorator
    :settings="{title: {pos: 'right'}, figure: {pos: 'right', showTill: 'mobile'}}"
    :is-figure="true"
    class="section"
  >
    <section-our-advantages></section-our-advantages>
  </simple-decorator>
  
  <section-articles :articles="articles" class="section"></section-articles>

  <section-client-reviews :reviews="reviews"></section-client-reviews>

  <section-seo :title="page.h1" :text="page.seo_text" class="section"></section-seo>

  <section-write-us></section-write-us>

</template>