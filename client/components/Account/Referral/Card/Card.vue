<script>
export default {
  setup() {
    const { t } = useI18n({useScope: 'local'})
    return {t}
  },
  
  data() {
    return {
      isActive: false
    }
  },

  props: {
    referral: {
      type: Object,
      required: true
    }
  },

  computed: {
    totalRefsLvl2() {
      return this.referral.referrals.length
    },

    totalRefsLvl3() {
      return this.referral.referrals.reduce((carry, user) => carry + user.referrals.length, 0)
    },
  },

  methods: {

    toggleHandler() {
      this.isActive = !this.isActive
    }
  }
}
</script>


<style src="../../card.scss" lang="sass" scoped />

<template>
  <ul @click="toggleHandler" :class="{active: isActive}" clickable class="referral-history__list">
    <li class="referral-history__item referral-history-position-1-lvl">
      <div class="main-wrapper">
        <p class="main-type">{{ t('My_referral') }} (1st lvl)</p>
        <p class="text">{{ referral.fullname }}</p>
      </div>
    </li>

    <li class="referral-history__item referral-history-position-2-lvl">
      <p class="text">{{ totalRefsLvl2 }}</p>
      <div class="referral-history__sub">
        <div class="wrapper">
          <p class="type">{{ t('Referral_partners') }} (2nd lvl)</p>
          <p class="description">{{ totalRefsLvl2 }}</p>
        </div>

        <ul class="referral-history__sub-list">
          <li
            v-for="ref_lvl_2 in referral.referrals"
            :key="ref_lvl_2.id"
            class="referral-history__sub-item"
          >
            {{ ref_lvl_2.fullname }}
          </li>
        </ul>
      </div>
    </li>

    <li class="referral-history__item referral-history-position-3-lvl">
      <p class="text">{{ totalRefsLvl3 }}</p>
      <div class="referral-history__sub">
        <div class="wrapper">
          <p class="type">{{ t('Referral_partners') }} (3rd lvl)</p>
          <p class="description">{{ totalRefsLvl3 }}</p>
        </div>
        <ul class="referral-history__sub-list">
          <template v-for="ref_lvl_2 in referral.referrals">
            <li
              v-for="ref_lvl_3 in ref_lvl_2.referrals"
              :key="ref_lvl_3.id"
              class="referral-history__sub-item"
            >
              {{ ref_lvl_3.fullname }}
            </li>
          </template>
        </ul>
      </div>
    </li>

    <li class="referral-history__item referral-history-position-data">
      <p class="text">{{ $d(referral.created_at, 'long') }}</p>
      <div class="referral-history__sub">
        <div class="wrapper">
          <p class="type">{{ t('add_date') }}</p>
          <p class="description">{{ $d(referral.created_at, 'long') }}</p>
        </div>
      </div>
    </li>

    <li :class="{hidden: !totalRefsLvl2}" class="referral-history__item referral-history-position-last">
      <img src="~assets/svg-icons/arrow-simple.svg"  class="icon toggle-list-btn" />
    </li>
  </ul>
</template>
<i18n>
  {
    "en": {
      "My_referral": "My referral",
      "Referral_partners": "Referral partners",
      "add_date": "add date",
      "lvl": "{lvl} lvl"
    },
    "ru": {
      "My_referral": "Реферал",
      "Referral_partners": "Партнеры",
      "add_date": "Дата добавления",
      "lvl": "{lvl} урв."
    }
  }
</i18n>