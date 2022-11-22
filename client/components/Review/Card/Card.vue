<script>
export default {
  props: {
    review: {
      type: Object,
      required: true
    },
    user: {
      type: Object,
    }
  },

  computed: {
    photo: function(){
      let noAvatar = '/img/photo-log-in.png';
      
      if(this.user)
        return this.user.usermeta.photo? this.user.usermeta.photo: noAvatar;
      else
        return noAvatar;
    }  
  },

  methods: {

	    reply: function(parentId, baseIndex){
		    var component = this;
		    
		    let params = {
			    parent_id: parentId,
			    product_id: this.productId,
			    text: this.comment.text,
			    name: this.user.usermeta.fullname,
			    likes: 0,
			    dislikes: 0,
			    photo: this.photo
		    };
		    
		    this.reviews.data[baseIndex].children.push(params);
		    
		    axios.post('/reviews/reply/create', params).then(function(response) {
			    console.log(response);
			   component.comment.text = '';
		    });
	    },

	    cancel: function(){
		    this.comment.text = '';
	    },

	    like: function(id, baseIndex, subIndex, type){
		    var component = this;
		    var params = {};
		    var reverseType = type == 'like'? 'dislike': 'like';
		    
		    if(this.check(id, type))
		    {
			    params[type] = -1;
			    
			    if(subIndex !== null)
			    	this.reviews.data[baseIndex].children[subIndex][type+'s']--;
			    else
		    		this.reviews.data[baseIndex][type+'s']--;
		    	
		    	component.toStorage(id, null);
				axios.post('/reviews/like/' + id, params);
		    }else if(this.check(id, reverseType)){
			    params[type] = 1;
			    params[reverseType] = -1;
			    
			    if(subIndex  !== null){
			    	this.reviews.data[baseIndex].children[subIndex][type+'s']++;
			    	this.reviews.data[baseIndex].children[subIndex][reverseType+'s']--;
			    }else{
		    		this.reviews.data[baseIndex][type+'s']++;
		    		this.reviews.data[baseIndex][reverseType+'s']--;
		    	}
		    		
			    component.toStorage(id, type);
			    axios.post('/reviews/like/' + id, params);
		    }else {
			    params[type] = 1;
			    
			    if(subIndex  !== null)
			    	this.reviews.data[baseIndex].children[subIndex][type+'s']++;
			    else
		    		this.reviews.data[baseIndex][type+'s']++;
		    	
		    	
		    	component.toStorage(id, type);
				axios.post('/reviews/like/' + id, params);
		    }
		    
	    },

	    dislike: function(id, baseIndex, subIndex){
		    var component = this;
		    
		    if(subIndex  !== null){
			    this.reviews.data[baseIndex].children[subIndex].dislikes++;
		    }else{
			    this.reviews.data[baseIndex].dislikes++;
		    }	    
	    },

	    toStorage: function(id, type){
		    if(!this.likes) {
			    this.likes = {};
		    }
		    
		    if(!this.likes[this.productId])
		    	this.likes[this.productId] = {};
		    	
		    this.likes[this.productId][id] = type;
		    
		    localStorage.likes = JSON.stringify(this.likes);
	    },

	    check: function(id, type){
		    if(this.likes && this.likes[this.productId] && this.likes[this.productId][id] && this.likes[this.productId][id] == type)
		    	return true;
		    else
		    	return false;
	    }
  }
}
</script>

<style src="./card.scss" lang="sass" scoped />

<template>
<li class="reviews__item">
    <div :style="{backgroundImage: 'url(' + review.photo + ')'}" :title="review.name" class="reviews-img"></div>

    <div class="reviews__item-info">

        <div class="reviews__item-info__header">
            <p class="name">{{ review.name }}</p>
            <p class="date">{{ review.created_at }}</p>
        </div>
        
        <div class="reviews__item-info__body" v-html="review.text">
        </div>

        <div class="reviews__item-info__footer js-drop-item">
            <div class="reviews__interaction">
              
              <button @click="like(review.id, baseIndex, null, 'like')" :class="{active: check(review.id, 'like')}" class="reviews__interaction__button" >
                  <span class="icon-like-up"></span>
                  <span class="text">{{ review.likes }}</span>
              </button>
              
              <button @click="like(review.id, baseIndex, null, 'dislike')" :class="{active: check(review.id, 'dislike')}" class="reviews__interaction__button" >
                  <span class="icon-like-down"></span>
                  <span class="text">{{ review.dislikes }}</span>
              </button>
              
              <button v-if="user" class="reviews__interaction__button reviews__interaction__button-reply js-drop-button">
                <span class="icon-comment"></span>
                <span class="text">{{ $t('text.reply') }}</span>
              </button>

            </div>

            <form action="#" class="add-reviews__form">
                <div class="wrapper">
                    <div class="reviews-img" :style="{backgroundImage: 'url(' + photo + ')'}"></div>
                    <label class="input__wrapper js-input-wrapper">
                        <input type="text" class="main-input js-input">
                        <span class="custome-placeholder__wrapper">
                            <span class="custome-placeholder__before"></span>
                            <span class="custome-placeholder__text">
                                <span class="inner-text">{{ $t('text.your_reviews') }}</span>
                            </span>
                            <span class="custome-placeholder__after"></span>
                        </span>
                    </label>
                </div>
                <div class="add-reviews__buttons">
                    <button type="button" class="button-only-text js-reviews-button">
                        <span class="text">{{ $t('text.cancel') }}</span>
                    </button>
                    <button class="main-button main-button-small main-button-confirm">
                        <span class="text">{{ $t('text.reply') }}</span>
                    </button>
                </div>
            </form>

        </div>
        
        
        <div class="reviews-reply js-drop-item" v-if="review.children.length">
          
          <button class="more-reviews-text js-drop-button">
            <span class="text">Show {{ review.children.length }} replies</span>
            <span class="icon-drop"></span>
          </button>

          <ul class="reviews__list">
            <li
              v-for="(subReview, subIndex) in review.children"
              :key="subReview.id"
              class="reviews__item"
            >
              <div class="reviews-img" :style="{backgroundImage: 'url(' + subReview.photo + ')'}"></div>

              <div class="reviews__item-info">
                <div class="reviews__item-info__header">
                  <p class="name">{{ subReview.name }}</p>
                  <p class="date">{{ subReview.created_at }}</p>
                </div>
                
                <div class="reviews__item-info__body">
                  <p>{{ subReview.text }}</p>
                </div>

                <div class="reviews__item-info__footer js-drop-item">
                  <div class="reviews__interaction">
                    <button @click="like(review.id, baseIndex, subIndex, 'like')" class="reviews__interaction__button">
                      <span class="icon-like-up"></span>
                      <span class="text">{{ subReview.likes }}</span>
                    </button>
                    <button @click="like(review.id, baseIndex, subIndex, 'dislike')" class="reviews__interaction__button">
                      <span class="icon-like-down"></span>
                      <span class="text">{{ subReview.dislikes }}</span>
                    </button>
                  </div>
                </div>
              </div>

            </li>
          </ul>
      </div>
        
    </div>
</li>
</template>