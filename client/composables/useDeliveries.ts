import jsonData from '/lang/data.json'

export const useDeliveries = async () => {
  const nuxtApp = useNuxtApp()
  const messages = useState('deliveries', () => {
    return {
      times: [],
      methods: []
    }
  })

  const locale = await nuxtApp.$i18n.locale

  const times = await jsonData[locale.value]?.deliveries?.times
  const methods = await jsonData[locale.value]?.deliveries?.methods

  messages.value = {
    times: [],
    methods: []
  }
  
  Object.keys(times).forEach((key) => {
    messages.value.times.push(times[key].source || null)
  })

  Object.keys(methods).forEach((key) => {
    messages.value.methods.push(methods[key].source || null)
  })

  return messages
}