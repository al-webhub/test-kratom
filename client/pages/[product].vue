<script>

import { useProductStore } from '~/store/product';
import { useReviewStore } from '~/store/review';

export default {
  setup() {
    const productStore = useProductStore()
    const reviewStore = useReviewStore()

    productStore.$reset()
    reviewStore.$reset()

    return {
      productStore,
      reviewStore
    }
  },
  
  data() {
    return {
      selectedModification: {},
      activeTab: 'description',
      user: {
        photo: '/images/ava1.jpg',
      },
    }
  },

  methods: {
    async getProducts() {
      await this.productStore?.getAll({per_page: 4})
    },

    async getProduct() {
      return await this.productStore?.getOne(this.slug)
    },

    async getReviews() {
      const type = String.raw`Backpack\Store\app\Models\Product`;
      const slug = this.slug

      return await this.reviewStore.getAll({
        per_page: 3,
        reviewable_slug: slug,
        reviewable_type: type
      })
    },

    changeAttr: function(attrName, value) {
      let attr = this.product[attrName];
      let component = this;

      if(!this.storage)
        this.storage = {};

      if(!this.storage[this.product.id])
        this.storage[this.product.id] = {};

      this.storage[this.product.id][attrName] = this.storage[this.product.id][attrName]? this.storage[this.product.id][attrName] + value : value;
      attr = parseInt(attr) + value;

      axios.post('/attribute/update', {id: component.product.id, attr: attrName, value: attr}).then(function(response) {
        attr = attr + '%';
        component.product[attrName] = attr;
        noty('success', 'Thank you, your vote has been counted!');
        localStorage.kratom = JSON.stringify(component.storage);
      });
    },

    changeModification: function(modification) {
      let amount = this.selectedModification.amount;
      this.selectedModification = Object.assign({}, modification);
      this.selectedModification.amount = amount;
    },

  },

  watch: {
    'selectedModification.amount': {
      handler: function(value) {
        this.selectedModification.amount = parseInt(value);
      },
      deep: true
    },
    product: {
      handler(value) {
        if(value) {
          this.selectedModification = Object.assign({}, value.modifications[0])
        }
      },
      immediate: true
    }
  },

  computed: {
    slug() {
      return this.$route.params.product
    },

    popularProducts() {
      return this.productStore?.all;
    },

    product() {
      return this.productStore?.product;
    },

    reviews() {
      return this.reviewStore?.all;
    },

    tabs() { 
      return {
        description: this.$t('text.description'),
        reviews: this.$t('text.reviews')
      }
    }
  },

  async created() {
    await useAsyncData('product', () => this.getProduct())
    await useAsyncData('product_reviews', () => this.getReviews())
    await useAsyncData('products', () => this.getProducts())
  }
}
</script>

<style src="assets/scss/pages/product.scss" lang="sass" scoped />

<template>
<div>
  <section class="wrapper" v-if="product">
    <div class="container">

      <h1 class="main-caption main-caption-align">{{ product.name }}</h1>

      <div class="header">
          <!-- IMAGE SLIDER -->
          <product-slider :images="product.images"></product-slider>

          <div class="meta">
            <!-- HEADER -->
            <div class="cart">
              
              <!-- ADD TO CART -->
              <product-cart
                :product="product"
                v-model:selected-modification="selectedModification"
              >
              </product-cart>

            </div>
            
            <!-- FOOTER -->
            <div class="qualities">
              <product-qualities
                v-model:stimulation="product.stimulation"
                v-model:relaxation="product.relaxation"
                v-model:euphoria="product.euphoria"
              >
              </product-qualities>
            </div> 
          </div>
      </div>

      <!-- CONTENT -->
      <div class="body">
          <simple-tabs v-model:activeTab="activeTab" :values="tabs" class="tabs"></simple-tabs>

          <!-- DESCRIPTION -->
          <div v-if="(activeTab === 'description' || $device.isDesktop)" class="description">
            <p class="product-page__caption">{{ $t('text.description') }}</p>
            <div v-html="product.content"></div>
          </div>
          
          <!-- REVIEWS -->
          <div v-if="(activeTab === 'reviews' || $device.isDesktop)" class="reviews">
            <p class="product-page__caption">{{ $t('text.reviews') }}</p>
            <product-review-block v-if="reviews && reviews.length" :reviews="reviews"></product-review-block>
          </div>
      </div>

    </div>
  </section>

  <product-grid
    v-if="popularProducts && popularProducts.length"
    :products="popularProducts"
    :title="$t('text.related_products')"
    class="section"
  >
  </product-grid>
  <!-- <product-grid :products="recently_viewed" :title="$t('text.recently_viewed')" class="section"></product-grid> -->

</div>
</template>