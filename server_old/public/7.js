(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[7],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/infinitySlider.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/infinitySlider.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  name: 'infinitySlider',
  data: function data() {
    return {
      items: this.dataItems,
      type: this.dataType,
      button: this.dataButton,
      component: null,
      currentIndex: 0,
      link: this.dataLink,
      translateX: 0,
      shows: [0, 1, 2, 3]
    };
  },
  props: ['dataItems', 'dataType', 'dataLink', 'dataButton', 'dataClassList', 'dataClassItem'],
  methods: {
    loader: function loader() {
      if (!this.type) {
        return null;
      }

      return __webpack_require__("./resources/js/components lazy recursive ^\\.\\/.*$")("./".concat(this.type));
    },
    prevSlide: function prevSlide(event) {
      var container = event.target.closest('.slider-infinity').querySelector('.js-infinity-slider-list');
      var allItems = container.querySelectorAll('.js-slider-item-infinity');
      var componentThis = this; // this.items.unshift(this.items[this.items.length-1]);
      // this.shows = this.shows.map(function(item){
      //     // console.log(item);
      //     return item-1;
      // });

      /*			    
      			    if(this.currentIndex >= 1)
      			    	this.currentIndex--;
      			    else
      			    	this.currentIndex = this.scaledItems.length - 5;
      */

      this.currentIndex--;
    },
    nextSlide: function nextSlide(event) {
      //var first = this.items.shift();
      var container = event.target.closest('.slider-infinity').querySelector('.js-infinity-slider-list');
      var allItems = container.querySelectorAll('.js-slider-item-infinity'); // this.items.push(this.items[0]);
      // this.shows = this.shows.map(function(item){
      //     // console.log(item);
      //     return item+1;
      // });

      /*			    
      				if(this.currentIndex < this.scaledItems.length - 5)
      			    	this.currentIndex++;
      			    else
      			    	this.currentIndex = 0;
      */
      // this.currentIndex++;
    }
  },
  computed: {
    scaledItems: function scaledItems() {
      //return this.items.concat(this.items);
      return this.items;
    },
    width: function width() {
      return {
        width: this.items.length * 330 + 'px'
      };
    },
    transform: function transform() {
      var pixels = this.currentIndex * 330 * -1;
      return {
        transform: 'translateX(' + pixels + 'px)'
      };
    }
  },
  mounted: function mounted() {
    var _this = this;

    this.loader().then(function () {
      _this.component = function () {
        return _this.loader();
      };
    });
  },
  watch: {},
  created: function created() {}
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/infinitySlider.vue?vue&type=template&id=332f83b4&":
/*!*****************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/infinitySlider.vue?vue&type=template&id=332f83b4& ***!
  \*****************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c(
      "ul",
      {
        staticClass: "js-infinity-slider-list",
        class: _vm.dataClassList,
        style: [_vm.transform, _vm.width]
      },
      _vm._l(_vm.scaledItems, function(item, index) {
        return _c(
          "li",
          {
            staticClass: "js-slider-item-infinity",
            class: [{ show: _vm.shows.indexOf(index) != -1 }, _vm.dataClassItem]
          },
          [
            _c(
              "transition",
              { attrs: { name: "fade" } },
              [
                _c(
                  "keep-alive",
                  [
                    _c(_vm.component, {
                      tag: "component",
                      attrs: { "data-item": item }
                    })
                  ],
                  1
                )
              ],
              1
            )
          ],
          1
        )
      }),
      0
    ),
    _vm._v(" "),
    _c("div", { staticClass: "general-slider__buttons js-arrow-infinity" }, [
      _c(
        "button",
        {
          staticClass: "slider-button prev",
          on: {
            click: function($event) {
              return _vm.prevSlide($event)
            }
          }
        },
        [_c("span", { staticClass: "icon-arrow-left" })]
      ),
      _vm._v(" "),
      _c(
        "div",
        { staticClass: "dots__list" },
        _vm._l(_vm.items, function(item, key) {
          return (key + 1) % 3 == 0
            ? _c("div", {
                staticClass: "dots__item js-dot",
                class: { active: key + 1 == 3 }
              })
            : _vm._e()
        }),
        0
      ),
      _vm._v(" "),
      _c("a", { staticClass: "main-button", attrs: { href: _vm.link } }, [
        _c("span", { staticClass: "text" }, [_vm._v(_vm._s(_vm.button))])
      ]),
      _vm._v(" "),
      _c(
        "button",
        {
          staticClass: "slider-button next",
          on: {
            click: function($event) {
              return _vm.nextSlide($event)
            }
          }
        },
        [_c("span", { staticClass: "icon-arrow-right" })]
      )
    ])
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js":
/*!********************************************************************!*\
  !*** ./node_modules/vue-loader/lib/runtime/componentNormalizer.js ***!
  \********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return normalizeComponent; });
/* globals __VUE_SSR_CONTEXT__ */

// IMPORTANT: Do NOT use ES2015 features in this file (except for modules).
// This module is a runtime utility for cleaner component module output and will
// be included in the final webpack user bundle.

function normalizeComponent (
  scriptExports,
  render,
  staticRenderFns,
  functionalTemplate,
  injectStyles,
  scopeId,
  moduleIdentifier, /* server only */
  shadowMode /* vue-cli only */
) {
  // Vue.extend constructor export interop
  var options = typeof scriptExports === 'function'
    ? scriptExports.options
    : scriptExports

  // render functions
  if (render) {
    options.render = render
    options.staticRenderFns = staticRenderFns
    options._compiled = true
  }

  // functional template
  if (functionalTemplate) {
    options.functional = true
  }

  // scopedId
  if (scopeId) {
    options._scopeId = 'data-v-' + scopeId
  }

  var hook
  if (moduleIdentifier) { // server build
    hook = function (context) {
      // 2.3 injection
      context =
        context || // cached call
        (this.$vnode && this.$vnode.ssrContext) || // stateful
        (this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext) // functional
      // 2.2 with runInNewContext: true
      if (!context && typeof __VUE_SSR_CONTEXT__ !== 'undefined') {
        context = __VUE_SSR_CONTEXT__
      }
      // inject component styles
      if (injectStyles) {
        injectStyles.call(this, context)
      }
      // register component module identifier for async chunk inferrence
      if (context && context._registeredComponents) {
        context._registeredComponents.add(moduleIdentifier)
      }
    }
    // used by ssr in case component is cached and beforeCreate
    // never gets called
    options._ssrRegister = hook
  } else if (injectStyles) {
    hook = shadowMode
      ? function () {
        injectStyles.call(
          this,
          (options.functional ? this.parent : this).$root.$options.shadowRoot
        )
      }
      : injectStyles
  }

  if (hook) {
    if (options.functional) {
      // for template-only hot-reload because in that case the render fn doesn't
      // go through the normalizer
      options._injectStyles = hook
      // register for functional component in vue file
      var originalRender = options.render
      options.render = function renderWithStyleInjection (h, context) {
        hook.call(context)
        return originalRender(h, context)
      }
    } else {
      // inject component registration as beforeCreate hook
      var existing = options.beforeCreate
      options.beforeCreate = existing
        ? [].concat(existing, hook)
        : [hook]
    }
  }

  return {
    exports: scriptExports,
    options: options
  }
}


/***/ }),

