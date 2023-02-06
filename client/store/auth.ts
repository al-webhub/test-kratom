type Profile = {
  id: number | null,
  email: string,
  fullname: string,
  firstname: string | null,
  lastname: string | null,
  photo: string | null
};

export const useAuthStore = defineStore('authStore', {
  persist: true,

  state: () => ({
    isShow: {
      logInEmail: false,
      logInPassword: false,
      logOut: false,
      signInEmail: false,
      signInSocial: false,
      checkEmail: false,
      changePassword: false,
    },
    
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
    showLogInEmail: (state) => state.isShow.logInEmail,
    showLogInPassword: (state) => state.isShow.logInPassword,
    showLogOut: (state) => state.isShow.logOut,
    showSignInEmail: (state) => state.isShow.signInEmail,
    showSignInSocial: (state) => state.isShow.signInSocial,
    showCheckEmail: (state) => state.isShow.checkEmail,
    showChangePassword: (state) => state.isShow.changePassword,
    getUser: (state) => state.user,
    getErrors: (state) => state.errors,
    isAuth: (state) => state.authenticated,
    redirectTo: (state) => state.redirectToState,
    getReferrerCode: (state) => state.referrerCode
  },

  actions: {
    open(target:string) {
      this.closeAll()
      this.isShow[target] = true
    },
    
    close(target:string) {
      this.isShow[target] = false
    },
    
    toggle(target:string) {
      this.isShow[target] = !this[target]
    },
    
    closeAll() {
      for (const [key, value] of Object.entries(this.isShow)) {
        this.isShow[key] = false
      }
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

    async login() {
      const runtimeConfig = useRuntimeConfig()
      const context = this
      const locale = useNuxtApp().$i18n.locale
      
      await this.getToken()

      return await useFetch(`${runtimeConfig.public.base}/login`,{
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-XSRF-TOKEN': useCookie('XSRF-TOKEN').value,
          'Accept-Language': locale.value
        },
        referrer: '',
        credentials: 'include',
        body: this.user,
        onRequestError({ request, options, error }) {
          // Handle the request errors
          console.log('onRequestError', request, options, error)
        },
        onResponse({ request, response, options }) {
          if(!response.ok || !response._data) {
            context.authenticated = false
            throw new Error('No user data')
          }

          context.setProfileData(response._data)
          context.authenticated = true
          context.errors = {}
        },
        onResponseError({ request, response, options }) {
          context.authenticated = false
          context.errors = response._data
        }
      })

    },

    async register() {
      const runtimeConfig = useRuntimeConfig()
      const locale = useNuxtApp().$i18n.locale
      const context = this

      await this.getToken()

      return await useFetch(`${runtimeConfig.public.base}/register`,{
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-XSRF-TOKEN': useCookie('XSRF-TOKEN').value,
          'Accept-Language': locale.value
        },
        credentials: 'include',
        body: {
          referrer_code: this.referrerCode,
          ...this.user,
        },
        onResponse({ request, response, options }) {
          if(!response.ok || !response._data) {
            context.authenticated = false
            context.errors = response._data
            throw new Error('No user data')
          }

          context.setProfileData(response._data)
          context.authenticated = true
          context.errors = {}
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