export default defineEventHandler((event) => {
  const req = event.node.req
  const fullUrl = req.url;

  if(fullUrl !== fullUrl.toLowerCase()){
    return sendRedirect(event, fullUrl.toLowerCase(), 301)
  }
})