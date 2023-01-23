import { useAuthStore } from '~/store/auth';

export const useLogout = () => {
  const nuxtApp = useNuxtApp()
  const authStore = useAuthStore()

  return async (redirectTo: string | null = null) => {
    const {setNoty} = useNoty()

    return await authStore.logout().then((res) => {
      setNoty(nuxtApp.$i18n.t('noty.logout'), 5000)

      if(redirectTo)
        return navigateTo(redirectTo)
    })
  }
}