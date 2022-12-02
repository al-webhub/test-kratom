<script>



export default {
  data() {
    return {
      product: {
        id: 1,
        name: 'WHITE MAENG DA KRATOM',
        image: null,
        images: [
          '/images/mgd-red-50.jpg',
          '/images/mgd-green-50.jpg'
        ],
        link: '/porduct',
        excerpt: '3123123123',
        description: `White Maeng Da Kratom has much common with Maeng Da Green, but in spite of the resemblance, it has a number of features that make it unique. This kind of kratom gives an incredible feeling of euphoria, without an obvious calming effect. To the opposite, it empowers you and courses stimulating effect. White vein maeng da contains a high rate of alkaloids, which are responsible for the feeling of euphoria. This species comes from Thailand, but the leaf processing is conducted in Borneo.`,
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
          name: 'WHITE MAENG DA KRATOM',
          image: '/images/mgd-red-50.jpg',
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
          name: 'WHITE MAENG DA KRATOM',
          image: '/images/mgd-green-50.jpg',
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
          name: 'WHITE MAENG DA KRATOM',
          image: '/images/mgd-red-50.jpg',
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
          name: 'WHITE MAENG DA KRATOM',
          image: '/images/mgd-green-50.jpg',
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
      reviews: [
        {
          id: 1,
          name: 'Vasia',
          photo: '/images/ava2.jpg',
          text: 'The best store on the Internet Thank you very much for what you are!',
          likes: 1,
          dislikes: 2,
          created_at: '18.19.2020',
          children: []
        },
        {
          id: 2,
          name: 'Vasia',
          photo: '/images/ava3.jpg',
          text: 'The best store on the Internet Thank you very much for what you are!',
          likes: 1,
          dislikes: 2,
          created_at: '18.19.2020',
          children: []
        }
      ],
      currentTab: 'description',
      user: {
        photo: '/images/ava1.jpg',
      },
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

          <!-- IMAGE SLIDER -->
          <product-slider :images="product.images"></product-slider>

          <div class="product-page__info">

              <!-- HEADER -->
              <div class="product-page__info-header">
                
                <!-- ADD TO CART -->
                <product-cart
                  :product="product"
                  v-model:selected-modification="selectedModification"
                >
                </product-cart>
                
                <!-- DISCOUNT  -->
                <product-sale
                  v-if="product.modifications[1]"
                  :product="product"
                  :selected-modification="selectedModification"
                >
                </product-sale>

              </div>
              
              <!-- FOOTER -->
              <div class="product-page__info-footer">
                
                <product-qualities
                  v-model:stimulation="product.stimulation"
                  v-model:relaxation="product.relaxation"
                  v-model:euphoria="product.euphoria"
                >
                </product-qualities>
                
                <simple-more-btn :text="$t('text.pay_delivery')"></simple-more-btn>
              </div>
              
          </div>
      </div>

      <!-- CONTENT -->
      <div class="product-page__body">
          
          <ul class="general-tabs__list">
            <li class="general-tabs__item active">{{ $t('text.description') }}</li>
            <li class="general-tabs__item">{{ $t('text.reviews') }}</li>
          </ul>

          <div class="product-page__description">
            <p class="product-page__caption">{{ $t('text.description') }}</p>
            <div v-html="product.description"></div>
          </div>
          
          
          <!-- REVIEWS -->
          <div class="product-page__reviews">
            <p class="product-page__caption">{{ $t('text.reviews') }}</p>
            <product-review-block :reviews="reviews"></product-review-block>
          </div>
          
      </div>
    </div>
  </section>

  <product-grid :products="popular_products" :title="$t('text.related_products')" class="section"></product-grid>
  <product-grid :products="recently_viewed" :title="$t('text.recently_viewed')" class="section"></product-grid>

  <aside></aside>

</template>