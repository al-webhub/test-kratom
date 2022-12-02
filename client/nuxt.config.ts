// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  css: [
    '@/assets/scss/global/main.scss'
  ],

  modules: [
    '@nuxtjs/device',
    [
      '@nuxt/image-edge',
      {
        screens: {
          mobile: 320,
          tablet: 768,
          desktop: 1024,
          large: 1440,
        },
        presets: {
          base: {
            modifiers: {
              format: 'webp',
            }
          }
        }
      }
    ],
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
        baseUrl: 'https://kratomhelper.com',
        defaultLocale: 'en',
        lazy: true,
        langDir: 'lang/',
        locales: [
          {
            iso: 'ru-RU',
            code: 'ru',
            file: 'ru.json',
            name: 'Русский',
            shortName: 'RU',
          }, 
          {
            iso: 'en-US',
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
