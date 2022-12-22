<script>
export default {
  data() {
    return {
      page: {
        h1: 'Frequently Asked Questions',
        title: 'We are fully aware of the fact that you may have several questions, which you would prefer to find the quick answers to (without writing to our messenger or e-mail box). Perhaps, you may find the information you need here.',
        content: '',
      },

      activeIndex: null
    }
  },

  computed: {
    faqs() { 
      return [
        {
          id: 1,
          title: this.$t('faqs.q_1'),
          content: this.$t('faqs.a_1')
        },{
          id: 2,
          title: this.$t('faqs.q_2'),
          content: this.$t('faqs.a_2')
        },{
          id: 3,
          title: this.$t('faqs.q_3'),
          content: this.$t('faqs.a_3')
        },{
          id: 4,
          title: this.$t('faqs.q_4'),
          content: this.$t('faqs.a_4')
        },{
          id: 5,
          title: this.$t('faqs.q_5'),
          content: this.$t('faqs.a_5')
        },{
          id: 6,
          title: this.$t('faqs.q_6'),
          content: this.$t('faqs.a_6')
        }
      ]
    }
  },

  methods: {
    toggleHandler(index) {
      if(this.activeIndex === index)
        this.activeIndex = null
      else
        this.activeIndex = index
    }
  }
}
</script>

<style src="assets/scss/pages/faq.scss" lang="sass" scoped />
<style>
.faq__item__body p {
  margin-bottom: 25px;
}
</style>

<template>
<div>  
  <section class="faq">
    <div class="faq__wrapper container">
      <!-- <div class="general-decor-figure"></div> -->
      
      <h1 class="main-caption main-caption-align">{{ page.h1 || page.title }}</h1>
      
      <p class="faq__text">{{ page.content }}</p>

      <div class="faq__container">
        <ul class="faq__list">
          <li
            v-for="(faq, index) in faqs"
            :key="faq.id"
            @click="toggleHandler(index)"
            :class="{active: index === activeIndex}"
            class="faq__item"
          >
            <div class="faq__item__header">
              <h2 class="name">{{ faq.title }}</h2>
              <img src="~assets/svg-icons/arrow-simple.svg" class="icon" />
            </div>
            <div class="faq__item__body" v-html="faq.content"></div>
          </li>
        </ul>
      </div>

    </div>
  </section>

  <section-write-us></section-write-us>
</div>
</template>