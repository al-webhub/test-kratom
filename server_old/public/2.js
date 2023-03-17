(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[2],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/productReviews.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/productReviews.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _mixins_reviews_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../mixins/reviews.js */ "./resources/js/mixins/reviews.js");
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
  name: 'productReviews',
  mixins: [_mixins_reviews_js__WEBPACK_IMPORTED_MODULE_0__["default"]],
  data: function data() {
    return {
      strings: strings
    };
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/productReviews.vue?vue&type=template&id=3554dd37&":
/*!*****************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/productReviews.vue?vue&type=template&id=3554dd37& ***!
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
  return _c(
    "div",
    {
      staticClass: "product-page__reviews js-product-item",
      attrs: { "data-target": "reviews" }
    },
    [
      _c("p", { staticClass: "product-page__caption" }, [
        _vm._v(_vm._s(_vm.strings.reviews))
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "add-reviews" }, [
        _c("div", { staticClass: "reviews__caprtion" }, [
          _c("span", { staticClass: "general-decor-elem" }),
          _vm._v(" "),
          _c("p", [_vm._v(_vm._s(_vm.strings.feedback_and_earn))])
        ]),
        _vm._v(" "),
        _c(
          "div",
          { staticClass: "add-reviews__item" },
          [
            _c("span", { staticClass: "icon-man" }),
            _vm._v(" "),
            _c("p", [_vm._v(_vm._s(_vm.strings.first_of_all))]),
            _vm._v(" "),
            _vm.user
              ? [_vm._m(0)]
              : [
                  _c(
                    "button",
                    {
                      staticClass: "button-enter js-button",
                      attrs: { "data-target": "registration-social" }
                    },
                    [_vm._v(_vm._s(_vm.strings.Log_In))]
                  )
                ]
          ],
          2
        ),
        _vm._v(" "),
        _c("div", { staticClass: "add-reviews__item" }, [
          _c("span", { staticClass: "icon-reviews-message" }),
          _vm._v(" "),
          _c("p", {
            domProps: { innerHTML: _vm._s(_vm.strings.leave_incognito_for) }
          })
        ]),
        _vm._v(" "),
        _vm.user
          ? _c("div", { staticClass: "add-reviews__form" }, [
              _c("div", { staticClass: "wrapper" }, [
                _c("div", {
                  directives: [
                    {
                      name: "lazy",
                      rawName: "v-lazy:background-image",
                      value: _vm.photo,
                      expression: "photo",
                      arg: "background-image"
                    }
                  ],
                  staticClass: "reviews-img"
                }),
                _vm._v(" "),
                _c(
                  "label",
                  { staticClass: "textarea__wrapper js-input-wrapper" },
                  [
                    _c("textarea", {
                      directives: [
                        {
                          name: "model",
                          rawName: "v-model",
                          value: _vm.comment.text,
                          expression: "comment.text"
                        }
                      ],
                      staticClass: "main-textarea js-input",
                      domProps: { value: _vm.comment.text },
                      on: {
                        input: function($event) {
                          if ($event.target.composing) {
                            return
                          }
                          _vm.$set(_vm.comment, "text", $event.target.value)
                        }
                      }
                    }),
                    _vm._v(" "),
                    _c(
                      "span",
                      { staticClass: "custome-placeholder__wrapper" },
                      [
                        _c("span", {
                          staticClass: "custome-placeholder__before"
                        }),
                        _vm._v(" "),
                        _c(
                          "span",
                          { staticClass: "custome-placeholder__text" },
                          [
                            _c("span", { staticClass: "inner-text" }, [
                              _vm._v(_vm._s(_vm.strings.your_reviews))
                            ])
                          ]
                        ),
                        _vm._v(" "),
                        _c("span", {
                          staticClass: "custome-placeholder__after"
                        })
                      ]
                    )
                  ]
                )
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "add-reviews__buttons" }, [
                _c(
                  "button",
                  {
                    staticClass: "main-button main-button-small",
                    on: {
                      click: function($event) {
                        return _vm.add(_vm.productId, true)
                      }
                    }
                  },
                  [
                    _c("span", { staticClass: "text" }, [
                      _vm._v(_vm._s(_vm.strings.post_incognito))
                    ])
                  ]
                ),
                _vm._v(" "),
                _c(
                  "button",
                  {
                    staticClass:
                      "main-button main-button-small main-button-confirm",
                    on: {
                      click: function($event) {
                        return _vm.add(_vm.productId)
                      }
                    }
                  },
                  [
                    _c("span", { staticClass: "text" }, [
                      _vm._v(_vm._s(_vm.strings.post))
                    ])
                  ]
                )
              ])
            ])
          : _vm._e()
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "reviews" }, [
        _c("div", { staticClass: "reviews__caprtion" }, [
          _c("span", { staticClass: "general-decor-elem" }),
          _vm._v(" "),
          _c("p", [_vm._v(_vm._s(_vm.strings.reviews))])
        ]),
        _vm._v(" "),
        _c(
          "ul",
          { staticClass: "reviews__list" },
          [
            _vm.reviews.data.length
              ? _vm._l(_vm.reviews.data, function(baseReview, baseIndex) {
                  return _c("li", { staticClass: "reviews__item" }, [
                    _c("div", {
                      directives: [
                        {
                          name: "lazy",
                          rawName: "v-lazy:background-image",
                          value: baseReview.photo,
                          expression: "baseReview.photo",
                          arg: "background-image"
                        }
                      ],
                      staticClass: "reviews-img"
                    }),
                    _vm._v(" "),
                    _c("div", { staticClass: "reviews__item-info" }, [
                      _c("div", { staticClass: "reviews__item-info__header" }, [
                        _c("p", { staticClass: "name" }, [
                          _vm._v(_vm._s(baseReview.name))
                        ]),
                        _vm._v(" "),
                        _c("p", { staticClass: "date" }, [
                          _vm._v(_vm._s(baseReview.created_at))
                        ])
                      ]),
                      _vm._v(" "),
                      _c("div", { staticClass: "reviews__item-info__body" }, [
                        _c("p", [_vm._v(_vm._s(baseReview.text))])
                      ]),
                      _vm._v(" "),
                      _c(
                        "div",
                        {
                          staticClass: "reviews__item-info__footer js-drop-item"
                        },
                        [
                          _c("div", { staticClass: "reviews__interaction" }, [
                            _c(
                              "button",
                              {
                                staticClass: "reviews__interaction__button",
                                class: {
                                  active: _vm.check(baseReview.id, "like")
                                },
                                on: {
                                  click: function($event) {
                                    return _vm.like(
                                      baseReview.id,
                                      baseIndex,
                                      null,
                                      "like"
                                    )
                                  }
                                }
                              },
                              [
                                _c("span", { staticClass: "icon-like-up" }),
                                _vm._v(" "),
                                _c("span", { staticClass: "text" }, [
                                  _vm._v(_vm._s(baseReview.likes))
                                ])
                              ]
                            ),
                            _vm._v(" "),
                            _c(
                              "button",
                              {
                                staticClass: "reviews__interaction__button",
                                class: {
                                  active: _vm.check(baseReview.id, "dislike")
                                },
                                on: {
                                  click: function($event) {
                                    return _vm.like(
                                      baseReview.id,
                                      baseIndex,
                                      null,
                                      "dislike"
                                    )
                                  }
                                }
                              },
                              [
                                _c("span", { staticClass: "icon-like-down" }),
                                _vm._v(" "),
                                _c("span", { staticClass: "text" }, [
                                  _vm._v(_vm._s(baseReview.dislikes))
                                ])
                              ]
                            ),
                            _vm._v(" "),
                            _vm.user
                              ? _c(
                                  "button",
                                  {
                                    staticClass:
                                      "reviews__interaction__button reviews__interaction__button-reply js-drop-button"
                                  },
                                  [
                                    _c("span", { staticClass: "icon-comment" }),
                                    _vm._v(" "),
                                    _c("span", { staticClass: "text" }, [
                                      _vm._v(_vm._s(_vm.strings.reply))
                                    ])
                                  ]
                                )
                              : _vm._e()
                          ]),
                          _vm._v(" "),
                          _c(
                            "form",
                            {
                              staticClass: "add-reviews__form",
                              attrs: { action: "#" }
                            },
                            [
                              _c("div", { staticClass: "wrapper" }, [
                                _c("div", {
                                  directives: [
                                    {
                                      name: "lazy",
                                      rawName: "v-lazy:background-image",
                                      value: _vm.photo,
                                      expression: "photo",
                                      arg: "background-image"
                                    }
                                  ],
                                  staticClass: "reviews-img"
                                }),
                                _vm._v(" "),
                                _c(
                                  "label",
                                  {
                                    staticClass:
                                      "input__wrapper js-input-wrapper"
                                  },
                                  [
                                    _c("input", {
                                      directives: [
                                        {
                                          name: "model",
                                          rawName: "v-model",
                                          value: _vm.comment.text,
                                          expression: "comment.text"
                                        }
                                      ],
                                      staticClass: "main-input js-input",
                                      attrs: { type: "text" },
                                      domProps: { value: _vm.comment.text },
                                      on: {
                                        input: function($event) {
                                          if ($event.target.composing) {
                                            return
                                          }
                                          _vm.$set(
                                            _vm.comment,
                                            "text",
                                            $event.target.value
                                          )
                                        }
                                      }
                                    }),
                                    _vm._v(" "),
                                    _c(
                                      "span",
                                      {
                                        staticClass:
                                          "custome-placeholder__wrapper"
                                      },
                                      [
                                        _c("span", {
                                          staticClass:
                                            "custome-placeholder__before"
                                        }),
                                        _vm._v(" "),
                                        _c(
                                          "span",
                                          {
                                            staticClass:
                                              "custome-placeholder__text"
                                          },
                                          [
                                            _c(
                                              "span",
                                              { staticClass: "inner-text" },
                                              [
                                                _vm._v(
                                                  _vm._s(
                                                    _vm.strings.your_reviews
                                                  )
                                                )
                                              ]
                                            )
                                          ]
                                        ),
                                        _vm._v(" "),
                                        _c("span", {
                                          staticClass:
                                            "custome-placeholder__after"
                                        })
                                      ]
                                    )
                                  ]
                                )
                              ]),
                              _vm._v(" "),
                              _c(
                                "div",
                                { staticClass: "add-reviews__buttons" },
                                [
                                  _c(
                                    "button",
                                    {
                                      staticClass:
                                        "button-only-text js-reviews-button",
                                      on: { click: _vm.cancel }
                                    },
                                    [
                                      _c("span", { staticClass: "text" }, [
                                        _vm._v(_vm._s(_vm.strings.cancel))
                                      ])
                                    ]
                                  ),
                                  _vm._v(" "),
                                  _c(
                                    "button",
                                    {
                                      staticClass:
                                        "main-button main-button-small main-button-confirm",
                                      on: {
                                        click: function($event) {
                                          return _vm.reply(
                                            baseReview.id,
                                            baseIndex
                                          )
                                        }
                                      }
                                    },
                                    [
                                      _c("span", { staticClass: "text" }, [
                                        _vm._v(_vm._s(_vm.strings.reply))
                                      ])
                                    ]
                                  )
                                ]
                              )
                            ]
                          )
                        ]
                      ),
                      _vm._v(" "),
                      baseReview.children.length
                        ? _c(
                            "div",
                            { staticClass: "reviews-reply js-drop-item" },
                            [
                              _c(
                                "button",
                                {
                                  staticClass:
                                    "more-reviews-text js-drop-button"
                                },
                                [
                                  _c("span", { staticClass: "text" }, [
                                    _vm._v(
                                      "Show " +
                                        _vm._s(baseReview.children.length) +
                                        " replies"
                                    )
                                  ]),
                                  _vm._v(" "),
                                  _c("span", { staticClass: "icon-drop" })
                                ]
                              ),
                              _vm._v(" "),
                              _c(
                                "ul",
                                { staticClass: "reviews__list" },
                                _vm._l(baseReview.children, function(
                                  subReview,
                                  subIndex
                                ) {
                                  return _c(
                                    "li",
                                    { staticClass: "reviews__item" },
                                    [
                                      _c("div", {
                                        directives: [
                                          {
                                            name: "lazy",
                                            rawName: "v-lazy:background-image",
                                            value: subReview.photo,
                                            expression: "subReview.photo",
                                            arg: "background-image"
                                          }
                                        ],
                                        staticClass: "reviews-img"
                                      }),
                                      _vm._v(" "),
                                      _c(
                                        "div",
                                        { staticClass: "reviews__item-info" },
                                        [
                                          _c(
                                            "div",
                                            {
                                              staticClass:
                                                "reviews__item-info__header"
                                            },
                                            [
                                              _c("p", { staticClass: "name" }, [
                                                _vm._v(_vm._s(subReview.name))
                                              ]),
                                              _vm._v(" "),
                                              _c("p", { staticClass: "date" }, [
                                                _vm._v(
                                                  _vm._s(subReview.created_at)
                                                )
                                              ])
                                            ]
                                          ),
                                          _vm._v(" "),
                                          _c(
                                            "div",
                                            {
                                              staticClass:
                                                "reviews__item-info__body"
                                            },
                                            [
                                              _c("p", [
                                                _vm._v(_vm._s(subReview.text))
                                              ])
                                            ]
                                          ),
                                          _vm._v(" "),
                                          _c(
                                            "div",
                                            {
                                              staticClass:
                                                "reviews__item-info__footer js-drop-item"
                                            },
                                            [
                                              _c(
                                                "div",
                                                {
                                                  staticClass:
                                                    "reviews__interaction"
                                                },
                                                [
                                                  _c(
                                                    "button",
                                                    {
                                                      staticClass:
                                                        "reviews__interaction__button",
                                                      on: {
                                                        click: function(
                                                          $event
                                                        ) {
                                                          return _vm.like(
                                                            baseReview.id,
                                                            baseIndex,
                                                            subIndex,
                                                            "like"
                                                          )
                                                        }
                                                      }
                                                    },
                                                    [
                                                      _c("span", {
                                                        staticClass:
                                                          "icon-like-up"
                                                      }),
                                                      _vm._v(" "),
                                                      _c(
                                                        "span",
                                                        { staticClass: "text" },
                                                        [
                                                          _vm._v(
                                                            _vm._s(
                                                              subReview.likes
                                                            )
                                                          )
                                                        ]
                                                      )
                                                    ]
                                                  ),
                                                  _vm._v(" "),
                                                  _c(
                                                    "button",
                                                    {
                                                      staticClass:
                                                        "reviews__interaction__button",
                                                      on: {
                                                        click: function(
                                                          $event
                                                        ) {
                                                          return _vm.like(
                                                            baseReview.id,
                                                            baseIndex,
                                                            subIndex,
                                                            "dislike"
                                                          )
                                                        }
                                                      }
                                                    },
                                                    [
                                                      _c("span", {
                                                        staticClass:
                                                          "icon-like-down"
                                                      }),
                                                      _vm._v(" "),
                                                      _c(
                                                        "span",
                                                        { staticClass: "text" },
                                                        [
                                                          _vm._v(
                                                            _vm._s(
                                                              subReview.dislikes
                                                            )
                                                          )
                                                        ]
                                                      )
                                                    ]
                                                  )
                                                ]
                                              )
                                            ]
                                          )
                                        ]
                                      )
                                    ]
                                  )
                                }),
                                0
                              )
                            ]
                          )
                        : _vm._e()
                    ])
                  ])
                })
              : [_c("li", [_c("p", [_vm._v(_vm._s(_vm.strings.no_reviews))])])]
          ],
          2
        ),
        _vm._v(" "),
        _vm.reviews.next_page_url
          ? _c(
              "button",
              { staticClass: "more-reviews-text", on: { click: _vm.loadMore } },
              [
                _c("span", { staticClass: "text" }, [
                  _vm._v(_vm._s(_vm.strings.load_more_reviews))
                ]),
                _vm._v(" "),
                _c("span", { staticClass: "icon-drop" })
              ]
            )
          : _vm._e()
      ])
    ]
  )
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", { staticClass: "add-reviews__active" }, [
      _c("span", { staticClass: "icon-active" })
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/productReviews.vue":
/*!****************************************************!*\
  !*** ./resources/js/components/productReviews.vue ***!
  \****************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _productReviews_vue_vue_type_template_id_3554dd37___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./productReviews.vue?vue&type=template&id=3554dd37& */ "./resources/js/components/productReviews.vue?vue&type=template&id=3554dd37&");
