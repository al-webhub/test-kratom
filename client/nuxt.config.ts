// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  runtimeConfig: {
    public: {
      base: 'http://super.kratomhelper.com:8888',
      apiBase: 'http://super.kratomhelper.com:8888/api'
    }
  },

  app: {
    pageTransition: { name: 'page-tr', mode: 'out-in' },
    layoutTransition: { name: 'layout-tr', mode: 'out-in' },
  },

  nitro: {
    compressPublicAssets: true,
  },

  css: [
    '@/assets/scss/global/main.scss'
  ],

  modules: [
    [
      '@nuxtjs/google-fonts',
      {
        families: {
          Montserrat: {
            wght: [400, 500, 700, 900]
          },
        }
      }
    ],
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
        },
        domains: ['super.kratomhelper.com:8888'],
        alias: {
          server: 'http://super.kratomhelper.com:8888'
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
    '@pinia-plugin-persistedstate/nuxt',
    [
      '@nuxtjs/i18n',
      {
        baseUrl: 'https://kratomhelper.com',
        defaultLocale: 'en',
        lazy: true,
        vueI18nLoader: true,
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
          datetimeFormats: {
            en: {
              short: {
                year: 'numeric',
                month: 'short',
                day: 'numeric'
              },
              long: {
                year: '2-digit',
                month: 'short',
                day: 'numeric',
                hour: 'numeric',
                minute: 'numeric'
              }
            },
            ru: {
              short: {
                year: 'numeric',
                month: 'short',
                day: 'numeric'
              },
              long: {
                year: '2-digit',
                month: 'short',
                day: 'numeric',
                hour: 'numeric',
                minute: 'numeric'
              }
            },
          },
        }
      }
    ]
  ],
})
