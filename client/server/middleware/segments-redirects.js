export default defineEventHandler((event) => {
  const req = event.node.req
  const host = req.headers.host
  const from = req.url

  const findSegments = /\/en-gh|\/index.php/ig

  if(from.match(findSegments)) {
    const to = from.replace(findSegments, '')
    const url = 'https://' + host + to

    return sendRedirect(event, url, 301)
  }
})