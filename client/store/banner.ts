type Banner = {
  id: number,
  name: string,
  slug: string,
  items: object[]
};

export const useBannerStore = defineStore('bannerStore', {
  state: () => ({ 
    allState: {
      data: [] as Banner[],
      meta: Object
    },
    bannerState: null as Banner | null,
  }),
  getters: {
    all: (state) => state.allState.data,
    meta: (state) => state.allState.meta,
    banner: (state) => state.bannerState,
  },
  actions: {
    getAll(query: string) {
      const runtimeConfig = useRuntimeConfig()
      const params = query? '?' + new URLSearchParams(query).toString(): '';

      $fetch(runtimeConfig.public.apiBase + '/banners' + params)
        .then(({ data, meta }) => {
          this.allState.data = this.allState.data.concat(data)
          this.allState.meta = meta
        })
        .catch((error) => console.log(error));
    },

    getOne(slug: string|number) {
      const runtimeConfig = useRuntimeConfig()

      $fetch(runtimeConfig.public.apiBase + '/banners/' + slug)
        .then((response) => {
          this.bannerState = response
        })
        .catch((error) => console.log(error));
    },
  },
})