/* harmony import */ var _productReviews_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./productReviews.vue?vue&type=script&lang=js& */ "./resources/js/components/productReviews.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _productReviews_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _productReviews_vue_vue_type_template_id_3554dd37___WEBPACK_IMPORTED_MODULE_0__["render"],
  _productReviews_vue_vue_type_template_id_3554dd37___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/productReviews.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/productReviews.vue?vue&type=script&lang=js&":
/*!*****************************************************************************!*\
  !*** ./resources/js/components/productReviews.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_productReviews_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./productReviews.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/productReviews.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_productReviews_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/productReviews.vue?vue&type=template&id=3554dd37&":
/*!***********************************************************************************!*\
  !*** ./resources/js/components/productReviews.vue?vue&type=template&id=3554dd37& ***!
  \***********************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_productReviews_vue_vue_type_template_id_3554dd37___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./productReviews.vue?vue&type=template&id=3554dd37& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/productReviews.vue?vue&type=template&id=3554dd37&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_productReviews_vue_vue_type_template_id_3554dd37___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_productReviews_vue_vue_type_template_id_3554dd37___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/mixins/reviews.js":
/*!****************************************!*\
  !*** ./resources/js/mixins/reviews.js ***!
  \****************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
var reviews = {
  data: function data() {
    return {
      comment: {
        text: ''
      },
      productId: this.dataProductId,
      reviews: this.dataReviews,
      user: this.dataUser,
      likes: JSON.parse(localStorage.getItem('likes'))
    };
  },
  props: ['dataReviews', 'dataUser', 'dataProductId'],
  computed: {
    photo: function photo() {
      var noAvatar = '/img/photo-log-in.png';
      if (this.user) return this.user.usermeta.photo ? this.user.usermeta.photo : noAvatar;else return noAvatar;
    }
  },
  methods: {
    add: function add() {
      var productId = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;
      var isIncognito = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;
      var component = this;
      var params = {
        product_id: productId,
        text: this.comment.text,
        name: isIncognito ? 'Incognito' : this.user.usermeta.fullname,
        likes: 0,
        dislikes: 0
      };
      axios.post('/reviews/review/add', params).then(function (response) {
        console.log(response.data);
        component.comment.text = '';
        noty('success', response.data.message);
      });
    },
    reply: function reply(parentId, baseIndex) {
      var component = this;
      var params = {
        parent_id: parentId,
        product_id: this.productId,
        text: this.comment.text,
        name: this.user.usermeta.fullname,
        likes: 0,
        dislikes: 0,
        photo: this.photo
      };
      this.reviews.data[baseIndex].children.push(params);
      axios.post('/reviews/reply/create', params).then(function (response) {
        console.log(response);
        component.comment.text = '';
      });
    },
    loadMore: function loadMore() {
      var component = this;
      var params = {
        product_id: this.productId,
        page: this.reviews.current_page + 1
      };
      axios.post('/reviews/loadmore', params).then(function (response) {
        console.log(response);
        component.reviews.current_page = response.data.current_page;
        component.reviews.next_page_url = response.data.next_page_url;
        response.data.data.forEach(function (review) {
          component.reviews.data.push(review);
        });
      });
    },
    cancel: function cancel() {
      this.comment.text = '';
    },
    like: function like(id, baseIndex, subIndex, type) {
      var component = this;
      var params = {};
      var reverseType = type == 'like' ? 'dislike' : 'like';

      if (this.check(id, type)) {
        params[type] = -1;
        if (subIndex !== null) this.reviews.data[baseIndex].children[subIndex][type + 's']--;else this.reviews.data[baseIndex][type + 's']--;
        component.toStorage(id, null);
        axios.post('/reviews/like/' + id, params);
      } else if (this.check(id, reverseType)) {
        params[type] = 1;
        params[reverseType] = -1;

        if (subIndex !== null) {
          this.reviews.data[baseIndex].children[subIndex][type + 's']++;
          this.reviews.data[baseIndex].children[subIndex][reverseType + 's']--;
        } else {
          this.reviews.data[baseIndex][type + 's']++;
          this.reviews.data[baseIndex][reverseType + 's']--;
        }

        component.toStorage(id, type);
        axios.post('/reviews/like/' + id, params);
      } else {
        params[type] = 1;
        if (subIndex !== null) this.reviews.data[baseIndex].children[subIndex][type + 's']++;else this.reviews.data[baseIndex][type + 's']++;
        component.toStorage(id, type);
        axios.post('/reviews/like/' + id, params);
      }
    },
    dislike: function dislike(id, baseIndex, subIndex) {
      var component = this;

      if (subIndex !== null) {
        this.reviews.data[baseIndex].children[subIndex].dislikes++;
      } else {
        this.reviews.data[baseIndex].dislikes++;
      }
    },
    toStorage: function toStorage(id, type) {
      if (!this.likes) {
        this.likes = {};
      }

      if (!this.likes[this.productId]) this.likes[this.productId] = {};
      this.likes[this.productId][id] = type;
      localStorage.likes = JSON.stringify(this.likes);
    },
    check: function check(id, type) {
      if (this.likes && this.likes[this.productId] && this.likes[this.productId][id] && this.likes[this.productId][id] == type) return true;else return false;
    }
  }
};
/* harmony default export */ __webpack_exports__["default"] = (reviews);

/***/ })

}]);