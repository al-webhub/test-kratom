<script>
import { useCartStore } from '~/store/cart';

export default {
  setup() {
    const cartStore = useCartStore()

    return {
      cartStore,
    }
  },

  data() {
    return {
      menu: [
        {
          id: 1,
          link: '/',
          name: 'Kratom'
        },{
          id: 2,
          link: '/',
          name: 'Kratom'
        },{
          id: 3,
          link: '/',
          name: 'Kratom'
        }
      ],
      search_list: [
        {
          name: 'Kratom 1',
          link: '/'
        },{
          name: 'Kratom 2',
          link: '/'
        }
      ],
      search_filter: null,
      user: null,
      isSearchActive: false,
      isLanguagesActive: false
    }
  },

  methods: {
    openSearchHandler() {
      this.isSearchActive = true
    },

    toggleLanguagesHandler() {
      this.isLanguagesActive = !this.isLanguagesActive
    },

    languageSelectHandler() {
      this.isLanguagesActive = false
    },

    openCartHandler() {
      this.cartStore.open()
    }
  }
}
</script>

<style src="./header.scss" lang="sass" scoped />

<template>
  <header class="header">
    
    <a href="/" class="logo">
      <img src="~assets/images/logo.png" alt="Kratom">
    </a>

    <nav class="nav">
        <span class="general-decor-elem"></span>

        <ul class="list">
            <li
              v-for="(item, index) in menu"
              :key="item.id"
              class="item">
                <a
                  :href="item.link"
                  :class="{active: false}"
                  class="link"
                >
                  {{ item.name }}
                </a>
            </li>
            
          
            <!-- <li class="header__item header__item__drop js-drop-item">
                <div class="wrapper js-drop-button">
                    <a class="text">{{ $t('text.menu') }}</a>
                    <span class="icon-drop"></span>
                </div>
                <ul class="header__drop-list">
                    @foreach($sub_menu as $item)
                    <li class="header__drop-item">
                        <a href="{{ url_locale($item->link) }}" class="header__drop-link @if(Request::url() == url($item->link)) active @endif">{{ $item->name }}</a>
                    </li>
                    @endforeach
                </ul>
            </li>           -->
            
        </ul>
        <button class="header__close-nav">
            <span class="icon-close"></span>
        </button>
    </nav>

    <div class="btns-set">
        <div :class="{active: isSearchActive}" class="search">
            
            <div class="search__form">
                
                <input 
                  :placeholder="$t('text.search')"
                  v-model="search_filter"
                  @blur="search_filter = null"
                  type="text"
                  class="search__input" 
                  autocomplete="off"
                />

                <button class="search__button">
                  <img src="~assets/svg-icons/search.svg" class="icon"  />
                </button>

            </div>

            <div :class="{active: search_list.length && isSearchActive}" class="livesearch">
              <ul class="livesearch__list">
                <li v-for="(item, index) in search_list" :key="index" class="livesearch__item">
                  <a
                    :href="item.link"
                    :title="item.name"
                    class="livesearch__link"
                  >
                    {{ item.name }}
                  </a>
                </li>
              </ul>
            </div>

            <button @click="openSearchHandler" class="header__search__button">
              <img src="~assets/svg-icons/search.svg" class="icon"  />
            </button>

        </div>

        <div class="header__nav-lang__item">
	        <div :class="{active: isLanguagesActive}" class="lang-popup">
            <modal-lang-switcher @select="languageSelectHandler"></modal-lang-switcher>
          </div>
	        
	        <button class="js-button js-drop-button" @click="toggleLanguagesHandler">
            <img src="~assets/svg-icons/globe.svg" class="icon" />
          </button>
        </div>

        <div class="header__nav-profile__item">
            
            <button v-if="!user" class="js-button" data-target="registration-social">
                <!-- <span class="icon-profile"></span> -->
              <img src="~assets/svg-icons/user.svg" class="icon" />
            </button>

            <a v-else href="account/order-history">
              <div 
                v-if="user.usermeta && user.usermeta.photo"
                :style="{backgroundImage: 'url(' + user.usermeta.photo + ')'}"
                class="img"
              >
              </div>
            
              <div
                v-else  
                :style="{backgroundImage: 'url(' + '~assets/img/photo-log-in.png' + ')' }"
                class="img" 
              >
              </div>
            </a>
        </div>
        
        <div class="header__nav-profile__item header__nav-profile__item-cart">
            <button class="js-button" @click="openCartHandler">
                <img src="~assets/svg-icons/cart.svg" class="icon"  />
            </button>
            <span class="decor-cart" v-if="cartLength"></span>
        </div>

        <div class="header__nav-profile__item header__nav-profile__item-burger">
          <button class="header__burger">
            <span class="decor"></span>
          </button>
        </div>
    </div>
  </header>
</template>