<script>

definePageMeta({
  layout: "account",
});

export default {
  data(){
    return {
      user: {
        referral_code: 'fdsf32f'
      },
      balance: 15,
      currentTab: 'referrals',
      referrals: {
        data: [
          {
            id: 1,
            fullname: 'Adam Smith',
            created_at: '10.10.2022',
            referrals: [
              {
                id: 2,
                fullname: 'Maria Ko',
                created_at: '12.10.2022',
                referrals: null
              }
            ]
          },{
            id: 2,
            fullname: 'Vasil Smith',
            created_at: '10.10.2022',
            referrals: null
          }
        ],
        current_page: 1,
        last_page: 2,
        total: 20
      },
      transactions: {
        data: [
          {
            id: 1,
            created_at: '10.05.2021',
            description: 'Description',
            is_comleted: true,
            change: 10,
            balance: 100
          },{
            id: 2,
            created_at: '10.05.2021',
            description: 'Description',
            is_comleted: true,
            change: 10,
            balance: 100
          }
        ],
        current_page: 1,
        last_page: 2,
        total: 20
      }
    }
  },

  computed: {
    tabs() {
      return [
        {
          uid: 'referrals',
          label: this.$t('text.Friends_Network'),
        },{
          uid: 'transactions',
          label: this.$t('text.transactions'),
        }
      ]
    },
    balances() {
      return [
        {
          uid: 1,
          title: this.$t('text.Bonuses_earned_total'),
          amount: 10
        },{
          uid: 2,
          title: this.$t('text.cashback_for_purchases'),
          amount: 10
        },{
          uid: 3,
          title: this.$t('text.earned_in_partner'),
          amount: 10
        },{
          uid: 4,
          title: this.$t('text.earned_for_reviews'),
          amount: 10
        },{
          uid: 5,
          title: this.$t('text.Your_current_balance'),
          amount: this.balance
        }
      ]
    },

    referralLink() {
      return '/?ref=' + this.user.referral_code;
    }
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
        <button class="main-button-color js-button" :class="{disabled: balance < 10}">
          <span class="text">{{ $t('text.request_withdrawal') }}</span>
        </button>
        <p>{{ $t('text.available') }}:</p>
        <ul>
          <li>{{ $t('text.once_a_day') }}</li>
          <li>{{ $t('text.balance_is_above') }}</li>
        </ul>
      </div>
    </div>


    <div class="referral-container">

        <p class="profile__info__caption">{{ $t('text.my_referral_network') }}</p>

        <!-- REFERRAL LINK -->
        <p class="referral-link-text">{{ $t('text.Copy_your_referral') }}</p>

        <div class="referral-link">
          <form-link v-model="referralLink" placeholder="Referral link"></form-link>
          <!-- <label class="input__wrapper">
            <input :value="referralLink" type="text" class="main-input" readonly>
            <span class="custome-placeholder__wrapper">
              <span class="custome-placeholder__before"></span>
              <span class="custome-placeholder__text">
              </span>
              <span class="custome-placeholder__after"></span>
            </span>
          </label>
          <button class="copy-referral-link">
            <span class="icon-copy"></span>
          </button> -->
        </div>

        <!-- TABS -->
        <ul class="general-tabs__list">
          <li 
            v-for="tab in tabs"
            :key="tab.uid"
            @click="currentTab = tab.uid"
            :class="{active: currentTab === tab.uid}"
            class="general-tabs__item"
          >
            {{ tab.label }}
          </li>
        </ul>

        <account-referral-table
          v-if="currentTab == 'referrals'"
          :referrals="referrals"
        >
        </account-referral-table>

        <account-transaction-table
          v-if="currentTab == 'transactions'"
          :transactions="transactions"
        >
        </account-transaction-table>

    </div>
</div>
</template>