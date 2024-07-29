document.addEventListener("DOMContentLoaded", function() {
    const slider = document.querySelector('.slider');
    const slides = document.querySelectorAll('.slider__item');
    const slides2 = document.querySelectorAll('.slider__item .slider__text-image, .slider__item .slider__accordion');
    const prevButton = document.querySelector('.slider__prev');
    const nextButton = document.querySelector('.slider__next');
    let currentIndex = 0;
    let startX, endX;
    const totalSlides = slides.length;
    const counterLine = document.querySelector('.slider__counter-line');
    const counterNum = document.querySelector('.slider__counter-num');
    // Рассчитать размер шага
    const stepSize = (94 - 41) / (totalSlides - 1); // Расстояние перемещения за слайд
    var maxSlideHeight = 0;
    var animationTime = 500;
    const slideIntervalTime = 30000;  //30000; // 30 секунд
    let slideInterval;

    function loadSlideImage(slide) {
        var image = slide.querySelector('.slider__image img');
        var src = image.getAttribute('data-slide-src');
        if (src) {
            image.src = src;
            // image.removeAttribute('data-src');
        }
    }

    // Функция загрузки фона слайда
    // function loadSlideBgImage(slide) {
    //     var bg = slide.getAttribute('data-slide-bg');
    //     if (bg) {
    //         slide.style.backgroundImage = 'url(' + bg + ')';
    //     }
    // }

    // Инициализация позиции слайдов
    slides.forEach((slide, index) => {
        slide.style.left = `${index * 100}%`;
        if (maxSlideHeight < slide.scrollHeight) maxSlideHeight = slide.scrollHeight;
    });

    const accordion_slides = document.querySelectorAll('.slider__item--accordion');
    slides.forEach((slide, index) => {
        slide.style.minHeight = `${maxSlideHeight}px`;
    });

    slider.style.height = `${maxSlideHeight}px`;

    var accordionItems = document.querySelectorAll('.slider__accordion-item');

    accordionItems.forEach(function(item) {
        item.addEventListener('click', function() {
            this.classList.toggle('active');
            animationTime = 500;
            updateSliderHeight();
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
            } else {
                slide.classList.remove('active');
            }
        });
        updateSliderHeight();
        updateCounterLine(index);
        updateCounterNum(index);
    }

    // Функция обновления высоты слайдера
    function updateSliderHeight() {
        const activeSlide = document.querySelector('.slider__item.active');
        let maxHeight = 0;

        // Если активный слайд существует
        if (activeSlide) {
            // Получаем все дочерние элементы, игнорируя элементы с position: absolute
            const children = Array.from(activeSlide.children).filter(child => getComputedStyle(child).position !== 'absolute');

            // Находим максимальную высоту среди всех дочерних элементов
            children.forEach(child => {
                maxHeight = Math.max(maxHeight, child.scrollHeight);
            });

            if (maxSlideHeight < maxHeight) maxSlideHeight = maxHeight;

            // Устанавливаем высоту слайдера
            slider.style.height = `${maxSlideHeight}px`;
        }

        // Обновляем высоту слайдера через небольшую задержку
        if (animationTime > 0)
            setTimeout(updateSliderHeight, 1);
        animationTime--;
    }

    // Функция запуска автоматического переключения слайдов
    function startSlideInterval() {
        // slideInterval = setInterval(() => {
        //     currentIndex = (currentIndex + 1) % slides.length;
        //     showSlide(currentIndex);
        // }, slideIntervalTime);
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

    // Изначальное отображение
    showSlide(currentIndex);
    window.addEventListener('resize', function () {
        maxSlideHeight = 0;
        slides.forEach((slide, index) => {
            slide.style.left = `${index * 100}%`;
            if (maxSlideHeight < slide.scrollHeight) maxSlideHeight = slide.scrollHeight;
        });
        slider.style.height = `${maxSlideHeight}px`;

        updateSliderHeight();
    });
    startSlideInterval();
});