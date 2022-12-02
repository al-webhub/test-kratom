<script>
export default {
  data() {
    return {
      user: {
        photo: '/images/ava1.jpg',
        usermeta: {
          photo: '/images/ava1.jpg'
        }
      },
    }
  },

  props: {
    reviews: {
      type: Array
    }
  }
}
</script>

<style src="./block.scss" lang="sass" scoped />

<template>

    <div class="add-reviews">
      <review-form :user="user"></review-form>
    </div>

    <div class="reviews">

      <div class="reviews__caprtion">
        <span class="general-decor-elem"></span>
        <p>{{ $t('text.reviews') }}</p>
      </div>
      
      <ul class="reviews__list">
        <review-card
          v-for="review in reviews"
          :key="review.id"
          :review="review"
          :user="user"
        >
        </review-card>
      </ul>

    </div>

</template>