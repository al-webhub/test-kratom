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
  }),
  getters: {
    all: (state) => state.allState.data,
    meta: (state) => state.allState.meta,
    product: (state) => state.productState,
  },
  actions: {
    getAll(query: string) {
      const runtimeConfig = useRuntimeConfig()
      const params = query? '?' + new URLSearchParams(query).toString(): '';

      $fetch(runtimeConfig.public.apiBase + '/products' + params)
        .then(({ data, meta }) => {
          this.allState.data = this.allState.data.concat(data)
          this.allState.meta = meta
        })
        .catch((error) => console.log(error));
    },

    getOne(slug: string) {
      const runtimeConfig = useRuntimeConfig()

      $fetch(runtimeConfig.public.apiBase + '/products/' + slug)
        .then(({data}) => (this.productState = data))
        .catch((error) => console.log(error));
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