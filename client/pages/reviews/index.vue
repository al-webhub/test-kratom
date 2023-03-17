<script>
import { useAuthStore } from '~/store/auth';
import { useReviewStore } from '~/store/review';
import { useLikesStore } from '~/store/likes';

export default {
  async setup() {
    const { t } = useI18n({useScope: 'local'})
    const reviewStore = useReviewStore()
    const likesStore = useLikesStore()
    const authStore = useAuthStore()

    const isLoading = ref(false)

    const meta = computed(() => {
      return reviewStore?.meta;
    })

    const setSeo = () => {
      useHead({
        title: t('seo.title'),
        meta: [
          {
            name: 'description',
            content: t('seo.description')
          },
        ],
      })
    }

    const getReviews = (query, refresh) => {
      return useLazyAsyncData('reviews', () => reviewStore.getAll(query, refresh))
    }

    const loadMoreHandler = async () => {
      isLoading.value = true

      await getReviews({per_page: 12, page: meta.value.current_page + 1}, false).then(() => {
        isLoading.value = false
      })
    }

    getReviews({per_page: 12}, true)
    setSeo()

    const breadcrumbs = [
        {
          name: t('crumbs.home'),
          link: useToLocalePath()('/')
        },{
          name: t('crumbs.reviews'),
          link: useToLocalePath()('/reviews')
        }
    ]

    useCrumbs().setCrumbs(breadcrumbs)

    useSchemaOrg([
      defineBreadcrumb({
        itemListElement: breadcrumbs
      }),
    ])

    return {
      reviewStore,
      likesStore,
      authStore,
      meta,
      loadMoreHandler,
      isLoading
    }
  },

  data() {
    return {
      createIsLoading: false
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
    async addReview(data) {
      this.createIsLoading = true

      await this.reviewStore?.create(data).then((res) => {
        if(res.data)
          useNoty().setNoty(this.$t('noty.add_review'), 3000)

        if(res.error)
          useNoty().setNoty(this.$t('noty.add_review_fail'), 5000)
        
        this.createIsLoading = false
      })
    },

    createHandler(value) {
      const data = {
        ...value,
        provider: 'auth',
      }

      this.addReview(data)
    },

  }
}
</script>

<style src="./reviews.scss" lang="sass" scoped />

<template>
  <div>
    <section class="wrapper">
        <div class="container">
            
            <h1 class="main-caption main-caption-align">{{ $t('title.reviews') }}</h1>
            
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

              <button
                v-if="meta && meta.current_page !== meta.last_page"
                @click="loadMoreHandler"
                :class="{loading: isLoading}"
                :aria-label="$t('button.show_more')"
                class="main-button loadmore-btn"
                type="button"
              >
                <span class="text">{{ $t('button.show_more') }}</span>
              </button>

              <!-- FORM -->
              <review-form
                :user="authUser"
                :is-loading="createIsLoading"
                @create="createHandler"
                class="form"
              >
              </review-form>

            </div>

        </div>
    </section>

    <section-write-us></section-write-us>
  </div>
</template>


<i18n>
  {
    "en": {
      "seo": {
        title: "Reviews {'|'} Kratomhelper",
        description: "Online store Kratomhelper 🍂 Reviews 🍂 100% high-quality Kratom 👍 Fast delivery around the world 🚗 Qualified consultation ☑ Returning money 💲"
      },
    },
    "ru": {
      "seo": {
        title: "Отзывы {'|'} Kratomhelper",
        description: "Интернет-магазин KratomHelper 🍂 Отзывы 🍂 100% высококачественный Kratom 👍 Быстрая доставка по всему миру 🚗 Квалифицированная консультация ☑ возвращающиеся деньги 💲"
      },
    }
  }
</i18n>