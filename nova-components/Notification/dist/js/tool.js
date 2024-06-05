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
module.exports = __webpack_require__(11);


/***/ }),
/* 1 */
/***/ (function(module, exports, __webpack_require__) {

Nova.booting(function (Vue, router, store) {
  router.addRoutes([{
    name: 'notification',
    path: '/notification',
    component: __webpack_require__(2)
  }]);
});

/***/ }),
/* 2 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(3)
  __webpack_require__(15)
}
var normalizeComponent = __webpack_require__(8)
/* script */
var __vue_script__ = __webpack_require__(9)
/* template */
var __vue_template__ = __webpack_require__(10)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
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
Component.options.__file = "resources/js/components/Tool.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-68ff5483", Component.options)
  } else {
    hotAPI.reload("data-v-68ff5483", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 3 */
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(4);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(6)("290c3e45", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../node_modules/css-loader/index.js!../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-68ff5483\",\"scoped\":false,\"hasInlineConfig\":true}!../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Tool.vue", function() {
     var newContent = require("!!../../../node_modules/css-loader/index.js!../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-68ff5483\",\"scoped\":false,\"hasInlineConfig\":true}!../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Tool.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),
/* 4 */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(5)(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n/* Your styles here */\n", ""]);

// exports


/***/ }),
/* 5 */
/***/ (function(module, exports) {

/*
	MIT License http://www.opensource.org/licenses/mit-license.php
	Author Tobias Koppers @sokra
*/
// css base code, injected by the css-loader
module.exports = function(useSourceMap) {
	var list = [];

	// return the list of modules as css string
	list.toString = function toString() {
		return this.map(function (item) {
			var content = cssWithMappingToString(item, useSourceMap);
			if(item[2]) {
				return "@media " + item[2] + "{" + content + "}";
			} else {
				return content;
			}
		}).join("");
	};

	// import a list of modules into the list
	list.i = function(modules, mediaQuery) {
		if(typeof modules === "string")
			modules = [[null, modules, ""]];
		var alreadyImportedModules = {};
		for(var i = 0; i < this.length; i++) {
			var id = this[i][0];
			if(typeof id === "number")
				alreadyImportedModules[id] = true;
		}
		for(i = 0; i < modules.length; i++) {
			var item = modules[i];
			// skip already imported module
			// this implementation is not 100% perfect for weird media query combinations
			//  when a module is imported multiple times with different media queries.
			//  I hope this will never occur (Hey this way we have smaller bundles)
			if(typeof item[0] !== "number" || !alreadyImportedModules[item[0]]) {
				if(mediaQuery && !item[2]) {
					item[2] = mediaQuery;
				} else if(mediaQuery) {
					item[2] = "(" + item[2] + ") and (" + mediaQuery + ")";
				}
				list.push(item);
			}
		}
	};
	return list;
};

function cssWithMappingToString(item, useSourceMap) {
	var content = item[1] || '';
	var cssMapping = item[3];
	if (!cssMapping) {
		return content;
	}

	if (useSourceMap && typeof btoa === 'function') {
		var sourceMapping = toComment(cssMapping);
		var sourceURLs = cssMapping.sources.map(function (source) {
			return '/*# sourceURL=' + cssMapping.sourceRoot + source + ' */'
		});

		return [content].concat(sourceURLs).concat([sourceMapping]).join('\n');
	}

	return [content].join('\n');
}

// Adapted from convert-source-map (MIT)
function toComment(sourceMap) {
	// eslint-disable-next-line no-undef
	var base64 = btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap))));
	var data = 'sourceMappingURL=data:application/json;charset=utf-8;base64,' + base64;

	return '/*# ' + data + ' */';
}


/***/ }),
/* 6 */
/***/ (function(module, exports, __webpack_require__) {

/*
  MIT License http://www.opensource.org/licenses/mit-license.php
  Author Tobias Koppers @sokra
  Modified by Evan You @yyx990803
*/

var hasDocument = typeof document !== 'undefined'

if (typeof DEBUG !== 'undefined' && DEBUG) {
  if (!hasDocument) {
    throw new Error(
    'vue-style-loader cannot be used in a non-browser environment. ' +
    "Use { target: 'node' } in your Webpack config to indicate a server-rendering environment."
  ) }
}

var listToStyles = __webpack_require__(7)

/*
type StyleObject = {
  id: number;
  parts: Array<StyleObjectPart>
}

type StyleObjectPart = {
  css: string;
  media: string;
  sourceMap: ?string
}
*/

var stylesInDom = {/*
  [id: number]: {
    id: number,
    refs: number,
    parts: Array<(obj?: StyleObjectPart) => void>
  }
*/}

var head = hasDocument && (document.head || document.getElementsByTagName('head')[0])
var singletonElement = null
var singletonCounter = 0
var isProduction = false
var noop = function () {}
var options = null
var ssrIdKey = 'data-vue-ssr-id'

// Force single-tag solution on IE6-9, which has a hard limit on the # of <style>
// tags it will allow on a page
var isOldIE = typeof navigator !== 'undefined' && /msie [6-9]\b/.test(navigator.userAgent.toLowerCase())

module.exports = function (parentId, list, _isProduction, _options) {
  isProduction = _isProduction

  options = _options || {}

  var styles = listToStyles(parentId, list)
  addStylesToDom(styles)

  return function update (newList) {
    var mayRemove = []
    for (var i = 0; i < styles.length; i++) {
      var item = styles[i]
      var domStyle = stylesInDom[item.id]
      domStyle.refs--
      mayRemove.push(domStyle)
    }
    if (newList) {
      styles = listToStyles(parentId, newList)
      addStylesToDom(styles)
    } else {
      styles = []
    }
    for (var i = 0; i < mayRemove.length; i++) {
      var domStyle = mayRemove[i]
      if (domStyle.refs === 0) {
        for (var j = 0; j < domStyle.parts.length; j++) {
          domStyle.parts[j]()
        }
        delete stylesInDom[domStyle.id]
      }
    }
  }
}

function addStylesToDom (styles /* Array<StyleObject> */) {
  for (var i = 0; i < styles.length; i++) {
    var item = styles[i]
    var domStyle = stylesInDom[item.id]
    if (domStyle) {
      domStyle.refs++
      for (var j = 0; j < domStyle.parts.length; j++) {
        domStyle.parts[j](item.parts[j])
      }
      for (; j < item.parts.length; j++) {
        domStyle.parts.push(addStyle(item.parts[j]))
      }
      if (domStyle.parts.length > item.parts.length) {
        domStyle.parts.length = item.parts.length
      }
    } else {
      var parts = []
      for (var j = 0; j < item.parts.length; j++) {
        parts.push(addStyle(item.parts[j]))
      }
      stylesInDom[item.id] = { id: item.id, refs: 1, parts: parts }
    }
  }
}

function createStyleElement () {
  var styleElement = document.createElement('style')
  styleElement.type = 'text/css'
  head.appendChild(styleElement)
  return styleElement
}

function addStyle (obj /* StyleObjectPart */) {
  var update, remove
  var styleElement = document.querySelector('style[' + ssrIdKey + '~="' + obj.id + '"]')

  if (styleElement) {
    if (isProduction) {
      // has SSR styles and in production mode.
      // simply do nothing.
      return noop
    } else {
      // has SSR styles but in dev mode.
      // for some reason Chrome can't handle source map in server-rendered
      // style tags - source maps in <style> only works if the style tag is
      // created and inserted dynamically. So we remove the server rendered
      // styles and inject new ones.
      styleElement.parentNode.removeChild(styleElement)
    }
  }

  if (isOldIE) {
    // use singleton mode for IE9.
    var styleIndex = singletonCounter++
    styleElement = singletonElement || (singletonElement = createStyleElement())
    update = applyToSingletonTag.bind(null, styleElement, styleIndex, false)
    remove = applyToSingletonTag.bind(null, styleElement, styleIndex, true)
  } else {
    // use multi-style-tag mode in all other cases
    styleElement = createStyleElement()
    update = applyToTag.bind(null, styleElement)
    remove = function () {
      styleElement.parentNode.removeChild(styleElement)
    }
  }

  update(obj)

  return function updateStyle (newObj /* StyleObjectPart */) {
    if (newObj) {
      if (newObj.css === obj.css &&
          newObj.media === obj.media &&
          newObj.sourceMap === obj.sourceMap) {
        return
      }
      update(obj = newObj)
    } else {
      remove()
    }
  }
}

var replaceText = (function () {
  var textStore = []

  return function (index, replacement) {
    textStore[index] = replacement
    return textStore.filter(Boolean).join('\n')
  }
})()

function applyToSingletonTag (styleElement, index, remove, obj) {
  var css = remove ? '' : obj.css

  if (styleElement.styleSheet) {
    styleElement.styleSheet.cssText = replaceText(index, css)
  } else {
    var cssNode = document.createTextNode(css)
    var childNodes = styleElement.childNodes
    if (childNodes[index]) styleElement.removeChild(childNodes[index])
    if (childNodes.length) {
      styleElement.insertBefore(cssNode, childNodes[index])
    } else {
      styleElement.appendChild(cssNode)
    }
  }
}

function applyToTag (styleElement, obj) {
  var css = obj.css
  var media = obj.media
  var sourceMap = obj.sourceMap

  if (media) {
    styleElement.setAttribute('media', media)
  }
  if (options.ssrId) {
    styleElement.setAttribute(ssrIdKey, obj.id)
  }

  if (sourceMap) {
    // https://developer.chrome.com/devtools/docs/javascript-debugging
    // this makes source maps inside style tags work properly in Chrome
    css += '\n/*# sourceURL=' + sourceMap.sources[0] + ' */'
    // http://stackoverflow.com/a/26603875
    css += '\n/*# sourceMappingURL=data:application/json;base64,' + btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap)))) + ' */'
  }

  if (styleElement.styleSheet) {
    styleElement.styleSheet.cssText = css
  } else {
    while (styleElement.firstChild) {
      styleElement.removeChild(styleElement.firstChild)
    }
    styleElement.appendChild(document.createTextNode(css))
  }
}


