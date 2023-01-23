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
      isShow: false,
      data: [] as ProductSmall[],
      meta: Object
    },

    chooseKratom: {
      isShow: false,
      data: [] as ProductSmall[],
    }
  }),
  
  getters: {
    all: (state) => state.allState.data,
    meta: (state) => state.allState.meta,
    product: (state) => state.productState,
    found: (state) => state.searchState.data,
    livesearchIsShow: (state) => state.searchState.isShow,
    chooseKratomIsShow: (state) => state.chooseKratom.isShow
  },

  actions: {
    toggleModal(name) {
      if(name)
        this[name].isShow = !this[name].isShow
      else
        this.searchState.isShow = !this.searchState.isShow
    },

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

      await useApiFetch(url).then(({data: {data}}) => {
        console.log('get one product', data)
        if(data)
          this.productState = data
      })

      return this.productState
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