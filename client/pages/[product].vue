<script>

import { useProductStore } from '~/store/product';
import { useReviewStore } from '~/store/review';
import { useOrderStore } from '~/store/order';

export default {
  async setup() {
    const { t, locale } = useI18n({useScope: 'local'})
    const productStore = useProductStore()
    const reviewStore = useReviewStore()
    const orderStore = useOrderStore()

    const route = useRoute()

    const slug = computed(() => {
      return route.params.product
    })

    const product = computed(() => {
      return productStore.product
    })

    const reviewQuery = computed(() => {
      const type = String.raw`Backpack\Store\app\Models\Product`;

      return {
        per_page: 6,
        reviewable_slug: slug.value,
        reviewable_type: type
      }
    })

    const reviewsMeta = computed(() => {
      return reviewStore?.meta;
    })


    const setSeo = () => {
      useHead({
        title: product.value && (product.value.seo.meta_title || product.value.seo.h1 || product.value.name),
        meta: [
          {
            name: 'description',
            content: product.value && product.value.seo.meta_description
          },
        ],
      })
    }

    const loadmoreReviewsHandler = async () => {
      const query = {
        ...reviewQuery.value,
        page: reviewsMeta.value.current_page + 1
      }
      await getReviews(query, false)
    }

    const getReviews = async (reviewQuery, refresh) => {
      await useAsyncData('reviews', () => reviewStore.getAll(reviewQuery, refresh))
    }

    await useAsyncData('product', () => productStore.getOne(route.params.product)).then((res) => {
      if(res.error._value){
        throw createError({ statusCode: 404, statusMessage: 'Page Not Found' })
      }

      setSeo()
    })
    await useAsyncData('products', () => productStore.getAll({per_page: 4}))
    await getReviews(reviewQuery.value, true)
    
    return {
      orderStore,
      productStore,
      reviewStore,
      reviewsMeta,
      product,
      loadmoreReviewsHandler,
      t
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

  computed: {
    features() {
      if(!this.product.categories)
        return null;
      
      let features = this.product.categories.map((item) => {
        const params = item?.extras?.params
        const nameParam = params && params.find((item) => item.key == 'name')
        
        if(nameParam && nameParam !== -1)
          return {
            name: nameParam.value,
            value: item.name,
            slug: item.slug
          }
      })
      
      features = features.filter(item => item !== undefined)
      
      return features
    },

    popularProducts() {
      return this.productStore?.all;
    },

    rating() {
      return this.product?.reviews_rating_detailes?.rating
    },

    ratingAmount() {
      return this.product?.reviews_rating_detailes?.rating_count
    },

    reviewsAmount() {
      return this.product?.reviews_rating_detailes?.reviews_count
    },

    reviews() {
      return this.reviewStore?.all;
    },

    tabs() {
      let tabs = {}

      if(this.product.content)
        tabs.description = this.$t('label.description')
      
      tabs.reviews = this.$t('label.reviews') + ` (${this.reviewsMeta?.total || 0})`

      if(this.features && this.features.length)
        tabs.features = this.$t('label.features')

      tabs = {
        ...tabs,
        delivery: this.$t('label.delivery'),
        payment: this.$t('label.payment'),
      }

      return tabs
    },

    stimulation() {
      const attr = this.product.attrs.find(item => item.slug === 'stimulation')
      return attr?.value && this.toHumanValue(attr.value) || null
    },

    relaxation() {
      const attr = this.product.attrs.find(item => item.slug === 'relaxation')
      return attr?.value && this.toHumanValue(attr.value) || null
    },

    euphoria() {
      const attr = this.product.attrs.find(item => item.slug === 'euphoria')
      return attr?.value && this.toHumanValue(attr.value) || null
    }
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

  methods: {
    toHumanValue(x) {
      return Math.floor(x / 20 * 2) / 2;
    },

    setCrumbs() {
      useCrumbs().setCrumbs([
          {
            name: this.$t('crumbs.home'),
            link: '/'
          },{
            name: this.$t('crumbs.shop'),
            link: '/shop'
          },{
            name: this.product?.name,
            link: '/' + this.product?.slug
          }
      ])
    },

    changeTabHandler(tab) {
      this.activeTab = tab
    },

    changeModification: function(modification) {
      let amount = this.selectedModification.amount;
      this.selectedModification = Object.assign({}, modification);
      this.selectedModification.amount = amount;
    },

  },

  async created() {
    this.setCrumbs()
  }
}
</script>

<style src="assets/scss/pages/product.scss" lang="sass" scoped />

<template>
<div>
  <section v-if="product" class="wrapper">
    <div class="container">

      <h1 class="main-caption main-caption-align">{{ product.name }}</h1>

      <div class="sup">
        <div v-if="product.code" class="sup-sku">
          <span class="sup-sku__label">SKU:</span>
          <span class="sup-sku__value">{{ product.code }}</span>
        </div>
        <div v-if="product.code" class="sup-delimiter"></div>
        <div v-if="rating" class="sup-rating">
          <img src="~assets/svg-icons/star.svg" class="icon"/>
          <span class="sup-rating__value">{{ rating }}</span>

          <NuxtLink v-if="ratingAmount || reviewsAmount" :to="'/'" class="sup-reviews">
            {{ $t('label.rating_reviews', {rating: ratingAmount, reviews: reviewsAmount}) }}
          </NuxtLink>
        </div>
      </div>

      <div class="header">
          <!-- IMAGE SLIDER -->
          <product-slider :images="product.images"></product-slider>

          <div class="meta">

            <div class="in-stock">{{ t('in_stock') }}</div>

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
                v-model:stimulation="stimulation"
                v-model:relaxation="relaxation"
                v-model:euphoria="euphoria"
              >
              </product-qualities>
            </div> 
          </div>
      </div>

      <simple-tabs v-model:modelValue="activeTab" :values="tabs" class="tabs large"></simple-tabs>

      <!-- CONTENT -->
      <div class="body">
        <transition name="fade-in">
          <!-- DESCRIPTION -->
          <div v-if="activeTab === 'description'" class="description">
            <product-description :product="product" :reviews="reviews" @changeTab="changeTabHandler"></product-description>
          </div>
        
          <!-- REVIEWS -->
          <div v-else-if="activeTab === 'reviews'" class="reviews">
            <product-review-block :reviews="reviews" :product="product" :meta="reviewsMeta" @loadmore="loadmoreReviewsHandler"></product-review-block>
          </div>

          <!-- FEATURES -->
          <div v-else-if="activeTab === 'features'">
            <product-features :features="features"></product-features>
          </div>
        
          <!-- DELIVERY -->
          <div v-else-if="activeTab === 'delivery'">
            <info-delivery></info-delivery>
          </div>

          <!-- PAYMENT -->
          <div v-else-if="activeTab === 'payment'">
            <info-payment></info-payment>
          </div>
        </transition>
      </div>

    </div>
  </section>

  <lazy-product-grid
    v-if="popularProducts && popularProducts.length"
    :products="popularProducts"
    :title="t('related_products')"
    class="section"
  >
  </lazy-product-grid>

</div>
</template>

<i18n>
  {
    en: {
      related_products: "Related products",
      in_stock: "In stock",
    },

    ru: {
      related_products: "Сопутствующие товары",
      in_stock: "В наличии",
    }
  }
</i18n>