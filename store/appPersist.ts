export const useAppPersistStore = defineStore('appPersistStore', {
  persist: true,

  state: () => ({ 
    
    popups: {
      adult: {
        isShow: false,
        data: true
      } as ModalObject
    },

  }),
  
  getters: {
    adult: (state) => state.popups.adult.isShow,
    adultIsNew: (state) => state.popups.adult.data
  },

  actions: {
    close(name: "adult") {
      this.popups[name].isShow = false
    },

    open(name: "adult") {
      this.popups[name].isShow = true
    },

    toggle(name: "adult") {
      this.popups[name].isShow = !this.popups[name].isShow
    },

    setData(name: "adult", data: Object | String) {
      this.popups[name].data = data
    }
  },
})