type Article = {
  id: number,
  title: string,
  slug: string,
  content: string,
  excerpt: string,
  image: string,
};

export const useArticleStore = defineStore('articleStore', {
  state: () => ({ 
    allState: {
      data: [] as Article[],
      meta: null
    },
    articleState: null as Article | null
  }),
  
  getters: {
    all: (state) => state.allState.data,
    meta: (state) => state.allState.meta,
    article: (state) => state.articleState,
  },

  actions: {

    async getAll(query: string, refresh: boolean = true) {
      const runtimeConfig = useRuntimeConfig()
      const params = query? '?' + new URLSearchParams(query).toString(): '';
      const url = `${runtimeConfig.public.apiBase}/articles${params}`

      await useApiFetch(url).then(({
        data: {data, meta}
      }) => {
        if(refresh)
          this.allState.data = data
        else
          this.allState.data = this.allState.data.concat(data)

        this.allState.meta = meta
      })
    },

    async getOne(slug: string) {
      const runtimeConfig = useRuntimeConfig()
      const url = `${runtimeConfig.public.apiBase}/articles/${slug}`

      return await useApiFetch(url).then(({data, error}) => {
        if(data) {
          this.articleState = data
        }
        
        if(error)
          throw new Error(error)  

        return data
      })
    },
  },
})