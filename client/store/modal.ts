export const useModalStore = defineStore('modalStore', {

  state: () => ({
    chooseKratom: {
      isShow: false,
      data: null
    } as ModalObject,
    
    buy1: {
      isShow: false,
      data: null
    } as ModalObject,

    withdrawal: {
      isShow: false
    } as ModalObject,

    cart: {
      isShow: false
    } as ModalObject,

    search: {
      isShow: false
    } as ModalObject,

    signInSocial: {
      isShow: false
    } as ModalObject,

    signInEmail: {
      isShow: false
    } as ModalObject,

    changePassword: {
      isShow: false
    } as ModalObject,

    logInEmail: {
      isShow: false
    } as ModalObject,

    logInPassword: {
      isShow: false
    } as ModalObject,

    logOut: {
      isShow: false
    } as ModalObject,

  }),
  
  getters: {
    show: (state) => {
      return (name: Modal) => state[name].isShow
    },

    data: (state) => {
      return (name: Modal) => state[name].data
    },
  },

  actions: {
    close(name: Modal) {
      this[name].isShow = false
    },

    open(name: Modal) {
      this.closeAll()
      this[name].isShow = true
    },

    toggle(name: Modal) {
      this[name].isShow = !this[name].isShow
    },
    
    closeAll() {
      for (const [key, value] of Object.entries(this.$state)) {
        this[key].isShow = false
      }
    },

    setData(name: Modal, data: Object) {
      this[name].data = data
    }
  },
})