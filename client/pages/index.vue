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
          stimulation: null,
          relaxation: null,
          euphoria: null,
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
          stimulation: null,
          relaxation: null,
          euphoria: null,
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
      ]
    }
  },
  methods: {
  }
}
</script>

<style src="assets/scss/pages/home.scss" lang="sass" scoped />

<template>
  <section-products-slider :products="products"></section-products-slider>
  <section-about-us></section-about-us>
  <section-our-advantages></section-our-advantages>
</template>