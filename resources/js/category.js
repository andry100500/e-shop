document.addEventListener('click', (event) => {
    const targetElement = event.target;


    // Подгрузка товаров в каталоге
    if (targetElement.classList.contains('.show-more-produts') || targetElement.closest('.show-more-produts')) {


        let currentPage = 1;



        let nextPagelink = document.querySelector('.next-page a').href;

        fetch(nextPagelink, {method: 'GET', headers: {'X-Requested-With': 'XMLHttpRequest'},})
            .then(response => {
                response.text().then(data => {
                    let domObject = document.createElement('div');
                    domObject.innerHTML = data;


                    let products = domObject.querySelectorAll('.products .product');

                    products.forEach(product => {
                        let productsContainer = document.querySelector('.products');
                        productsContainer.appendChild(product);
                    })
                    // После первой подгрузки страницы не понимает, что нужно теперь загружать следующую
                });
            });
    }

})
