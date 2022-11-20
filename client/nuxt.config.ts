// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  css: [
    '@/assets/scss/global/main.scss'
  ],

  modules: [
    '@nuxtjs/device',
    '@nuxt/image-edge',
    [
      '@pinia/nuxt',
      {
        autoImports: [
          // automatically imports `defineStore`
          'defineStore', // import { defineStore } from 'pinia'
          // automatically imports `defineStore` as `definePiniaStore`
          //['defineStore', 'definePiniaStore'], // import { defineStore as definePiniaStore } from 'pinia'
        ],
      },
    ],
    [
      '@nuxtjs/i18n',
      {
        defaultLocale: 'en',
        lazy: true,
        langDir: 'lang/',
        locales: [
          {
            code: 'ru',
            file: 'ru.json',
            name: 'Русский',
            shortName: 'RU',
          }, 
          {
            code: 'en',
            file: 'en.json',
            name: 'English',
            shortName: 'EN',
          }
        ],
        vueI18n: {
          fallbackLocale: 'en',
        }
      }
    ]
  ]
})
