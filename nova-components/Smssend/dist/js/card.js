/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(1);
module.exports = __webpack_require__(6);


/***/ }),
/* 1 */
/***/ (function(module, exports, __webpack_require__) {

Nova.booting(function (Vue, router, store) {
  Vue.component('smssend', __webpack_require__(2));
});

/***/ }),
/* 2 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(3)
/* script */
var __vue_script__ = __webpack_require__(4)
/* template */
var __vue_template__ = __webpack_require__(5)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/Card.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-b9bc2c0a", Component.options)
  } else {
    hotAPI.reload("data-v-b9bc2c0a", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 3 */
/***/ (function(module, exports) {

/* globals __VUE_SSR_CONTEXT__ */

// IMPORTANT: Do NOT use ES2015 features in this file.
// This module is a runtime utility for cleaner component module output and will
// be included in the final webpack user bundle.

module.exports = function normalizeComponent (
  rawScriptExports,
  compiledTemplate,
  functionalTemplate,
  injectStyles,
  scopeId,
  moduleIdentifier /* server only */
) {
  var esModule
  var scriptExports = rawScriptExports = rawScriptExports || {}

  // ES6 modules interop
  var type = typeof rawScriptExports.default
  if (type === 'object' || type === 'function') {
    esModule = rawScriptExports
    scriptExports = rawScriptExports.default
  }

  // Vue.extend constructor export interop
  var options = typeof scriptExports === 'function'
    ? scriptExports.options
    : scriptExports

  // render functions
  if (compiledTemplate) {
    options.render = compiledTemplate.render
    options.staticRenderFns = compiledTemplate.staticRenderFns
    options._compiled = true
  }

  // functional template
  if (functionalTemplate) {
    options.functional = true
  }

  // scopedId
  if (scopeId) {
    options._scopeId = scopeId
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
    hook = injectStyles
  }

  if (hook) {
    var functional = options.functional
    var existing = functional
      ? options.render
      : options.beforeCreate

    if (!functional) {
      // inject component registration as beforeCreate hook
      options.beforeCreate = existing
        ? [].concat(existing, hook)
        : [hook]
    } else {
      // for template-only hot-reload because in that case the render fn doesn't
      // go through the normalizer
      options._injectStyles = hook
      // register for functioal component in vue file
      options.render = function renderWithStyleInjection (h, context) {
        hook.call(context)
        return existing(h, context)
      }
    }
  }

  return {
    esModule: esModule,
    exports: scriptExports,
    options: options
  }
}


/***/ }),
/* 4 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
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
    data: function data() {
        return {
            Message: "",
            selectval: [], // Change this to an array for multi-select
            Types: [],
            maxCount: 140,
            remainingCount: 140,
            message: '',
            hasError: false,
            isOpen: false,
            searchQuery: ''
        };
    },

    props: ["card"],
    beforeMount: function beforeMount() {
        this.getType();
    },

    computed: {
        selectedText: function selectedText() {
            var _this = this;

            if (this.selectval.length === 0) {
                return 'اختر الفئة';
            }
            return this.Types.filter(function (type) {
                return _this.selectval.includes(type.id);
            }).map(function (type) {
                return type.name;
            }).join(', ');
        },
        filteredTypes: function filteredTypes() {
            var _this2 = this;

            return this.Types.filter(function (type) {
                return type.name.toLowerCase().includes(_this2.searchQuery.toLowerCase());
            });
        }
    },
    methods: {
        send: function send() {
            axios.get('/SendMessageSms', {
                params: {
                    type: this.selectval, // This will be an array of selected values
                    Message: this.Message
                }
            }).then(function (response) {
                alert('Message Sent');
            }).catch(function (error) {
                console.error('Error sending message:', error);
                alert('Failed to send message');
            });
        },

        getType: function getType() {
            var _this3 = this;

            axios.post("/getType").then(function (response) {
                _this3.Types = response.data;
            });
        },
        countdown: function countdown() {
            this.remainingCount = this.maxCount - this.Message.length; // Fix to use this.Message instead of this.message
            this.hasError = this.remainingCount < 0;
        },
        toggleDropdown: function toggleDropdown() {
            this.isOpen = !this.isOpen;
        },
        toggleSelect: function toggleSelect(type) {
            var index = this.selectval.indexOf(type.id);
            if (index > -1) {
                this.selectval.splice(index, 1);
            } else {
                this.selectval.push(type.id);
            }
        }
    }
});

/***/ }),
/* 5 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("card", { staticClass: "flex flex-col" }, [
    _c(
      "form",
      {
        attrs: { method: "get" },
        on: {
          submit: function($event) {
            $event.preventDefault()
            return _vm.onSubmit.apply(null, arguments)
          }
        }
      },
      [
        _c("div", { staticClass: "mb-6 p-12" }, [
          _c(
            "label",
            {
              staticClass:
                "block mb-2 text-sm font-medium text-gray-900 dark:text-white",
              attrs: { for: "default-input" }
            },
            [_vm._v("\n                اختر الفئة\n            ")]
          ),
          _vm._v(" "),
          _c("div", { staticClass: "relative" }, [
            _c(
              "div",
              {
                staticClass:
                  "w-full form-control form-input form-input-bordered cursor-pointer bg-white border border-gray-200 rounded px-4 py-2 flex items-center justify-between",
                on: { click: _vm.toggleDropdown }
              },
              [
                _c("span", [_vm._v(_vm._s(_vm.selectedText))]),
                _vm._v(" "),
                _c(
                  "svg",
                  {
                    staticClass: "w-4 h-4",
                    attrs: {
                      xmlns: "http://www.w3.org/2000/svg",
                      viewBox: "0 0 20 20",
                      fill: "currentColor"
                    }
                  },
                  [
                    _c("path", {
                      attrs: {
                        "fill-rule": "evenodd",
                        d:
                          "M5.293 7.707a1 1 0 011.414 0L10 11.414l3.293-3.707a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z",
                        "clip-rule": "evenodd"
                      }
                    })
                  ]
                )
              ]
            ),
            _vm._v(" "),
            _c(
              "div",
              {
                directives: [
                  {
                    name: "show",
                    rawName: "v-show",
                    value: _vm.isOpen,
                    expression: "isOpen"
                  }
                ],
                staticClass:
                  "absolute w-full bg-white border border-gray-200 rounded mt-1 max-h-60 overflow-y-auto z-10"
              },
              [
                _c("input", {
                  directives: [
                    {
                      name: "model",
                      rawName: "v-model",
                      value: _vm.searchQuery,
                      expression: "searchQuery"
                    }
                  ],
                  staticClass:
                    "w-full form-control form-input form-input-bordered mb-2 px-4 py-2 border-gray-200 rounded-md",
                  attrs: { type: "text", placeholder: "Search..." },
                  domProps: { value: _vm.searchQuery },
                  on: {
                    input: function($event) {
                      if ($event.target.composing) {
                        return
                      }
                      _vm.searchQuery = $event.target.value
                    }
                  }
                }),
                _vm._v(" "),
                _vm._l(_vm.filteredTypes, function(type) {
                  return _c(
                    "div",
                    {
                      key: type.id,
                      staticClass: "px-4 py-2 cursor-pointer hover:bg-gray-100",
                      on: {
                        click: function($event) {
                          return _vm.toggleSelect(type)
                        }
                      }
                    },
                    [
                      _c("input", {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: _vm.selectval,
                            expression: "selectval"
                          }
                        ],
                        staticClass: "mr-2",
                        attrs: { type: "checkbox" },
                        domProps: {
                          value: type.id,
                          checked: Array.isArray(_vm.selectval)
                            ? _vm._i(_vm.selectval, type.id) > -1
                            : _vm.selectval
                        },
                        on: {
                          change: function($event) {
                            var $$a = _vm.selectval,
                              $$el = $event.target,
                              $$c = $$el.checked ? true : false
                            if (Array.isArray($$a)) {
                              var $$v = type.id,
                                $$i = _vm._i($$a, $$v)
                              if ($$el.checked) {
                                $$i < 0 && (_vm.selectval = $$a.concat([$$v]))
                              } else {
                                $$i > -1 &&
                                  (_vm.selectval = $$a
                                    .slice(0, $$i)
                                    .concat($$a.slice($$i + 1)))
                              }
                            } else {
                              _vm.selectval = $$c
                            }
                          }
                        }
                      }),
                      _vm._v(_vm._s(type.name) + "\n                    ")
                    ]
                  )
                })
              ],
              2
            )
          ]),
          _vm._v(" "),
          _c(
            "label",
            {
              staticClass:
                "block mb-2 text-sm font-medium text-gray-900 dark:text-white",
              attrs: { for: "default-input" }
            },
            [_vm._v("\n                ادخل نص الرسالة\n            ")]
          ),
          _vm._v(" "),
          _c("span", [_vm._v("Add a comment")]),
          _vm._v(" "),
          _c("em", { staticClass: "text-light" }, [
            _vm._v("(up to 140 characters)")
          ]),
          _vm._v(" "),
          _c("textarea", {
            directives: [
              {
                name: "model",
                rawName: "v-model",
                value: _vm.Message,
                expression: "Message"
              }
            ],
            staticClass:
              "appearance-none border border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-black",
            attrs: {
              placeholder: "",
              id: "default-input",
              name: "",
              cols: "30",
              rows: "10"
            },
            domProps: { value: _vm.Message },
            on: {
              keyup: _vm.countdown,
              input: function($event) {
                if ($event.target.composing) {
                  return
                }
                _vm.Message = $event.target.value
              }
            }
          }),
          _vm._v(" "),
          _c(
            "p",
            {
              staticClass: "text-right text-small",
              class: { "text-danger": _vm.hasError }
            },
            [_vm._v(_vm._s(_vm.remainingCount))]
          ),
          _vm._v(" "),
          _c(
            "div",
            { staticClass: "flex flex-row items-center justify-end mt-4" },
            [
              _c(
                "button",
                {
                  staticClass:
                    "shadow bg-green-600 hover:bg-green-500 focus:shadow-outline focus:outline-none text-white font-bold px-16 py-4 rounded",
                  attrs: { type: "submit" },
                  on: { click: _vm.send }
                },
                [_vm._v("\n                    ارسال\n                ")]
              )
            ]
          )
        ])
      ]
    )
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-b9bc2c0a", module.exports)
  }
}

/***/ }),
/* 6 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })
/******/ ]);