type Popups = "adult"

export const useAppStore = defineStore('appStore', {
  persist: true,

  state: () => ({ 
    popups: {
      adult: true
    }
  }),
  
  getters: {
    adult: (state) => state.popups.adult,
  },

  actions: {
    close(name: Popups) {
      this.popups[name] = false
    },

    open(name: Popups) {
      this.popups[name] = false
    },

    toggle(name: Popups) {
      this.popups[name] = !this.popups[name]
    }
  },
})