<script>
export default {
  props: {
    product: {
      type: Object
    },

    selectedModification: {
      type: Object
    }
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
  }
}
</script>

<style src="./sale.scss" lang="sass" scoped />

<template>
  <div class="box">
    <p class="discount">{{ $t('text.current_DISCOUNT') }}: <span>{{ currentDiscount }}%</span></p>
    
    <p class="sale">{{ $t('text.save') }} {{ discounts.slice(-1)[0] }}%</p>

    <p class="offer">
      {{ $t('text.Order') }} {{ saleWeights }} 
      <br>
      {{ $t('text.and') }} 
      <span>{{ $t('text.get_a_discount') }}</span> 
      {{ discountsString }}
    </p>
  </div>
</template>