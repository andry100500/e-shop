/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************!*\
  !*** ./resources/js/category.js ***!
  \**********************************/
document.addEventListener('click', function (event) {
  var targetElement = event.target; // Подгрузка товаров в каталоге

  if (targetElement.classList.contains('.show-more-produts') || targetElement.closest('.show-more-produts')) {
    var currentPage = 1;
    var nextPagelink = document.querySelector('.next-page a').href;
    fetch(nextPagelink, {
      method: 'GET',
      headers: {
        'X-Requested-With': 'XMLHttpRequest'
      }
    }).then(function (response) {
      response.text().then(function (data) {
        var domObject = document.createElement('div');
        domObject.innerHTML = data;
        var products = domObject.querySelectorAll('.products .product');
        products.forEach(function (product) {
          var productsContainer = document.querySelector('.products');
          productsContainer.appendChild(product);
        }); // После первой подгрузки страницы не понимает, что нужно теперь загружать следующую
      });
    });
  }
});
/******/ })()
;