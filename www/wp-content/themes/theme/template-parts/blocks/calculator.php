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
    <?php if ($image): ?>
        <div class="calculator__image">
            <img src="<?php echo esc_url($image); ?>" alt="Calculator Image" class="calculator__img">
        </div>
    <?php endif; ?>
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
    <div class="calculator__inputs">
        <?php if ($square_miles): ?>
            <div class="calculator__input-group">
                <label for="square-miles" class="calculator__label">Square Miles:</label>
                <input type="text" id="square-miles" class="calculator__input" value="<?php echo esc_attr($square_miles); ?>" readonly>
            </div>
        <?php endif; ?>
        <?php if ($percent): ?>
            <div class="calculator__input-group">
                <label for="percent" class="calculator__label">Percent:</label>
                <input type="text" id="percent" class="calculator__input" value="<?php echo esc_attr($percent); ?>" readonly>
            </div>
        <?php endif; ?>
        <div class="calculator__input-group">
            <label for="num1" class="calculator__label">Number 1:</label>
            <input type="number" id="num1" class="calculator__input" value="<?php echo esc_attr($num1); ?>" readonly>
        </div>
        <div class="calculator__input-group">
            <label for="operation" class="calculator__label">Operation:</label>
            <input type="text" id="operation" class="calculator__input" value="<?php echo esc_attr($operation); ?>" readonly>
        </div>
        <div class="calculator__input-group">
            <label for="num2" class="calculator__label">Number 2:</label>
            <input type="number" id="num2" class="calculator__input" value="<?php echo esc_attr($num2); ?>" readonly>
        </div>
        <button id="calculate-button" class="calculator__button" data-api-url="<?php echo esc_url(rest_url('my-custom/v1/calculate')); ?>">Calculate</button>
        <div id="calculator-result" class="calculator__result">Результат: N/A</div>
    </div>
</div>