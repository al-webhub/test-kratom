export default defineEventHandler((event) => {
  const req = event.node.req
  const host = req.headers.host

  let fromPath = req.url.split('?')[0];
  let fromQuery = '';
  
  if (req.url.includes("?")) {
    fromQuery = '?' + req.url.split('?')[1]
  }

  if (fromPath !== '/' && fromPath.endsWith('/')) {
    const toPath = fromPath.replace(/\/+$/, '') || '/'
    const toRoute = toPath + fromQuery

    return sendRedirect(event, toRoute, 301)
  }
})