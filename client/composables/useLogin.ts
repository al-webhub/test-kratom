import { useAuthStore } from '~/store/auth';

export const useLogin = () => {
  const nuxtApp = useNuxtApp()
  const authStore = useAuthStore()

  return async (redirectTo: string | null = null) => {
    const {setNoty} = useNoty()

    return await authStore.login().then((res) => {

      if(res.data._value) {
        setNoty(nuxtApp.$i18n.t('noty.login_success'), 3000)
        authStore.closeAll()
      }

      if(res.error._value)
        setNoty(nuxtApp.$i18n.t('noty.login_failed'), 5000)

      if(redirectTo)
        return navigateTo(redirectTo)
    })
  }
}