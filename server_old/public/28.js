(window.webpackJsonp=window.webpackJsonp||[]).push([[28,5],{14:function(t,e,n){"use strict";function s(t,e,n,s,i,a,o,r){var c,_="function"==typeof t?t.options:t;if(e&&(_.render=e,_.staticRenderFns=n,_._compiled=!0),s&&(_.functional=!0),a&&(_._scopeId="data-v-"+a),o?(c=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),i&&i.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(o)},_._ssrRegister=c):i&&(c=r?function(){i.call(this,(_.functional?this.parent:this).$root.$options.shadowRoot)}:i),c)if(_.functional){_._injectStyles=c;var d=_.render;_.render=function(t,e){return c.call(e),d(t,e)}}else{var l=_.beforeCreate;_.beforeCreate=l?[].concat(l,c):[c]}return{exports:t,options:_}}n.d(e,"a",(function(){return s}))},52:function(t,e,n){"use strict";n.r(e);var s={name:"reviewcard",data:function(){return{review:this.dataItem}},props:["dataItem"],methods:{},computed:{},watch:{dataItem:{handler:function(t){this.review=t},deep:!0}},created:function(){console.log(this.review)}},i=n(14),a=Object(i.a)(s,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",[n("div",{staticClass:"clients-say__info"},[n("span",{staticClass:"general-decor-elem"}),t._v(" "),n("div",{staticClass:"clients-say__info__text"},[n("div",{staticClass:"content js-content"},[n("p",[t._v(t._s(t.review.text))])])]),t._v(" "),n("button",{staticClass:"clients-say__info__more js-more js-button",attrs:{"data-target":"reviews"}},[t._v("Read more")])]),t._v(" "),n("div",{staticClass:"clients-say__item__footer"},[n("div",{staticClass:"clients-say__item__img",style:{backgroundImage:"url("+t.review.photo+")"}}),t._v(" "),n("p",{staticClass:"clients-say__item__name"},[t._v(t._s(t.review.name))])])])}),[],!1,null,null,null);e.default=a.exports}}]);