/***/ }),
/* 7 */
/***/ (function(module, exports) {

/**
 * Translates the list format produced by css-loader into something
 * easier to manipulate.
 */
module.exports = function listToStyles (parentId, list) {
  var styles = []
  var newStyles = {}
  for (var i = 0; i < list.length; i++) {
    var item = list[i]
    var id = item[0]
    var css = item[1]
    var media = item[2]
    var sourceMap = item[3]
    var part = {
      id: parentId + ':' + i,
      css: css,
      media: media,
      sourceMap: sourceMap
    }
    if (!newStyles[id]) {
      styles.push(newStyles[id] = { id: id, parts: [part] })
    } else {
      newStyles[id].parts.push(part)
    }
  }
  return styles
}


/***/ }),
/* 8 */
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
/* 9 */
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
    data: function data() {
        return {
            users: [],
            myNotification: [],
            myAlertNotification: [],
            allNotifications: [],

            openTab: 1,
            selected: { id: 0 },
            date: "",
            Notifications: "",
            selectedAdmin: ""
        };
    },

    methods: {
        getusers: function getusers() {
            var _this = this;

            axios.post("/users").then(function (response) {
                _this.users = response.data;
                // console.log("user admin", this.users);
            });
        },
        UserAdmin: function UserAdmin() {
            var _this2 = this;

            axios.post("/UserAdmin").then(function (response) {
                console.log("start");
                console.log(_this2.Admin);
                _this2.Admin = response.data;

                console.log("user admin");
                console.log(_this2.Admin);
                console.log("finsh");
            });
        },
        myNotifications: function myNotifications() {
            var _this3 = this;

            axios.post("/myNotification").then(function (response) {
                _this3.myNotification = response.data;
            });
        },
        myAlert: function myAlert() {
            var _this4 = this;

            axios.post("/myAlert").then(function (response) {
                _this4.myAlertNotification = response.data;
            });
        },
        sendNotifications: function sendNotifications() {
            axios.post("/sendNotification", {
                Notifications: this.Notifications,
                date: this.date,
                user: this.selected.id
            });
            this.myNotifications();
            this.Notifications = [];
            this.selected.id = 0;
            alert("send done");
        },
        AdminNotifications: function AdminNotifications(event) {
            var _this5 = this;

            // alert(event.target.value);
            axios.post("/AdminNotifications", {
                user: event.target.value
            }).then(function (response) {
                _this5.allNotifications = response.data;
            });
            console.log(this.allNotifications);
        },

        toggleTabs: function toggleTabs(tabNumber) {
            this.openTab = tabNumber;
        },
        UNCompletNotifications: function UNCompletNotifications($event) {
            axios.post("/UNCompletNotifications", {
                Notificationsid: $event
            });
            this.myNotifications();
        },
        receivedNotifications: function receivedNotifications($event, $type) {
            axios.post("/receivedNotifications", {
                Notificationsid: $event
            });
            this.myNotifications();
        },
        WorkOnNotifications: function WorkOnNotifications($event, $type) {
            axios.post("/WorkOnNotifications", {
                Notificationsid: $event
            });
            this.myNotifications();
        },
        CompletNotifications: function CompletNotifications($event, $type) {
            axios.post("/CompletNotifications", {
                Notificationsid: $event
            });
            this.myNotifications();
        },
        DeleteNotifications: function DeleteNotifications($event) {
            axios.post("/DeleteNotifications", {
                Notificationsid: $event
            });
            this.myNotifications();
        },
        AddNote: function AddNote($event, $note) {
            // alert($note);
            if ($note) {
                axios.post("/AddNoteNotifications", {
                    Notificationsid: $event,
                    NotificationsNote: $note

                }).then(function (response) {
                    alert("done");
                });
                this.myNotifications();
            }
        }
    },

    beforeMount: function beforeMount() {
        this.getusers();
        this.myNotifications();
        this.UserAdmin();
        this.myAlert();
    }
});

