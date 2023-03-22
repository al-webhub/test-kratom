<script>
import rewardsImg from 'assets/images/rewards.png'

export default {
  setup() {
    const { t } = useI18n({useScope: 'local'}) 

    const breadcrumbs = [
        {
          name: t('crumbs.home'),
          item: useToLocalePath()('/')
        },{
          name: t('crumbs.rewards'),
          item: useToLocalePath()('/rewards')
        }
    ]

    useCrumbs().setCrumbs(breadcrumbs)

    useSchemaOrg([
      defineBreadcrumb({
        itemListElement: breadcrumbs
      }),
    ])

    return {t}
  },

  data() {
    return {}
  },

  computed: {
    iconImg() {
      return 'url(' + rewardsImg + ')'
    },

    page() {
      return {
        h1: this.t('title'),
        title: this.t('title'),
        compensation_mt_1: this.t('compensation_mt_1'),
        compensation_t_1: this.t('compensation_t_1'),
        compensation_c_1: this.t('compensation_c_1'),
        compensation_t_2: this.t('compensation_t_2'),
        compensation_c_2: this.t('compensation_c_2'),
        compensation_t_3: this.t('compensation_t_3'),
        compensation_c_3: this.t('compensation_c_3'),
        program_mt_1: this.t('program_mt_1'),
        partner_program_info: this.t('partner_program_info'),
        htw_mt_1: this.t('htw_mt_1'),
        program_t_1: this.t('program_t_1'),
        program_c_1: this.t('program_c_1'),
        program_t_2: this.t('program_t_2'),
        program_c_2: this.t('program_c_2'),
        program_t_3: this.t('program_t_3'),
        program_c_3: this.t('program_c_3'),
        htw_info: this.t('htw_info')
      }
    }
  },
}
</script>

<style src="./rewards.scss" lang="sass" scoped />

<i18n src="./messages.json"></i18n>

<template>
<div>
  <simple-decor :figure-amount="2">
    <section class="earn">
      <div class="earn__wrapper container">
          <h1 class="main-caption main-caption-align">{{ page.h1 || page.title }}</h1>
          <div class="earn__compensation">
              
            <h2 class="main-caption-l">{{ page.compensation_mt_1 }}</h2>

              <ul class="earn__compensation__list">

                  <li class="earn__compensation__item">
                      <div class="general-decor-caption">
                        <img src="~assets/svg-icons/promo/cart.svg" class="icon" alt="cart icon" />
                      </div>
                      <h3 class="main-caption-s">{{ page.compensation_t_1 }}</h3>
                      <div v-html="page.compensation_c_1"></div>
                  </li>

                  <li class="earn__compensation__item">
                      <div class="general-decor-caption">
                        <img src="~assets/svg-icons/promo/percent.svg" class="icon" alt="percent icon" />
                      </div>
                      <h3 class="main-caption-s">{{ page.compensation_t_2 }}</h3>
                      <div v-html="page.compensation_c_2"></div>
                  </li>

                  <li class="earn__compensation__item">
                      <div class="general-decor-caption">
                        <img src="~assets/svg-icons/promo/dollar.svg" class="icon" alt="dollar icon" /> 
                      </div>
                      <h3 class="main-caption-s">{{ page.compensation_t_3 }}</h3>
                      <div v-html="page.compensation_c_3"></div>
                  </li>

              </ul>
          </div>

          <div class="earn__partner-programm">
              <h2 class="main-caption-l">{{ page.program_mt_1 }}</h2>
              <div v-html="page.partner_program_info"></div>
          </div>

          <div class="earn__how-works">
              <h2 class="main-caption-l">{{ page.htw_mt_1 }}</h2>
              <ul class="earn__how-works__list">
                  <li class="earn__how-works__item">
                      <div class="number-wrapper">
                          <p class="number">1.</p>
                      </div>
                      <p class="main-caption-s">{{ page.program_t_1 }}</p>
                      <div v-html="page.program_c_1"></div>
                  </li>
                  <li class="earn__how-works__item">
                      <div class="number-wrapper">
                          <p class="number">2.</p>
                      </div>
                      <p class="main-caption-s">{{ page.program_t_2 }}</p>
                      <div v-html="page.program_c_2"></div>
                  </li>
                  <li class="earn__how-works__item">
                      <div class="number-wrapper">
                          <p class="number">3.</p>
                      </div>
                      <p class="main-caption-s">{{ page.program_t_3 }}</p>
                      <div v-html="page.program_c_3"></div>
                  </li>
              </ul>
          </div>
          <div class="earn__text" v-html="page.htw_info"> 
          </div>
      </div>
    </section>
  </simple-decor>
  <section-referral></section-referral>
</div>
</template>