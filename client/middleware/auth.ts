import { useProfileStore } from '~/store/profile';
// import { useAuthStore } from '~/store/auth';

export default defineNuxtRouteMiddleware(async (to, from) => {

  const profileStore = useProfileStore()
  // const authStore = useAuthStore()
  
  return await profileStore.getProfile().then((res) => {
    if(res.error._value) {
      return navigateTo('/')
      //return abortNavigation(res.error._value)
    }
  })
  
})