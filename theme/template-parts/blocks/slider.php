<?php
// Fetch the ACF fields for the slider block
$slides = get_field('slider');
?>

<div class="slider">

    <div class="slider__counter desktop <?= (sizeof($slides) <= 1) ? 'none' : '' ?>">
        <div class="slider__counter-container container">
            <div class="slider__counter-box">
                <div class="slider__counter-num">01</div>
                <div class="slider__counter-line"></div>
                <div class="slider__counter-all"><?= sprintf("%02d", sizeof($slides)) ?></div>
            </div>
        </div>
    </div>


    <div class="slider__container">
        <?php if ($slides): ?>
            <?php foreach ($slides as $slide): ?>
                <div
                    class="slider__item
                     <?php echo ($slide['slide_type'] === 'image_text')? 'slider__item--image-text' : ''; ?>
                     <?php echo ($slide['slide_type'] === 'accordion')? 'slider__item--accordion' : ''; ?>
                    "

                    <?php if (false && $slide['slide_type'] === 'image_text'): ?>
                        data-slide-bg="<?php echo esc_url($slide['image']); ?>"
                    <?php endif; ?>

                >
                    <div class="slider__inner">

                        <?php if ($slide['slide_type'] === 'image_text'): ?>

                            <div class="slider__wrapper">
                                <div class="container">
                                    <div class="slider__text-image">
                                        <?php if ($slide['text_area_1']): ?>
                                            <div class="slider__title">
                                                <?php echo nl2br(esc_html($slide['text_area_1'])); ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($slide['text_area_2']): ?>
                                            <div class="slider__subtitle">
                                                <?php echo nl2br(esc_html($slide['text_area_2'])); ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($slide['link']): ?>
                                            <a href="<?php echo esc_url($slide['link']); ?>" class="slider__link">Book a tour</a>
                                        <?php endif; ?>
                                        <?php if ($slide['benefits']): ?>
                                            <ul class="slider__benefits">
                                                <?php foreach ($slide['benefits'] as $benefit): ?>
                                                    <li class="slider__benefit">
                                                        <?php echo esc_html($benefit['benefit_text']); ?>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                        <?php endif; ?>


                        <?php if ($slide['slide_type'] === 'accordion'): ?>

                            <div class="slider__wrapper slider__accordion-wrapper">
                                <div class="container">
                                    <div class="slider__accordion">

                                        <div class="slider__info">
                                            <?php if ($slide['accordion_subtitle']): ?>
                                                <div class="slider__subtitle slider__accordion-subtitle">
                                                    <?php echo nl2br(esc_html($slide['accordion_subtitle'])); ?>
                                                </div>
                                            <?php endif; ?>

                                            <?php if ($slide['accordion_title']): ?>
                                                <h2 class="slider__title slider__accordion-title">
                                                    <?php echo nl2br(esc_html($slide['accordion_title'])); ?>
                                                </h2>
                                            <?php endif; ?>
                                        </div>

                                        <?php if ($slide['accordion_items']): ?>
                                            <div class="slider__accordion-list">
                                                <?php foreach ($slide['accordion_items'] as $item): ?>
                                                    <div class="slider__accordion-item">
                                                        <div class="slider__accordion-item-title">
                                                            <span><?php echo nl2br(esc_html($item['item_title'])); ?></span>
                                                        </div>
                                                        <div class="slider__accordion-item-content">
                                                            <?php echo nl2br(esc_html($item['item_content'])); ?>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>

                        <?php endif; ?>


                    </div>
                    <?php if ($slide['image']): ?>
                        <div class="slider__image">
                            <div class="slider__image-wrapper">
                                <img loading="lazy" data-slide-src="<?php echo esc_url($slide['image']); ?>" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==" alt="">
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <div class="slider__nav mobile <?= (sizeof($slides) <= 1) ? 'none' : '' ?>">
        <div class="slider__prev"></div>
        <div class="slider__next"></div>
    </div>


</div>