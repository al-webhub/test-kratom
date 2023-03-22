<script>
export default {
  setup() {
    const { t } = useI18n({
      useScope: 'local'
    }) 

    return {t}
  },

  data() {
    return {
    }
  },

  props: {
    reviews: {
      type: Array,
      required: true
    }
  },
}
</script>

<style src="./client-reviews.scss" lang="sass" scoped />

<i18n src="./messages.json"></i18n>

<template>
  <section class="clients-say">
     
    <nuxt-img
      src="/images/clients-say-bg.png"
      height="226"
      sizes = "mobile:100vw desktop:100vw"
      format = "webp"
      quality = "80"
      fit="cover"
      loading = "lazy"
      class="bg-image"
      alt="kratomhelper forest"
    >
    </nuxt-img>
      
    <div class="wrapper container">
        
      <h2 class="main-caption">{{ t('What_our_clients_say') }}</h2>
        
      <div class="header">
        <p class="caption">{{ t('leave_feedback_and_earn') }}</p>

        <div class="buttons">
          <NuxtLink :to="localePath('/reviews')" :aria-label="$t('button.leave_feedback')" clickable class="main-button primary">
            <span class="text">{{ $t('button.leave_feedback') }}</span>
          </NuxtLink>
          <NuxtLink :to="localePath('/rewards')" :aria-label="$t('button.learn_more')" clickable class="main-button transparent">
            <span class="text">{{ $t('button.learn_more') }}</span>
          </NuxtLink>
        </div>
      </div>
    </div>

    <div class="slider-holder">
      <simple-slider
          :values="reviews"
          target-component-name="reviewHomeCard"
          target-data-name="review"
          :all-items-label="$t('button.read_all_reviews')"
          all-items-link="reviews"
          class="slider"
      >
      </simple-slider>
    </div>
  </section>
</template>