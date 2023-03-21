<script>
import { useProfileStore } from '~/store/profile';
import { useTransactionStore } from '~/store/transaction';
import { useModalStore } from '~/store/modal';

export default {
  setup() {
    const { t } = useI18n({useScope: 'local'})

    definePageMeta({
      layout: 'account',
      middleware: 'auth'
    })

    useAccount().setTitle(t('title.referral_network'))

    const profileStore = useProfileStore()
    const transactionStore = useTransactionStore()

    transactionStore.$reset()

    return {
      profileStore,
      transactionStore,
      t
    }
  },

  data(){
    return {
      currentTab: 'referrals',
    }
  },

  computed: {
    
    referrerCode() {
      return this.profile?.referrer_code
    },

    profile() {
      return this.profileStore.profile  
    },

    balance() {
      return this.profile?.balance
    },

    referrals() {
      return this.profileStore?.referrals;
    },

    referralsMeta() {
      return this.profileStore?.referralsMeta;
    },

    transactions() {
      return this.transactionStore?.transactions;
    },

    transactionsMeta() {
      return this.transactionStore?.meta;
    },

    tabs() {
      return [
        {
          uid: 'referrals',
          label:  this.t('Friends_Network'),
        },{
          uid: 'transactions',
          label:  this.t('transactions'),
        }
      ]
    },

    balances() {
      return [
        {
          uid: 1,
          title: this.t('Bonuses_earned_total'),
          amount: this.balance?.debit
        },{
          uid: 2,
          title:  this.t('cashback_for_purchases'),
          amount: this.balance?.cashback
        },{
          uid: 3,
          title:  this.t('earned_in_partner'),
          amount: this.balance?.bonus
        },{
          uid: 4,
          title:  this.t('earned_for_reviews'),
          amount: this.balance?.review
        },{
          uid: 5,
          title:  this.t('Your_current_balance'),
          amount: this.balance?.balance
        }
      ]
    },

    referralLink() {
      return `${useAppConfig().SITE_URL}?ref=${this.referrerCode}`
    }
  },

  watch: {
    currentTab: {
      async handler(value){
        if(value === 'transactions'){
          await this.getTransactions()
        }
      },
      immediate: true
    }
  },

  methods: {
    setCrumbs() {
      useCrumbs().setCrumbs([
          {
            name: this.$t('crumbs.home'),
            link: '/'
          },{
            name: this.$t('crumbs.account'),
            link: '/account'
          },{
            name: this.$t('crumbs.referral_network'),
            link: '/account/referral_network'
          }
      ])
    },

    withdrawalHandler() {
      useModalStore().open('withdrawal')
    },

    async getReferrals() {
      await this.profileStore?.getReferrals()
    },
    
    async loadmoreReferralsHandler() {
      const params = {
        page: this.referralsMeta.current_page + 1
      }

      await this.profileStore?.getReferrals(params, false)
    },

    async getTransactions() {
      await this.transactionStore?.getTransactions()
    },

    async loadmoreTransactionsHandler() {
      const params = {
        page: this.transactionsMeta.current_page + 1
      }

      await this.transactionStore?.getTransactions(params, false)

    }
  },

  async created() {
    await useAsyncData('referrals', () => this.getReferrals())
    this.setCrumbs()
  }
}
</script>

<style src="./referral-network.scss" lang="sass" scoped />
<i18n src="./messages.json"></i18n>

<template>
  <div>
    <div class="referral-info">
      <!-- HEADER LEFT SIDE -->
      <ul class="referral-info__list">
        <li
          v-for="balance in balances"
          :key="balance.uid"
          class="referral-info__item"
        >
          <p class="type">{{ balance.title }}</p>
          <p class="description">USD {{ balance.amount }}</p>
        </li>
      </ul>

      <!-- HEADER RIGHT SIDE -->
      <div class="referral-withdrawal">
        <button @click="withdrawalHandler" :class="{disabled: balance.balance < 10}" clickable class="main-button primary">
          <span class="text">{{ t('request_withdrawal') }}</span>
        </button>
        <p>{{ t('available') }}:</p>
        <ul>
          <li>{{ t('once_a_day') }}</li>
          <li>{{ t('balance_is_above') }}</li>
        </ul>
      </div>
    </div>


    <div class="referral-container">

        <p class="profile__info__caption">{{ t('my_referral_network') }}</p>

        <!-- REFERRAL LINK -->
        <p class="referral-link-text">{{ t('Copy_your_referral') }}</p>

        <div class="referral-link">
          <form-link v-model="referralLink" :placeholder="$t('form.referral_link')"></form-link>
        </div>

        <!-- TABS -->
        <simple-tabs
          v-model="currentTab"
          :values="tabs"
          index="uid"
          value="label"
        >
        </simple-tabs>

        <account-referral-table
          v-if="currentTab == 'referrals'"
          :referrals="referrals"
          :meta="referralsMeta"
          @loadmore="loadmoreReferralsHandler"
        >
        </account-referral-table>

        <account-transaction-table
          v-if="currentTab == 'transactions'"
          :transactions="transactions"
          :meta="transactionsMeta"
          @loadmore="loadmoreTransactionsHandler"
        >
        </account-transaction-table>

    </div>
  </div>
</template>