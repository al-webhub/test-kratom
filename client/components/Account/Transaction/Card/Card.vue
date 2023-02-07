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
        <p class="main-type">{{ t('Transaction_date') }}</p>
        <p class="text">{{ $d(transaction.created_at, 'long') }}</p>
      </div>
    </li>
    <li class="referral-history__item referral-history-position-descrip">
      <p class="text" v-html="transaction.description"></p>
      <div class="referral-history__sub">
        <div class="wrapper">
          <p class="type">{{ t('description') }}</p>
          <div class="description-text" v-html="transaction.description"></div>
        </div>
      </div>
    </li>
    <li class="referral-history__item referral-history-position-amount">
      <p class="text" style="text-transform: uppercase">{{ transaction.status }}</p>
      <div class="referral-history__sub">
        <div class="wrapper">
          <p class="type">{{ t('Status') }}</p>
          <p class="description">{{ transaction.status }}</p>
        </div>
      </div>
    </li>
    <li class="referral-history__item referral-history-position-amount">
      <p class="text">{{ transaction.value }}</p>
      <div class="referral-history__sub">
        <div class="wrapper">
          <p class="type">{{ t('Amount') }}</p>
          <p class="description">{{ transaction.value }}</p>
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
            <p class="type">{{ t('Current_balance') }}</p>
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
<i18n>
  {
    "en": {
      "Transaction_date": "Transaction date",
      "description": "Description",
      "Status": "Status",
      "Amount": "Amount",
      "Current_balance": "Current balance"
    },
    "ru": {
      "Transaction_date": "Дата",
      "description": "Описание",
      "Status": "Статус",
      "Amount": "Сумма",
      "Current_balance": "Баланс"
    }
  }
</i18n>