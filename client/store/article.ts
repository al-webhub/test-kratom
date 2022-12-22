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

    getAll(query: string) {
      const runtimeConfig = useRuntimeConfig()
      const params = query? '?' + new URLSearchParams(query).toString(): '';

      $fetch(runtimeConfig.public.apiBase + '/articles' + params)
        .then(({ data, meta }) => {
          this.allState.data = this.allState.data.concat(data)
          this.allState.meta = meta
        })
        .catch((error) => console.log(error));
    },

    getOne(slug: string) {
      const runtimeConfig = useRuntimeConfig()

      $fetch(runtimeConfig.public.apiBase + '/articles/' + slug)
        .then((data) => {
          this.articleState = data
        })
        .catch((error) => console.log(error));
    },
  },
})