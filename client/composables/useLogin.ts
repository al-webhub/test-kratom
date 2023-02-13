import { useAuthStore } from '~/store/auth';

export const useLogin = () => {
  const nuxtApp = useNuxtApp()

  return async (redirectTo: string | null = null) => {

    return await useAuthStore().login().then((res) => {

      if(res.data._value) {
        useNoty().setNoty(nuxtApp.$i18n.t('noty.login_success'), 3000)
      }

      if(res.error._value) {
        useNoty().setNoty(nuxtApp.$i18n.t('noty.login_failed'), 5000)
        throw new Error(res.error._value)
      }

      if(redirectTo)
        return navigateTo(redirectTo)
    })
  }
}