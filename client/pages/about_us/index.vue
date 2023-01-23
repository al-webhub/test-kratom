<script>
export default {
  setup() {
    const { t } = useI18n({
      useScope: 'local'
    }) 

    return {
      t
    }
  },
  data() {
    return {}
  },

  computed: {
    page() {
      return {
        title: this.t('title'),
        title_1: this.t('title_1'),
        content_1: this.t('content_1'),
        q_1: this.t('q_1'),
        title_2: this.t('title_2'),
        content_2: this.t('content_2'),
        content_3: this.t('content_3'),
      }
    }
  },

  methods: {
    setCrumbs() {
      useCrumbs().setCrumbs([
          {
            name: this.$t('crumbs.home'),
            link: '/'
          },{
            name: this.$t('crumbs.about_us'),
            link: '/about_us'
          }
      ])
    },
  },

  created() {
    this.setCrumbs()
  }
}
</script>

<style src="assets/scss/pages/about-us.scss" lang="sass" scoped />

<i18n src="./messages.json"></i18n>

<template>
  <div>
    <section class="about-us-page">
        <div class="about-us-page__wrapper container">
            <!-- <div class="general-decor-figure"></div>
            <div class="general-decor-text">about us</div> -->
            <h1 class="main-caption main-caption-align">{{ page.h1 || page.title }}</h1>

            <div class="about-us-page__container">
                
                <nuxt-img
                  src = "/images/about-1.jpg"
                  sizes = "mobile:100vw tablet:322px"
                  quality = "100"
                  fit="cover"
                  class="about-us-page__main-img"
                >
                </nuxt-img>
                
                <div class="about-us-page__content">
                  <h2 class="about-us-page__content__caption">{{ page.title_1 }}</h2>
                  
                  <p>{{ page.content_1 }}</p>
                  
                  <div class="main">
                    <p>{{ page.q_1 }}</p>
                  </div>
                  
                  <h2 class="about-us-page__content__caption">{{ page.title_2 }}</h2>
                  
                  <p>{{ page.content_2 }}</p>
                  
                  <div class="about-us-page__img-group about-us-page__img-group-tablet">
                    <nuxt-img
                      src = "/images/about-2.jpg"
                      sizes = "mobile:100vw tablet:238px"
                      quality = "25"
                      fit="cover"
                      class="img js-img-bg"
                    >
                    </nuxt-img>
                    <nuxt-img
                      src = "/images/about-3.jpg"
                      sizes = "mobile:100vw tablet:238px"
                      quality = "25"
                      fit="cover"
                      class="img js-img-bg"
                    >
                    </nuxt-img>
                  </div>

                  <p>{{ page.content_3 }}</p>
                </div>

                <div class="about-us-page__img-group">
                    <nuxt-img
                      src = "/images/about-2.jpg"
                      sizes = "mobile:100vw tablet:238px"
                      quality = "25"
                      fit="cover"
                      class="img js-img-bg"
                    >
                    </nuxt-img>
                    <nuxt-img
                      src = "/images/about-3.jpg"
                      sizes = "mobile:100vw tablet:238px"
                      quality = "25"
                      fit="cover"
                      class="img js-img-bg"
                    >
                    </nuxt-img>
                </div>

            </div>
        </div>
    </section>

    <section-write-us></section-write-us>
  </div>
</template>