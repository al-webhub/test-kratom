

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

  methods: {
    emitHeightHandler() {
      if (process.client){
        if(window.innerWidth >= 1024)
          this.$emit('height', '305px')
        else
          this.$emit('height', 'auto')
      }else{
        if(this.$device.isDesktop)
          this.$emit('height', '305px')
        else
          this.$emit('height', 'auto')        
      }
    }
  },

  created: function(){
    this.emitHeightHandler()

    if (process.client){
      window.addEventListener("resize", this.emitHeightHandler);
    }
  },

  destroyed: function() {
    if (process.client){
      window.removeEventListener("resize", this.emitHeightHandler);
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
          :src = "review.owner.photo"
          sizes = "mobile:70px"
          format = "webp"
          quality = "80"
          loading = "lazy"
          class="photo cover"
        >
        </nuxt-picture> 
	      <p class="name">{{ review.owner.name }}</p>
	    </div>
	</div>
</template>
