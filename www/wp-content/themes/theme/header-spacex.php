<!DOCTYPE html >
<html lang="ru">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo esc_attr(get_bloginfo('title')); ?></title>
    <meta name="description" content="<?php echo esc_attr(get_bloginfo('description')); ?>">
    <?php wp_head(); ?>
</head>

<?php include "inc/HeaderMenuBuilder.php"; ?>
<?php
// Получение значений полей
$header_title = get_post_meta(get_the_ID(), '_header_title', true);
$header_subtitle = get_post_meta(get_the_ID(), '_header_subtitle', true);
$header_button_text = get_post_meta(get_the_ID(), '_header_button_text', true);
$header_button_url = get_post_meta(get_the_ID(), '_header_button_url', true);

$header_adv_items = get_post_meta(get_the_ID(), '_header_adv_items', true);
$HeaderMenu = new HeaderMenuBuilder('header-menu-spacex', 'header-menu');

?>

<div class="header">
    <div class="header__bg">
        <img class="header__bg-img" loading="lazy" data-src="<?= get_template_directory_uri()."/assets/img/spacex/header-bg.png"; ?>" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==" alt="">
        <img class="header__bg-planet" loading="lazy" data-src="<?= get_template_directory_uri()."/assets/img/spacex/header-bg-planet.png"; ?>" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==" alt="">
    </div>

    <div class="container">
        <div class="header__inner">

            <div class="header__wrapper">
                <a class="header__logo header-logo" href="/spacex">
                    <div class="header-logo__img">
                        <img loading="lazy" data-src="<?= get_template_directory_uri()."/assets/img/spacex/logo.png"; ?>" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==" alt="">
                    </div>
                </a>

                <?php
                if (has_nav_menu('header-menu-spacex')) {
                    $HeaderMenu->render_menu_tree();
                }
                ?>

            </div>

            <div class="header__wrapper header__wrapper-info">

                <div class="header__desc">
                    <div class="header__title"><?php echo esc_html($header_title); ?></div>
                    <div class="header__subtitle"><?php echo esc_html($header_subtitle); ?></div>
                    <a href="<?php echo esc_url($header_button_url); ?>" class="header__button desktop">
                        <div class="header__button-border-blue"></div>
                        <div class="header__button-border-blue header__button-border-blue--left-top"></div>
                        <div class="header__button-border-white header__button-border-white--shadow"></div>
                        <div class="header__button-border-white header__button-border-white--shadow header__button-border-white--shadow-top-right"></div>
                        <div class="header__button-border-white"></div>
                        <div class="header__button-text"><?php echo esc_html($header_button_text); ?></div>
                    </a>
                </div>

                <div class="header__adv">
                    <?php if (!empty($header_adv_items)) : ?>
                        <?php foreach ($header_adv_items as $item) : ?>
                            <div class="header__adv-item">
                                <div class="header__adv-label header__adv-label-first"><?php echo esc_html($item['label_first']); ?></div>
                                <div class="header__adv-val"><?php echo esc_html($item['val']); ?></div>
                                <div class="header__adv-label"><?php echo esc_html($item['label']); ?></div>
                                <div class="header__adv-item-bg"></div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <a href="<?php echo esc_url($header_button_url); ?>" class="header__button mobile">
                    <div class="header__button-border-blue"></div>
                    <div class="header__button-border-blue header__button-border-blue--left-top"></div>
                    <div class="header__button-border-white header__button-border-white--shadow"></div>
                    <div class="header__button-border-white header__button-border-white--shadow header__button-border-white--shadow-top-right"></div>
                    <div class="header__button-border-white"></div>
                    <div class="header__button-text"><?php echo esc_html($header_button_text); ?></div>
                </a>

            </div>

        </div>
    </div>
</div>
