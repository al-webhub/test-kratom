<script>
import bgImage from 'assets/images/question-block-img.png'

export default {
  setup() {
    const { t } = useI18n({useScope: 'local'})

    return {
      t
    }
  },

  data() {
    return {
      user: false
    }
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
              
            <h2 class="main-caption">{{ t('Lets_earn_together') }}</h2>

              <p class="sub">{{ t('Bring_your_friends_to_us') }}</p>
              
              <a v-if="user" href="transactions" class="main-button primary" :aria-label="t('earn_with_us')">
                <span class="text">{{ t('earn_with_us') }}</span>
              </a>
              
              <button v-else class="main-button primary" :aria-label="t('earn_with_us')" type="button">
                <span class="text">{{ t('earn_with_us') }}</span>
              </button>
          </div>
      </div>
  </section>
</template>

<i18n>
  {
    "en": {
      "Lets_earn_together" : "Let’s earn together!",
      "Bring_your_friends_to_us" : "Bring your friends to us",
      "earn_with_us" : "earn with us",
    },
    "ru": {
      "Lets_earn_together" : "Давайте заработаем вместе!",
      "Bring_your_friends_to_us" : "Приведите своих друзей к нам",
      "earn_with_us" : "Начать",
    }
  }
</i18n>