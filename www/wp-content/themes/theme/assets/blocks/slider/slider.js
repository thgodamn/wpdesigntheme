document.addEventListener("DOMContentLoaded", function() {
    const slider = document.querySelector('.slider');
    const slides = document.querySelectorAll('.slider__item');
    // const prevButton = document.querySelector('.slider__prev');
    // const nextButton = document.querySelector('.slider__next');
    let currentIndex = 0;
    let startX, endX;
    const totalSlides = slides.length;
    const counterLine = document.querySelector('.slider__counter-line');
    const counterNum = document.querySelector('.slider__counter-num');
    // Calculate step size
    const stepSize = (94 - 41) / (totalSlides - 1); // Distance to move per slide

    // Initialize slides position
    slides.forEach((slide, index) => {
        slide.style.left = `${index * 100}%`;
    });

    // Function to update counter line position
    // function updateCounterLine(index) {
    //     const newPosition = index * stepSize;
    //     console.log([
    //         '.slider__counter-line:after',
    //         `top: ${newPosition}px;`
    //     ]);
    //     document.styleSheets[0].addRule(
    //         '.slider__counter-line:after',
    //         `top: ${newPosition}px;`
    //     );
    // }

    // Function to update counter line position
    function updateCounterLine(index) {
        const newPosition = index * stepSize;
        counterLine.style.setProperty('--counter-line-position', `${newPosition}px`);
    }

    function updateCounterNum(index) {
        counterNum.textContent = String(index+1).padStart(2, '0');
    }

    // Function to show slide
    function showSlide(index) {
        const offset = index * -100;
        slides.forEach(slide => {
            slide.style.transition = 'transform 0.5s ease-in-out';
            slide.style.transform = `translateX(${offset}%)`;
        });
        updateSliderHeight();
        updateCounterLine(index);
        updateCounterNum(index);
    }

    // Function to update slider height
    function updateSliderHeight() {
        let maxHeight = 0;
        slides.forEach(slide => {
            slide.style.height = '100%'; // Reset height
            const height = slide.scrollHeight;
            if (height > maxHeight) {
                maxHeight = height;
            }
        });
        slider.style.height = `${maxHeight}px`;
    }

    // Next button click handler
    // nextButton.addEventListener('click', () => {
    //     currentIndex = (currentIndex + 1) % slides.length;
    //     showSlide(currentIndex);
    // });
    //
    // // Prev button click handler
    // prevButton.addEventListener('click', () => {
    //     currentIndex = (currentIndex - 1 + slides.length) % slides.length;
    //     showSlide(currentIndex);
    // });

    // Touch start event
    slider.addEventListener('touchstart', function(e) {
        startX = e.touches[0].pageX;
    });

    // Touch end event
    slider.addEventListener('touchend', function(e) {
        endX = e.changedTouches[0].pageX;
        handleSwipe();
    });

    // Mouse down event
    slider.addEventListener('mousedown', function(e) {
        startX = e.pageX;
        slider.style.cursor = 'grabbing';
    });

    // Mouse up event
    slider.addEventListener('mouseup', function(e) {
        endX = e.pageX;
        slider.style.cursor = 'grab';
        handleSwipe();
    });

    // Handle swipe
    function handleSwipe() {
        if (startX - endX > 100) {
            currentIndex = (currentIndex + 1) % slides.length;
        } else if (endX - startX > 100) {
            currentIndex = (currentIndex - 1 + slides.length) % slides.length;
        }
        showSlide(currentIndex);
    }

    // Initial display
    showSlide(currentIndex);
    window.addEventListener('resize', updateSliderHeight);
});