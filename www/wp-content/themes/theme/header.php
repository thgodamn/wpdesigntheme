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
                        'menu_class'     => 'header__menu header-menu desktop',
                        'walker'         => new Walker_Nav_Header(),
                    ));
                }
                ?>

                <div class="mobile">
                    <?php
                    if (has_nav_menu('header-menu')) {
                        wp_nav_menu(array(
                            'theme_location' => 'header-menu',
                            'menu_class'     => 'header__menu header-menu mobile',
                            'walker'         => new Walker_Nav_Header(),
                        ));
                    }
                    ?>
                </div>
            </div>

            <div class="header-menu__toggle mobile"><img src="<?= get_template_directory_uri()."/assets/img/menu-toggle.svg" ?>" alt=""></div>
            <a href="/" class="header__button desktop">Book a tour</a>

        </div>
    </div>
</div>
