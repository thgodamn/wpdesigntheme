<?php
// Fetch the ACF fields for the slider block
$slides = get_field('slider');
?>

<div class="slider">
    <?php if ($slides): ?>
        <?php foreach ($slides as $slide): ?>
            <div class="slider__slide">
                <?php if ($slide['slide_type'] === 'image_text'): ?>
                    <?php if ($slide['image']): ?>
                        <img src="<?php echo esc_url($slide['image']); ?>" class="slider__image" alt="Slide Image">
                    <?php endif; ?>
                    <?php if ($slide['text_area_1']): ?>
                        <div class="slider__text slider__text--primary">
                            <?php echo nl2br(esc_html($slide['text_area_1'])); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($slide['text_area_2']): ?>
                        <div class="slider__text slider__text--secondary">
                            <?php echo nl2br(esc_html($slide['text_area_2'])); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($slide['link']): ?>
                        <a href="<?php echo esc_url($slide['link']); ?>" class="slider__link">Learn more</a>
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
                <?php elseif ($slide['slide_type'] === 'accordion'): ?>
                    <?php if ($slide['accordion_subtitle']): ?>
                        <div class="slider__accordion-subtitle">
                            <?php echo nl2br(esc_html($slide['accordion_subtitle'])); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($slide['accordion_title']): ?>
                        <h2 class="slider__accordion-title">
                            <?php echo nl2br(esc_html($slide['accordion_title'])); ?>
                        </h2>
                    <?php endif; ?>
                    <?php if ($slide['accordion_items']): ?>
                        <div class="slider__accordion">
                            <?php foreach ($slide['accordion_items'] as $item): ?>
                                <div class="slider__accordion-item">
                                    <button class="slider__accordion-item-title">
                                        <?php echo nl2br(esc_html($item['item_title'])); ?>
                                    </button>
                                    <div class="slider__accordion-item-content">
                                        <?php echo nl2br(esc_html($item['item_content'])); ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>