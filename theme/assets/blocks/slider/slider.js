document.addEventListener("DOMContentLoaded", function() {
    const slider = document.querySelector('.slider');
    const slides = document.querySelectorAll('.slider__item');
    const prevButton = document.querySelector('.slider__prev');
    const nextButton = document.querySelector('.slider__next');
    let currentIndex = 0;
    let startX, endX;
    const totalSlides = slides.length;
    const counterLine = document.querySelector('.slider__counter-line');
    const counterNum = document.querySelector('.slider__counter-num');
    // Рассчитать размер шага
    const stepSize = (94 - 41) / (totalSlides - 1); // Расстояние перемещения за слайд
    const slideIntervalTime = 5000;  //30000; // 30 секунд
    let slideInterval;

    function ImageToCenter(slide) {
        const image = slide.querySelector('.slider__image img');
        const sliderWidth = slide.offsetWidth;
        const sliderHeight = slide.offsetHeight;

        // Устанавливаем размеры контейнера
        slide.style.position = 'relative';
        image.style.position = 'absolute';
        image.style.top = '50%';
        image.style.left = '50%';
        image.style.transform = 'translate(-50%, -50%)'; // Центрирование изображения

        // Устанавливаем размеры до загрузки
        image.style.width = 'auto';
        image.style.height = 'auto';

        // Подождем, пока изображение загрузится
        image.onload = () => {
            // Получаем ширину и высоту изображения
            const imageWidth = image.naturalWidth;
            const imageHeight = image.naturalHeight;

            if (imageWidth > sliderWidth) {
                // Если изображение шире контейнера
                image.style.width = 'auto';
                image.style.left = `50%`; // Устанавливаем позицию по центру
            } else {
                // Если изображение меньше или равно ширине контейнера
                image.style.width = '100%'; // Растягиваем изображение на весь контейнер
            }

            if (imageHeight > sliderHeight) {
                // Если изображение выше контейнера
                image.style.height = 'auto';
                image.style.top = `50%`; // Устанавливаем позицию по центру
            } else {
                // Если изображение меньше или равно высоте контейнера
                image.style.height = '100%'; // Растягиваем изображение на всю высоту контейнера
            }
        };

        // Если изображение уже загружено
        if (image.complete) {
            image.onload();
        }
    }

    function loadSlideImage(slide) {
        var image = slide.querySelector('.slider__image img');
        var src = image.getAttribute('data-slide-src');
        if (src) {
            image.src = src;
        }
    }

    var accordionItems = document.querySelectorAll('.slider__accordion-item');
    accordionItems.forEach(function(item) {
        item.addEventListener('click', function() {
            this.classList.toggle('active');
        });
    });

    // Функция обновления позиции линии счётчика
    function updateCounterLine(index) {
        const newPosition = index * stepSize;
        counterLine.style.setProperty('--counter-line-position', `${newPosition}px`);
    }

    // Функция обновления номера счётчика
    function updateCounterNum(index) {
        counterNum.textContent = String(index + 1).padStart(2, '0');
    }

    // Функция показа слайда
    function showSlide(index) {
        const offset = index * -100;
        slides.forEach((slide, i) => {
            slide.style.transition = 'transform 0.5s ease-in-out';
            slide.style.transform = `translateX(${offset}%)`;
            if (i === index) {
                slide.classList.add('active');
                loadSlideImage(slide);
                ImageToCenter(slide);
            } else {
                slide.classList.remove('active');
            }
        });
        updateCounterLine(index);
        updateCounterNum(index);
    }

    // Функция запуска автоматического переключения слайдов
    function startSlideInterval() {
        slideInterval = setInterval(() => {
            currentIndex = (currentIndex + 1) % slides.length;
            showSlide(currentIndex);
        }, slideIntervalTime);
    }

    // Функция остановки автоматического переключения слайдов
    function stopSlideInterval() {
        clearInterval(slideInterval);
    }

    // Обработчик клика на кнопку "следующий"
    nextButton.addEventListener('click', () => {
        stopSlideInterval();
        currentIndex = (currentIndex + 1) % slides.length;
        showSlide(currentIndex);
        startSlideInterval();
    });

    // Обработчик клика на кнопку "предыдущий"
    prevButton.addEventListener('click', () => {
        stopSlideInterval();
        currentIndex = (currentIndex - 1 + slides.length) % slides.length;
        showSlide(currentIndex);
        startSlideInterval();
    });

    // Обработчик начала касания
    slider.addEventListener('touchstart', function(e) {
        stopSlideInterval();
        startX = e.touches[0].pageX;
    });

    // Обработчик окончания касания
    slider.addEventListener('touchend', function(e) {
        endX = e.changedTouches[0].pageX;
        handleSwipe();
        startSlideInterval();
    });

    // Обработчик начала перетаскивания мышью
    slider.addEventListener('mousedown', function(e) {
        stopSlideInterval();
        startX = e.pageX;
        slider.style.cursor = 'grabbing';
    });

    // Обработчик окончания перетаскивания мышью
    slider.addEventListener('mouseup', function(e) {
        endX = e.pageX;
        slider.style.cursor = 'grab';
        handleSwipe();
        startSlideInterval();
    });

    // Обработчик свайпа
    function handleSwipe() {
        if (startX - endX > 100) {
            currentIndex = (currentIndex + 1) % slides.length;
        } else if (endX - startX > 100) {
            currentIndex = (currentIndex - 1 + slides.length) % slides.length;
        }
        showSlide(currentIndex);
    }

    // Центрируем при ресайзе
    window.addEventListener('resize', () => {
        ImageToCenter(slides[currentIndex]);
    });

    // Изначальное отображение
    showSlide(currentIndex);
    startSlideInterval();
});