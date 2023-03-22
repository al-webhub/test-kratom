const vObserve = {
  
  options: {
    root: null,
    rootMargin: '0px',
    threshold: 1.0
  },

  callback: (v, observer) => {
    v.forEach((entry) => {
      console.log('observ', entry.isIntersecting, entry, observer)
    })
  },

  observer: null,

  mounted: (el, binding, vnode, prevVnode) => {
    const index = binding.value.index

    const observer = new IntersectionObserver((v) => {
      v.forEach((entry) => {
        binding.value.callback(index, entry.isIntersecting)
        //console.log('observ', entry.isIntersecting, entry, observer)
      })
    }, vObserve.options)

    //binding.value.callback(index, 'a1', 'a2')

    // if(binding.instance[binding.value]) {
    //   binding.instance[binding.value]('arg1', 'gop2')
    // }

    observer.observe(el)

    // console.log('FUNCTION', binding.value)
    // console.log('vObserve', el, binding, vnode, prevVnode)
  }
}

export default defineNuxtPlugin((nuxtApp) => {
  nuxtApp.vueApp.directive('observe', vObserve)
})