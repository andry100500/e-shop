export default function getWishlistModal() {

    fetch('/api/wishlist/get-modal', {method: 'GET', headers: {'X-Requested-With': 'XMLHttpRequest'},})
        .then(response => {
            response.text().then(modalContent => {
                let modal = document.createElement('div');
                modal.classList.add('modal');
                modal.innerHTML = modalContent;
                document.querySelector('body').appendChild(modal);

                modal.addEventListener('click', (event) => {

                    if (event.target.classList.contains('add') || event.target.closest('button').classList.contains('add')) {
                        console.log('add');

                        fetch('/api/basket/add?product_id=' + event.target.closest('.product').getAttribute('data-product-id'),
                            {method: 'POST'})
                            .then(() => {
                                    event.target.closest('.product').querySelector('.count .count').value
                                        = parseInt(event.target.closest('.product').querySelector('.count .count').value) + 1;
                                    basketProductsCount();
                                    recalculateSumms();
                                }
                            );

                    } else if (event.target.classList.contains('subtract') || event.target.closest('button').classList.contains('subtract')) {
                        console.log('subtract');

                        if (parseInt(event.target.closest('.product').querySelector('.count .count').value) > 1) {
                            fetch('/api/basket/subtract?product_id=' + event.target.closest('.product').getAttribute('data-product-id'),
                                {method: 'POST'})
                                .then(() => {
                                        event.target.closest('.product').querySelector('.count .count').value
                                            = parseInt(event.target.closest('.product').querySelector('.count .count').value) - 1;
                                        basketProductsCount();
                                        recalculateSumms();
                                    }
                                );
                        }

                    } else if (event.target.classList.contains('remove') || event.target.closest('button').classList.contains('remove')) {
                        console.log('remove');
                        fetch('/api/basket/remove?product_id=' + event.target.closest('.product').getAttribute('data-product-id'),
                            {method: 'POST'})
                            .then(() => {
                                    event.target.closest('.product').parentNode.removeChild(event.target.closest('.product'));
                                    basketProductsCount();
                                    recalculateSumms();
                                }
                            );


                    } else if (event.target.classList.contains('close-modal') || event.target.closest('button').classList.contains('close-modal')) {
                        modal.parentNode.removeChild(modal);
                    }
                });


            });
        });


    // обновляет количество товаров в корзине -- функция продублирована в common.js, нужно подумать, что с этим делать
    let basketProductsCount = () => {
        fetch('/api/basket/get-produts-count', {method: 'GET', headers: {'X-Requested-With': 'XMLHttpRequest'},})
            .then(response => {
                response.text().then(data => {
                    document.querySelector('.basket-widget .products-count').innerHTML = data;
                });
            });
    }


// Пересчитывает итоговые суммы по каждому товару и общую сумму по заказу
    let recalculateSumms = () => {
        let total = 0;
        document.querySelectorAll('.modal .products .product').forEach(productRow => {
            let price = parseFloat(productRow.querySelector('.price span').innerHTML);
            let count = parseFloat(productRow.querySelector('.count input').value);
            let summ = price * count;
            productRow.querySelector('.summ span').innerHTML = summ;
            total += price * count;
        });
        document.querySelector('.total span').innerHTML = total;
    }
}


