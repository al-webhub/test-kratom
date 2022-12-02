export const useCartStore = defineStore('cartStore', {
  state: () => ({ is_show: false, data: [] }),
  getters: {
    show: (state) => state.is_show,
  },
  actions: {
    open() {
      this.is_show = true
    },
    close() {
      this.is_show = false
    },
    toggle() {
      this.is_show = !this.is_show
    }
  },
})