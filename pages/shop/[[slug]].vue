<script>
import { useProductStore } from '~/store/product';

export default {
  setup() {
    const route = useRoute()
    const productStore = useProductStore()

    // COMPUTED
    const categorySlug = computed(() => {
      return route?.params?.slug || null
    })

    const query = computed(() => {
      const query = {
        per_page: 12,
      }

      if(categorySlug.value)
        query.category_slug = categorySlug.value
      else
        query.category_slug = 'kratom'

      return query
    })


    const {pending} = useLazyAsyncData('products', () => productStore.getAll(query.value))

    return {
      productStore,
      categorySlug,
      query,
      pending
    }
  },

  data() {
    return {}
  },

  computed: {
    products() {
      return this.productStore?.all;
    },

    meta() {
      return this.productStore?.meta;
    },
  },

  methods: {

    async loadmoreHandler() {
      const query = {
        ...this.query,
        page: this.meta.current_page + 1
      }

      await this.productStore?.getAll(query, false)
    }
  },
}
</script>

<style src="assets/scss/pages/shop-slug.scss" lang="sass" scoped />

<template>
  <div class="products-wrapper">
    <transition name="fade-in">
      <ul v-if="products && products.length" :class="{pending: pending}" class="products-list">
        <li 
          v-for="product in products"
          :key="product.id"
          class="products-item" 
        >
          <product-card :product="product" :key="product.id"></product-card>
        </li>
      </ul>
      <p v-else>{{ $t('messages.products_no_found') }}</p>
    </transition>

    <div class="loadmore">
      <button v-if="meta && meta.current_page !== meta.last_page" @click="loadmoreHandler" clickable class="main-button">
        <span class="text">{{ $t('button.show_more') }}</span>
      </button>
    </div>
    
  </div>
</template>