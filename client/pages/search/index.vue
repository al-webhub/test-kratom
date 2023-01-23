<script setup>
  import { useProductStore } from '~/store/product';

  const productStore = useProductStore()
  const route = useRoute()
  const nuxtApp = useNuxtApp()
  const { t } = useI18n({useScope: 'global'})
  
  useCrumbs().setCrumbs([
      {
        name: nuxtApp.$i18n.t('crumbs.home'),
        link: '/'
      },{
        name: nuxtApp.$i18n.t('crumbs.search'),
        link: '/search'
      }
  ])
  

  const h1 = computed(() => {
    return t('messages.search_results', {search: search.value})
  })

  const search = ref('')

  const products = computed(() => productStore.found)

  async function getProducts() {
    return await productStore?.search({q: search.value, per_page: 30})
  }

  //await useAsyncData('search', () => getProducts())

  onMounted(() => {
    const q = route?.query?.q

    if(q && q.length) {
      search.value = q
      getProducts()
    }
  })
</script>

<style src="assets/scss/pages/search.scss" lang="sass" scoped />

<template>
  <div>
    <div class="container">
      <h1 class="main-caption main-caption-align">{{ h1 }}</h1>

      <div class="input-wrapper">
        <img src="~assets/svg-icons/search.svg" class="icon" />
        
        <input v-model="search" @keypress.enter="getProducts" class="input"/>

        <button @click="getProducts" class="main-button main-button-small">
          <span class="text">{{ $t('button.search') }}</span>
        </button>
      </div>

      <div v-if="products && products.length" class="product__position">
        <ul class="list">
          <li 
            v-for="product in products"
            :key="product.id"
            class="item" 
          >
            <product-card :product="product"></product-card>
          </li>
        </ul>
      </div>
      <div v-else>
        {{ $t('messages.no_results', {search: search}) }}
      </div>
    </div>
  </div>
</template>