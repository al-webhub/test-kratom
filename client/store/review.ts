type Review = {
  id: number,
  text: string,
  likes: number,
  dislikes: number,
  owner: object,
  children: object[]
};

export const useReviewStore = defineStore('reviewStore', {
  state: () => ({ 
    allState: {
      data: [] as Review[],
      meta: null
    },
  }),
  
  getters: {
    all: (state) => state.allState.data,
    meta: (state) => state.allState.meta,
  },

  actions: {

    getAll(query: string) {
      const runtimeConfig = useRuntimeConfig()
      const params = query? '?' + new URLSearchParams(query).toString(): '';

      $fetch(runtimeConfig.public.apiBase + '/reviews' + params)
        .then(({ data, meta }) => {
          this.allState.data = this.allState.data.concat(data)
          this.allState.meta = meta
        })
        .catch((error) => console.log(error));
    },

    create(data: object) {
      const runtimeConfig = useRuntimeConfig()

      $fetch(runtimeConfig.public.apiBase + '/reviews', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
      })
        .then((review) => {
          this.allState.data.unshift(review as Review)
        })
        .catch((error) => console.log(error));
    },

    like(id: number, data: object) {
      const runtimeConfig = useRuntimeConfig()

      $fetch(`${runtimeConfig.public.apiBase}/reviews/${id}/like`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
      })
        .then(({likes, dislikes}) => {
          const index = this.allState.data.findIndex((item) => item.id === id)
          
          if(likes)
            this.allState.data[index].likes = likes
          else
            this.allState.data[index].dislikes = dislikes
        })
        .catch((error) => console.log(error));
    }
  },
})