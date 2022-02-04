/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/basket-modal.js":
/*!**************************************!*\
  !*** ./resources/js/basket-modal.js ***!
  \**************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ getBasketModal)
/* harmony export */ });
function getBasketModal() {
  fetch('/api/basket/get-modal', {
    method: 'GET',
    headers: {
      'X-Requested-With': 'XMLHttpRequest'
    }
  }).then(function (response) {
    response.text().then(function (modalContent) {
      var modal = document.createElement('div');
      modal.classList.add('modal');
      modal.innerHTML = modalContent;
      document.querySelector('body').appendChild(modal);
      modal.addEventListener('click', function (event) {
        if (event.target.classList.contains('add') || event.target.closest('button').classList.contains('add')) {
          console.log('add');
          fetch('/api/basket/add?product_id=' + event.target.closest('.product').getAttribute('data-product-id'), {
            method: 'POST'
          }).then(function () {
            event.target.closest('.product').querySelector('.count .count').value = parseInt(event.target.closest('.product').querySelector('.count .count').value) + 1;
            basketProductsCount();
            recalculateSumms();
          });
        } else if (event.target.classList.contains('subtract') || event.target.closest('button').classList.contains('subtract')) {
          console.log('subtract');

          if (parseInt(event.target.closest('.product').querySelector('.count .count').value) > 1) {
            fetch('/api/basket/subtract?product_id=' + event.target.closest('.product').getAttribute('data-product-id'), {
              method: 'POST'
            }).then(function () {
              event.target.closest('.product').querySelector('.count .count').value = parseInt(event.target.closest('.product').querySelector('.count .count').value) - 1;
              basketProductsCount();
              recalculateSumms();
            });
          }
        } else if (event.target.classList.contains('remove') || event.target.closest('button').classList.contains('remove')) {
          console.log('remove');
          fetch('/api/basket/remove?product_id=' + event.target.closest('.product').getAttribute('data-product-id'), {
            method: 'POST'
          }).then(function () {
            event.target.closest('.product').parentNode.removeChild(event.target.closest('.product'));
            basketProductsCount();
            recalculateSumms();
          });
        } else if (event.target.classList.contains('close-modal') || event.target.closest('button').classList.contains('close-modal')) {
          modal.parentNode.removeChild(modal);
        }
      });
    });
  }); // обновляет количество товаров в корзине -- функция продублирована в common.js, нужно подумать, что с этим делать

  var basketProductsCount = function basketProductsCount() {
    fetch('/api/basket/get-produts-count', {
      method: 'GET',
      headers: {
        'X-Requested-With': 'XMLHttpRequest'
      }
    }).then(function (response) {
      response.text().then(function (data) {
        document.querySelector('.basket-widget .products-count').innerHTML = data;
      });
    });
  }; // Пересчитывает итоговые суммы по каждому товару и общую сумму по заказу


  var recalculateSumms = function recalculateSumms() {
    var total = 0;
    document.querySelectorAll('.modal .products .product').forEach(function (productRow) {
      var price = parseFloat(productRow.querySelector('.price span').innerHTML);
      var count = parseFloat(productRow.querySelector('.count input').value);
      var summ = price * count;
      productRow.querySelector('.summ span').innerHTML = summ;
      total += price * count;
    });
    document.querySelector('.total span').innerHTML = total;
  };
}

/***/ }),

/***/ "./resources/js/common.js":
/*!********************************!*\
  !*** ./resources/js/common.js ***!
  \********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _basket_modal__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./basket-modal */ "./resources/js/basket-modal.js");
/* harmony import */ var _wishlist_modal__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./wishlist-modal */ "./resources/js/wishlist-modal.js");


basketProductsCount();
wishlistProductsCount();
document.addEventListener('click', function (event) {
  var targetElement = event.target;
  var targetElementClass = targetElement.className.toLowerCase(); // Main menu

  if (event.target.closest('.first-level > .item')) {
    closeOpenedMenuItems(event);
    event.target.closest('.first-level').querySelector('.sub-categories').classList.toggle('open');
  } else {
    closeOpenedMenuItems(event);
  } // Add product to basket


  if (targetElement.classList.contains('add-to-basket') || targetElement.closest('.add-to-basket')) {
    var productId = targetElement.closest('.product').getAttribute('data-product-id');
    var apiUrl = '/api/basket/add?product_id=' + productId;
    fetch(apiUrl, {
      method: 'POST'
    }).then(basketProductsCount(), (0,_basket_modal__WEBPACK_IMPORTED_MODULE_0__.default)());
  } // Add product to wishlist


  if (targetElement.classList.contains('add-to-wishlist') || targetElement.closest('.add-to-wishlist')) {
    var _productId = targetElement.closest('.product').getAttribute('data-product-id');

    var _apiUrl = '/api/wishlist/add?product_id=' + _productId;

    fetch(_apiUrl, {
      method: 'POST'
    }).then((0,_wishlist_modal__WEBPACK_IMPORTED_MODULE_1__.default)(), wishlistProductsCount());
  }
}); // обновляет количество товаров в корзине

