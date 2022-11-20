<script>
export default {
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
      search_list: [],
      search_filter: null,
      user: null
    }
  }
}
</script>

<style src="./header.scss" lang="sass" scoped />

<template>
  <header class="header">
    <a href="/" class="header__logo">
        <img src="~assets/images/logo.png" alt="Kratom">
    </a>
    <nav class="header__nav">
        <span class="general-decor-elem"></span>
        <ul class="header__list">
            <li
              v-for="(item, index) in menu"
              :key="item.id"
              class="header__item">
                <a
                  :href="item.link"
                  :class="{active: false}"
                  class="header__link"
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
    <div class="header__nav-profile">
        <div class="header__search js-drop-item">
            
            <div class="header__search-form">
                
                <input 
                  :placeholder="$t('text.search')"
                  v-model="search_filter"
                  @blur="search_filter = null"
                  type="text"
                  class="header__search__input" 
                  autocomplete="off"
                />

                <button class="header__search__button">
                    <span class="icon-search"></span>
                </button>

            </div>

            <div class="header__livesearch" :class="{active: search_list.length}">
                <ul class="header__livesearch-list">
                    <li class="header__livesearch-item" v-for="(item, index) in search_list" :key="index">
                        <a
                          :href="item.link"
                          :title="item.name"
                          class="header__livesearch-link"
                        >
                          {{ item.name }}
                        </a>
                    </li>
                </ul>
            </div>

            <button class="header__search__button js-drop-button">
                <span class="icon-search"></span>
            </button>

        </div>
        <div class="header__nav-lang__item js-drop-item">
	        <div class="footer__lang_popup">
	           <!-- @include('includes.languages') -->
            </div>
	        
	        <button class="js-button js-drop-button">
                <span class="icon-globe"></span>
            </button>
        </div>
        <div class="header__nav-profile__item">
            
            <button v-if="!user" class="js-button" data-target="registration-social">
                <span class="icon-profile"></span>
            </button>

            <a v-else href="{{ url_locale('account/order-history')}}">
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
            <button class="js-button" data-target="noty-cart">
                <span class="icon-cart"></span>
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