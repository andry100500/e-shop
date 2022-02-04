productImagesInit('#product-images');


function productImagesInit(imagesBlockSelector) {
    let imagesBlock = document.querySelector(imagesBlockSelector);
    imagesBlock.addEventListener('click', (event) => {
        event.preventDefault();
        if (event.target.classList.contains('big-image')) {
            showImageModal();
        } else if (event.target.classList.contains('small-image')) {
            changeBigImage(event);
        }
    });
}

function showImageModal() {
    let modal = document.createElement('div');
    modal.classList.add('modal');
    modal.innerHTML = '<div class="modal-content"><div class="image-block"></div></div>';
    let bigImage = document.querySelector('.big-image');
    let currentBigestImage = bigImage.cloneNode();
    currentBigestImage.setAttribute('src', bigImage.closest('a').getAttribute('href'));

    let modalImageBlock = modal.querySelector('.image-block');
    modalImageBlock.appendChild(currentBigestImage);

    let prevButton = document.createElement('div');
    prevButton.classList.add('prev-area');
    prevButton.innerHTML = "<";

    let nextButton = document.createElement('div');
    nextButton.classList.add('next-area');
    nextButton.innerHTML = '>';

    let closeButton = document.createElement('div');
    closeButton.classList.add('close-modal');
    closeButton.innerHTML = 'X';

    modalImageBlock.appendChild(prevButton, nextButton);
    modalImageBlock.appendChild(nextButton);
    modalImageBlock.appendChild(closeButton);


    document.querySelector('body').appendChild(modal);


    let imagesList = document.querySelectorAll('.small-images a');
    let imageNode = modal.querySelector('.big-image');

    // инициируем создание слайдера картинок в модальном окне
    let imageSlider = new ImageSlider(imagesList, imageNode);

    modal.addEventListener('click', (event) => {
        if (event.target.classList.contains('prev-area')) {
            imageSlider.showPrevImage();

        } else if (event.target.classList.contains('next-area')) {
            imageSlider.showNextImage();
        }else if (event.target.classList.contains('close-modal')) {
            modal.parentNode.removeChild(modal);
        }
    });


}


function changeBigImage(event) {
    let bigImage = document.querySelector('.big-image');
    let newImageUrl = event.target.closest('a').getAttribute('href');
    bigImage.setAttribute('src', newImageUrl);
    bigImage.closest('a').setAttribute('href', newImageUrl);
    let prevCurrentImage = document.querySelector('.small-images .active');
    prevCurrentImage.classList.remove('active');
    event.target.classList.add('active');
}


class ImageSlider {
    images = [];
    imageNode = null;
    currentImageIndex = 0;

    constructor(imagesList, imageNode) {

        this.images = imagesList;
        this.imageNode = imageNode;

        // set main image index
        for (let i = 0; i < imagesList.length; i++) {
            if (this.images[i].getAttribute('href') === this.imageNode.getAttribute('src')) {
                this.currentImageIndex = i;
            }
        }


    }


    showPrevImage() {
        if (this.currentImageIndex > 0) {
            this.currentImageIndex--;
        }else {
            this.currentImageIndex = this.images.length - 1;
        }

        this.imageNode.setAttribute('src', this.images[this.currentImageIndex]);

        // показать стрелку "назад", если индекс текущей картинки больше 0
        // скрыть стрелку вперед, если показана последняя картинка
    }

    showNextImage() {
        if (this.currentImageIndex <= this.images.length - 2) {
            this.currentImageIndex++;
        }else {
            this.currentImageIndex = 0;
        }
        this.imageNode.setAttribute('src', this.images[this.currentImageIndex]);


        // скрыть стрелку назад, если долистали до первой картинки

    }

}