function basketProductsCount() {
  fetch('/api/basket/get-produts-count', {
    method: 'GET',
    headers: {
      'X-Requested-With': 'XMLHttpRequest'
    }
  }).then(function (response) {
    response.text().then(function (data) {
      document.querySelector('.basket-widget .products-count').innerHTML = data;
    });
  });
} // обновляет количество товаров в закладках


function wishlistProductsCount() {
  fetch('/api/wishlist/get-produts-count', {
    method: 'GET',
    headers: {
      'X-Requested-With': 'XMLHttpRequest'
    }
  }).then(function (response) {
    response.text().then(function (count) {
      var countContainer = document.querySelector('.wishlist-widget .products-count');

      if (count > 0) {
        if (!countContainer) {
          countContainer = document.createElement('div');
          countContainer.classList.add('products-count');
          document.querySelector('.wishlist-widget').appendChild(countContainer);
        }

        countContainer.innerHTML = count;
      } else {
        if (countContainer) {
          countContainer.parentNode.removeChild(countContainer);
        }
      }
    });
  });
}

function closeOpenedMenuItems(event) {
  var openedMenuItems = document.querySelectorAll('.open');
  openedMenuItems.forEach(function (item) {
    if (item.closest('.first-level') != event.target.closest('.first-level')) {
      item.classList.remove('open');
    }
  });
} // Клик по виджету корзины


document.querySelector('.basket-widget').addEventListener('click', function () {
  (0,_basket_modal__WEBPACK_IMPORTED_MODULE_0__.default)();
}); // Клик по виджету закладок

document.querySelector('.wishlist-widget').addEventListener('click', function () {
  (0,_wishlist_modal__WEBPACK_IMPORTED_MODULE_1__.default)();
}); // function modalInit() {
//     document.querySelector('.modal').addEventListener('click', (event) => {
//         if (event.target.classList.contains('close-modal') || !event.target.closest('.modal-content')) {
//             closeModal();
//         }
//     });
// }

window.closeModal = function closeModal() {
  var modal = document.querySelector('.modal');
  modal.parentNode.removeChild(modal);
}; //////////////////////////////////

/***/ }),

/***/ "./resources/js/wishlist-modal.js":
/*!****************************************!*\
  !*** ./resources/js/wishlist-modal.js ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ getWishlistModal)
/* harmony export */ });
function getWishlistModal() {
  fetch('/api/wishlist/get-modal', {
    method: 'GET',
    headers: {
      'X-Requested-With': 'XMLHttpRequest'
    }
  }).then(function (response) {
    response.text().then(function (modalContent) {
      var modal = document.createElement('div');
      modal.classList.add('modal');
      modal.innerHTML = modalContent;
      document.querySelector('body').appendChild(modal);
      modal.addEventListener('click', function (event) {
        if (event.target.classList.contains('add') || event.target.closest('button').classList.contains('add')) {
          console.log('add');
          fetch('/api/basket/add?product_id=' + event.target.closest('.product').getAttribute('data-product-id'), {
            method: 'POST'
          }).then(function () {
            event.target.closest('.product').querySelector('.count .count').value = parseInt(event.target.closest('.product').querySelector('.count .count').value) + 1;
            basketProductsCount();
            recalculateSumms();
          });
        } else if (event.target.classList.contains('subtract') || event.target.closest('button').classList.contains('subtract')) {
          console.log('subtract');

          if (parseInt(event.target.closest('.product').querySelector('.count .count').value) > 1) {
            fetch('/api/basket/subtract?product_id=' + event.target.closest('.product').getAttribute('data-product-id'), {
              method: 'POST'
            }).then(function () {
              event.target.closest('.product').querySelector('.count .count').value = parseInt(event.target.closest('.product').querySelector('.count .count').value) - 1;
              basketProductsCount();
              recalculateSumms();
            });
          }
        } else if (event.target.classList.contains('remove') || event.target.closest('button').classList.contains('remove')) {
          console.log('remove');
          fetch('/api/basket/remove?product_id=' + event.target.closest('.product').getAttribute('data-product-id'), {
            method: 'POST'
          }).then(function () {
            event.target.closest('.product').parentNode.removeChild(event.target.closest('.product'));
            basketProductsCount();
            recalculateSumms();
          });
        } else if (event.target.classList.contains('close-modal') || event.target.closest('button').classList.contains('close-modal')) {
          modal.parentNode.removeChild(modal);
        }
      });
    });
  }); // обновляет количество товаров в корзине -- функция продублирована в common.js, нужно подумать, что с этим делать

  var basketProductsCount = function basketProductsCount() {
    fetch('/api/basket/get-produts-count', {
      method: 'GET',
      headers: {
        'X-Requested-With': 'XMLHttpRequest'
      }
    }).then(function (response) {
      response.text().then(function (data) {
        document.querySelector('.basket-widget .products-count').innerHTML = data;
      });
    });
  }; // Пересчитывает итоговые суммы по каждому товару и общую сумму по заказу


  var recalculateSumms = function recalculateSumms() {
    var total = 0;
    document.querySelectorAll('.modal .products .product').forEach(function (productRow) {
      var price = parseFloat(productRow.querySelector('.price span').innerHTML);
      var count = parseFloat(productRow.querySelector('.count input').value);
      var summ = price * count;
      productRow.querySelector('.summ span').innerHTML = summ;
      total += price * count;
    });
    document.querySelector('.total span').innerHTML = total;
  };
}

