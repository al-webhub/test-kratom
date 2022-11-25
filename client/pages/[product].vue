<script>

export default {
  data() {
    return {
      product: {
        id: 1,
        name: '123123',
        image: null,
        images: [],
        link: '/porduct',
        excerpt: '3123123123',
        stimulation: 3,
        relaxation: 4,
        euphoria: 5,
        modifications: [
          {
            id: 1,
            name: '50',
            price: 10,
            amount: 1,
          },{
            id: 2,
            name: '100',
            price: 15,
            amount: 1,
          },{
            id: 3,
            name: '150',
            price: 20,
            amount: 1,
          }
        ]
      },
      selectedModification: {},
      recently_viewed: [
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
      popular_products: [
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
      reviews: [],
      currentTab: 'description',
      user: null,
      //storage: JSON.parse(localStorage.getItem('kratom')),
      storage: {}
    }
  },

  methods: {
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
    }
  },

  watch: {
    'selectedModification.amount': {
      handler: function(value) {
        this.selectedModification.amount = parseInt(value);
      },
      deep: true
    },
  },

  computed: {

		saleWeights: function(){
			let saleModifications = this.product.modifications.slice(1, this.product.modifications.length + 1);
			
			return saleModifications.reduce(function(previous, current){
				let weight = current.weight || +current.name
				return (previous !== null? previous + '/': '') + weight;
			}, null) + 'g';
		},

		currentDiscount: function(){
			let baseModification = this.product.modifications[0];
			let selectedModificationWeight = this.selectedModification.weight || +this.selectedModification.name
			let baseModificationWeight = baseModification.weight || +baseModification.name
			
			let basePrice = baseModification.price * selectedModificationWeight / baseModificationWeight;
			
      //console.log('basePrice', Math.round(100 - this.selectedModification.price * 100 / basePrice) );

	 		return Math.round(100 - this.selectedModification.price * 100 / basePrice);
		},

		discounts: function(){
			let saleModifications = this.product.modifications.slice(1, this.product.modifications.length + 1);
			
			//console.log(modifications, this.product.modifications);
			
			let baseModification = this.product.modifications[0];
			let baseModificationWeight = baseModification.weight || +baseModification.name
			let values = [];
			
			saleModifications.forEach(function(item){
				let itemWeight = item.weight || +item.name
				let basePrice = baseModification.price * itemWeight / baseModificationWeight;
	 			values.push(Math.round(100 - item.price * 100 / basePrice));
			});
			
			return values;
		},

		discountsString: function(){
			return this.discounts.reduce(function(previous, current){
				return (previous !== null? previous + '/': '') + current;
			}, null) + '%';
		}
  },

  created: function() {

    this.selectedModification = Object.assign({}, this.product.modifications[0]);

  }
}
</script>

<style src="assets/scss/pages/product.scss" lang="sass" scoped />

<template>
  <section class="product-page">
      <div class="product-page__wrapper container">

          <h1 class="main-caption main-caption-align">{{ product.name }}</h1>

          <div class="product-page__header">

              <!-- update -->
              <div class="product-page__img slider">
                  <ul class="product-page__img-list">
                      <li class="product-page__img-item js-slider-item show">
                          <img 
                            :src="product.image"
                            :title="product.name"
                            :alt="product.name"
                          />
                      </li>
                      <li 
                        v-for="(image, index) in product.images"
                        :key="index"
                        class="product-page__img-item js-slider-item"
                      >
                        <img
                          :src="image"
                          :title="product.name"
                          :alt="product.name"
                        />
                      </li>
                  </ul>
                  
                  <div
                    v-if="Object.keys(product.images).length"
                    class="product-page__img-arrows js-arrows"
                  >
                      <button class="slider-button prev">
                          <span class="icon-arrow-left"></span>
                      </button>
                      <button class="slider-button next">
                          <span class="icon-arrow-right"></span>
                      </button>
                  </div>

                  <div v-if="Object.keys(product.images).length" class="dots__list">
                      <div class="dots__item active js-dot"></div>
                      <div
                        v-for="index in Object.keys(product.images).length"
                        :key="index"
                        class="dots__item js-dot"
                      >
                      </div>
                  </div>
              </div>
              <!-- /update -->


              <div class="product-page__info">
                  <div class="product-page__info-header">
                      <div class="product-page__info-choose">
                          
                        <ul class="product__weight-list">
                          <li
                            v-for="(modification, key) in product.modifications"
                            :key="modification.id"
                            @click="changeModification(modification)"
                            :class="{active: modification.id === selectedModification.id}"
                            class="product__weight-item"
                          >
                            {{ modification.name }}
                          </li>
                        </ul>

                        <div class="product-page__price-wrapper">
                          <div class="wrapper">
                              <p class="product-page__price">USD <span>@{{ selectedModification.price * selectedModification.amount }}</span></p>
                              <div class="product__calc">
                                  <button class="calc_button" @click="(selectedModification.amount > 1)? selectedModification.amount-- : false">
                                      <span class="text">-</span>
                                  </button>
                                  <input type="text" class="calc-input" v-model="selectedModification.amount">
                                  <button class="calc_button" @click="selectedModification.amount++">
                                      <span class="text">+</span>
                                  </button>
                              </div>
                          </div>

                          <div v-if="product.modifications[1]" class="product-page__info-sale product-page__info-sale-mobile">
                              <p class="current-dis">
                                {{ $t('text.current_DISCOUNT') }}: 
                                <span>{{ currentDiscount }}%</span>
                              </p>
                              <p class="sale">
                                {{ $t('text.save') }} {{ discounts.slice(-1)[0] }}%
                              </p>
                              <p class="offer">
                                {{ $t('text.Order') }} {{ saleWeights }} 
                                <br>
                                {{ $t('text.and') }} 
                                <span>{{ $t('text.get_a_discount') }}</span> 
                                {{ discountsString }}
                              </p>
                          </div>

                          <button @click="addToCart(product.id, selectedModification)" class="main-button-color">
                              <span class="text">{{ $t('text.add_to_cart') }}</span>
                          </button>

                        </div>
                      </div>
                      
                      <div v-if="product.modifications[1]" class="product-page__info-sale">
                          <p class="current-dis">{{ $t('text.current_DISCOUNT') }}: <span>{{ currentDiscount }}%</span></p>
                          <p class="sale">{{ $t('text.save') }} {{ discounts.slice(-1)[0] }}%</p>
                          <p class="offer">
                            {{ $t('text.Order') }} {{ saleWeights }} 
                            <br>
                            {{ $t('text.and') }} 
                            <span>{{ $t('text.get_a_discount') }}</span> 
                            {{ discountsString }}
                          </p>
                      </div>

                  </div>
                  
                  <div class="product-page__info-footer">
                      <div 
                        v-if="product.stimulation != null && product.relaxation != null && product.euphoria != null" 
                        class="choose-kratom__filter"
                      >
                          <div class="choose-kratom__filter__item">
                              
                            <p class="caption">{{ $t('text.stimulation') }}</p>

                              <div class="choose-kratom__filter__select">
                                  
                                  <button
                                    class="choose-kratom__filter__button"
                                    @click="changeAttr('stimulation', -1)"
                                    :class="{disabled: storage && storage[product.id] && storage[product.id]['stimulation'] == -1 || product.stimulation == '0%'}"
                                  >
                                    <span class="icon-minus"></span>
                                  </button>
                                  
                                  <div class="choose-kratom__point" 
                                    v-for="point in 5"
                                    :key="point"
                                    :class="{
                                      active: product.stimulation > (point * 20 - 10), 
                                      'active-half': (product.stimulation <= (point * 20 - 10) && product.stimulation > (point * 20 - 20))
                                    }"
                                  >
                                    <span class="point-decor__wrapper">
                                      <span class="point-decor__inner"></span>
                                    </span>
                                  </div>
                                  
                                  <button
                                    @click="changeAttr('stimulation', 1)"
                                    :class="{disabled: storage && storage[product.id] && storage[product.id]['stimulation'] == 1 || product.stimulation == '100%'}"
                                    class="choose-kratom__filter__button"
                                  >
                                    <span class="icon-plus"></span>
                                  </button>
                              </div>
                          </div>
                          
                          <div class="choose-kratom__filter__item">
                              
                              <p class="caption">{{ $t('text.relaxation') }}</p>
                              
                              <div class="choose-kratom__filter__select">
                                  
                                  <button
                                    class="choose-kratom__filter__button"
                                    @click="changeAttr('relaxation', -1)"
                                    :class="{disabled: storage && storage[product.id] && storage[product.id]['relaxation'] == -1 || product.relaxation == '0%'}"
                                  >
                                    <span class="icon-minus"></span>
                                  </button>
                                  
                                  <div class="choose-kratom__point" 
                                    v-for="point in 5"
                                    :key="point"
                                    :class="{
                                      active: product.relaxation > (point * 20 - 10), 
                                    'active-half': (product.relaxation <= (point * 20 - 10) && product.relaxation > (point * 20 - 20))
                                    }"
                                  >
                                    <span class="point-decor__wrapper">
                                      <span class="point-decor__inner"></span>
                                    </span>
                                  </div>
                                  
                                  <button
                                    class="choose-kratom__filter__button"
                                    @click="changeAttr('relaxation', 1)"
                                    :class="{disabled: storage && storage[product.id] && storage[product.id]['relaxation'] == 1 || product.relaxation == '100%'}"
                                  >
                                      <span class="icon-plus"></span>
                                  </button>
                              </div>
                          </div>

                          <div class="choose-kratom__filter__item">
                              <p class="caption">{{ $t('text.euphoria') }}</p>
                              
                              <div class="choose-kratom__filter__select">
                                  <button
                                    class="choose-kratom__filter__button"
                                    @click="changeAttr('euphoria', -1)"
                                    :class="{disabled: storage && storage[product.id] && storage[product.id]['euphoria'] == -1 || product.euphoria == '0%'}"
                                  >
                                    <span class="icon-minus"></span>
                                  </button>
                                  
                                  <div class="choose-kratom__point" 
                                    v-for="point in 5"
                                    :key="point"
                                    :class="{
                                      active: product.euphoria > (point * 20 - 10), 
                                      'active-half': (product.euphoria <= (point * 20 - 10) && product.euphoria > (point * 20 - 20))
                                    }"
                                  >
                                    <span class="point-decor__wrapper">
                                      <span class="point-decor__inner"></span>
                                    </span>
                                  </div>
                                  
                                  <button
                                    class="choose-kratom__filter__button"
                                    @click="changeAttr('euphoria', 1)"
                                    :class="{disabled: storage && storage[product.id] && storage[product.id]['euphoria'] == 1 || product.euphoria == '100%'}"
                                  >
                                    <span class="icon-plus"></span>
                                  </button>
                              </div>
                          </div>
                      </div>
                      
                      <div
                        class="product-page__info-text"
                        v-if="product.stimulation != null && product.relaxation != null && product.euphoria != null"
                      >
                        <p>{{ $t('text.Users_take') }}</p>
                        <p>{{ $t('text.As_soon_as') }}</p>
                      </div>

                      <button class="general-more js-button" data-target="delivery">
                        <span class="text">{{ $t('text.pay_delivery') }}</span>
                        <span class="icon-arrow-right"></span>
                      </button>
                  </div>
              </div>
          </div>

          <div class="product-page__body">
              
            <ul class="general-tabs__list">
                  <li class="general-tabs__item js-product-tab active" data-target="description">{{ $t('text.description') }}</li>
                  <li class="general-tabs__item js-product-tab" data-target="reviews">{{ $t('text.reviews') }}</li>
              </ul>

              <div class="product-page__description js-product-item" data-target="description">
                  <p class="product-page__caption">{{ $t('text.description') }}</p>
                  <div v-html="product.description"></div>
              </div>
              
              
              <!-- REVIEWS -->
              <!-- <reviews :data-reviews="reviews" :data-user="user" :data-product-id="product.id"></reviews> -->
              <!-- REVIEWS -->
              
          </div>
      </div>
  </section>

  <section class="container">
    <div class="product__wrapper_header">
      <p class="main-caption">{{ $t('text.related_products') }}</p>
      <a href="shop" class="general-more">
        <span class="text">{{ $t('text.shop') }}</span>
        <span class="icon-arrow-right"></span>
      </a>
    </div>
    <div class="grid">
      <product-card 
        v-for="(product, key) in popular_products"
        :key="product.id"
        :product="product"
      ></product-card>
    </div>
  </section>

  <!-- <section class="product slider-infinity">
    <div class="product__wrapper container">
      
      <div class="product__wrapper_header">
          <p class="main-caption">{{ $t('text.related_products') }}</p>
          <a href="shop" class="general-more">
              <span class="text">{{ $t('text.shop') }}</span>
              <span class="icon-arrow-right"></span>
          </a>
      </div>

      <ul class="product__list product-slider__list js-infinity-slider-list">
          <li
            v-for="(product, key) in popular_products"
            :key="product.id"
            :data-index="key + 1"
            class="product__item product-slider__item show js-slider-item-infinity"
          >
            <product-card :product="product"></product-card>
          </li>
      </ul>
    </div>
  </section> -->

  <aside></aside>

</template>