/***/ }),
/* 10 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _c("heading", { staticClass: "mb-6" }, [_vm._v("المهام و الاشعارات")]),
      _vm._v(" "),
      _c("div", { staticClass: "flex" }, [
        _c("div", { staticClass: "w-full h-full" }, [
          _c(
            "div",
            {
              staticClass:
                "flex flex-row items-center justify-satrt w-full my-4 gap-x-2"
            },
            [
              _c(
                "div",
                {
                  staticClass:
                    "flex flex-row items-center justify-center cursor-pointer w-1/2"
                },
                [
                  _c(
                    "a",
                    {
                      class: {
                        "text-green-600 bg-white w-full py-4 text-center rounded-md":
                          _vm.openTab !== 1,
                        "text-white bg-green-600 w-full py-4 text-center rounded-md":
                          _vm.openTab === 1
                      },
                      on: {
                        click: function($event) {
                          return _vm.toggleTabs(1)
                        }
                      }
                    },
                    [
                      _vm._v(
                        "\n                        مهامي\n                    "
                      )
                    ]
                  )
                ]
              ),
              _vm._v(" "),
              _c(
                "div",
                {
                  staticClass:
                    "flex flex-row items-center justify-center cursor-pointer w-1/2"
                },
                [
                  _c(
                    "a",
                    {
                      class: {
                        "text-green-600 bg-white w-full py-4 text-center rounded-md":
                          _vm.openTab !== 2,
                        "text-white bg-green-600 w-full py-4 text-center rounded-md":
                          _vm.openTab === 2
                      },
                      on: {
                        click: function($event) {
                          return _vm.toggleTabs(2)
                        }
                      }
                    },
                    [
                      _vm._v(
                        "\n                        اضافة مهام\n                    "
                      )
                    ]
                  )
                ]
              ),
              _vm._v(" "),
              _c(
                "div",
                {
                  staticClass:
                    "flex flex-row items-center justify-center cursor-pointer w-1/2"
                },
                [
                  _c(
                    "a",
                    {
                      class: {
                        "text-green-600 bg-white w-full py-4 text-center rounded-md":
                          _vm.openTab !== 4,
                        "text-white bg-green-600 w-full py-4 text-center rounded-md":
                          _vm.openTab === 4
                      },
                      on: {
                        click: function($event) {
                          return _vm.toggleTabs(4)
                        }
                      }
                    },
                    [
                      _vm._v(
                        "\n                        الاشعارات\n                    "
                      )
                    ]
                  )
                ]
              ),
              _vm._v(" "),
              _c(
                "div",
                {
                  staticClass:
                    "flex flex-row items-center justify-center cursor-pointer w-1/2"
                },
                [
                  _c(
                    "a",
                    {
                      class: {
                        "text-green-600 bg-white w-full py-4 text-center rounded-md":
                          _vm.openTab !== 3,
                        "text-white bg-green-600 w-full py-4 text-center rounded-md":
                          _vm.openTab === 3
                      },
                      on: {
                        click: function($event) {
                          return _vm.toggleTabs(3)
                        }
                      }
                    },
                    [
                      _vm._v(
                        "\n                        مهام الموظفين\n                    "
                      )
                    ]
                  )
                ]
              )
            ]
          ),
          _vm._v(" "),
          _c("div", { staticClass: "overflow-x-auto" }, [
            _c(
              "div",
              {
                staticClass:
                  "relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded p-4 for-mobile-scoll-x",
                class: {
                  hidden: _vm.openTab !== 1,
                  block: _vm.openTab === 1
                }
              },
              [
                _c(
                  "table",
                  { staticClass: "text-center" },
                  [
                    _vm._m(0),
                    _vm._v(" "),
                    _vm._l(_vm.myNotification, function(Notification) {
                      return _c(
                        "tr",
                        {
                          key: Notification.id,
                          attrs: { value: Notification.id }
                        },
                        [
                          _c("td", [
                            _vm._v(
                              _vm._s(Notification.Notifications.Notifications)
                            )
                          ]),
                          _vm._v(" "),
                          _c("td", { staticClass: "flex w-full h-full" }, [
                            _c(
                              "label",
                              {
                                staticClass:
                                  "mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white",
                                attrs: { for: "search" }
                              },
                              [_vm._v("Search")]
                            ),
                            _vm._v(" "),
                            _c("div", { staticClass: "relative w-full" }, [
                              _c("input", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: Notification.note,
                                    expression: "Notification.note"
                                  }
                                ],
                                staticClass:
                                  "block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500",
                                attrs: {
                                  type: "text",
                                  id: "fname",
                                  required: ""
                                },
                                domProps: { value: Notification.note },
                                on: {
                                  input: function($event) {
                                    if ($event.target.composing) {
                                      return
                                    }
                                    _vm.$set(
                                      Notification,
                                      "note",
                                      $event.target.value
                                    )
                                  }
                                }
                              }),
                              _vm._v(" "),
                              _c(
                                "button",
                                {
                                  staticClass:
                                    "text-white absolute left-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800",
                                  attrs: { type: "submit" },
                                  on: {
                                    click: function($event) {
                                      return _vm.AddNote(
                                        Notification.id,
                                        Notification.note
                                      )
                                    }
                                  }
                                },
                                [_vm._v("اضافة")]
                              )
                            ])
                          ]),
                          _vm._v(" "),
                          _c("td", [_vm._v(_vm._s(Notification.sender.name))]),
                          _vm._v(" "),
                          Notification.Notifications.date
                            ? _c("td", [
                                _vm._v(
                                  "\n                                " +
                                    _vm._s(Notification.Notifications.date) +
                                    "\n                            "
                                )
                              ])
                            : _c("td", [_vm._v("لا يوجد وقت")]),
                          _vm._v(" "),
                          Notification.status == 1
                            ? _c("td", [
                                _c(
                                  "button",
                                  {
                                    staticClass:
                                      "shadow bg-green-600 focus:shadow-outline focus:outline-none text-white font-bold px-16 py-2 rounded",
                                    attrs: { type: "submit" },
                                    on: {
                                      click: function($event) {
                                        return _vm.receivedNotifications(
                                          Notification.id
                                        )
                                      }
                                    }
                                  },
                                  [
                                    _vm._v(
                                      "\n                                    استلام المهمة\n                                "
                                    )
                                  ]
                                )
                              ])
                            : Notification.status == 2
                            ? _c("td", [
                                _c(
                                  "button",
                                  {
                                    staticClass:
                                      "shadow bg-green-600 focus:shadow-outline focus:outline-none text-white font-bold px-16 py-2 rounded",
                                    attrs: { type: "submit" },
                                    on: {
                                      click: function($event) {
                                        return _vm.WorkOnNotifications(
                                          Notification.id
                                        )
                                      }
                                    }
                                  },
                                  [
                                    _vm._v(
                                      "\n                                    جاري العمل على المهمة\n                                "
                                    )
                                  ]
                                )
                              ])
                            : Notification.status == 3
                            ? _c("td", [
                                _c(
                                  "button",
                                  {
                                    staticClass:
                                      "shadow bg-green-600 focus:shadow-outline focus:outline-none text-white font-bold px-16 py-2 rounded",
                                    attrs: { type: "submit" },
                                    on: {
                                      click: function($event) {
                                        return _vm.CompletNotifications(
                                          Notification.id
                                        )
                                      }
                                    }
                                  },
                                  [
                                    _vm._v(
                                      "\n                                    مكتمل\n                                "
                                    )
                                  ]
                                )
                              ])
                            : _c("td", [
                                _vm._v(
                                  "\n                                المهمة انتهت\n                            "
                                )
                              ]),
                          _vm._v(" "),
                          _c("th", [
                            _c(
                              "button",
                              {
                                staticClass:
                                  "shadow bg-red-500 hover:bg-red-600 text-sm focus:shadow-outline focus:outline-none text-white px-10 py-2 rounded",
                                attrs: { type: "submit" },
                                on: {
                                  click: function($event) {
                                    return _vm.DeleteNotifications(
                                      Notification.id
                                    )
                                  }
                                }
                              },
                              [
                                _vm._v(
                                  "\n                                    حذف\n                                "
                                )
                              ]
                            )
                          ])
                        ]
                      )
                    })
                  ],
                  2
                )
              ]
            )
          ]),
          _vm._v(" "),
          _c(
            "div",
            {
              staticClass:
                "relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded p-4",
              class: {
                hidden: _vm.openTab !== 2,
                block: _vm.openTab === 2
              }
            },
            [
              _c(
                "form",
                {
                  staticClass: "add-form py-4",
                  on: {
                    submit: function($event) {
                      $event.preventDefault()
                      return _vm.sendNotifications.apply(null, arguments)
                    }
                  }
                },
                [
                  _c(
                    "div",
                    {
                      staticClass: "grid grid-cols-1 gap-4 sm:grid-cols-2 mb-4"
                    },
                    [
                      _c("div", [
                        _c(
                          "label",
                          {
                            staticClass:
                              "block text-black text-base py-2 font-medium md:text-right mb-1 md:mb-0"
                          },
                          [
                            _vm._v(
                              "\n                                المستخدم\n                            "
                            )
                          ]
                        ),
                        _vm._v(" "),
                        _c(
                          "select",
                          {
                            directives: [
                              {
                                name: "model",
                                rawName: "v-model",
                                value: _vm.selected,
                                expression: "selected"
                              }
                            ],
                            staticClass:
                              "select1 mt-1 block w-full rounded-md border border-gray-200 px-4 py-2 pl-3 pr-10 text-base max-w-4xl mx-auto focus:border-black focus:outline-none focus:ring-black sm:text-sm",
                            on: {
                              change: function($event) {
                                var $$selectedVal = Array.prototype.filter
                                  .call($event.target.options, function(o) {
                                    return o.selected
                                  })
                                  .map(function(o) {
                                    var val = "_value" in o ? o._value : o.value
                                    return val
                                  })
                                _vm.selected = $event.target.multiple
                                  ? $$selectedVal
                                  : $$selectedVal[0]
                              }
                            }
                          },
                          [
                            _c(
                              "option",
                              {
                                attrs: {
                                  selected: "",
                                  disabled: "",
                                  value: "0"
                                }
                              },
                              [_vm._v("الرجاء اختيار واحد")]
                            ),
                            _vm._v(" "),
                            _vm._l(_vm.users, function(user) {
                              return _c(
                                "option",
                                {
                                  key: user.id,
                                  domProps: { value: { id: user.id } }
                                },
                                [
                                  _vm._v(
                                    "\n                                    " +
                                      _vm._s(user.name) +
                                      "\n                                "
                                  )
                                ]
                              )
                            })
                          ],
                          2
                        )
                      ]),
                      _vm._v(" "),
                      _c("div", [
                        _c(
                          "label",
                          {
                            staticClass:
                              "block text-black text-base py-2 font-medium md:text-right mb-1 md:mb-0"
                          },
                          [
                            _vm._v(
                              "\n                                التاريخ\n                            "
                            )
                          ]
                        ),
                        _vm._v(" "),
                        _c("div", [
                          _c("input", {
                            directives: [
                              {
                                name: "model",
                                rawName: "v-model",
                                value: _vm.date,
                                expression: "date"
                              }
                            ],
                            staticClass:
                              "appearance-none border border-gray-200 rounded w-full py-2.5 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-black",
                            attrs: { type: "date" },
                            domProps: { value: _vm.date },
                            on: {
                              input: function($event) {
                                if ($event.target.composing) {
                                  return
                                }
                                _vm.date = $event.target.value
                              }
                            }
                          })
                        ])
                      ])
                    ]
                  ),
                  _vm._v(" "),
                  _vm._m(1),
                  _vm._v(" "),
                  _c("div", { staticClass: "md:w-2/3" }, [
                    _c("textarea", {
                      directives: [
                        {
                          name: "model",
                          rawName: "v-model",
                          value: _vm.Notifications,
                          expression: "Notifications"
                        }
                      ],
                      staticClass:
                        "appearance-none border border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-black",
                      attrs: {
                        rows: "6",
                        cols: "50",
                        id: "inline-full-name",
                        type: "text"
                      },
                      domProps: { value: _vm.Notifications },
                      on: {
                        input: function($event) {
                          if ($event.target.composing) {
                            return
                          }
                          _vm.Notifications = $event.target.value
                        }
                      }
                    })
                  ]),
                  _vm._v(" "),
                  _vm._m(2)
                ]
              )
            ]
          ),
          _vm._v(" "),
          _c(
            "div",
            {
              staticClass:
                "relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded p-4",
              class: { hidden: _vm.openTab !== 3, block: _vm.openTab === 3 }
            },
            [
              _vm._m(3),
              _vm._v(" "),
              _c("div", { staticClass: "md:w-2/3 mb-8" }, [
                _c(
                  "select",
                  {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: _vm.selectedAdmin,
                        expression: "selectedAdmin"
                      }
                    ],
                    staticClass:
                      "select1 mt-1 block w-full rounded-md border border-gray-200 px-4 py-2 pl-3 pr-10 text-base max-w-4xl mx-auto focus:border-black focus:outline-none focus:ring-black sm:text-sm",
                    on: {
                      change: [
                        function($event) {
                          var $$selectedVal = Array.prototype.filter
                            .call($event.target.options, function(o) {
                              return o.selected
                            })
                            .map(function(o) {
                              var val = "_value" in o ? o._value : o.value
                              return val
                            })
                          _vm.selectedAdmin = $event.target.multiple
                            ? $$selectedVal
                            : $$selectedVal[0]
                        },
                        function($event) {
                          return _vm.AdminNotifications($event)
                        }
                      ]
                    }
                  },
                  [
                    _c(
                      "option",
                      { attrs: { selected: "", disabled: "", value: "0" } },
                      [_vm._v("الرجاء اختيار واحد")]
                    ),
                    _vm._v(" "),
                    _vm._l(_vm.users, function(user) {
                      return _c(
                        "option",
                        { key: user.id, domProps: { value: user.id } },
                        [
                          _vm._v(
                            "\n                            " +
                              _vm._s(user.name) +
                              "\n                        "
                          )
                        ]
                      )
                    })
                  ],
                  2
                )
              ]),
              _vm._v(" "),
              _c(
                "table",
                { staticClass: "text-center" },
                [
                  _vm._m(4),
                  _vm._v(" "),
                  _vm._l(_vm.allNotifications, function(Notification) {
                    return _c(
                      "tr",
                      {
                        key: Notification.id,
                        attrs: { value: Notification.id }
                      },
                      [
                        _c("td", [
                          _vm._v(
                            _vm._s(Notification.Notifications.Notifications)
                          )
                        ]),
                        _vm._v(" "),
                        _c("td", [_vm._v(_vm._s(Notification.note))]),
                        _vm._v(" "),
                        Notification.Notifications.date
                          ? _c("td", [
                              _vm._v(
                                "\n                            " +
                                  _vm._s(Notification.Notifications.date) +
                                  "\n                        "
                              )
                            ])
                          : _c("td", [_vm._v("لا يوجد وقت")]),
                        _vm._v(" "),
                        Notification.status == 1
                          ? _c("td", [
                              _vm._v(
                                "\n                            استلام المهمة\n                        "
                              )
                            ])
                          : Notification.status == 2
                          ? _c("td", [
                              _vm._v(
                                "\n                            جاري العمل على المهمة\n                        "
                              )
                            ])
                          : Notification.status == 3
                          ? _c("td", [
                              _vm._v(
                                "\n                            مكتمل\n                        "
                              )
                            ])
                          : _c("td", [
                              _vm._v(
                                "\n                            المهمة انجزت\n                        "
                              )
                            ]),
                        _vm._v(" "),
                        Notification.done
                          ? _c("td", [
                              _vm._v(
                                "\n                            مكتمل\n                        "
                              )
                            ])
                          : _c("td", [
                              _vm._v(
                                "\n                            تم\n                        "
                              )
                            ])
                      ]
                    )
                  })
                ],
                2
              )
            ]
          ),
          _vm._v(" "),
          _c("div", { staticClass: "overflow-x-auto" }, [
            _c(
              "div",
              {
                staticClass:
                  "relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded p-4 for-mobile-scoll-x",
                class: { hidden: _vm.openTab !== 4, block: _vm.openTab === 4 }
              },
              [
                _c(
                  "table",
                  { staticClass: "text-center" },
                  [
                    _vm._m(5),
                    _vm._v(" "),
                    _vm._l(_vm.myAlertNotification, function(Notification) {
                      return _c(
                        "tr",
                        {
                          key: Notification.id,
                          attrs: { value: Notification.id }
                        },
                        [
                          _c("td", [
                            _vm._v(
                              _vm._s(Notification.Notifications.Notifications)
                            )
                          ]),
                          _vm._v(" "),
                          _c("td", { staticClass: "flex w-full h-full" }, [
                            _c(
                              "label",
                              {
                                staticClass:
                                  "mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white",
                                attrs: { for: "search" }
                              },
                              [_vm._v("Search")]
                            ),
                            _vm._v(" "),
                            _c("div", { staticClass: "relative w-full" }, [
                              _c("input", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: Notification.note,
                                    expression: "Notification.note"
                                  }
                                ],
                                staticClass:
                                  "block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500",
                                attrs: {
                                  type: "text",
                                  id: "fname",
                                  required: ""
                                },
                                domProps: { value: Notification.note },
                                on: {
                                  input: function($event) {
                                    if ($event.target.composing) {
                                      return
                                    }
                                    _vm.$set(
                                      Notification,
                                      "note",
                                      $event.target.value
                                    )
                                  }
                                }
                              })
                            ])
                          ]),
                          _vm._v(" "),
                          _c("td", [_vm._v(_vm._s(Notification.sender.name))]),
                          _vm._v(" "),
                          Notification.Notifications.date
                            ? _c("td", [
                                _vm._v(
                                  "\n                                " +
                                    _vm._s(Notification.Notifications.date) +
                                    "\n                            "
                                )
                              ])
                            : _c("td", [_vm._v("لا يوجد وقت")])
                        ]
                      )
                    })
                  ],
                  2
                )
              ]
            )
          ])
        ])
      ])
    ],
    1
  )
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("tr", [
      _c("th", { staticStyle: { width: "40%" } }, [_vm._v("المهمة")]),
      _vm._v(" "),
      _c("th", { staticStyle: { width: "40%" } }, [_vm._v("الملاحضات")]),
      _vm._v(" "),
      _c("th", { staticStyle: { width: "10%" } }, [_vm._v("المرسل")]),
      _vm._v(" "),
      _c("th", { staticStyle: { width: "10%" } }, [_vm._v("التاريخ")]),
      _vm._v(" "),
      _c("th", [_vm._v("تم")]),
      _vm._v(" "),
      _c("th", [_vm._v("حذف")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "md:w-1/3" }, [
      _c(
        "label",
        {
          staticClass:
            "block text-black text-base py-2 font-medium md:text-right mb-1 md:mb-0"
        },
        [
          _vm._v(
            "\n                            المهمة\n                        "
          )
        ]
      )
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "md:w-2/3" }, [
      _c(
        "button",
        {
          staticClass:
            "shadow bg-green-600 hover:bg-green-500 mt-4 focus:shadow-outline focus:outline-none text-white font-medium px-16 py-4 rounded"
        },
        [_vm._v("\n                            حفظ\n                        ")]
      )
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "md:w-1/3" }, [
      _c(
        "label",
        {
          staticClass:
            "block text-black text-base py-2 font-medium md:text-right mb-1 md:mb-0"
        },
        [_vm._v("\n                        المستخدم\n                    ")]
      )
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("tr", [
      _c("th", { staticStyle: { width: "40%" } }, [_vm._v("المهمة")]),
      _vm._v(" "),
      _c("th", { staticStyle: { width: "40%" } }, [_vm._v("الملاحضات")]),
      _vm._v(" "),
      _c("th", { staticStyle: { width: "10%" } }, [_vm._v("التاريخ")]),
      _vm._v(" "),
      _c("th", { staticStyle: { width: "10%" } }, [_vm._v("الحالة")]),
      _vm._v(" "),
      _c("th", [_vm._v("تم")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("tr", [
      _c("th", { staticStyle: { width: "40%" } }, [_vm._v("المهمة")]),
      _vm._v(" "),
      _c("th", { staticStyle: { width: "40%" } }, [_vm._v("الملاحضات")]),
      _vm._v(" "),
      _c("th", { staticStyle: { width: "10%" } }, [_vm._v("المرسل")]),
      _vm._v(" "),
      _c("th", { staticStyle: { width: "10%" } }, [_vm._v("التاريخ")])
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-68ff5483", module.exports)
  }
}

/***/ }),
/* 11 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),
/* 12 */,
/* 13 */,
/* 14 */,
/* 15 */
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(16);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(6)("6c975c06", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../node_modules/css-loader/index.js!../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-68ff5483\",\"scoped\":false,\"hasInlineConfig\":true}!../../../node_modules/vue-loader/lib/selector.js?type=styles&index=1!./Tool.vue", function() {
     var newContent = require("!!../../../node_modules/css-loader/index.js!../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-68ff5483\",\"scoped\":false,\"hasInlineConfig\":true}!../../../node_modules/vue-loader/lib/selector.js?type=styles&index=1!./Tool.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),
/* 16 */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(5)(false);
// imports


// module
exports.push([module.i, "\ntable {\n    font-family: arial, sans-serif;\n    border-collapse: collapse;\n    width: 100%;\n}\ntd,\nth {\n    border: 1px solid #dddddd;\n\n    padding: 8px;\n}\n.for-mobile-scoll-x {\n    min-width: 800px;\n}\n", ""]);

// exports


/***/ })
/******/ ]);