/***/ }),

/***/ "./resources/css/front/product-page.css":
/*!**********************************************!*\
  !*** ./resources/css/front/product-page.css ***!
  \**********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/front/main-page.css":
/*!*******************************************!*\
  !*** ./resources/css/front/main-page.css ***!
  \*******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/front/info-page.css":
/*!*******************************************!*\
  !*** ./resources/css/front/info-page.css ***!
  \*******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/front/user-sitemap.css":
/*!**********************************************!*\
  !*** ./resources/css/front/user-sitemap.css ***!
  \**********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/front/brands.css":
/*!****************************************!*\
  !*** ./resources/css/front/brands.css ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/front/blog.css":
/*!**************************************!*\
  !*** ./resources/css/front/blog.css ***!
  \**************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/front/article.css":
/*!*****************************************!*\
  !*** ./resources/css/front/article.css ***!
  \*****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/front/basket.css":
/*!****************************************!*\
  !*** ./resources/css/front/basket.css ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/front/contacts-page.css":
/*!***********************************************!*\
  !*** ./resources/css/front/contacts-page.css ***!
  \***********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/front/thank-you-page.css":
/*!************************************************!*\
  !*** ./resources/css/front/thank-you-page.css ***!
  \************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/front/login.css":
/*!***************************************!*\
  !*** ./resources/css/front/login.css ***!
  \***************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/front/common.css":
/*!****************************************!*\
  !*** ./resources/css/front/common.css ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/front/header.css":
/*!****************************************!*\
  !*** ./resources/css/front/header.css ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/front/footer.css":
/*!****************************************!*\
  !*** ./resources/css/front/footer.css ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/front/bread-crumbs.css":
/*!**********************************************!*\
  !*** ./resources/css/front/bread-crumbs.css ***!
  \**********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/front/category-page.css":
/*!***********************************************!*\
  !*** ./resources/css/front/category-page.css ***!
  \***********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					result = fn();
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/js/common": 0,
/******/ 			"css/common": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			for(moduleId in moreModules) {
/******/ 				if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 					__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 				}
/******/ 			}
/******/ 			if(runtime) var result = runtime(__webpack_require__);
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkIds[i]] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunk"] = self["webpackChunk"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["css/common"], () => (__webpack_require__("./resources/js/common.js")))
/******/ 	__webpack_require__.O(undefined, ["css/common"], () => (__webpack_require__("./resources/css/front/common.css")))
/******/ 	__webpack_require__.O(undefined, ["css/common"], () => (__webpack_require__("./resources/css/front/header.css")))
/******/ 	__webpack_require__.O(undefined, ["css/common"], () => (__webpack_require__("./resources/css/front/footer.css")))
/******/ 	__webpack_require__.O(undefined, ["css/common"], () => (__webpack_require__("./resources/css/front/bread-crumbs.css")))
/******/ 	__webpack_require__.O(undefined, ["css/common"], () => (__webpack_require__("./resources/css/front/category-page.css")))
/******/ 	__webpack_require__.O(undefined, ["css/common"], () => (__webpack_require__("./resources/css/front/product-page.css")))
/******/ 	__webpack_require__.O(undefined, ["css/common"], () => (__webpack_require__("./resources/css/front/main-page.css")))
/******/ 	__webpack_require__.O(undefined, ["css/common"], () => (__webpack_require__("./resources/css/front/info-page.css")))
/******/ 	__webpack_require__.O(undefined, ["css/common"], () => (__webpack_require__("./resources/css/front/user-sitemap.css")))
/******/ 	__webpack_require__.O(undefined, ["css/common"], () => (__webpack_require__("./resources/css/front/brands.css")))
/******/ 	__webpack_require__.O(undefined, ["css/common"], () => (__webpack_require__("./resources/css/front/blog.css")))
/******/ 	__webpack_require__.O(undefined, ["css/common"], () => (__webpack_require__("./resources/css/front/article.css")))
/******/ 	__webpack_require__.O(undefined, ["css/common"], () => (__webpack_require__("./resources/css/front/basket.css")))
/******/ 	__webpack_require__.O(undefined, ["css/common"], () => (__webpack_require__("./resources/css/front/contacts-page.css")))
/******/ 	__webpack_require__.O(undefined, ["css/common"], () => (__webpack_require__("./resources/css/front/thank-you-page.css")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["css/common"], () => (__webpack_require__("./resources/css/front/login.css")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;