<script>
export default {
  data() {
    return {
      isActive: false
    }
  },

  props: {
    transaction: {
      type: Object
    }
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
  <ul :class="{active: isActive}" class="referral-history__list referral-history__list-transactions">
    <li class="referral-history__item referral-history-position-data">
      <div class="main-wrapper">
        <p class="main-type">{{ $t('text.Transaction_date') }}</p>
        <p class="text">{{ transaction.created_at }}</p>
      </div>
    </li>
    <li class="referral-history__item referral-history-position-descrip">
      <p class="text" v-html="transaction.description"></p>
      <div class="referral-history__sub">
        <div class="wrapper">
          <p class="type">{{ $t('text.description') }}</p>
          <div class="description-text" v-html="transaction.description"></div>
        </div>
      </div>
    </li>
    <li class="referral-history__item referral-history-position-amount">
      <p class="text" style="text-transform: uppercase">{{ transaction.is_completed? 'done': 'pending' }}</p>
      <div class="referral-history__sub">
        <div class="wrapper">
          <p class="type">{{ $t('text.Status') }}</p>
          <p class="description">{{ transaction.is_completed }}</p>
        </div>
      </div>
    </li>
    <li class="referral-history__item referral-history-position-amount">
      <p class="text">{{ transaction.change }}</p>
      <div class="referral-history__sub">
        <div class="wrapper">
          <p class="type">{{ $t('text.Amount') }}</p>
          <p class="description">{{ transaction.change }}</p>
        </div>
      </div>
    </li>
    <li class="referral-history__item referral-history__item-balance referral-history-position-balance">
      <template v-if="transaction.balance">
        <p class="text">USD {{ transaction.balance }}</p>
      </template>
      <template v-else>
        <p class="text">–</p>
      </template>
      <div class="referral-history__sub">
          <div class="wrapper">
            <p class="type">{{ $t('text.Current_balance') }}</p>
            <template v-if="transaction.balance">
              <p class="description">USD {{ transaction.balance }}</p>
            </template>
            <template v-else>
              <p class="description">–</p>
            </template>	
          </div>
      </div>
    </li>
    <li @click="toggleHandler" class="referral-history__item referral-history__item-icon-drop">
      <img src="~assets/svg-icons/arrow-simple.svg"  class="icon toggle-list-btn" />
    </li>
  </ul>
</template>