(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[4],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/homeBanners.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/homeBanners.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************************************************************************************************/
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
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  name: 'homeBanners',
  data: function data() {
    return {
      banners: this.dataBanners,
      currentIndex: 0,
      bannersAmount: 0
    };
  },
  props: ['dataBanners'],
  methods: {
    getImage: function getImage(index) {
      return this.banners[index].badImage;
    },
    prevSlide: function prevSlide() {
      if (this.currentIndex >= 1) this.currentIndex--;else this.currentIndex = this.bannersAmount - 1;
    },
    nextSlide: function nextSlide() {
      if (this.currentIndex < this.bannersAmount - 1) this.currentIndex++;else this.currentIndex = 0;
    }
  },
  computed: {},
  watch: {},
  created: function created() {
    this.bannersAmount = this.dataBanners.length;
    var component = this;
    window.addEventListener("load", function (event) {
      console.log('was load');
      setTimeout(function () {
        for (var key in component.banners) {
          component.banners[key].badImage = component.banners[key].image;
        }
      }, 0);
      var sliderAutoStart;
      setTimeout(function () {
        var slider = document.querySelector('.main-banner');

        if (window.innerWidth > 1160) {
          slider.addEventListener('mouseover', function () {
            clearInterval(sliderAutoStart);
          });
          slider.addEventListener('mouseleave', function () {
            sliderAutoStart = setInterval(component.nextSlide, 10000);
          });
          sliderAutoStart = setInterval(component.nextSlide, 10000);
        }

        var startPointX;
        slider.addEventListener("touchstart", function (event) {
          startPointX = event.changedTouches[0].screenX;
          clearInterval(sliderAutoStart);
        }, {
          passive: true
        });
        slider.addEventListener("touchend", function (event) {
          var endPointX = event.changedTouches[0].screenX;

          if (startPointX - endPointX > 40) {
            component.nextSlide();
          } else if (endPointX - startPointX > 40) {
            component.prevSlide();
          }
        }, {
          passive: true
        });
      }, 0);
    });
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/homeBanners.vue?vue&type=template&id=20032fed&":
/*!**************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/homeBanners.vue?vue&type=template&id=20032fed& ***!
  \**************************************************************************************************************************************************************************************************************/
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
    _c("div", { staticClass: "general-decor-figure" }),
    _vm._v(" "),
    _vm._m(0),
    _vm._v(" "),
    _c("div", { staticClass: "general-decor-text" }, [_vm._v("kratom helper")]),
    _vm._v(" "),
    _c(
      "ul",
      { staticClass: "main-banner__list js-list" },
      [
        _vm._l(_vm.banners, function(banner, index) {
          return [
            _c(
              "li",
              {
                staticClass: "main-banner__item js-slider-item",
                class: { show: _vm.currentIndex == index }
              },
              [
                _c("div", {
                  staticClass: "main-banner__img",
                  style: { backgroundImage: "url(" + banner.badImage + ")" }
                }),
                _vm._v(" "),
                _c("div", { staticClass: "main-banner__info" }, [
                  _c("p", { staticClass: "main-banner__info__descrip-sub" }, [
                    _vm._v(_vm._s(banner.desc))
                  ]),
                  _vm._v(" "),
                  _c("p", { staticClass: "main-banner__info__descrip" }, [
                    _vm._v(_vm._s(banner.short_desc))
                  ]),
                  _vm._v(" "),
                  _c(
                    "a",
                    {
                      staticClass: "main-button-color",
                      attrs: { href: banner.link }
                    },
                    [
                      _c("span", { staticClass: "text" }, [
                        _vm._v(_vm._s(banner.title))
                      ])
                    ]
                  )
                ])
              ]
            )
          ]
        })
      ],
      2
    ),
    _vm._v(" "),
    _c("div", { staticClass: "main-banner__arrows main-js-arrows" }, [
      _c(
        "button",
        {
          staticClass: "slider-button slider-button-small prev",
          on: { click: _vm.prevSlide }
        },
        [_c("span", { staticClass: "icon-arrow-left" })]
      ),
      _vm._v(" "),
      _c(
        "div",
        { staticClass: "main-banner__nav" },
        _vm._l(_vm.bannersAmount, function(number, index) {
          return _c(
            "button",
            {
              staticClass: "main-banner__nav__button js-dot",
              class: { active: index == _vm.currentIndex },
              on: {
                click: function($event) {
                  _vm.currentIndex = index
                }
              }
            },
            [_vm._v("0" + _vm._s(number))]
          )
        }),
        0
      ),
      _vm._v(" "),
      _c(
        "button",
        {
          staticClass: "slider-button slider-button-small next",
          on: { click: _vm.nextSlide }
        },
        [_c("span", { staticClass: "icon-arrow-right" })]
      )
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("ul", { staticClass: "general-decor-text__list" }, [
      _c("li", { staticClass: "general-decor-text__item" }, [
        _vm._v("kratom powder")
      ]),
      _vm._v(" "),
      _c("li", { staticClass: "general-decor-text__item" }, [
        _vm._v("Kratom Pills")
      ]),
      _vm._v(" "),
      _c("li", { staticClass: "general-decor-text__item" }, [
        _vm._v("Griffonia seeds")
      ])
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/homeBanners.vue":
/*!*************************************************!*\
  !*** ./resources/js/components/homeBanners.vue ***!
  \*************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _homeBanners_vue_vue_type_template_id_20032fed___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./homeBanners.vue?vue&type=template&id=20032fed& */ "./resources/js/components/homeBanners.vue?vue&type=template&id=20032fed&");
/* harmony import */ var _homeBanners_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./homeBanners.vue?vue&type=script&lang=js& */ "./resources/js/components/homeBanners.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _homeBanners_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _homeBanners_vue_vue_type_template_id_20032fed___WEBPACK_IMPORTED_MODULE_0__["render"],
  _homeBanners_vue_vue_type_template_id_20032fed___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/homeBanners.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/homeBanners.vue?vue&type=script&lang=js&":
/*!**************************************************************************!*\
  !*** ./resources/js/components/homeBanners.vue?vue&type=script&lang=js& ***!
  \**************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_homeBanners_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./homeBanners.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/homeBanners.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_homeBanners_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/homeBanners.vue?vue&type=template&id=20032fed&":
/*!********************************************************************************!*\
  !*** ./resources/js/components/homeBanners.vue?vue&type=template&id=20032fed& ***!
  \********************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_homeBanners_vue_vue_type_template_id_20032fed___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./homeBanners.vue?vue&type=template&id=20032fed& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/homeBanners.vue?vue&type=template&id=20032fed&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_homeBanners_vue_vue_type_template_id_20032fed___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_homeBanners_vue_vue_type_template_id_20032fed___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);