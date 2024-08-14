document.addEventListener('DOMContentLoaded', function() {

    // Мобильное меню
    var HeaderMenu = document.querySelector('.header-menu');
    var HeaderMenuToggle = document.querySelector('.header-menu__toggle');

    HeaderMenuToggle.addEventListener('click', function() {
        // Toggle the 'active' class on the mobile menu
        HeaderMenu.classList.toggle('active');
        HeaderMenuToggle.classList.toggle('active');
    });


    function HeaderBgToCenter() {
        const header = document.querySelector('.header');

        const bg = header.querySelector('.header__bg-img');
        const planet = header.querySelector('.header__bg-planet');
        const headerWidth = header.offsetWidth;

        const planetWidth = 386;
        const planetHeight = 386;
        const planetTop = 136;

        // Устанавливаем размеры контейнера
        // header.style.position = 'relative';

        // Подождем, пока изображение загрузится
        bg.onload = () => {
            // Получаем ширину и высоту изображения
            const bgWidth = bg.naturalWidth;
            const bgHeight = bg.naturalHeight;


            if (bgWidth > headerWidth) {
                bg.style.transform = `translate(-${(bgWidth - headerWidth)/2}px, 0)`;
                bg.style.width = `auto`;

                planet.style.width = `${planetWidth}px`;
                planet.style.height = `${planetHeight}px`;
                planet.style.top = `${planetTop}px`;
                planet.style.transform = `none`;
            } else {
                // Если изображение меньше или равно ширине контейнера
                bg.style.width = `100%`;
                bg.style.transform = `none`;

                var proportion = headerWidth / bgWidth;
                planet.style.width = `${planetWidth * proportion}px`;
                planet.style.height = `${planetHeight * proportion}px`;
                planet.style.transform = `translate(-${( (planetWidth * proportion) - planetWidth)/2}px, 0`;
                planet.style.top = `${planetTop * proportion}px`;
            }

        };

        // Если изображение уже загружено
        if (bg.complete) {
            bg.onload();
        }
    }

    //центрируем при загрузке
    HeaderBgToCenter();

    // Центрируем при ресайзе
    window.addEventListener('resize', () => {
        HeaderBgToCenter();
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