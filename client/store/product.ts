import { defineStore } from "pinia";

type ProductSmall = {
  id: number,
  name: string,
  slug: string,
  price: number,
  image: object,
  old_price?: number,
  excerpt: string,
  stimulation?: number,
  relaxation?: number,
  euphoria?: number,
  modifications: object[]
};

type ProductLarge = {
  id: number,
  name: string,
  slug: string,
  price: number,
  images: object[],
  old_price?: number,
  content: string,
  category: object,
  stimulation: number,
  relaxation: number,
  euphoria: number,
  modifications: object[]
};

export const useProductStore = defineStore('productStore', {
  state: () => ({ 
    allState: {
      data: [] as ProductSmall[],
      meta: Object
    },

    productState: null as ProductLarge | null,

    searchState: {
      data: [] as ProductSmall[],
      meta: Object
    },

    gridData: [] as ProductSmall[]
  }),
  
  getters: {
    all: (state) => state.allState.data,
    meta: (state) => state.allState.meta,
    product: (state) => state.productState,
    found: (state) => state.searchState.data,
    grid: (state) => state.gridData,
  },

  actions: {
    async search(query: string) {
      await this.index(query).then(({ data }) => {
        this.searchState.data = data.data
        this.searchState.meta = data.meta
      })
    },

    async index(query: string) {
      const runtimeConfig = useRuntimeConfig()
      const url = runtimeConfig.public.apiBase + '/products'

      return await useApiFetch(url, query)
    },

    async getAll(query: string, refresh: boolean = true) {
      await this.index(query).then(({ data }) => {
        if(!data)
          return

        if(refresh)
          this.allState.data = data.data
        else
          this.allState.data = this.allState.data.concat(data.data)

        this.allState.meta = data.meta
      })
    },

    async getRandom(id: Number) {
      const runtimeConfig = useRuntimeConfig()
      const url = `${runtimeConfig.public.apiBase}/products/random?not_id=${id}`;

      return await useApiFetch(url)
        .then(({data, error}) => {

          if(data && data.data) {
            this.gridData = data.data
            return data.data
          }

          if(error)
            throw new Error(error)
        })
    },

    async getOne(slug: string) {
      const runtimeConfig = useRuntimeConfig()
      const url = `${runtimeConfig.public.apiBase}/products/${slug}`;

      return await useApiFetch(url).then(({data, error}) => {
        if(data && data.data) {
          this.productState = data.data
          return data.data
        }
        
        if(error)
          throw new Error(error)
      })
    },

    async getSimilar(params: Object) {
      const runtimeConfig = useRuntimeConfig()
      const url = `${runtimeConfig.public.apiBase}/products/similar`;

      return await useApiFetch(url, params, 'POST').then(({data, error}) => {
        
        if(data && data.data){
          return data.data
        }

        if(error)
          throw new Error(error)
      })
    },

    async updateQualities(id: number, data: object) {
      const runtimeConfig = useRuntimeConfig()
      const url = `${runtimeConfig.public.apiBase}/products/${id}/updateQualities`;

      return await useApiFetch(url, data, 'POST').then(({data, error}) => {
        if(data)
          return data

        if(error)
          throw Error(error)
      })
    }
  },
})