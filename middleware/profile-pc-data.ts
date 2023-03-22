import { useAuthStore } from '~/store/auth';
import { useProfileStore } from '~/store/profile';
import { useModalStore } from '~/store/modal';
import { useServerApiFetch } from '~~/composables/useServerApiFetch';
import { callWithNuxt } from '#app'

const getProfile = async () => {
  const runtimeConfig = useRuntimeConfig()
  const url = `${runtimeConfig.public.apiBase}/profile`

  return await useServerApiFetch(url).then(({data, error}) => {
    if(data) {
      return data
    }

    if(error) {
      return null
    }
  })
}

export default defineNuxtRouteMiddleware(async (to, from) => {
  if(useAuthStore().isAuth) {

    const profile = await getProfile()

    if(!profile)
      return false

    if(!profile.communication || !profile.communication_number || !profile.communication_number.length) {
      useModalStore().setData('pc', to.fullPath)
      useModalStore().open('pc')
      return false
    }
  }
})