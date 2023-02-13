import { useApiFetch } from "~~/composables/useApiFetch";

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
  }),
  
  getters: {
    all: (state) => state.allState.data,
    meta: (state) => state.allState.meta,
    product: (state) => state.productState,
    found: (state) => state.searchState.data,
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

      // return this.productState
    },

    async getSimilar(params: Object) {
      const runtimeConfig = useRuntimeConfig()
      const url = `${runtimeConfig.public.apiBase}/products/similar`;

      await useApiFetch(url, params).then(({data: {data}}) => {
        console.log('get one product', data)
      })
    },

    updateQualities(id: number, data: object) {
      const runtimeConfig = useRuntimeConfig()

      $fetch(`${runtimeConfig.public.apiBase}/products/${id}/updateQualities`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
      }).catch((error) => console.log(error));
    }
  },
})