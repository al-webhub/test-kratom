<template>
	<div class="product-page__reviews js-product-item"  data-target="reviews">
        <p class="product-page__caption">{{ strings.reviews }}</p>
        
        
        <div class="add-reviews">
            <div class="reviews__caprtion">
                <span class="general-decor-elem"></span>
                <p>{{ strings.feedback_and_earn }}</p>
            </div>
            <div class="add-reviews__item">
                <span class="icon-man"></span>
                <p>{{ strings.first_of_all }}</p>
                
                <template v-if="user">
                	<p class="add-reviews__active"><span class="icon-active"></span></p>
                </template>
                <template v-else>
                	<button class="button-enter js-button" data-target="registration-social">{{ strings.Log_In }}</button>
                </template>
            </div>
            <div class="add-reviews__item">
                <span class="icon-reviews-message"></span>
                <p v-html="strings.leave_incognito_for"></p>
            </div>
            <div class="add-reviews__form" v-if="user"> <!-- Form-->
                <div class="wrapper">
                    <!-- А если есть фотка из соц. сети, то ее нужно будет подгрузить -->
                    <div class="reviews-img" v-lazy:background-image="photo"></div>
                    
                    <label class="textarea__wrapper js-input-wrapper">
                        <textarea class="main-textarea js-input" v-model="comment.text"></textarea>
                        <span class="custome-placeholder__wrapper">
                            <span class="custome-placeholder__before"></span>
                            <span class="custome-placeholder__text">
                                <span class="inner-text">{{ strings.your_reviews }}</span>
                            </span>
                            <span class="custome-placeholder__after"></span>
                        </span>
                    </label>
                </div>
                <!-- Если не залогиненный пытается отправить отзыв нужен noty с ошибкой -->
                <div class="add-reviews__buttons">
                    <button class="main-button main-button-small" @click="add(productId, true)">
                        <span class="text">{{ strings.post_incognito }}</span>
                    </button>
                    <button class="main-button main-button-small main-button-confirm" @click="add(productId)">
                        <span class="text">{{ strings.post }}</span>
                    </button>
                </div>
            </div> <!-- Form-->
        </div>
        
        
        <div class="reviews">
            <div class="reviews__caprtion">
                <span class="general-decor-elem"></span>
                <p>{{ strings.reviews }}</p>
            </div>
            
            <!-- REVIEWS -->
			<ul class="reviews__list">
		    	<template v-if="reviews.data.length">
			    	<li class="reviews__item" v-for="(baseReview, baseIndex) in reviews.data">
			            <div class="reviews-img" v-lazy:background-image="baseReview.photo"></div>
			            <div class="reviews__item-info">
			                <div class="reviews__item-info__header">
			                    <p class="name">{{ baseReview.name }}</p>
			                    <p class="date">{{ baseReview.created_at }}</p>
			                </div>
			                <div class="reviews__item-info__body">
			                    <p>{{ baseReview.text }}</p>
			                </div>
			                <div class="reviews__item-info__footer js-drop-item">
			                    <div class="reviews__interaction">
			                        <button class="reviews__interaction__button" @click="like(baseReview.id, baseIndex, null, 'like')" :class="{active: check(baseReview.id, 'like')}">
			                            <span class="icon-like-up"></span>
			                            <span class="text">{{ baseReview.likes }}</span>
			                        </button>
			                        <button class="reviews__interaction__button" @click="like(baseReview.id, baseIndex, null, 'dislike')" :class="{active: check(baseReview.id, 'dislike')}">
			                            <span class="icon-like-down"></span>
			                            <span class="text">{{ baseReview.dislikes }}</span>
			                        </button>
			                        <button class="reviews__interaction__button reviews__interaction__button-reply js-drop-button" v-if="user">
			                            <span class="icon-comment"></span>
			                            <span class="text">{{ strings.reply }}</span>
			                        </button>
			                    </div>
			                    <form action="#" class="add-reviews__form">
			                        <div class="wrapper">
			                            <div class="reviews-img" v-lazy:background-image="photo"></div>
										
			                            <label class="input__wrapper js-input-wrapper">
			                                <input type="text" class="main-input js-input" v-model="comment.text">
			                                <span class="custome-placeholder__wrapper">
			                                    <span class="custome-placeholder__before"></span>
			                                    <span class="custome-placeholder__text">
			                                        <span class="inner-text">{{ strings.your_reviews }}</span>
			                                    </span>
			                                    <span class="custome-placeholder__after"></span>
			                                </span>
			                            </label>
			                        </div>
			                        <div class="add-reviews__buttons">
			                            <button class="button-only-text js-reviews-button" @click="cancel">
			                                <span class="text">{{ strings.cancel }}</span>
			                            </button>
			                            <button class="main-button main-button-small main-button-confirm" @click="reply(baseReview.id, baseIndex)">
			                                <span class="text">{{ strings.reply }}</span>
			                            </button>
			                        </div>
			                    </form>
			                </div>
			               
			               
			                <div class="reviews-reply js-drop-item" v-if="baseReview.children.length">
			                    
			                    <button class="more-reviews-text js-drop-button">
			                        <span class="text">Show {{ baseReview.children.length }} replies</span>
			                        <span class="icon-drop"></span>
			                    </button>
			                    
			                    <ul class="reviews__list">
			                        
			                        <li class="reviews__item" v-for="(subReview, subIndex) in baseReview.children">
			                            <div class="reviews-img" v-lazy:background-image="subReview.photo"></div>
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
			                                        <button class="reviews__interaction__button" @click="like(baseReview.id, baseIndex, subIndex, 'like')">
			                                            <span class="icon-like-up"></span>
			                                            <span class="text">{{ subReview.likes }}</span>
			                                        </button>
			                                        <button class="reviews__interaction__button" @click="like(baseReview.id, baseIndex, subIndex, 'dislike')">
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
				<template v-else>
					<li><p>{{ strings.no_reviews }}</p></li>
				</template>
		    </ul>
		    
		    
		    <button class="more-reviews-text" @click="loadMore" v-if="reviews.next_page_url">
		        <span class="text">{{ strings.load_more_reviews }}</span>
		        <span class="icon-drop"></span>
		    </button>
			<!-- REVIEWS -->
        </div>
        
    </div>  
</template>

<script>
	import reviews from '../mixins/reviews.js'
	
    export default {
		name: 'productReviews',
		mixins: [reviews],
		data: function(){
			return {
				strings: strings
			}
		}
	}
</script>
