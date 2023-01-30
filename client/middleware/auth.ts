import { useProfileStore } from '~/store/profile';
import { callWithNuxt } from '#app'

export default defineNuxtRouteMiddleware(async (to, from) => {

  const profileStore = useProfileStore()
  const nuxtApp = useNuxtApp()

  let profile = null

  try{
    profile = await profileStore.getProfile()
  }catch(e) {
    profile = null
  }

  if (!profile) {
    const locale = nuxtApp.$i18n.locale.value === nuxtApp.$i18n.fallbackLocale.value ? '' : '/' + nuxtApp.$i18n.locale.value;
    return callWithNuxt(nuxtApp, navigateTo, [locale])
  }
  
})