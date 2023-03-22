<script setup>
  import { useProductStore } from '~/store/product';
  import { useModalStore } from '~/store/modal';

  const { t } = useI18n({useScope: 'local'}) 

  const products = ref([])

  const calc = computed(() => {
    return useModalStore().data('chooseKratom')
  })

  // METHODS
  const closeHandler = () => {
    useModalStore().close('chooseKratom')
  }

  // HOOKS
  useAsyncData('random', () => {return useProductStore().getSimilar(calc.value)})
    .then(({data, error}) => {
      if(data)
        products.value = data.value
    })
</script>

<style src="./choose-kratom.scss" lang="sass" scoped />

<template>
  <popup-layout-simple size="medium" @close="closeHandler">
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