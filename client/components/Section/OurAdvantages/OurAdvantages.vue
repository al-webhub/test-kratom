<script>
import call_img from 'assets/svg-icons/promo/call.svg';
import track_img from 'assets/svg-icons/promo/track.svg';
import wallet_img from 'assets/svg-icons/promo/wallet.svg';
import diamond_img from 'assets/svg-icons/promo/diamond.svg';

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
    return {
      
    }
  },

  computed: {
    advantages() {
      return [
        {
          id: 1,
          title: this.t('Consultation'),
          text: this.t('Our_advantages_1'),
          image: call_img,
          link: '/our-advantages'
        },
        {
          id: 2,
          title: this.t('Fast_delivery'),
          text: this.t('Our_advantages_2'),
          image: track_img,
          link: '/our-advantages#delivery'
        },
        {
          id: 3,
          title: this.t('Return_the_money'),
          text: this.t('Our_advantages_3'),
          image: wallet_img,
          link: '/our-advantages#return'
        },
        {
          id: 4,
          title: this.t('Quality'),
          text: this.t('Our_advantages_4'),
          image: diamond_img,
          link: '/our-advantages#quality'
        }
      ]
    }
  }
}
</script>

<style src="./our-advantages.scss" lang="sass" scoped />

<i18n src="./messages.json"></i18n>

<template>
  <section class="container">

    <h2 class="main-caption">{{ t('Our_advantages') }}</h2>
    
    <ul class="list">
      <li 
        v-for="advantage in advantages"
        :key="advantage.id"
        class="item"
      >
        <div class="img">
          <img :src="advantage.image" class="icon" />
        </div>
        <p class="caption">{{ advantage.title }}</p>

        <div class="content">{{ advantage.text }}</div>

        <simple-more-btn :link="advantage.link" class="more-btn"></simple-more-btn>
      </li>
    </ul>

  </section>
</template>