<!DOCTYPE html >
<html lang="ru">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo esc_attr(get_bloginfo('title')); ?></title>
    <meta name="description" content="<?php echo esc_attr(get_bloginfo('description')); ?>">
    <?php wp_head(); ?>
</head>

<?php include "inc/Walker_Nav_Header.php"; ?>

<div class="header">
    <div class="container">
        <div class="header__inner">

            <div class="header__wrapper">
                <a class="header__logo header-logo" href="/">
                    <div class="header-logo__img">
                        <img loading="lazy"data-src="<?= get_template_directory_uri()."/assets/img/logo.png"; ?>" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==" alt="">
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

            <div class="header-menu__toggle mobile"><img loading="lazy"data-src="<?= get_template_directory_uri()."/assets/img/menu-toggle.svg" ?>" width="24" height="24" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==" alt=""></div>
            <a href="/" class="header__button desktop">Book a tour</a>

        </div>
    </div>
</div>
