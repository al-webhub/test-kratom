import dynamicRoutes from './helpers/dynamicRoutes'

// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  appConfig: {
    SITE_URL: process.env.SITE_URL
  },

  runtimeConfig: {
    public: {
      siteUrl: process.env.SITE_URL || 'https://kratomhelper.com',
      base: process.env.SERVER_URL,
      apiBase: process.env.API_SERVER_URL
    }
  },

  app: {
    pageTransition: { name: 'page-tr', mode: 'out-in' },
    layoutTransition: { name: 'layout-tr', mode: 'out-in' },
    head: {
      script: [
        { src: `https://www.googletagmanager.com/gtm.js?id=${process.env.GTM}`, async: true, type: 'text/partytown' },
      ],
    },
  },

  css: [
    '@/assets/scss/global/main.scss'
  ],
  
  // webpack: {
  //   analyze: true,
  //   extractCSS: true,
  //   optimization: {
  //     minimize: true,
  //     removeAvailableModules: true,
  //     removeEmptyChunks: true,
  //   },
  // },
  
  // sourcemap: false,

  experimental: {
    // asyncEntry: true,
    // viteServerDynamicImports: true
    payloadExtraction: false
  },
  
  debug: false,

  nitro: {
    // preset: 'node-server',

    // noPublicDir: true,
    
    compressPublicAssets: { 
      gzip: true, 
      brotli: true 
    },

    minify: true,

    prerender: {
      crawlLinks: true,
      routes: [
        '/',
      ]
    },

    routeRules: {
      '/pages/**': { static: true, headers: { 'Cache-Control': 'max-age=31536000, immutable' } },
      '/assets/**': { headers: { 'Cache-Control': 'max-age=31536000, immutable' } },
      '/images/**': { headers: { 'Cache-Control': 'max-age=31536000, immutable' } },
      '/_nuxt/**': { headers: { 'Cache-Control': 'max-age=31536000, immutable' } },
      '/**/*.js': { headers: { 'Cache-Control': 'max-age=31536000, immutable' } },
      '/**/*.css': { headers: { 'Cache-Control': 'max-age=31536000, immutable' } },
      '/**/*.json': { headers: { 'Cache-Control': 'max-age=31536000, immutable' } },
      '/**/*.html': { headers: { 'Cache-Control': 'max-age=31536000, immutable' } },
      '/**/*.xml': { headers: { 'Cache-Control': 'max-age=31536000, immutable' } },
      '/**/*.svg': { headers: { 'Cache-Control': 'max-age=31536000, immutable' } },
    }
  },
  

  // vite: {
  //   build: {
  //     assetsInlineLimit: 0
  //   }
  //   optimizeDeps: {
  //     exclude: ['@vue/server-renderer', '@vue/runtime-core']
  //   }
  // },

  modules: [
    [
      '@nuxtjs/partytown',
      {
        debug: process.env.NODE_ENV === 'development',
        forward: ['dataLayer.push']
      }
    ],
    [
      '@nuxtjs/web-vitals',
      {
        debug: process.env.NODE_ENV === 'development',
        disabled: process.env.NODE_ENV === 'development',
        ga: { id: process.env.GA }
      }
    ],
    '@nuxtjs/html-validator',
    [
      'nuxt-simple-sitemap',
      {
        enabled: true,
        exclude: [
            '/account/**'
        ],
        defaults: {
          changefreq: 'daily',
          priority: 1,
          lastmod: new Date().toISOString(),
        },
        urls: dynamicRoutes
      }
    ],
    'nuxt-schema-org',
    '@nuxtjs/device',
    '@nuxtjs/fontaine',
    [
      'nuxt-delay-hydration',
      {
        mode: 'manual',
        debug: process.env.NODE_ENV === 'development'
      }
    ],
    [
      '@nuxtjs/google-fonts',
      {
        families: {
          Montserrat: {
            wght: [400, 700]
          },
        },
        display: 'swap',
        preload: true
      }
    ],
    [
      '@nuxt/image-edge',
      {
        provider: process.env.IMAGE_PROVIDER || "ipx",
        
        screens: {
          mobile: 320,
          tablet: 768,
          desktop: 1024,
          large: 1440,
        },
        
        domains: [process.env.DOMAIN],
        
        alias: {
          server: process.env.SERVER_URL
        },
        
        dir: process.env.IMAGE_DIR || "public",
        
        vercel: {
          dirname: 'public'
        },

        ipx: {
          domains: [
            process.env.DOMAIN
          ]
        }
      }
    ],
    [
      '@pinia/nuxt',
      {
        autoImports: [
          'defineStore',
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
        vueI18nLoader: false,
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
    ],
  ],
})
