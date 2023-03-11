<script>
import { useCategoryStore } from '~/store/category';

export default {
  async setup() {
    const route = useRoute()
    const { t } = useI18n({useScope: 'global'})
    const categoryStore = useCategoryStore()

    // COMPUTED
    const categorySlug = computed(() => {
      return route?.params?.slug || null
    })

    const realCategorySlug = computed(() => {
      return categorySlug.value === null? 'kratom': categorySlug.value
    })

    const category = computed(() => {
      return categoryStore.category;
    })

    const h1 = computed(() => {
      return category.value?.seo?.h1 || category.value?.name || ''
    })

    // WATCH
    watch(categorySlug, async(val) => {
      await getCategory()
      setSeo()
      setCrumbs()
    })

    // METHODS
    const getCategory = async () => {
      await useAsyncData('category', () => categoryStore.getOne(realCategorySlug.value))
    }

    // const setCrumbs = () => {
    //   const crumbs = [
    //       {
    //         name: t('crumbs.home'),
    //         link: '/'
    //       },{
    //         name: t('crumbs.shop'),
    //         link: '/shop'
    //       }
    //   ]

    //   if(category.value && category.value.slug !== 'shop') {
    //     crumbs.push({
    //       name: category.value.seo.h1 || category.value.name,
    //       link: category.value.slug
    //     })
    //   }

    //   useCrumbs().setCrumbs(crumbs)
    // }

    const setSeo = () => {
      useHead({
        title: category.value && (category.value.seo.meta_title || category.value.seo.h1 || category.value.name),
        meta: [
          {
            name: 'description',
            content: category.value && category.value.seo.meta_description
          },
        ],
      })
    }

    const setCrumbs = (article) => {
      const breadcrumbs = [
        {
          name: t('crumbs.home'),
          item: useToLocalePath()('/')
        },{
          name: t('crumbs.shop'),
          item: useToLocalePath()('/shop')
        }
      ]

      if(category.value && category.value.slug !== 'shop') {
        breadcrumbs.push({
          name: category.value.seo.h1 || category.value.name,
          item: useToLocalePath()(`/shop/${category.value.slug}`)
        })
      }

      useCrumbs().setCrumbs(breadcrumbs)

      useSchemaOrg([
        defineBreadcrumb({
          itemListElement: breadcrumbs
        }),
      ])
    }

    await getCategory().then(() => {
      //set meta after category fetch
      setSeo()
      setCrumbs()
    });
    


    return {
      categoryStore,
      categorySlug,
      h1,
      category
    }
  },
  
  data() {
    return {
      activeCategory: null,
    }
  },

  computed: {

    categories() {
      return [
        {
          id: 1,
          name: 'Kratom',
          slug: '/shop'
        },{
          id: 2,
          name: 'Other products',
          slug: '/shop/other-products'
        }
      ]
    },

    tabs() {
      return this.categories.map((item) => (item.name))
    },

    filters() {
      return useProductGroups()
    },
  },

  watch: {
    activeCategory: {
      handler(indx) {
        if(indx !== null)
          navigateTo(this.localePath(this.categories[indx].slug))
      }
    },

    '$route.params.slug': {
      handler(slug) {
        this.setActiveTabFromRoute()
      }
    }
  },

  methods: {
    setActiveTabFromRoute() {
      const initCategoryIndex = this.categories.findIndex((item) => item.slug === this.$route.fullPath)
      
      if(initCategoryIndex !== -1)
        this.activeCategory = initCategoryIndex
      else
        this.activeCategory = null
    }
  },

  mounted() {
    this.setActiveTabFromRoute()
  }
}
</script>

<style src="assets/scss/pages/shop.scss" lang="sass" scoped />

<template>
<div>
  <section class="shop-page">
      <div class="shop-page__wrapper container">
          <!-- <div class="general-decor-figure"></div> -->
          
          <h1 class="main-caption main-caption-align">{{ h1 }}</h1>

          <simple-tabs
            v-if="categories && categories.length"
            v-model:modelValue="activeCategory"
            :values="tabs"
            class="tabs"
          ></simple-tabs>

          <div class="content">

            <aside class="sidebar-wrapper">
              <div v-for="(filter, index) in filters" :key="index" class="attribute">
                <div class="attribute-title">{{ filter.name }}</div>
                <ul>
                  <li v-for="(item, key) in filter.items" :key="key">
                    <NuxtLink :to="localePath(item.link)" clickable>{{ item.name }}</NuxtLink>
                  </li>
                </ul>
              </div>
            </aside>

            <NuxtPage :foobar="123" />

          </div>
      </div>
  </section>
    
    
  <!-- <section v-if="category?.content" class="container">
    <div class="seo-block__container" v-html="category.content"></div>
  </section> -->

  <section-seo v-if="category?.content" :text="category.content" class="seo"></section-seo>

  <section-write-us></section-write-us>
</div>
</template>