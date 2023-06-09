import { useAuthStore } from '~/store/auth';

export default defineNuxtRouteMiddleware((to, from) => {
  const authStore = useAuthStore()

  const route = useRoute()
  
  if(route.query.ref)
    authStore.setReferrerCode(route.query.ref as string)
})