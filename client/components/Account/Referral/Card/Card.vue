<script>
export default {
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

  methods: {
    totalRefsLvl2(arg) {
      return 10
    },

    totalRefsLvl3(arg) {
      return 4
    },

    toggleHandler() {
      this.isActive = !this.isActive
    }
  }
}
</script>


<style src="../../card.scss" lang="sass" scoped />

<template>
  <ul :class="{active: isActive}" class="referral-history__list">
    <li class="referral-history__item referral-history-position-1-lvl">
      <div class="main-wrapper">
        <p class="main-type">{{ $t('text.My_referral') }} (1st lvl)</p>
        <p class="text">{{ referral.fullname }}</p>
      </div>
    </li>

    <li class="referral-history__item referral-history-position-2-lvl">
      <p class="text">{{ totalRefsLvl2(referral) }}</p>
      <div class="referral-history__sub">
        <div class="wrapper">
          <p class="type">{{ $t('text.Referral_partners') }} (2nd lvl)</p>
          <p class="description">{{ totalRefsLvl2(referral) }}</p>
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
      <p class="text">{{ totalRefsLvl3(referral) }}</p>
      <div class="referral-history__sub">
        <div class="wrapper">
          <p class="type">{{ $t('text.Referral_partners') }} (3rd lvl)</p>
          <p class="description">{{ totalRefsLvl3(referral) }}</p>
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
      <p class="text">{{ referral.created_at }}</p>
      <div class="referral-history__sub">
        <div class="wrapper">
          <p class="type">{{ $t('text.add_date') }}</p>
          <p class="description">{{ referral.created_at }}</p>
        </div>
      </div>
    </li>

    <li @click="toggleHandler" class="referral-history__item referral-history-position-last">
      <img src="~assets/svg-icons/arrow-simple.svg"  class="icon toggle-list-btn" />
    </li>
  </ul>
</template>