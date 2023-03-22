export const useFeedbackStore = defineStore('feedbackStore', {
  state: () => ({
    feedback: null as Feedback | null,
    requestErrors: null
  }),
  
  getters: {
    errors: (state) => state.requestErrors
  },

  actions: {
    async createFeedback(data: Feedback) {
      const runtimeConfig = useRuntimeConfig()
      const url = `${runtimeConfig.public.apiBase}/feedback`

      return await useApiFetch(url, data, 'POST').then(({data, error}) => {

        if(data){
          this.requestErrors = null
          return data;
        }

        if(error) {
          this.requestErrors = error
          throw new Error(error)
        }
      })
    },
  },
})