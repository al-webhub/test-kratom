<script>
import { useProductStore } from '~/store/product';
import { useCategoryStore } from '~/store/category';

export default {
  setup() {

    const productStore = useProductStore()
    const categoryStore = useCategoryStore()

    return {
      productStore,
      categoryStore
    }
  },

  data() {
    return {
      tab: 0,
      pageH1: 'Kratom'
    }
  },

  computed: {
    products() {
      return this.productStore?.all;
    },

    meta() {
      console.log('META', this.productStore?.meta)
      return this.productStore?.meta;
    },

    categories() {
      return this.categoryStore?.all;
    },

    tabs() {
      return this.categories.map((item) => (item.name))
    }
  },

  methods: {
    async getProducts() {
      await this.productStore?.getAll({per_page: 8})
    },

    async getCategories() {
      await this.categoryStore?.getAll()
    },

    async loadmoreHandler() {
      await this.productStore?.getAll({per_page: 8, page: this.meta.current_page + 1})
    }
  },

  async created() {
    await useAsyncData('products', () => this.getProducts())
    await useAsyncData('categories', () => this.getCategories())
  }
}
</script>

<style src="assets/scss/pages/shop.scss" lang="sass" scoped />

<template>
<div>
  <section class="shop-page">
      <div class="shop-page__wrapper container">
          <!-- <div class="general-decor-figure"></div> -->
          
          <h1 class="main-caption main-caption-align">{{ pageH1 }}</h1>

          <simple-tabs
            v-if="categories && categories.length"
            v-model:activeTab="tab"
            :values="tabs"
          ></simple-tabs>

          <div v-if="products && products.length" class="product__position">
            <ul class="product__list">
              <li 
                v-for="product in products"
                :key="product.id"
                class="product__item" 
              >
                <product-card :product="product"></product-card>
              </li>
            </ul>
          </div>

          <button v-if="meta && meta.current_page !== meta.last_page" @click="loadmoreHandler" class="main-button">
            <span class="text">{{ $t('text.show_more') }}</span>
          </button>
      </div>
  </section>
    
    
  <section v-if="categories.length && categories[tab].content" class="seo-block seo-block-main">
    <div class="seo-block__wrapper container">
<!--             <div class="main-caption">Kratom tea for sale</div> -->
      <div class="seo-block__container" v-html="categories[tab].content"></div>
    </div>
  </section>

  <section-write-us></section-write-us>
</div>
</template>