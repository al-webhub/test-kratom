<script>
import bgImage from 'assets/images/question-block-img.png'

export default {
  data() {
    return {}
  },

  computed: {
    bgImage() {
      return 'url(' + bgImage + ')'
    }
  }
}
</script>

<style src="./referral.scss" lang="sass" scoped />

<template>
  <section :style="{backgroundImage: bgImage}" class="subscribe js-img-bg">
      <div class="subscribe__wrapper container">
          <div class="subscribe__container">
              
            <h2 class="main-caption">{{ $t('text.Lets_earn_together') }}</h2>

              <p class="sub">{{ $t('text.Bring_your_friends_to_us') }}</p>
              
              <a v-if="user" href="transactions" class="main-button-color main-button-color-earn">
                  <span class="text">{{ $t('text.earn_with_us') }}</span>
              </a>
              <button v-else class="main-button-color main-button-color-earn js-button" data-target="registration-social">
                  <span class="text">{{ $t('text.earn_with_us') }}</span>
              </button>
          </div>
      </div>
  </section>
</template>