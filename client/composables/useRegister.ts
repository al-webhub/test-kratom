import { useAuthStore } from '~/store/auth';

export const useRegister = () => {
  const nuxtApp = useNuxtApp()
  const authStore = useAuthStore()

  return async (data: Auth, redirectTo: string | null = null) => {
    return await authStore.register(data)
      .then((res) => {
        if(res.data._value) {
          useNoty().setNoty(nuxtApp.$i18n.t('noty.registe_success'), 3000)
        }

        if(redirectTo)
          return navigateTo(redirectTo)
      }).catch((error) => {
        useNoty().setNoty(nuxtApp.$i18n.t('noty.registe_fail'), 5000)
        throw error
      })
  }
}