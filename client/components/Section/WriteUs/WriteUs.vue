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
  <section :style="{backgroundImage: bgImage}" class="qb">
    <div class="wrapper container">
        <div class="inner">
            <p class="main-caption">{{ $t('text.have_any_questions?') }}</p>
            
            <p class="sub">{{ $t('text.Write_to_us') }}</p>

            <ul class="list">
                <li class="item message">
                    <a href="mailto: {{ config('settings.contact_email') }}" class="link">
                        <img src="~assets/svg-icons/mail.svg" class="icon" />
                    </a>
                </li>
                <li class="item telegram">
                    <a href="tg://resolve?domain={{ config('settings.tg') }}" class="link">
                        <img src="~assets/svg-icons/telegram.svg" class="icon" />
                    </a>
                </li>
                <li class="item whatsapp">
                    <a href="https://wa.me/{{ config('settings.whatsapp') }}" class="link">
                        <img src="~assets/svg-icons/whatsapp.svg" class="icon" />
                    </a>
                </li>
                <li class="item skype">
                    <a href="skype:{{ config('settings.skype') }}?chat" class="link">
                        <img src="~assets/svg-icons/skype.svg" class="icon" />
                    </a>
                </li>
                <li class="item viber">
                    <a href="viber://chat?number=+{{ config('settings.viber') }}" class="link hide-desktop">
                        <img src="~assets/svg-icons/viber.svg" class="icon" />
                    </a>
                    <a href="viber://chat?number={{ config('settings.viber') }}" class="link hide-mobile">
                        <img src="~assets/svg-icons/viber.svg" class="icon" />
                    </a>
                </li>
            </ul>

        </div>
    </div>
  </section>
</template>