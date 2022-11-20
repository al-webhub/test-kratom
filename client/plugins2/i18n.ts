import { createI18n } from 'vue-i18n'

export default defineNuxtPlugin(({ vueApp }) => {
  const i18n = createI18n({
    //legacy: false,
    globalInjection: true,
    locale: 'en',
    lazy: true,
		langDir: 'lang/',
    locales: [
    	{
	    	code: 'ru',
				file: 'ru.js',
				name: 'Русский',
				shortName: 'RU',
	    }, 
    	{
	    	code: 'en',
				file: 'en.js',
				name: 'English',
				shortName: 'EN',
	    }
    ],
    defaultLocale: 'en',
    vueI18n: {
      fallbackLocale: 'ru',
      //messages: {}
    }
  })

  vueApp.use(i18n)
})