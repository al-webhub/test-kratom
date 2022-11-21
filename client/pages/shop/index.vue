<script>
export default {
  data() {
    return {
      products: [
        {
          id: 1,
          name: '123123',
          image: null,
          link: '/porduct',
          excerpt: '3123123123',
          stimulation: 3,
          relaxation: 4,
          euphoria: 5,
          modifications: [
            {
              id: 1,
              name: '50',
              price: 10
            },{
              id: 2,
              name: '100',
              price: 15
            },{
              id: 3,
              name: '150',
              price: 20
            }
          ]
        },
        {
          id: 2,
          name: '123123',
          image: null,
          link: '/porduct',
          excerpt: '3123123123',
          stimulation: 2,
          relaxation: 3,
          euphoria: 2,
          modifications: [
            {
              id: 1,
              name: '50',
              price: 10
            },{
              id: 2,
              name: '100',
              price: 15
            },{
              id: 3,
              name: '150',
              price: 20
            }
          ]
        }
      ],
      categories: [
        {
          id: 1,
          name: 'Kratom',
          description: `The history of the occurrence and usage of the kratom

Kratom was first time mentioned in Thailand. The tradition of its usage originated from that exotic country. But later it spread over many countries. It is believed to empower human strength and increase endurance that was so crucial for hard workers in fields. So, it was mainly used to support a man while his hard physical labor. In this regard, men consumed much more kratom than women. This was how the whole story began.`
        },{
          id: 2,
          name: 'Other products',
          description: null
        }
      ],
      query: {
        category: 1
      },
      pageH1: 'Kratom'
    }
  },

  methods: {
    loadmore() {

    }
  }
}
</script>

<style src="assets/scss/pages/shop.scss" lang="sass" scoped />

<template>
  <section class="shop-page">
        <div class="shop-page__wrapper container">
            <div class="general-decor-figure"></div>
            
            <h1 class="main-caption main-caption-align">{{ pageH1 }}</h1>

            <ul class="general-tabs__list">
                <li 
                  v-for="(category, index) in categories"
                  :key="category.id"
                  @click="query.category = category.id"
                  :class="{active: query.category == category.id}" 
                  class="general-tabs__item" 
                >
                  {{ category.name }}
                </li>
            </ul>

            <div class="product__position">
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

            <button class="main-button" @click="loadmore()" v-if="products.current_page != products.last_page">
                <span class="text">{{ $t('text.show_more') }}</span>
            </button>
        </div>
    </section>
    
    
    <section v-if="categories[query.category].description" class="seo-block seo-block-main">
	    <div class="seo-block__wrapper container">
<!--             <div class="main-caption">Kratom tea for sale</div> -->
        <div class="seo-block__container" v-html="categories[query.category].description"></div>
		  </div>
    </section>

    <section-write-us></section-write-us>

</template>