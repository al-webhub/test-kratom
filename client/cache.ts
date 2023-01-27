import { RenderResponse } from "nitropack"

export default defineNitroPlugin((nitroApp) => {
    nitroApp.hooks.hook('render:response', (res: RenderResponse) => {
        res.headers['cache-control'] = `max-age=${60*60*24*365}`
    })
})