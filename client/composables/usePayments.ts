import jsonData from '/lang/data.json'

type Payment = {
  name: String,
  image: String
}

export const usePayments = async () => {
  const nuxtApp = useNuxtApp()
  
  const { locale } = useI18n({useScope: 'global'})

  const messages = useState('payments', () => [] as Payment[])

  const payments = await jsonData[locale.value]?.payment?.options

  messages.value = []
  
  Object.keys(payments).forEach((key) => {
    messages.value.push({
      name: payments[key].name?.source || null,
      image: payments[key].image?.source || null
    })
  })

  return messages
}