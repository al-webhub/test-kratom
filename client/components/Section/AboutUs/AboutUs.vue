<script>

import type_1_img from 'assets/images/about-us-img-1.png'
import type_2_img from 'assets/images/about-us-img-2.png'
import type_3_img from 'assets/images/about-us-img-3.png'

export default {
  computed: {
    types() { 
      return [
        {
          id: 1,
          title: this.$t('text.Green_strain'),
          text: this.$t('text.Green_strain_1'),
          image: type_1_img
        },{
          id: 2,
          title: this.$t('text.Red_strain'),
          text: this.$t('text.Red_strain_1'),
          image: type_2_img
        },{
          id: 3,
          title: this.$t('text.White_strain'),
          text: this.$t('text.White_strain_1'),
          image: type_3_img
        }
      ]
    }
  }
}
</script>

<style src="./about-us.scss" lang="sass" scoped />

<template>
  <section class="about-us-block">
      <div class="about-us-block__wrapper container">
          
        <p class="main-caption">{{ $t('text.about_our_kratom') }}</p>
        
        <div class="about-us-block__container">
            
          <div class="about-us-block__img">
              <img src="~assets/images/about-us-block-img-1.png" alt="Фото">
          </div>
          
          <div class="about-us-block__text">
              <span class="general-decor-elem"></span>
              <div class="wrapper">
                  <p>{{ $t('text.about_our_kratom_1') }}</p>
              </div>
              <a href="about_us" class="main-button">
                  <span class="text">{{ $t('text.learn_more') }}</span>
              </a>
          </div>

        </div>

        <div class="about-us-block__description">
            
          <h2 class="main-caption-s">{{ $t('text.Types_of_kratom') }}</h2>

          <p class="info">{{ $t('text.Types_of_kratom_1') }}</p>

          <ul class="about-us-block__description__list">
              
              <li 
                v-for="type in types"
                :key="type.id"
                class="about-us-block__description__item">
                  <div class="img">
                      <img :src="type.image" alt="Kratom">
                  </div>
                  <h3 class="main-caption-xs">{{ type.title }}</h3>
                  <p class="info">{{ type.text  }}</p>
              </li>

          </ul>
        </div>

      </div>
  </section>
</template>