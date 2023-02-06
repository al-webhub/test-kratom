<script>
import { useProfileStore } from '~/store/profile';
import { useTransactionStore } from '~/store/transaction';

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
      this.transactionStore.toggle('withdrawal')
    },

    async getReferrals() {
      await this.profileStore?.getReferrals()
    },
    
    async loadmoreReferralsHandler() {
      const params = {
        page: this.referralsMeta.current_page + 1
      }

      await this.profileStore?.getReferrals(params)
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

<style src="assets/scss/pages/account/referral-network.scss" lang="sass" scoped />

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
        <button @click="withdrawalHandler" :class="{disabled: balance.balance < 10}" class="main-button primary">
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

<i18n>
  {
    "en": {
      "Bonuses_earned_total" : "Bonuses earned total",
      "cashback_for_purchases" : "cashback for purchases",
      "earned_in_partner" : "earned in partner program",
      "earned_for_reviews" : "earned for reviews",
      "Your_current_balance" : "Your current balance",
      "request_withdrawal" : "request withdrawal",
      "available" : "available",
      "once_a_day" : "once a day",
      "balance_is_above" : "balance is above 10$",
      "my_referral_network" : "my referral network",
      "Copy_your_referral" : "Copy your referral link and send it to your friends to start build the network!",
      "Friends_Network" : "Friends Network",
      "transactions" : "transactions",
      "My_referral" : "My referral",
      "Referral_partners" : "Referral’s partners",
      "add_date" : "add date",
    },
    "ru": {
      "Bonuses_earned_total" : "Всего заработано бонусов",
      "cashback_for_purchases" : "Кэшбек за покупки",
      "earned_in_partner" : "Заработано в партнерке",
      "earned_for_reviews" : "Заработано за отзывы",
      "Your_current_balance" : "Ваш текущий баланс",
      "request_withdrawal" : "Вывод средств",
      "available" : "доступно",
      "once_a_day" : "один раз в день",
      "balance_is_above" : "баланс выше 10$",
      "my_referral_network" : "моя реферальная сеть",
      "Copy_your_referral" : "Скопируйте свою реферальную ссылку и отправьте ее своим друзьям, чтобы начать строить сеть!",
      "Friends_Network" : "Сеть друзей",
      "transactions" : "Транзакции",
      "My_referral" : "Мой реферал",
      "Referral_partners" : "Партнеры реферала",
      "add_date" : "дата добавления",
    }
  }
</i18n>