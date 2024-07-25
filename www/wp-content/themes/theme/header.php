<?php wp_head(); ?>

<?php include "inc/Walker_Nav_Header.php"; ?>

<div class="header">
    <div class="container">
        <div class="header__inner">

            <div class="header__wrapper">
                <a class="header__logo header-logo" href="/">
                    <div class="header-logo__img">
                        <img src="<?= get_template_directory_uri()."/assets/img/logo.png"; ?>" alt="">
                    </div>
                    <div class="header-logo__text">SAFARI</div>
                </a>

                <?php
                if (has_nav_menu('header-menu')) {
                    wp_nav_menu(array(
                        'theme_location' => 'header-menu',
                        'menu_class'     => 'header__menu header-menu',
                        'walker'         => new Walker_Nav_Header(),
                    ));
                }
                ?>

<!--                <div class="header__menu header-menu">-->
<!--                    <div class="header-menu__item">Home</div>-->
<!--                    <div class="header-menu__item">Top destinations</div>-->
<!--                    <div class="header-menu__item">Travel information</div>-->
<!--                    <div class="header-menu__item">Contact Us</div>-->
<!--                </div>-->
            </div>

            <a href="/" class="header__button">Book a tour</a>

        </div>
    </div>
</div>
