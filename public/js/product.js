/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************!*\
  !*** ./resources/js/product.js ***!
  \*********************************/
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

productImagesInit('#product-images');

function productImagesInit(imagesBlockSelector) {
  var imagesBlock = document.querySelector(imagesBlockSelector);
  imagesBlock.addEventListener('click', function (event) {
    event.preventDefault();

    if (event.target.classList.contains('big-image')) {
      showImageModal();
    } else if (event.target.classList.contains('small-image')) {
      changeBigImage(event);
    }
  });
}

function showImageModal() {
  var modal = document.createElement('div');
  modal.classList.add('modal');
  modal.innerHTML = '<div class="modal-content"><div class="image-block"></div></div>';
  var bigImage = document.querySelector('.big-image');
  var currentBigestImage = bigImage.cloneNode();
  currentBigestImage.setAttribute('src', bigImage.closest('a').getAttribute('href'));
  var modalImageBlock = modal.querySelector('.image-block');
  modalImageBlock.appendChild(currentBigestImage);
  var prevButton = document.createElement('div');
  prevButton.classList.add('prev-area');
  prevButton.innerHTML = "<";
  var nextButton = document.createElement('div');
  nextButton.classList.add('next-area');
  nextButton.innerHTML = '>';
  var closeButton = document.createElement('div');
  closeButton.classList.add('close-modal');
  closeButton.innerHTML = 'X';
  modalImageBlock.appendChild(prevButton, nextButton);
  modalImageBlock.appendChild(nextButton);
  modalImageBlock.appendChild(closeButton);
  document.querySelector('body').appendChild(modal);
  var imagesList = document.querySelectorAll('.small-images a');
  var imageNode = modal.querySelector('.big-image'); // инициируем создание слайдера картинок в модальном окне

  var imageSlider = new ImageSlider(imagesList, imageNode);
  modal.addEventListener('click', function (event) {
    if (event.target.classList.contains('prev-area')) {
      imageSlider.showPrevImage();
    } else if (event.target.classList.contains('next-area')) {
      imageSlider.showNextImage();
    } else if (event.target.classList.contains('close-modal')) {
      modal.parentNode.removeChild(modal);
    }
  });
}

function changeBigImage(event) {
  var bigImage = document.querySelector('.big-image');
  var newImageUrl = event.target.closest('a').getAttribute('href');
  bigImage.setAttribute('src', newImageUrl);
  bigImage.closest('a').setAttribute('href', newImageUrl);
  var prevCurrentImage = document.querySelector('.small-images .active');
  prevCurrentImage.classList.remove('active');
  event.target.classList.add('active');
}

var ImageSlider = /*#__PURE__*/function () {
  function ImageSlider(imagesList, imageNode) {
    _classCallCheck(this, ImageSlider);

    _defineProperty(this, "images", []);

    _defineProperty(this, "imageNode", null);

    _defineProperty(this, "currentImageIndex", 0);

    this.images = imagesList;
    this.imageNode = imageNode; // set main image index

    for (var i = 0; i < imagesList.length; i++) {
      if (this.images[i].getAttribute('href') === this.imageNode.getAttribute('src')) {
        this.currentImageIndex = i;
      }
    }
  }

  _createClass(ImageSlider, [{
    key: "showPrevImage",
    value: function showPrevImage() {
      if (this.currentImageIndex > 0) {
        this.currentImageIndex--;
      } else {
        this.currentImageIndex = this.images.length - 1;
      }

      this.imageNode.setAttribute('src', this.images[this.currentImageIndex]); // показать стрелку "назад", если индекс текущей картинки больше 0
      // скрыть стрелку вперед, если показана последняя картинка
    }
  }, {
    key: "showNextImage",
    value: function showNextImage() {
      if (this.currentImageIndex <= this.images.length - 2) {
        this.currentImageIndex++;
      } else {
        this.currentImageIndex = 0;
      }

      this.imageNode.setAttribute('src', this.images[this.currentImageIndex]); // скрыть стрелку назад, если долистали до первой картинки
    }
  }]);

  return ImageSlider;
}();
/******/ })()
;