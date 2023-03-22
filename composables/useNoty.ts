export const useNoty = () => {
  const noties = useState('messages', () => [] as String[])

  const setNoty = (message: String, timeout: Number = 3000) => {
    noties.value.push(message)
    const thisIndex = noties.length - 1

    setTimeout(() => {
      noties.value.splice(thisIndex, 1)
    }, timeout)
  }

  return {
    noties,
    setNoty
  }
}