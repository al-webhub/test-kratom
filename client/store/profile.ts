type Profile = {
  id: number | null,
  email: string,
  fullname: string,
  photo: string | null,
  addresses: Object[]
};

export const useProfileStore = defineStore('profileStore', {
  state: () => ({
    profileState: {
      id: null,
      email: '',
      fullname: '',
      photo: null,
      addresses: [
        {
          is_default: true,
          country: '',
          street: '',
          apartment: '',
          city: '',
          state: '',
          zip: '',
          comment: ''
        }
      ],
      communication: null,
      communication_number: '',
    } as Profile | null,

    referralsState: {
      data: [] as Profile[],
      meta: null
    },
  }),
  
  getters: {
    profile: (state) => state.profileState,
    referrals: (state) => state.referralsState.data,
    referralsMeta: (state) => state.referralsState.meta,
  },

  actions: {

    setProfileData(data: Profile) {
      if(!data)
        return 

      Object.keys(data).forEach((k) => data[k] == null && delete data[k]);
      
      this.profileState = {
        ...this.profileState,
        ...data
      }
    },

    async getProfile() {
      const runtimeConfig = useRuntimeConfig()
      const url = `${runtimeConfig.public.apiBase}/profile`

      return await useApiFetch(url).then(({data, error}) => {

        if(data) {
          this.setProfileData(data as Profile)
          return this.profileState
        }

        if(error) {
          throw new Error(error.data)
        }
      })
    },

    async getReferrals(params = null) {
      const runtimeConfig = useRuntimeConfig()
      const query = params? '?' + new URLSearchParams(params).toString(): '';

      const { data, pending, error, refresh } = await useFetch(`${runtimeConfig.public.apiBase}/profile/referrals${query}`,{
        headers: {
          'Accept': 'application/json',
          'X-XSRF-TOKEN': useCookie('XSRF-TOKEN').value,
          'X-Requested-With': 'XMLHttpRequest'
        },
        credentials: 'include',
        onResponse({ request, response, options }) {
          console.log('refferals response', response._data)
          // Process the response data
          return response._data
        },
      });

      this.referralsState.data = this.referralsState.data.concat(data?.value?.data)
      this.referralsState.meta = data?.value?.meta
    },

    async updateProfile() {
      const runtimeConfig = useRuntimeConfig()

      return await useFetch(`${runtimeConfig.public.apiBase}/profile/update`,{
        method: 'POST',
        headers: {
          'Accept': 'application/json',
          'X-XSRF-TOKEN': useCookie('XSRF-TOKEN').value,
          'X-Requested-With': 'XMLHttpRequest'
        },
        credentials: 'include',
        body: this.profileState,
        onResponse({ request, response, options }) {
          console.log('PROFILE RESP', response._data)
        },
        onResponseError({ request, response, options }) {
          console.log('PROFILE RESP Error', response._data)
        }
      });

    },
  },
})