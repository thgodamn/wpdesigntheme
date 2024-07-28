document.addEventListener('DOMContentLoaded', function() {
    // Select the menu toggle button and the mobile menu
    var menuToggle = document.querySelector('.header-menu__toggle.mobile');
    var mobileMenu = document.querySelector('.header__menu.header-menu.mobile');

    // Add click event listener to the menu toggle button
    menuToggle.addEventListener('click', function() {
        // Toggle the 'active' class on the mobile menu
        menuToggle.classList.toggle('active');
        mobileMenu.classList.toggle('active');
    });

});