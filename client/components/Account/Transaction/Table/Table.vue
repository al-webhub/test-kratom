<script>
export default {
  setup() {
    const { t } = useI18n({useScope: 'local'})
    return {t}
  },

  props: {
    transactions: {
      type: Object
    },
    meta: {
      type: Object
    }
  },

  methods: {
    loadmoreHandler() {
      this.$emit('loadmore')
    }
  }
}
</script>

<style src="../../table.scss" lang="sass" scoped />

<template>
  <div class="referral-history" >
    <div class="referral-history__header">
        <p class="referral-history__name referral-history-position-data">{{ t('Transaction_date') }}</p>
        <p class="referral-history__name referral-history-position-descrip">{{ t('description') }}</p>
        <p class="referral-history__name referral-history-position-amount">{{ t('Status') }}</p>
        <p class="referral-history__name referral-history-position-amount">{{ t('Amount') }}</p>
        <p class="referral-history__name referral-history-position-balance">{{ t('Current_balance') }}</p>
    </div>
    <div v-if="transactions && transactions.length" class="referral-history__body">
        <account-transaction-card
          v-for="transaction in transactions"
          :key="transaction.id"
          :transaction="transaction"
        >
        </account-transaction-card>
        
        <div
          v-if="meta.last_page != meta.current_page"
          @click="loadmoreHandler()"
          clickable
          style="text-align:center; cursor:pointer;padding:10px"
        >
          {{ $t('button.show_more') }}
        </div>
        
    </div>
    <div
      v-else
      class="referral-info-body referra-empty"
    >
      <p>{{ $t('messages.have_any_transactions') }}</p>
    </div>
  </div>
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