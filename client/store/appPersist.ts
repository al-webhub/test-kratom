export const useAppPersistStore = defineStore('appPersistStore', {
  persist: true,

  state: () => ({ 
    
    popups: {
      adult: {
        isShow: true
      } as ModalObject
    },

  }),
  
  getters: {
    adult: (state) => state.popups.adult.isShow,
  },

  actions: {
    close(name: "adult") {
      this.popups[name].isShow = false
    },

    open(name: "adult") {
      this.popups[name].isShow = false
    },

    toggle(name: "adult") {
      this.popups[name].isShow = !this.popups[name].isShow
    }
  },
})