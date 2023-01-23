

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

  computed: {
    photo() {
      if(this.review.owner.photo) {
        return '/server/' + this.review.owner.photo 
      }
      else
      {
        return '/images/photo-log-in.png'
      }
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
        
        <!-- <button class="info__more">{{ $t('text.read_more') }}</button> -->
	    </div>

	    <div class="footer">
        <nuxt-img
          :src = "photo"
          sizes = "mobile:70px"
          format = "webp"
          quality = "80"
          loading = "lazy"
          class="photo cover"
        >
        </nuxt-img> 
	      <p class="name">{{ review.owner.name }}</p>
	    </div>
	</div>
</template>
