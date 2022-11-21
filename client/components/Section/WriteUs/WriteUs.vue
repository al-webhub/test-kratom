<script>
import bgImage from 'assets/images/question-block-img.png';
export default {
  computed: {
    bgImage() {
      return 'url(' + bgImage + ')'
    }
  },

  methods: {
    config(text) {
      return text
    }
  },

}
</script>

<style src="./write-us.scss" lang="sass" scoped />

<template>
  <section :style="{backgroundImage: bgImage}" class="question-block js-img-bg">
    <div class="question-block__wrapper container">
        <div class="question-block__container">
            <p class="main-caption">{{ $t('text.have_any_questions?') }}</p>
            <p class="sub">{{ $t('text.Write_to_us') }}</p>
            <ul class="question-block__list">
                <li class="question-block__item question-block__item-message">
                    <a href="mailto: {{ config('settings.contact_email') }}" class="question-block__link">
                        <span class="icon-message"></span>
                    </a>
                </li>
                <li class="question-block__item question-block__item-teleg">
                    <a href="tg://resolve?domain={{ config('settings.tg') }}" class="question-block__link">
                        <span class="icon-teleg"></span>
                    </a>
                </li>
                <li class="question-block__item question-block__item-whatsapp">
                    <a href="https://wa.me/{{ config('settings.whatsapp') }}" class="question-block__link">
                        <span class="icon-whatsapp"></span>
                    </a>
                </li>
                <li class="question-block__item question-block__item-skype">
                    <a href="skype:{{ config('settings.skype') }}?chat" class="question-block__link">
                        <span class="icon-skype"></span>
                    </a>
                </li>
                <li class="question-block__item question-block__item-viber">
                    <a href="viber://chat?number=+{{ config('settings.viber') }}" class="question-block__link hide-desktop">
                        <span class="icon-viber"></span>
                    </a>
                    <a href="viber://chat?number={{ config('settings.viber') }}" class="question-block__link hide-mobile">
                        <span class="icon-viber"></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
  </section>
</template>