<?php
// Получаем поля ACF для блока калькулятора
$image = get_field('image'); // Получаем URL изображения
$subtitle = get_field('subtitle');
$title = get_field('title');
$square_miles = get_field('square_miles');
$percent = get_field('percent');
$num1 = get_field('num1');
$operation = get_field('operation');
$num2 = get_field('num2');
?>

<div class="calculator">
    <div class="container">
        <div class="calculator__inner">

            <?php if ($image): ?>
                <div class="calculator__image">
                    <img src="<?php echo esc_url($image); ?>" alt="Calculator Image" class="calculator__img">
                </div>
            <?php endif; ?>

            <div class="calculator__wrapper">
                <?php if ($subtitle): ?>
                    <div class="calculator__subtitle">
                        <?php echo nl2br(esc_html($subtitle)); ?>
                    </div>
                <?php endif; ?>
                <?php if ($title): ?>
                    <h2 class="calculator__title">
                        <?php echo nl2br(esc_html($title)); ?>
                    </h2>
                <?php endif; ?>
                <div class="calculator__row">
                    <div class="calculator__info">
                        <div class="calculator__info-value"><?php echo esc_attr($square_miles); ?></div>
                        <div class="calculator__info-label">Square Miles</div>
                    </div>
                    <div class="calculator__info">
                        <div class="calculator__info-value"><?php echo esc_attr($percent); ?></div>
                        <div class="calculator__info-label">Percent</div>
                    </div>
                </div>

                <div class="calculator__text">Vacation calculator</div>
                <div class="calculator__inputs">
                    <input type="number" id="calculator__num1" class="calculator__input" value="<?php echo esc_attr($num1); ?>" >
<!--                    <input type="text" id="calculator__operation" data-api-url="--><?php //echo esc_url(rest_url('my-custom/v1/calculate')); ?><!--" class="calculator__input" value="--><?php //echo esc_attr($operation); ?><!--" >-->
                    <select id="calculator__operation" data-api-url="<?php echo esc_url(rest_url('my-custom/v1/calculate')); ?>" class="calculator__input">
                        <option value="+">+</option>
                        <option value="-">-</option>
                        <option value="*">*</option>
                        <option value="/">/</option>
                    </select>
                    <input type="number" id="calculator__num2" class="calculator__input" value="<?php echo esc_attr($num2); ?>" >
                </div>
                <div id="calculator-result" class="calculator__result">Result: N/A</div>

            </div>

        </div>
    </div>
</div>