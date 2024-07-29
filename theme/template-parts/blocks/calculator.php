<?php
// Получаем поля ACF для блока калькулятора
$image = get_field('image'); // Получаем URL изображения
$image_position = get_field('image_position');
$subtitle = get_field('subtitle');
$title = get_field('title');
$square_miles = get_field('square_miles');
$percent = get_field('percent');
$animals = get_field('animals');
$birds = get_field('birds');
$num1 = get_field('num1');
$operation = get_field('operation');
$num2 = get_field('num2');

// Выполняем вычисление в зависимости от $operation
switch ($operation) {
    case '+':
        $result = $num1 + $num2;
        break;
    case '-':
        $result = $num1 - $num2;
        break;
    case '*':
        $result = $num1 * $num2;
        break;
    case '/':
        // Проверка деления на ноль
        if ($num2 != 0) {
            $result = $num1 / $num2;
        } else {
            $result = 'Error: Division by zero';
        }
        break;
    default:
        $result = 'N/A';
        break;
}
?>

<div class="calculator">
    <div class="container">
        <div class="calculator__inner <?= ($image_position == 'first') ? 'calculator__inner--first' : 'calculator__inner--second' ?>">

            <?php if ($image && $image_position == 'first'): ?>
                <div class="calculator__image">
                    <img loading="lazy"data-src="<?php echo esc_url($image); ?>" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==" alt="Calculator Image" class="calculator__img">
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
                    <div class="calculator__info mobile">
                        <div class="calculator__info-value"><?php echo esc_attr($animals); ?></div>
                        <div class="calculator__info-label">Species of plains animals</div>
                    </div>
                    <div class="calculator__info mobile">
                        <div class="calculator__info-value"><?php echo esc_attr($birds); ?></div>
                        <div class="calculator__info-label">Species of birds</div>
                    </div>
                </div>

                <div class="calculator__text desktop">Vacation calculator</div>
                <div class="calculator__inputs desktop">
                    <input type="number" class="calculator__input calculator__input-num1" value="<?php echo esc_attr($num1); ?>" >
                    <select data-api-url="<?php echo esc_url(rest_url('my-custom/v1/calculate')); ?>" data-bg="<?php echo get_template_directory_uri().'/assets/blocks/calculator/calc-arrow-down.svg' ?>" class="calculator__operation">
                        <option value="+" <?php selected($operation, '+'); ?>>+</option>
                        <option value="-" <?php selected($operation, '-'); ?>>-</option>
                        <option value="*" <?php selected($operation, '*'); ?>>*</option>
                        <option value="/" <?php selected($operation, '/'); ?>>/</option>
                    </select>
                    <input type="number" class="calculator__input calculator__input-num2" value="<?php echo esc_attr($num2); ?>" >
                </div>
                <div id="calculator-result" class="calculator__result desktop"><span class="calculator__result-text">Result:</span> <span class="calculator__result-value"><?php echo esc_attr($result) ?></span></div>

            </div>

            <?php if ($image && $image_position == 'second'): ?>
                <div class="calculator__image">
                    <img loading="lazy" data-src="<?php echo esc_url($image); ?>" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==" alt="Calculator Image" class="calculator__img">
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>