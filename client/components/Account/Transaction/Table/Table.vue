<script>
export default {
  props: {
    transactions: {
      type: Object
    }
  },

  methods: {
    loadmore() {
      
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
    <div class="referral-history__body">
        <account-transaction-card
          v-for="transaction in transactions.data"
          :key="transaction.id"
          :transaction="transaction"
        >
        </account-transaction-card>
        
        <div
          v-if="transactions.last_page != transactions.current_page"
          @click="loadmore()"
          style="text-align:center; cursor:pointer;padding:10px"
        >
          {{ $t('text.Load_more') }}
        </div>
        
    </div>
    <div
      v-if="!transactions.total"
      class="referral-info-body referra-empty"
    >
      <p>{{ $t('text.have_any_transactions') }}</p>
    </div>
  </div>
</template>