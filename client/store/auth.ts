export const useAuthStore = defineStore('authStore', {
  state: () => ({
    isShow: {
      logInEmail: false,
      logInPassword: false,
      logOut: false,
      signInEmail: false,
      signInSocial: false,
      checkEmail: false,
      changePassword: false,
    }
  }),
  getters: {
    showLogInEmail: (state) => state.isShow.logInEmail,
    showLogInPassword: (state) => state.isShow.logInPassword,
    showLogOut: (state) => state.isShow.logOut,
    showSignInEmail: (state) => state.isShow.signInEmail,
    showSignInSocial: (state) => state.isShow.signInSocial,
    showCheckEmail: (state) => state.isShow.checkEmail,
    showChangePassword: (state) => state.isShow.changePassword,
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
    }
  },
})