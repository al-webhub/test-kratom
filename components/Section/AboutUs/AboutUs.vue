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

  computed: {
    page() {
      return {
        h1: this.t('about_our_kratom'),
        text: this.t('about_our_kratom_1'),
        types: this.t('Types_of_kratom'),
        types_desc: this.t('Types_of_kratom_1')
      }
    },

    kratoms() { 
      return [
        {
          id: 1,
          title: this.t('Green_strain'),
          text: this.t('Green_strain_1'),
          image: '/images/about-us-img-1.png'
        },{
          id: 2,
          title: this.t('Red_strain'),
          text: this.t('Red_strain_1'),
          image: '/images/about-us-img-2.png'
        },{
          id: 3,
          title: this.t('White_strain'),
          text: this.t('White_strain_1'),
          image: '/images/about-us-img-3.png'
        }
      ]
    }
  }
}
</script>

<style src="./about-us.scss" lang="sass" scoped />

<i18n src="./messages.json"></i18n>

<template>
  <section class="wrapper">
      <div class="container">
          
        <p class="main-caption">{{ page.h1  }}</p>
        
        <div class="row-1">
          <nuxt-img
            src = "/images/about-us-block-img-1.png"
            alt="About out kratom"
            width="570"
            height="342"
            sizes = "mobile:100vw tablet:360px desktop:580px"
            quality = "25"
            fit="cover"
            format="webp"
            class="row-1-img cover"
          >
          </nuxt-img>
          
          <div class="row-1-text">
            <span class="general-decor-elem"></span>
            
            <div class="wrapper">
              <p>{{ page.text }}</p>
            </div>
            
            <NuxtLink :to="localePath('/about_us')" clickable class="main-button">
              <span class="text">{{ $t('button.learn_more') }}</span>
            </NuxtLink>
          </div>
        </div>

        <div class="row-2">
            
          <h2 class="main-caption-s">{{ page.types }}</h2>

          <p class="info">{{ page.types_desc }}</p>

          <ul class="row-2__list">
              
              <li
                v-for="(type, index) in kratoms"
                :key="type.id"
                class="row-2__item"
              >
                  <div class="img">
                    <nuxt-img
                      :src = "type.image"
                      width="100"
                      height="100"
                      sizes = "mobile:100px desktop:100px"
                      quality = "5"
                      loading = "lazy"
                      fit="cover"
                      :alt="type.title"
                      class="cover"
                    >
                    </nuxt-img> 
                  </div>
                  <h3 class="main-caption-xs">{{ type.title }}</h3>
                  <p class="info">{{ type.text  }}</p>
              </li>

          </ul>
        </div>

      </div>
  </section>
</template>