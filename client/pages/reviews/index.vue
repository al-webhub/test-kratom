<script>
import { useAuthStore } from '~/store/auth';
import { useReviewStore } from '~/store/review';
import { useLikesStore } from '~/store/likes';

export default {
  async setup() {
    const reviewStore = useReviewStore()
    const likesStore = useLikesStore()
    const authStore = useAuthStore()

    const meta = computed(() => {
      return reviewStore?.meta;
    })

    const getReviews = async (query, refresh) => {
      await useAsyncData('reviews', () => reviewStore.getAll(query, refresh))
    }

    const loadMoreHandler = async () => {
      await getReviews({per_page: 12, page: meta.value.current_page + 1}, false)
    }

    getReviews({per_page: 12}, true)

    return {
      reviewStore,
      likesStore,
      authStore,
      meta,
      loadMoreHandler
    }
  },

  data() {
    return {
      page: {
        h1: 'REVIEWS',
        title: ''
      },
    }
  },

  computed: {

    isAuth() {
      return this.authStore?.isAuth
    },

    user() {
      return this.authStore?.getUser
    },

    reviews() {
      return this.reviewStore?.all;
    },

    authUser() {
      return this.isAuth? this.user: null
    }
  },

  methods: {
    setCrumbs() {
      useCrumbs().setCrumbs([
          {
            name: this.$t('crumbs.home'),
            link: '/'
          },{
            name: this.$t('crumbs.reviews'),
            link: '/reviews'
          }
      ])
    },

    async addReview(data) {
      const {setNoty} = useNoty()

      await this.reviewStore?.create(data).then((res) => {
        if(res.data) {
          setNoty(this.$t('noty.add_review'), 3000)
        }

        if(res.error)
          setNoty(this.$t('noty.add_review_fail'), 5000)
      })
    },

    createHandler(value) {
      const data = {
        ...value,
        provider: 'auth',
      }

      this.addReview(data)
    },

  },

  async created() {
    this.setCrumbs()
  }
}
</script>

<style src="assets/scss/pages/reviews.scss" lang="sass" scoped />

<template>
  <div>
    <simple-decorator
      :is-figure="true"
      :settings="{title: {posX: 'left', posY: 'bottom'}, figure: {posX:'left', posY: 'bottom', showTill: 'desktop'}}"
    >
    <section class="wrapper">
        <div class="container">
            
            <h1 class="main-caption main-caption-align">{{ page.h1 || page.title }}</h1>
            
            <div class="inner">
              <ul class="list">
                <review-card
                  v-for="(review, index) in reviews" 
                  :key="review.id"
                  :review="review"
                  :user="authUser"
                  class="review"
                  body-class="card"
                >
                </review-card>
              </ul>

              <button v-if="meta && meta.current_page !== meta.last_page" @click="loadMoreHandler" class="main-button small loadmore-btn" >
                <span class="text">{{ $t('button.show_more') }}</span>
              </button>

              <!-- FORM -->
              <review-form
                :user="authUser"
                @create="createHandler"
                class="form"
              >
              </review-form>

            </div>

        </div>
    </section>
    </simple-decorator>

    <section-write-us></section-write-us>
  </div>
</template>