<script>
import { useProductStore } from '~/store/product';

export default {
  setup() {
    const { t } = useI18n({useScope: 'local'})
    const productStore = useProductStore()

    return {
      productStore,
      t
    }
  },

  data() {
    return {
      search_q: '',
      searchTimeout: null,
    }
  },

  computed: {
    searchPageLink() {
      return `/search?q=${this.search_q}`;
    },

    foundProducts() {
      return this.productStore.found
    },
  },

  watch: {
    search_q: {
      handler(v) {
        clearTimeout(this.searchTimeout)

        if(v && v.length > 2)
          this.searchTimeout = setTimeout(() => {
            this.productStore.search({q: v})
          }, 1000)
      },
      immediate: true
    }
  },

  methods: {

    toggleSearchHandler() {
      this.productStore.toggleModal()
    },
    
    goSearchPageHandler() {
      this.toggleSearchHandler()
      navigateTo(this.searchPageLink)
    }
  }
}
</script>

<style src="./livesearch.scss" lang="scss" scoped />

<template>
  <div class="search">

    <button @click="toggleSearchHandler" class="close-btn">
      <img src="~assets/svg-icons/close.svg" class="icon" />
    </button>

    <div class="search-form">
                
      <input 
        :placeholder="t('search')"
        v-model="search_q"
        @keypress.enter="goSearchPageHandler"
        type="text"
        class="search-input" 
        autocomplete="off"
      />

      <NuxtLink :to="localePath(searchPageLink)" @click="toggleSearchHandler" class="search-button">
        <img src="~assets/svg-icons/search.svg" class="icon"  />
      </NuxtLink>

    </div>

    <div :class="{active: foundProducts.length}" class="livesearch">
      <ul class="livesearch__list">
        <li v-for="(item, index) in foundProducts" :key="index" class="livesearch__item">
          <NuxtLink
            :to="localePath('/' + item.slug)"
            :title="item.name"
            @click="toggleSearchHandler"
            class="livesearch__link"
          >
            {{ item.name }}
            – 
            <span v-if="item.old_price" class="old-price">$ {{ item.old_price }}</span> 
            <span v-if="item.price" class="price">$ {{ item.price }}</span>
          </NuxtLink>
        </li>
      </ul>
    </div>
  </div>
</template>

<i18n>
  {
    "en": {
      "search" : "Search",
    },
    "ru": {
      "search" : "Поиск",
    }
  }
</i18n>