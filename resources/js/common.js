import getBasketModal from "./basket-modal";
import getWishlistModal from "./wishlist-modal";

basketProductsCount();
wishlistProductsCount();





document.addEventListener('click', (event) => {
    const targetElement = event.target;
    const targetElementClass = targetElement.className.toLowerCase();

    // Main menu
    if (event.target.closest('.first-level > .item')) {
        closeOpenedMenuItems(event);
        event.target.closest('.first-level')
            .querySelector('.sub-categories')
            .classList.toggle('open');
    } else {
        closeOpenedMenuItems(event);
    }

    // Add product to basket
    if (targetElement.classList.contains('add-to-basket') || targetElement.closest('.add-to-basket')) {
        const productId = targetElement.closest('.product').getAttribute('data-product-id');
        const apiUrl = '/api/basket/add?product_id=' + productId;
        fetch(apiUrl, {method: 'POST'})
            .then(
                basketProductsCount(),
                getBasketModal()
            );
    }

    // Add product to wishlist
    if (targetElement.classList.contains('add-to-wishlist') || targetElement.closest('.add-to-wishlist')) {
        const productId = targetElement.closest('.product').getAttribute('data-product-id');

        const apiUrl = '/api/wishlist/add?product_id=' + productId;
        fetch(apiUrl, {method: 'POST'})
            .then(
                getWishlistModal(),
                wishlistProductsCount()
            )
        ;
    }
});

// обновляет количество товаров в корзине
function basketProductsCount() {
    fetch('/api/basket/get-produts-count', {method: 'GET', headers: {'X-Requested-With': 'XMLHttpRequest'},})
        .then(response => {
            response.text().then(data => {
                document.querySelector('.basket-widget .products-count').innerHTML = data;
            });
        });
}

// обновляет количество товаров в закладках

function wishlistProductsCount() {
    fetch('/api/wishlist/get-produts-count', {method: 'GET', headers: {'X-Requested-With': 'XMLHttpRequest'},})
        .then(response => {
            response.text().then(count => {

                let countContainer = document.querySelector('.wishlist-widget .products-count');

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
    let openedMenuItems = document.querySelectorAll('.open');
    openedMenuItems.forEach(item => {
        if (item.closest('.first-level') != event.target.closest('.first-level')) {
            item.classList.remove('open');
        }
    });
}


// Клик по виджету корзины
document.querySelector('.basket-widget').addEventListener('click', () => {
    getBasketModal();
});
// Клик по виджету закладок
document.querySelector('.wishlist-widget').addEventListener('click', () => {
    getWishlistModal();
});

// function modalInit() {
//     document.querySelector('.modal').addEventListener('click', (event) => {
//         if (event.target.classList.contains('close-modal') || !event.target.closest('.modal-content')) {
//             closeModal();
//         }
//     });
// }

window.closeModal = function closeModal() {
    let modal = document.querySelector('.modal');
    modal.parentNode.removeChild(modal);
}




//////////////////////////////////


