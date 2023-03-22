<script>
export default {
  setup() {
    const { t } = useI18n({useScope: 'local'})
    return {t}
  },

  data() {
    return {}
  },

  props: {
    referrals: {
      type: Array,
    }
  },

  methods: {
    loadmore() {}
  }
}
</script>

<style src="../../table.scss" lang="sass" scoped />

<template>
  <div class="referral-history">
    <div class="referral-history__header">
      <p class="referral-history__name referral-history-position-1-lvl">{{ t('My_referral') }}<br>({{ t('lvl', {lvl: 1}) }})</p>
      <p class="referral-history__name referral-history-position-2-lvl">{{ t('Referral_partners') }}<br>({{ t('lvl', {lvl: 2}) }})</p>
      <p class="referral-history__name referral-history-position-3-lvl">{{ t('Referral_partners') }}<br>({{ t('lvl', {lvl: 3}) }})</p>
      <p class="referral-history__name referral-history-position-data">{{ t('add_date') }}</p>
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
          {{ $t('button.show_more') }}
        </div>
    </div>
    
    <div v-else class="referral-info-body referra-empty">
      <p>{{ $t('messages.network_is_empty') }}</p>
    </div>

  </div>
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