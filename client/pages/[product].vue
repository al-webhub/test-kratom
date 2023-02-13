<script setup>
  import { useProductStore } from '~/store/product';
  import { useReviewStore } from '~/store/review';

  const { t } = useI18n({useScope: 'local'})

  // DATA
  const activeTab = ref('description')
  const selectedModification = ref({})

  // COMPUTED
  const slug = computed(() => {
    return useRoute().params.product
  })

  const product = computed(() => {
    return useProductStore().product
  })

  const reviewsMeta = computed(() => {
    return useReviewStore().meta;
  })

  const popularProducts = computed(() => {
    return useProductStore().all;
  })

  const rating = computed(() => {
    return product.value?.reviews_rating_detailes?.rating
  })

  const ratingAmount = computed(() => {
    return product.value?.reviews_rating_detailes?.rating_count
  })

  const reviewsAmount = computed(() => {
    return product.value?.reviews_rating_detailes?.reviews_count
  })

  const reviews = computed(() => {
    return useReviewStore().all
  })

  const features = computed(() => {
    if(!product.value.categories)
      return null;
    
    let features = product.value.categories.map((item) => {
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
  })

  const tabs = computed(() => {
    let tabs = {}

    if(product.value.content)
      tabs.description = t('label.description')
    
    tabs.reviews = t('label.reviews') + ` (${reviewsMeta.value?.total || 0})`

    if(features.value && features.value.length)
      tabs.features = t('label.features')

    tabs = {
      ...tabs,
      delivery: t('label.delivery'),
      payment: t('label.payment'),
    }

    return tabs
  })

  const reviewQuery = computed(() => {
    const type = String.raw`Backpack\Store\app\Models\Product`;

    return {
      per_page: 6,
      reviewable_slug: slug.value,
      reviewable_type: type
    }
  })

  // WATCHERS
  watch(
    () => selectedModification.amount,
    (value) => {
      selectedModification.value.amount = parseInt(value);
    }
  )

  watch(
    product, 
    (value) => {
      if(value) {
        selectedModification.value = Object.assign({}, value.modifications[0])
      }
    }, 
    { immediate: true}
  )

  // METHODS
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

  const setCrumbs = (product) => {
    const breadcrumbs = [
      {
        name: t('crumbs.home'),
        item: useToLocalePath()('/')
      },{
        name: t('crumbs.shop'),
        item: useToLocalePath()('/shop')
      }
      ,{
        name: product.value?.name,
        item: useToLocalePath()(`/shop/${product.value?.slug}`)
      }
    ]

    useCrumbs().setCrumbs(breadcrumbs)

    useSchemaOrg([
      defineBreadcrumb({
        itemListElement: breadcrumbs
      }),
    ])
  }

  const setScheema = (product, reviews) => {
    const scheema = {
      name: product.value.name,
      image: `${useRuntimeConfig().public.base}/${product.value.images[0]?.src}`,
      description: product.value.content,
      sku: product.value.code,
      brand: 'Kratomhelper',
      seller: 'Kratomhelper.com',
      offers: [
        { price: product.value.price },
      ],
      aggregateRating: {
        ratingValue: rating.value,
        bestRating: 5,
        ratingCount: ratingAmount.value,
      },
      review: getReviewsScheema(reviews.value),
    }

    useSchemaOrg([
      defineProduct(scheema),
    ])
  }

  const getReviewsScheema = (reviews) => {
    return reviews.map((item) => {
      return {
        comment: item.text,
        author: {
          name: item.owner?.fullname,
        },
        reviewRating: {
          ratingValue: item.rating,
        },
      }
    })
  }

  const getReviews = async (reviewQuery, refresh) => {
    await useAsyncData('reviews', () => useReviewStore().getAll(reviewQuery, refresh))
  }

  // HANDLERS
  const loadmoreReviewsHandler = async () => {
    const query = {
      ...reviewQuery.value,
      page: reviewsMeta.value.current_page + 1
    }
    await getReviews(query, false)
  }

  const changeTabHandler = (tab) => {
    activeTab.value = tab
  }

  // HOOKES
  await Promise.all([
    await useAsyncData('product', () => useProductStore().getOne(slug.value)).then(({data: product, error}) => {
      if(product.value) {
        selectedModification.value = product.value.modifications[0]
        setCrumbs(product)
        setSeo()
      }

      if(error.value){
        throw createError({ statusCode: 404, statusMessage: 'Page Not Found' })
      }

      return product
    }),
    await useAsyncData('reviews', () => useReviewStore().getAll(reviewQuery.value, true)).then(({data: reviews, error}) => {
      return reviews
    })
  ]).then(([ product, reviews]) => {
    setScheema(product, reviews)
  })


  await useAsyncData('products', () => useProductStore().getAll({per_page: 4}))
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
                :product="product"
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