window.addToBasket = function (buttonNode, productId) {
    event.preventDefault();
    fetch('/api/basket/add?product_id=' + productId, {method: 'POST'})
        .then(() => {
                buttonNode.closest('.product').querySelector('.count .count').value
                    = parseInt(buttonNode.closest('.product').querySelector('.count .count').value) + 1;
                basketProductsCount(event);
                recalculateSumms();
            }
        );
}

window.subtructFromBasket = function (event) {
    event.preventDefault();
    fetch('/api/basket/subtract?product_id=' + productId, {method: 'POST'})
        .then(() => {
                if (buttonNode.closest('.product').querySelector('.count .count').value > 1) {
                    buttonNode.closest('.product').querySelector('.count .count').value
                        = parseInt(buttonNode.closest('.product').querySelector('.count .count').value) - 1;
                    basketProductsCount();
                    recalculateSumms();
                }
            }
        );
}

window.removeFromBasket = function (buttonNode, productId) {
    event.preventDefault();
    fetch('/api/basket/remove?product_id=' + productId, {method: 'POST'})
        .then(() => {
                buttonNode.closest('.product').parentNode.removeChild(buttonNode.closest('.product'));
                basketProductsCount();
                recalculateSumms();
            }
        );
}

window.setProductCount = function (inputNode, productId) {
    event.preventDefault();
    console.log(event.target)
    fetch('/api/basket/set-product-count?product_id=' + productId + '&count=' + inputNode.value,{method: 'POST'})
        .then(() => {
                console.log('seted')
            }
        );
}

// обновляет количество товаров в корзине -- функция продублирована в common.js, нужно подумать, что с этим делать
function basketProductsCount() {
    fetch('/api/basket/get-produts-count', {method: 'GET', headers: {'X-Requested-With': 'XMLHttpRequest'},})
        .then(response => {
            response.text().then(data => {
                document.querySelector('.basket-widget .products-count').innerHTML = data;
            });
        });
}

// Пересчитывает итоговые суммы по каждому товару и общую сумму по заказу
function recalculateSumms() {
    let total = 0;
    document.querySelectorAll('#basket .products .product').forEach(productRow => {
        const price = parseFloat(productRow.querySelector('.price span').innerHTML);
        const count = parseFloat(productRow.querySelector('.count input').value);
        const summ = price * count;
        productRow.querySelector('.summ span').innerHTML = summ;

        total += price * count;
    });
    document.querySelector('.total span').innerHTML = total;
}


