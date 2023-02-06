import { useAuthStore } from '~/store/auth';

export default defineNuxtRouteMiddleware(async (to, from) => {
  const token = to.query?.token

  if(token){
    useAuthStore().getUserByToken(token)
    //await useAsyncData('loginUserByToken', () => useAuthStore().getUserByToken(token)) 
    
    //return '/'
    // const locale = nuxtApp.$i18n.locale.value === nuxtApp.$i18n.fallbackLocale.value ? '' : '/' + nuxtApp.$i18n.locale.value;
    // return callWithNuxt(nuxtApp, navigateTo, [locale])
  }

})