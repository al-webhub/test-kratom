<script>
export default {
  
  data() {
    return {
      current_language: 'En',
    }
  },

  computed: {
    menu() {
      return [
        {
          id: 1,
          link: '/shop',
          name: this.$t('menu.item_1')
        },{
          id: 2,
          link: '/shop/other-products',
          name: this.$t('menu.item_2')
        },{
          id: 3,
          link: '/rewards',
          name: this.$t('menu.item_3')
        },{
          id: 4,
          link: '/pay_delivery',
          name: this.$t('menu.item_4')
        },{
          id: 5,
          link: '/reviews',
          name: this.$t('menu.item_5')
        },{
          id: 6,
          link: '/guidebook',
          name: this.$t('menu.item_6')
        },{
          id: 7,
          link: '/about_us',
          name: this.$t('menu.item_7')
        },{
          id: 8,
          link: '/faq',
          name: this.$t('menu.item_8')
        },{
          id: 9,
          link: '/contacts',
          name: this.$t('menu.item_9')
        }
      ]
    },

    year() {
      return new Date().getFullYear()
    }
  }

}
</script>

<style src="./footer.scss" lang="sass" scoped />

<template>
  <footer class="footer">

    <div class="footer__wrapper container">

      <div class="footer__wrapper__top">
          
        <div class="footer__logo-wrapper">
          <div class="footer__logo">
              <img src="~assets/images/logo.svg" alt="Kratom">
          </div>
        </div>

        <ul class="footer__list">
          <li
            v-for="(item, index) in menu"
            :key="item.id"
            class="footer__item"
          >
            <NuxtLink
              :to="localePath(item.link)"
              class="footer__link"
            >
              {{ item.name }}
            </NuxtLink>
          </li>
        </ul>
          
          <!-- <ul class="footer__social-list">
              <li class="footer__social-item">
                  <a href="{{ config('settings.fb') }}" class="footer__social__link" target="_blank">
                      <span class="icon-fb"></span>
                  </a>
              </li>
              <li class="footer__social-item">
                  <a href="{{ config('settings.inst') }}" class="footer__social__link" target="_blank">
                      <span class="icon-inst"></span>
                  </a>
              </li>
          </ul> -->

        <div class="footer__lang js-drop-item">
          <div class="footer__lang_popup">
            <!-- @include('includes.languages') -->
          </div>
          <div class="footer__lang_link js-drop-button">
            <div>
              <span class="icon-globe"></span>
            </div>

            <div class="footer__lang_name">
              {{ current_language }}
            </div>

            <div>
              <span class="icon-drop"></span>
            </div>
          </div>
        </div>

      </div>

      <div class="footer__wrapper__down">
        <p class="footer__copyright">
          Copyright © {{ year }}
        </p>

        <NuxtLink :to="localePath('terms')" class="footer__down-link">
          {{ $t('text.Terms_Conditions') }}
        </NuxtLink>

        <NuxtLink :to="localePath('privacy')" class="footer__down-link">
          {{ $t('text.Privacy_Policy') }}
        </NuxtLink>
      </div>

    </div>

  </footer>
</template>