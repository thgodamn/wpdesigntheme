<?php wp_footer(); ?>

<?php include 'inc/Walker_Nav_Footer.php' ?>
<?php include 'inc/Walker_Nav_SubFooter.php' ?>

<div class="footer">
    <div class="container">

        <div class="footer__wrapper">

            <div>
                <a href="/" class="footer__logo footer-logo">
                    <div class="footer-logo__img"><img src="<?= get_template_directory_uri()."/assets/img/logo-footer.png"; ?>" alt=""></div>
                    <div class="footer-logo__text">SAFARI</div>
                </a>
            </div>

            <?php
            if (has_nav_menu('footer-menu')) {
                wp_nav_menu(array(
                    'theme_location' => 'footer-menu',
                    'menu_class'     => 'footer__menu footer-menu',
                    'walker'         => new Walker_Nav_Footer(),
                ));
            }
            ?>

            <a href="/" class="footer-menu__button mobile">Book a tour</a>

    </div>

    <div class="footer__wrapper footer__wrapper-bottom">

        <div class="footer__submenu footer-sub-menu">
            <div class="footer-sub-menu__item">
                © <?= date('Y'); ?> Tanzania
            </div>
            <?php
            if (has_nav_menu('sub-footer-menu')) {
                wp_nav_menu(array(
                    'theme_location' => 'sub-footer-menu',
                    'walker'         => new Walker_Nav_SubFooter(),
                    'items_wrap' => '%3$s'
                ));
            }
            ?>
        </div>

        <div class="footer__social-menu footer-social-menu">
            <a href="/" class="footer-social-menu__item">
                <img data-src="<?= get_template_directory_uri()."/assets/img/icon-instagram.png"; ?>" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==" alt="">
            </a>
            <a href="/" class="footer-social-menu__item">
                <img data-src="<?= get_template_directory_uri()."/assets/img/icon-facebook.png"; ?>" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==" alt="">
            </a>
            <a href="/" class="footer-social-menu__item">
                <img data-src="<?= get_template_directory_uri()."/assets/img/icon-twitter.png"; ?>" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==" alt="">
            </a>
            <a href="/" class="footer-social-menu__item">
                <img data-src="<?= get_template_directory_uri()."/assets/img/icon-pinterest.png"; ?>" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==" alt="">
            </a>
        </div>

    </div>


</div>
