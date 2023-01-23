<script>
export default {
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
        <p class="referral-history__name referral-history-position-data">{{ $t('text.Transaction_date') }}</p>
        <p class="referral-history__name referral-history-position-descrip">{{ $t('text.description') }}</p>
        <p class="referral-history__name referral-history-position-amount">{{ $t('text.Status') }}</p>
        <p class="referral-history__name referral-history-position-amount">{{ $t('text.Amount') }}</p>
        <p class="referral-history__name referral-history-position-balance">{{ $t('text.Current_balance') }}</p>
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
          style="text-align:center; cursor:pointer;padding:10px"
        >
          {{ $t('text.Load_more') }}
        </div>
        
    </div>
    <div
      v-else
      class="referral-info-body referra-empty"
    >
      <p>{{ $t('account.have_any_transactions') }}</p>
    </div>
  </div>
</template>