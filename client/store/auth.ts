import { useLoginMock } from '~/composables/mockups/useLoginMock';

export const useAuthStore = defineStore('authStore', {
  persist: true,

  state: () => ({
    loginForm: {...useLoginMock()} as LoginForm,

    user: {
      id: null,
      photo: '/images/photo-log-in.png',
      firstname: '',
      lastname: '',
      fullname: '',
      email: '',
      password: '',
      password_confirmation: '',
      communication: null,
      communication_number: '',
    } as Profile,

    errors: {},
    
    authenticated: false,

    redirectToState: '/account/order-history',

    referrerCode: null as null | String
  }),

  getters: {
    getLogin: (state) => state.loginForm,
    getUser: (state) => state.user,
    getErrors: (state) => state.errors,
    isAuth: (state) => state.authenticated,
    redirectTo: (state) => state.redirectToState,
    getReferrerCode: (state) => state.referrerCode
  },

  actions: {
    
    resetLoginForm() {
      this.loginForm = {...useLoginMock()}
    },

    setIsAuth(value: boolean) {
      this.authenticated = value
    },

    setReferrerCode(code: string) {
      this.referrerCode = code
    },

    setProfileData(data: Profile) {
      Object.keys(data).forEach((k) => data[k] == null && delete data[k]);

      this.user = {
        ...this.user,
        ...data
      }
    },

    async getToken() {
      const runtimeConfig = useRuntimeConfig()
      const locale = useNuxtApp().$i18n.locale

      const res = await fetch(`${runtimeConfig.public.base}/sanctum/csrf-cookie`, {
        headers: {
          'Accept': 'application/json',
          'Accept-Language': locale.value
        },
        credentials: 'include'
      })
    },

    async logout() {
      const runtimeConfig = useRuntimeConfig()
      const context = this
      const locale = useNuxtApp().$i18n.locale

      const { data, pending, error, refresh } = await useFetch(`${runtimeConfig.public.base}/logout`,{
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-XSRF-TOKEN': useCookie('XSRF-TOKEN').value,
          'Accept-Language': locale.value
        },
        credentials: 'include',
        onResponse({ request, response, options }) {
          context.authenticated = false
        },
      });
    },

    async login(data: LoginForm) {
      const runtimeConfig = useRuntimeConfig()
      const url = `${runtimeConfig.public.base}/login`
      
      await this.getToken()

      return await useApiFetch(url, {...data}, 'POST')
        .then(({data, error}) => {
          if(data) {
            this.authenticated = true
            this.setProfileData(data)
            return data
          }

          if(error) {
            this.authenticated = false
            throw error
          }
        })
    },

    async register(data: Auth) {
      const runtimeConfig = useRuntimeConfig()
      const url = `${runtimeConfig.public.base}/register`

      await this.getToken()

      return await useApiFetch(url, {
          referrer_code: this.referrerCode,
          ...data,
        }, 'POST')
        .then(({data, error}) => {

          if(data) {
            this.setProfileData(data)
            this.authenticated = true
            return data
          }

          if(error) {
            this.authenticated = false
            throw error
          }
        })

    },

    async google() {
      const runtimeConfig = useRuntimeConfig()
      const url = `${runtimeConfig.public.base}/auth/google`

      return await useApiFetch(url, null, 'POST').then(({data}) => {
        if(data){
          navigateTo(data, {external: true})
        }
      })
    },

    async getUserByToken(token) {
      const runtimeConfig = useRuntimeConfig()
      const url = `${runtimeConfig.public.base}/auth/loginByToken?token=${token}`

      await this.getToken()

      return await useApiFetch(url).then(({data, error}) => {
        if(data) {
          this.setProfileData(data)
          this.authenticated = true
          return data
        }

        if(error)
          throw new Error(error)
      })

    }
  },
})