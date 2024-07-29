document.addEventListener('DOMContentLoaded', function() {
    // Мобильное меню
    var menuToggle = document.querySelector('.header-menu__toggle.mobile');
    var mobileMenu = document.querySelector('.header__menu.header-menu.mobile');

    menuToggle.addEventListener('click', function() {
        // Toggle the 'active' class on the mobile menu
        menuToggle.classList.toggle('active');
        mobileMenu.classList.toggle('active');
    });

    //Отложенная загрузка изображений в видимой области для CSS background-image
    var lazyBgItems = document.querySelectorAll('[data-bg]');
    function loadBgImages() {
        lazyBgItems.forEach(function(item) {
            var bg = item.getAttribute('data-bg');
            item.style.backgroundImage = 'url(' + bg + ')';
            // item.removeAttribute('data-bg');
        });
    }

    if ('IntersectionObserver' in window) {
        var observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    var item = entry.target;
                    var bg = item.getAttribute('data-bg');
                    item.style.backgroundImage = 'url(' + bg + ')';
                    // item.removeAttribute('data-bg');
                    observer.unobserve(item);
                }
            });
        });

        lazyBgItems.forEach(function(item) {
            observer.observe(item);
        });
    } else {
        loadBgImages();
    }

    //Отложенная загрузка изображений в видимой области для Img
    var lazyImages = document.querySelectorAll('img[data-src]');
    function loadImage(image) {
        var src = image.getAttribute('data-src');
        if (src) {
            image.src = src;
            // image.removeAttribute('data-src');
        }
    }

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


});