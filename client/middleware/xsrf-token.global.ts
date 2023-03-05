import { useAuthStore } from '~/store/auth';

export default defineNuxtRouteMiddleware((to, from) => {
  if (process.server) return
  
  const authStore = useAuthStore()
  const xsrf = useCookie('XSRF-TOKEN').value

  if(!xsrf) {
    authStore.getToken();
  }
})