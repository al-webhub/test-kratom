export const useAccount = () => {
  const title = useState('titleState', () => '' as String)

  const setTitle = (newTitle: String) => {
    title.value = newTitle
  }

  return {
    title,
    setTitle
  }
}