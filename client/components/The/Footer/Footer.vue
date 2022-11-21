<script>
export default {
  
  data() {
    return {
      current_language: 'En',
      menu: [
        {
          id: 1,
          name: 'Menu 1',
          link: '/'
        },{
          id: 2,
          name: 'Menu 2',
          link: '/'
        },{
          id: 3,
          name: 'Menu 3',
          link: '/'
        }
      ],
      submenu: [
        {
          id: 1,
          name: 'Menu 1',
          link: '/'
        },{
          id: 2,
          name: 'Menu 2',
          link: '/'
        },{
          id: 3,
          name: 'Menu 3',
          link: '/'
        }
      ]
    }
  },

  computed: {
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
                <a :href="item.link" class="footer__link">{{ item.name }}</a>
            </li>

            <li
              v-for="(item, index) in sub_menu"
              :key="item.id"
              class="footer__item"
            >
                <a :href="item.link" class="footer__link">{{ item.name }}</a>
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

          <a href="terms" itemprop="url" class="footer__down-link">
            {{ $t('text.Terms_Conditions') }}
          </a>

          <a href="privacy" itemprop="url" class="footer__down-link">
            {{ $t('text.Privacy_Policy') }}
          </a>
      </div>

    </div>

  </footer>
</template>