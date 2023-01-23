import { useAuthStore } from '~/store/auth';

export default defineNuxtRouteMiddleware(async (to, from) => {
  const authStore = useAuthStore()
  const xsrf = useCookie('XSRF-TOKEN').value

  if(!xsrf) {
    authStore.getToken();
  }
})