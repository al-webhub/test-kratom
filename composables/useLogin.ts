import { useAuthStore } from '~/store/auth';

export const useLogin = () => {
  const nuxtApp = useNuxtApp()

  return async (data: LoginForm, redirectTo: string | null = null) => {
    return await useAuthStore().login(data)
      .then((profile: Profile) => {
        if(profile) {
          useNoty().setNoty(nuxtApp.$i18n.t('noty.login_success'), 3000)
          return profile
        }

        if(redirectTo)
          return navigateTo(redirectTo)
      })
      .catch((e) => {
        useNoty().setNoty(nuxtApp.$i18n.t('noty.login_failed'), 5000)
        // e.message
        throw e.errors
      })
  }
}