document.addEventListener('DOMContentLoaded', function() {
    // Функция для установки размеров изображения
    function setImageSize(image, width, height) {
        image.style.width = width + 'px';
        image.style.height = height + 'px';
    }

    // Функция для загрузки изображения и установки его размера
    function loadImage(image) {
        var src = image.getAttribute('data-src');
        if (src) {
            var tempImg = new Image();
            tempImg.src = src;
            tempImg.onload = function() {
                // Устанавливаем src изображения
                image.src = src;

                // Устанавливаем размеры изображения
                setImageSize(image, tempImg.width, tempImg.height);

                // Удаляем атрибут data-src
                // image.removeAttribute('data-src');
            };
        }
    }

    // Отложенная загрузка изображений в видимой области для Img
    var lazyImages = document.querySelectorAll('img[data-src]');

    if ('IntersectionObserver' in window) {
        var observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    var image = entry.target;
                    loadImage(image);
                    observer.unobserve(image);
                }
            });
        });

        lazyImages.forEach(function(image) {
            observer.observe(image);
        });
    } else {
        // Если Intersection Observer не поддерживается
        lazyImages.forEach(function(image) {
            loadImage(image);
        });
    }

    // Отложенная загрузка изображений в видимой области для CSS background-image
    var lazyBgItems = document.querySelectorAll('[data-bg]');

    function loadBgImages() {
        lazyBgItems.forEach(function(item) {
            var bg = item.getAttribute('data-bg');
            item.style.backgroundImage = 'url(' + bg + ')';
            // item.removeAttribute('data-bg');
        });
    }

    if ('IntersectionObserver' in window) {
        var bgObserver = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    var item = entry.target;
                    var bg = item.getAttribute('data-bg');
                    item.style.backgroundImage = 'url(' + bg + ')';
                    // item.removeAttribute('data-bg');
                    bgObserver.unobserve(item);
                }
            });
        });

        lazyBgItems.forEach(function(item) {
            bgObserver.observe(item);
        });
    } else {
        loadBgImages();
    }
});