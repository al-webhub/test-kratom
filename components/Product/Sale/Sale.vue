<script>
export default {
  setup() {
    const { t } = useI18n({useScope: 'local'})
    return {t}
  },
  
  props: {
    product: {
      type: Object
    },

    selectedModification: {
      type: Object
    }
  },

  computed: {
    maxDiscount() {
      return this.discounts.slice(-1)[0].sale
    },

    weightsString() {
      return this.product.modifications.reduce((carry, item, key) => {
        const weight = item.attrs.find((item) => {
          return item.slug === 'weight'
        })

        return carry + weight.value + (key + 1 === this.product.modifications.length? 'g': '/')
      }, '')
    },

		currentDiscount: function(){
			const discount = this.discounts.find(item => item.id === this.selectedModification.id)
      return discount.sale
		},

    salesPluck() {
      return this.product.modifications.map((item) => {
        const weightAttr = item.attrs.find(item => item.slug === 'weight')

        return {
          id: item.id,
          weight: +weightAttr.value,
          price: item.price
        }
      });
    },

    base() {
      return this.salesPluck[0]
    },

		discounts: function(){
      const basePricePerGram = this.base.price / this.base.weight

			return this.salesPluck.map((item) => {
        const pricePerGram = item.price / item.weight
	 			return {
          id: item.id,
          sale: Math.floor(100 - pricePerGram * 100 / basePricePerGram)
        }
			});
		},

		discountsString: function(){
			return this.discounts.reduce(function(previous, current){
				return (previous !== null? previous + '/': '') + current.sale;
			}, null) + '%';
		}
  }
}
</script>

<style src="./sale.scss" lang="sass" scoped />

<template>
  <div class="box">
    <p class="discount">{{ t('current_DISCOUNT') }}: <span>{{ currentDiscount }}%</span></p>
    <p class="sale">{{ t('save') }} {{ maxDiscount }}%</p>
    <p class="offer" v-html="t('sale_string', {weights: weightsString, discounts: discountsString})"></p>
  </div>
</template>
<i18n>
  {
    en: {
      "current_DISCOUNT" : "current DISCOUNT",
      "save": "Save",
      "sale_string": "Order {weights}<br> and <b>GET A DISCOUNT</b><br> {discounts}",
    },

    ru: {
      "current_DISCOUNT" : "Текущая скидка",
      "save": "Экономия до",
      "sale_string": "Заказывайте {weights}<br> и <b>ПОЛУЧАЙТЕ СКИДКУ</b><br> {discounts}",
    }
  }
</i18n>