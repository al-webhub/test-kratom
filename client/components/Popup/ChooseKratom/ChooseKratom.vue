<script>
import { useProductStore } from '~/store/product';

export default {
  setup() {
    const productStore = useProductStore()
    const { t } = useI18n({useScope: 'local'}) 

    return {
      productStore,
      t
    }
  },

  data() {
    return {}
  },

  computed: {
    products() {
      return this.productStore.all.slice(0,4)
    },

    isActive() {
      return this.productStore.chooseKratomIsShow
    },
  },

  methods: {
    closeHandler() {
      return this.productStore.toggleModal('chooseKratom')
    },
  }
}
</script>

<style src="./choose-kratom.scss" lang="sass" scoped />

<template>
  <popup-layout-simple :is-active="isActive" size="medium" @close="closeHandler">
    <template v-slot:title>
      {{ t('kratom_for_you') }}
    </template>

    <template v-slot:content>

      <div v-if="products" class="grid">
        <product-card
          v-for="product in products"
          :key="product.id"
          :product="product"
        ></product-card>
      </div>

    </template>

    <template v-slot:footer>
    </template>

  </popup-layout-simple>
</template>
<i18n>
  {
    "en": {
      "kratom_for_you": "Kratom for you",
    },
    "ru": {
      "kratom_for_you": "Кратом для вас",
    }
  }
</i18n>