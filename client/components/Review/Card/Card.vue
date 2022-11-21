

<script>
export default {

  data: function(){
    return {
    }
  },

  props: {
    review: {
      type: Object,
      required: true
    }
  },

}
</script>

<style src="./card.scss" lang="sass" scoped />

<template>
	<div>

	    <div class="clients-say__info">
        <span class="general-decor-elem"></span>

        <div class="clients-say__info__text">
            <div class="content js-content">
                <p>{{ review.text }}</p>
            </div>
        </div>
        
        <button class="clients-say__info__more js-more js-button" data-target="reviews">Read more</button>
	    </div>

	    <div class="clients-say__item__footer">
        <div class="clients-say__item__img" :style="{backgroundImage: review.photo}" ></div>
	      <p class="clients-say__item__name">{{ review.name }}</p>
	    </div>
	</div>
</template>
