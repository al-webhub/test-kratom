type Banner = {
  id: number,
  name: string,
  slug: string,
  items: object[]
};

export const useBannerStore = defineStore('bannerStore', {
  state: () => ({ 
    bannerState: null as Banner | null,
  }),
  
  getters: {
    banner: (state) => state.bannerState,
  },

  actions: {
    async getOne(slug: string|number) {
      const runtimeConfig = useRuntimeConfig()
      const url = `${runtimeConfig.public.apiBase}/banners/${slug}`

      await useApiFetch(url).then((response) => {
        if(response.data)
          this.bannerState = response.data
      })
    },
  },
})