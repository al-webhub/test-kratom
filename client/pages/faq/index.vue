<script>
export default {
  setup() {
    const { t } = useI18n({
      useScope: 'local'
    }) 

    const breadcrumbs = [
      {
        name: t('crumbs.home'),
        item: useToLocalePath()('/')
      },{
        name: t('crumbs.faq'),
        item: useToLocalePath()('/faq')
      }
    ]

    useCrumbs().setCrumbs(breadcrumbs)

    useSchemaOrg([
      defineBreadcrumb({
        itemListElement: breadcrumbs
      }),
    ])

    return {
      t
    }
  },

  data() {
    return {
      activeIndex: null
    }
  },

  computed: {
    page() {
      return {
        title: this.t('title'),
        content: this.t('content'),
      }
    },

    faqs() { 
      return [
        {
          id: 1,
          title: this.t('q_1'),
          content: this.t('a_1')
        },{
          id: 2,
          title: this.t('q_2'),
          content: this.t('a_2')
        },{
          id: 3,
          title: this.t('q_3'),
          content: this.t('a_3')
        },{
          id: 4,
          title: this.t('q_4'),
          content: this.t('a_4')
        },{
          id: 5,
          title: this.t('q_5'),
          content: this.t('a_5')
        },{
          id: 6,
          title: this.t('q_6'),
          content: this.t('a_6')
        }
      ]
    }
  },

  methods: {

    toggleHandler(index) {
      if(this.activeIndex === index)
        this.activeIndex = null
      else
        this.activeIndex = index
    }
  },
}
</script>

<style src="./faq.scss" lang="sass" scoped />
<style>
.faq__item__body p {
  margin-bottom: 25px;
}
</style>

<i18n src="./messages.json"></i18n>

<template>
<div>
  <simple-decor :title-amount="0">
    <section class="faq">
      <div class="faq__wrapper container">
        
        <h1 class="main-caption main-caption-align">{{ page.h1 || page.title }}</h1>
        
        <p class="faq__text">{{ page.content }}</p>

        <div class="faq__container">
          <ul class="faq__list">
            <li
              v-for="(faq, index) in faqs"
              :key="faq.id"
              @click="toggleHandler(index)"
              :class="{active: index === activeIndex}"
              class="faq__item"
            >
              <div class="faq__item__header">
                <h2 class="name">{{ faq.title }}</h2>
                <img src="~assets/svg-icons/arrow-simple.svg" class="icon" />
              </div>
              <div class="faq__item__body" v-html="faq.content"></div>
            </li>
          </ul>
        </div>

      </div>
    </section>
  </simple-decor>

  <section-write-us></section-write-us>
</div>
</template>