/***/ "./resources/js/components lazy recursive ^\\.\\/.*$":
/*!****************************************************************!*\
  !*** ./resources/js/components lazy ^\.\/.*$ namespace object ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var map = {
	"./ExampleComponent": [
		"./resources/js/components/ExampleComponent.vue",
		3
	],
	"./ExampleComponent.vue": [
		"./resources/js/components/ExampleComponent.vue",
		3
	],
	"./homeBanners": [
		"./resources/js/components/homeBanners.vue",
		4
	],
	"./homeBanners.vue": [
		"./resources/js/components/homeBanners.vue",
		4
	],
	"./infinitySlider": [
		"./resources/js/components/infinitySlider.vue"
	],
	"./infinitySlider.vue": [
		"./resources/js/components/infinitySlider.vue"
	],
	"./pageReviews": [
		"./resources/js/components/pageReviews.vue",
		1
	],
	"./pageReviews.vue": [
		"./resources/js/components/pageReviews.vue",
		1
	],
	"./productCard": [
		"./resources/js/components/productCard.vue",
		0
	],
	"./productCard.vue": [
		"./resources/js/components/productCard.vue",
		0
	],
	"./productReviews": [
		"./resources/js/components/productReviews.vue",
		2
	],
	"./productReviews.vue": [
		"./resources/js/components/productReviews.vue",
		2
	],
	"./productSlider": [
		"./resources/js/components/productSlider.vue",
		10,
		12
	],
	"./productSlider.vue": [
		"./resources/js/components/productSlider.vue",
		10,
		12
	],
	"./reviewCard": [
		"./resources/js/components/reviewCard.vue",
		6
	],
	"./reviewCard.vue": [
		"./resources/js/components/reviewCard.vue",
		6
	]
};
function webpackAsyncContext(req) {
	if(!__webpack_require__.o(map, req)) {
		return Promise.resolve().then(function() {
			var e = new Error("Cannot find module '" + req + "'");
			e.code = 'MODULE_NOT_FOUND';
			throw e;
		});
	}

	var ids = map[req], id = ids[0];
	return Promise.all(ids.slice(1).map(__webpack_require__.e)).then(function() {
		return __webpack_require__(id);
	});
}
webpackAsyncContext.keys = function webpackAsyncContextKeys() {
	return Object.keys(map);
};
webpackAsyncContext.id = "./resources/js/components lazy recursive ^\\.\\/.*$";
module.exports = webpackAsyncContext;

/***/ }),

/***/ "./resources/js/components/infinitySlider.vue":
/*!****************************************************!*\
  !*** ./resources/js/components/infinitySlider.vue ***!
  \****************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _infinitySlider_vue_vue_type_template_id_332f83b4___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./infinitySlider.vue?vue&type=template&id=332f83b4& */ "./resources/js/components/infinitySlider.vue?vue&type=template&id=332f83b4&");
/* harmony import */ var _infinitySlider_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./infinitySlider.vue?vue&type=script&lang=js& */ "./resources/js/components/infinitySlider.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _infinitySlider_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _infinitySlider_vue_vue_type_template_id_332f83b4___WEBPACK_IMPORTED_MODULE_0__["render"],
  _infinitySlider_vue_vue_type_template_id_332f83b4___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/infinitySlider.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/infinitySlider.vue?vue&type=script&lang=js&":
/*!*****************************************************************************!*\
  !*** ./resources/js/components/infinitySlider.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_infinitySlider_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./infinitySlider.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/infinitySlider.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_infinitySlider_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/infinitySlider.vue?vue&type=template&id=332f83b4&":
/*!***********************************************************************************!*\
  !*** ./resources/js/components/infinitySlider.vue?vue&type=template&id=332f83b4& ***!
  \***********************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_infinitySlider_vue_vue_type_template_id_332f83b4___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./infinitySlider.vue?vue&type=template&id=332f83b4& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/infinitySlider.vue?vue&type=template&id=332f83b4&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_infinitySlider_vue_vue_type_template_id_332f83b4___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_infinitySlider_vue_vue_type_template_id_332f83b4___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);