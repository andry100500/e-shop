/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	// The require scope
/******/ 	var __webpack_require__ = {};
/******/ 	
/************************************************************************/
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
/************************************************************************/
var __webpack_exports__ = {};
/*!**************************************!*\
  !*** ./resources/js/basket-modal.js ***!
  \**************************************/
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
/******/ })()
;