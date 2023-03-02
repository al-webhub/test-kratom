

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
      if(this.review.owner.photo)
        return this.review.owner.photo.startsWith('http')? this.review.owner.photo :'/server/' + this.review.owner.photo
      else
        return '/images/photo-log-in.png'
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
        
        <!-- <button class="info__more" type="button" title="read more">{{ $t('text.read_more') }}</button> -->
	    </div>

	    <div class="footer">
        <nuxt-img
          :src = "photo"
          :alt="review.owner.fullname"
          :title="review.owner.fullname"
          width="70"
          height="70"
          sizes = "mobile:70px desktop:70px"
          format = "webp"
          quality = "80"
          fit="cover"
          loading = "lazy"
          class="photo cover"
        >
        </nuxt-img> 
	      <p class="name">{{ review.owner.fullname }}</p>
	    </div>
	</div>
</template>
