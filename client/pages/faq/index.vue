<script>
export default {
  data() {
    return {
      page: {
        h1: 'Frequently Asked Questions',
        title: 'We are fully aware of the fact that you may have several questions, which you would prefer to find the quick answers to (without writing to our messenger or e-mail box). Perhaps, you may find the information you need here.',
        content: '',

      },
      faqs: [
        {
          id: 1,
          title: 'How to use kratom?',
          content: 'There are lots of ways. Kratom is a natural plant ingredient, which may be used in different ways: it may be intaken as a dietary additive, it may be brewed like tea, it may be used in the form of powder or tablets in order to provide the body with energy and alleviate the pain.'
        }, {
          id: 2,
          title: 'How to use kratom?',
          content: 'There are lots of ways. Kratom is a natural plant ingredient, which may be used in different ways: it may be intaken as a dietary additive, it may be brewed like tea, it may be used in the form of powder or tablets in order to provide the body with energy and alleviate the pain.'
        }
      ]
    }
  },
}
</script>

<style src="assets/scss/pages/faq.scss" lang="sass" scoped />

<template>
  <section class="faq">
      <div class="faq__wrapper container">
          <div class="general-decor-figure"></div>
          
          <h1 class="main-caption main-caption-align">{{ page.h1 || page.title }}</h1>
          
          <p class="faq__text">{{ page.content }}</p>

          <div class="faq__container">
              <ul class="faq__list">
                  <li
                    v-for="(faq, index) in faqs"
                    :key="faq.id"
                    class="faq__item js-drop-item"
                  >
                      <div class="faq__item__header js-drop-button">
                          <h2 class="name">{{ faq.title }}</h2>
                          <span class="icon-drop"></span>
                      </div>
                      <div class="faq__item__body" v-html="faq.content"></div>
                  </li>
              </ul>
          </div>
      </div>
  </section>

  <section-write-us></section-write-us>

</template>