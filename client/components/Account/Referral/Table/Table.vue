<script>
export default {
  data() {
    return {

    }
  },

  props: {
    referrals: {
      type: Array,
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
  <div class="referral-history">
    <div class="referral-history__header">
      <p class="referral-history__name referral-history-position-1-lvl">{{ $t('text.My_referral') }}<br>(1st lvl)</p>
      <p class="referral-history__name referral-history-position-2-lvl">{{ $t('text.Referral_partners') }}<br>(2nd lvl)</p>
      <p class="referral-history__name referral-history-position-3-lvl">{{ $t('text.Referral_partners') }}<br>(3nd lvl)</p>
      <p class="referral-history__name referral-history-position-data">{{ $t('text.add_date') }}</p>
      <p class="referral-history__name referral-history-position-last"></p>
    </div>

    <div v-if="referrals.length" class="referral-history__body">
        <account-referral-card
          v-for="(referral, key) in referrals"
          :key="referral.id"
          :referral="referral"
        >
        </account-referral-card>

        <div
          v-if="referrals.last_page != referrals.current_page"
          @click="loadmore()"
          style="text-align:center; cursor:pointer;padding:10px"
        >
          {{ $t('text.Load_more') }}
        </div>
    </div>
    
    <div v-else class="referral-info-body referra-empty">
      <p>{{ $t('account.network_is_empty') }}</p>
    </div>

  </div>
</template>