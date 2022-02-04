document.querySelector('.products').addEventListener('click', (event)=>{
    const targetElement = event.target;


    // удаление товара из закладок
    if (targetElement.getAttribute('name') === 'remove') {

        const productRow = targetElement.closest('.product');
        const productId = productRow.getAttribute('data-product-id');
        const apiUrl = '/api/wishlist/remove?product_id=' + productId;


        fetch(apiUrl, {method: 'POST'})
            .then(
                productRow.parentNode.removeChild(productRow),
                setTimeout(() => {
                    wishlistProductsCount();
                }, 500)
            );

    }



})



// обновляет количество товаров в закладках -- функция продублирована в wishlist.js, нужно подумать, что с этим делать
function wishlistProductsCount() {
    fetch('/api/wishlist/get-produts-count', {method: 'GET', headers: {'X-Requested-With': 'XMLHttpRequest'},})
        .then(response => {
            response.text().then(count => {

                if (count > 0) {

                    let countContainer = document.querySelector('.wishlist-widget .products-count');

                    if (!countContainer){
                        let countContainer = document.createElement('div');
                        countContainer.classList.add('products-count');
                    }

                    countContainer.innerHTML = count;

                    document.querySelector('.wishlist-widget').appendChild(countContainer);
                }else {
                    let countContainer = document.querySelector('.wishlist-widget .products-count');
                    countContainer.parentNode.removeChild(countContainer);
                }

            });
        });
}
