<script>
import { useTransactionStore } from '~/store/transaction'
import { useProfileStore } from '~/store/profile';
import { useModalStore } from '~/store/modal';

export default {
  setup() {
    const { t } = useI18n({useScope: 'local'})
    const transactionStore = useTransactionStore()
    const profileStore = useProfileStore()

    return {
      profileStore,
      transactionStore,
      t
    }
  },

  data() {
    return {
      isLoading: false,

      withdrawal: {
        value: 10,
        method: 'Bank card',
        bank_card: null,
        email: null,
        full_name: null,
        phone: null,
        country: null,
        city: null
      },

      methods: [
        'Bank card',
        'Paypal',
        'Western Union'
      ]
    }
  },

  computed: {
    errors() {
      return this.transactionStore.withdrawal.errors
    },

    profile() {
      return this.profileStore.profile  
    },

    balance() {
      const balance = this.profile.balance?.balance
      return Math.floor(balance)
    },
  },

  methods: {
    setDefaultValue() {
      this.withdrawal.value = 10
      this.withdrawal.method ='Bank card'
      this.withdrawal.bank_card = null
      this.withdrawal.email = null
      this.withdrawal.full_name = null
      this.withdrawal.phone = null
      this.withdrawal.country = null
      this.withdrawal.city = null
    },

    closeHandler() {
      useModalStore().close('withdrawal')
    },

    async createHandler() {
      this.isLoading = true
      const withdrawal = JSON.parse(JSON.stringify(this.withdrawal))

      try {
        await this.transactionStore.createTransaction({
          value: withdrawal.value * -1,
          description: `Withdrawal: USD${withdrawal.value }, Method: ${withdrawal.method}`,
          type: 'withdrawal',
          extras: withdrawal
        }).then((res) => {
          useNoty().setNoty(this.$t('noty.withdrawal_success'))
          this.closeHandler()
          this.setDefaultValue()
          this.profileStore.getProfile()
        })
      }catch(e) {
          useNoty().setNoty(this.$t('noty.withdrawal_fail'))
      }finally{
        this.isLoading = false
      }
    },
  }
}
</script>

<style src="./withdrawal.scss" lang="sass" scoped />

<template>
  <popup-layout-simple :is-active="isActive" @close="closeHandler">
    <template v-slot:title>
      {{ t('wr') }}
    </template>

    <template v-slot:content>
      <div>

        <form-select
          v-model="withdrawal.method"
          :values="methods"
          :placeholder="t('method')"
          :nullable="false"
          :error="errors?.method"
          class="form-item"
        >
        </form-select>

        <template v-if="withdrawal.method === 'Bank card'">
          <form-bank-card
            v-model="withdrawal.bank_card"
            :placeholder="$t('form.card_number')"
            :error="errors?.bank_card"
            class="form-item"
          >
          </form-bank-card>
        </template>
        
        <template v-else-if="withdrawal.method === 'Paypal'">
          <form-text
            v-model="withdrawal.email"
            :placeholder="$t('form.email')"
            :error="errors?.email"
            class="form-item"
          >
          </form-text>
        </template>

        <template v-else-if="withdrawal.method === 'Western Union'">
          <form-text
            v-model="withdrawal.full_name"
            :placeholder="$t('form.full_name')"
            :error="errors?.full_name"
            class="form-item"
          >
          </form-text>
          <form-text
            v-model="withdrawal.phone"
            :placeholder="$t('form.phone')"
            :error="errors?.phone"
            class="form-item"
          >
          </form-text>
          <form-text
            v-model="withdrawal.country"
            :placeholder="$t('form.Country_Region')"
            :error="errors?.country"
            class="form-item"
          >
          </form-text>
          <form-text
            v-model="withdrawal.city"
            :placeholder="$t('form.Town_City')"
            :error="errors?.city"
            class="form-item"
          >
          </form-text>
        </template>

        <div class="amount-block form-item">
          <form-amount
            v-model="withdrawal.value"
            :min="10"
            :max="balance"
          >
          </form-amount>

          <p class="hint">{{ t('max', {balance: balance}) }}</p>
        </div>

      </div>
    </template>

    <template v-slot:footer>
      <button @click.once="createHandler()" :class="{loading: isLoading}" clickable class="main-button primary small btn">
        <span class="text">{{ $t('button.send_request') }}</span>
      </button>
    </template>

  </popup-layout-simple>
</template>

<i18n>
  {
    en: {
      "wr": "withdrawal request",
      "method": "Withdrawal method",
      "max": "Maximum: ${balance} due to your balance"
    },

    ru: {
      "wr": "Запрос на снятие средств",
      "method": "Метод",
      "max": "Максимум: ${balance} доступно на вашем балансе"
    }
  }
</i18n>