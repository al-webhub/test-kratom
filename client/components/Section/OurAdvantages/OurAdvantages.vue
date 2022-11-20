<script>
import advantagesImg from 'assets/images/our-advantages__img.png';

export default {
  data() {
    return {
      image: {
        advantages: advantagesImg
      }
    }
  },

  computed: {
    advantagesImg() {
      return 'url(' + advantagesImg + ')'
    }
  }
}
</script>

<style src="./our-advantages.scss" lang="sass" scoped />

<template>
  <section class="our-advantages">
      <div class="our-advantages__wrapper container">
          <h2 class="main-caption">{{ $t('text.Our_advantages') }}</h2>
          <div class="general-decor-text">kratomhelper</div>
          <ul class="our-advantages__list">
              <li class="our-advantages__item">
                  <div class="our-advantages__img">
                      <div :style="{backgroundImage: advantagesImg}" class="our-advantages__img-inner our-advantages__img-consultation js-img-bg"></div>
                  </div>
                  <p class="our-advantages__caption">{{ $t('text.Consultation') }}</p>
                  <div class="our-advantages__text">{{ $t('text.Our_advantages_1') }}</div>
                  <a href="our-advantages" class="general-more">
                      <span class="text">{{ $t('text.read_more') }}</span>
                      <span class="icon-arrow-right"></span>
                  </a>
              </li>
              <li class="our-advantages__item">
                  <div class="our-advantages__img">
                      <div :style="{backgroundImage: advantagesImg}" class="our-advantages__img-inner our-advantages__img-delivery js-img-bg"></div>
                  </div>
                  <p class="our-advantages__caption">{{ $t('text.Fast_delivery') }}</p>
                  <div class="our-advantages__text">{{ $t('text.Our_advantages_2') }}</div>
                  <a href="our-advantages#delivery" class="general-more">
                      <span class="text">{{ $t('text.read_more') }}</span>
                      <span class="icon-arrow-right"></span>
                  </a>
              </li>
              <li class="our-advantages__item">
                  <div class="our-advantages__img">
                      <div :style="{backgroundImage: advantagesImg}" class="our-advantages__img-inner our-advantages__img-money js-img-bg"></div>
                  </div>
                  <p class="our-advantages__caption">{{ $t('text.Return_the_money') }}</p>
                  <div class="our-advantages__text">{{ $t('text.Our_advantages_3') }}</div>
                  <a href="our-advantages#return" class="general-more">
                      <span class="text">{{ $t('text.read_more') }}</span>
                      <span class="icon-arrow-right"></span>
                  </a>
              </li>
              <li class="our-advantages__item">
                  <div class="our-advantages__img">
                      <div :style="{backgroundImage: advantagesImg}" class="our-advantages__img-inner our-advantages__img-quality js-img-bg"></div>
                  </div>
                  <p class="our-advantages__caption">{{ $t('text.Quality') }}</p>
                  <div class="our-advantages__text">{{ $t('text.Our_advantages_4') }}</div>
                  <a href="our-advantages#quality" class="general-more">
                      <span class="text">{{ $t('text.read_more') }}</span>
                      <span class="icon-arrow-right"></span>
                  </a>
              </li>
          </ul>
      </div>
  </section>
</template>