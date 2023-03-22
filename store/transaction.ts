type Transaction = {
  id: number,
  value: number,
  balance: number,
  currency: string,
  type: string,
  status: string,
  description: string,
  created_at: string
};

type Modals = "withdrawal"

export const useTransactionStore = defineStore('transactionStore', {
  state: () => ({
    transactionsState: {
      data: [] as Transaction[],
      meta: null
    },
    modal: {
      withdrawal: {
        isShow: false,
        errors: null
      }
    },
  }),
  
  getters: {
    transactions: (state) => state.transactionsState.data,
    meta: (state) => state.transactionsState.meta,
    withdrawal: (state) => state.modal.withdrawal
  },

  actions: {
    toggle(name: Modals) {
      this.modal[name].isShow = !this.modal[name].isShow
    },

    async createTransaction(data: Transaction) {
      const runtimeConfig = useRuntimeConfig()
      const url = `${runtimeConfig.public.apiBase}/transactions`

      return await useApiFetch(url, data, 'POST').then(({data, error}) => {
        if(error) {
          throw new Error(error.data)
        }
      })
    },

    async getTransactions(query: string, refresh = true) {
      const runtimeConfig = useRuntimeConfig()
      const params = query? '?' + new URLSearchParams(query).toString(): '';
      const url = `${runtimeConfig.public.apiBase}/transactions${params}`

      return await useApiFetch(url).then(({data, error}) => {

        if(data){
          if(refresh)
            this.transactionsState.data = data.data
          else
            this.transactionsState.data = this.transactionsState.data.concat(data.data)

          this.transactionsState.meta = data.meta
        }

        if(error) {
          throw new Error(error.data)
        }
      })
    },
  },
})