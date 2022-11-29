

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

<style src="./home-card.scss" lang="sass" scoped />

<template>
	<div>
	    <div class="info">
        <span class="general-decor-elem"></span>

        <div class="info__text">
          <div class="content">
            <p>{{ review.text }}</p>
          </div>
        </div>
        
        <button class="info__more">{{ $t('text.read_more') }}</button>
	    </div>

	    <div class="footer">
        <nuxt-picture
          :src = "review.photo"
          sizes = "mobile:70px"
          format = "webp"
          quality = "80"
          loading = "lazy"
          class="photo cover"
        >
        </nuxt-picture> 
	      <p class="name">{{ review.name }}</p>
	    </div>
	</div>
</template>
