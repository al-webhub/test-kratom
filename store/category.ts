type Category = {
  id: number,
  name: string,
  slug: string,
  children: object[]
};

export const useCategoryStore = defineStore('categoryStore', {
  state: () => ({ 
    allState: {
      data: [] as Category[],
      meta: Object
    },
    categoryState: null as Category | null,
  }),
  
  getters: {
    all: (state) => state.allState.data,
    category: (state) => state.categoryState,
  },

  actions: {
    getAll(query: string) {
      const runtimeConfig = useRuntimeConfig()
      const params = query? '?' + new URLSearchParams(query).toString(): '';

      $fetch(runtimeConfig.public.apiBase + '/categories' + params)
        .then(({ data, meta }) => {
          this.allState.data = data
          this.allState.meta = meta
        })
        .catch((error) => console.log(error));
    },

    async getOne(slug: string) {
      const runtimeConfig = useRuntimeConfig()
      const url = `${runtimeConfig.public.apiBase}/categories/${slug}`

      return await useApiFetch(url).then(({data: {data}}) => {
        if(data)
          this.categoryState = data
      })

      $fetch(runtimeConfig.public.apiBase + '/categories/' + slug)
        .then(({ data }) => (this.categoryState = data))
        .catch((error) => console.log(error));
    },
  },
})