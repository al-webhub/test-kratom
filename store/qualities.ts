export const useQualitiesStore = defineStore('qualitiesStore', {
  persist: true,

  state: () => ({ 
    marks: {},
  }),
  
  getters: {
    getMarks: (state) => {
      return (id: number) => state.marks[id]
    }
  },

  actions: {
    setMark(id: number, key: string, value: number) {
      this.marks[id] = {
        ...this.marks[id] || {},
        ...{[key]: value}
      }
    },
  }
})