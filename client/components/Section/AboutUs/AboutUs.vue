<script>
export default {
  methods: {
    __(text) {
      return text;
    } 
  }
}
</script>

<style src="./about-us.scss" lang="sass" scoped />

<template>
  <section class="about-us-block">
      <div class="about-us-block__wrapper container">
          <p class="main-caption">{{ $t('text.about_our_kratom') }}</p>
          <div class="general-decor-text">kratomhelper</div>
          <div class="general-decor-figure"></div>
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
                  <li class="about-us-block__description__item">
                      <div class="img">
                          <img src="~assets/images/about-us-img-1.png" alt="Kratom">
                      </div>
                      <h3 class="main-caption-xs">{{ __('text.Green_strain') }}</h3>
                      <p class="info">{{ $t('text.Green_strain_1') }}</p>
                  </li>
                  <li class="about-us-block__description__item">
                      <div class="img">
                          <img src="~assets/images/about-us-img-2.png" alt="Kratom">
                      </div>
                      <h3 class="main-caption-xs">{{ $t('text.Red_strain') }}</h3>
                      <p class="info">{{ $t('text.Red_strain_1') }}</p>
                  </li>
                  <li class="about-us-block__description__item">
                      <div class="img">
                          <img src="~assets/images/about-us-img-3.png" alt="Kratom">
                      </div>
                      <h3 class="main-caption-xs">{{ $t('text.White_strain') }}</h3>
                      <p class="info">{{ $t('text.White_strain_1') }}</p>
                  </li>
              </ul>
          </div>
      </div>
  </section>
</template>