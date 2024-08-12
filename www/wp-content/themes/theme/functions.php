<?php
/**
 * functions.php
 */

// Активировать отладку и логирование ошибок
$debug = false;
if ($debug) {
    define('WP_DEBUG', true);
    define('WP_DEBUG_LOG', true);
    define('WP_DEBUG_DISPLAY', true);
} else {
    define('WP_DEBUG', false);
    define('WP_DEBUG_LOG', false);
    define('WP_DEBUG_DISPLAY', false);
    error_reporting(E_ERROR | E_PARSE);
    ini_set('display_errors', '0');
}

function debug_logx($value)
{
    $h = fopen("{$_SERVER['DOCUMENT_ROOT']}/debug.log", 'a');
    ob_start();
    var_dump($value);
    fwrite($h, ob_get_clean());
    fwrite($h, "---------------------------------\n");
    fclose($h);
}

function debug($value) {
    echo '<pre>'; var_dump($value); echo '</pre>';
}

function add_viewport_meta_tag() {
    echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
}
add_action('wp_head', 'add_viewport_meta_tag');

function theme_enqueue_styles() {
    // Регистрация стилей global, header, footer
    wp_enqueue_style('header-style', get_template_directory_uri() . '/assets/header.min.css');
    wp_enqueue_style('footer-style', get_template_directory_uri() . '/assets/footer.min.css');
    wp_enqueue_style('global-style', get_template_directory_uri() . '/assets/global.min.css');

    // Регистрация и подключение кастомного скрипта
    wp_register_script('global-js', get_template_directory_uri() . '/assets/global.min.js', array(), '1.0', true);

    // Регистрация стилей и скриптов slider
    wp_register_style('slider-style', get_template_directory_uri() . '/assets/blocks/slider/slider.min.css', array(), '1.0');
    wp_register_script('slider-script', get_template_directory_uri() . '/assets/blocks/slider/slider.min.js', array(), '1.0', true);

    // Регистрация стилей и скриптов calculator
    wp_register_style('calculator-style', get_template_directory_uri() . '/assets/blocks/calculator/calculator.min.css', array(), '1.0');
    wp_register_script('calculator-script', get_template_directory_uri() . '/assets/blocks/calculator/calculator.min.js', array(), '1.0', true);

    // Локализация скрипта с URL API
    wp_localize_script('calculator-script', 'calculatorApi', array(
        'apiUrl' => esc_url(rest_url('my-custom/v1/calculate'))
    ));


    wp_enqueue_script('global-js');
//    wp_enqueue_script('slider-script');
//    wp_enqueue_script('calculator-script');
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

//ускоряем загрузку frontend, убираем jquery)))
function remove_default_jquery() {
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_dequeue_script('jquery');
    }
}
add_action('wp_enqueue_scripts', 'remove_default_jquery');

function my_custom_admin_styles() {
    wp_enqueue_style('custom-admin-styles', get_template_directory_uri() . '/assets/admin-styles.min.css');
}
add_action('admin_enqueue_scripts', 'my_custom_admin_styles');

// Регистрация ACF-блоков
function register_acf_blocks() {
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name' => 'slider',
            'title' => __('Slider'),
            'render_template' => 'template-parts/blocks/slider.php',
            'enqueue_assets' => function() {
                wp_enqueue_style('slider-style');
                wp_enqueue_script('slider-script');
            }
        ));

        acf_register_block_type(array(
            'name' => 'calculator',
            'title' => __('Calculator'),
            'render_template' => 'template-parts/blocks/calculator.php',
            'enqueue_assets' => function() {
                wp_enqueue_style('calculator-style');
                wp_enqueue_script('calculator-script');
            }
        ));
    }
}
add_action('acf/init', 'register_acf_blocks');

// Регистрация полей ACF
function register_acf_field_groups() {
    if (function_exists('acf_add_local_field_group')) {
        // Поля для блока Slider
        acf_add_local_field_group(array(
            'key' => 'group_slider',
            'title' => 'Slider',
            'layout' => 'block',
            'fields' => array(
                array(
                    'key' => 'field_slider_repeater',
                    'label' => 'Slides',
                    'name' => 'slider',
                    'type' => 'repeater',
                    'layout' => 'block',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_slide_type',
                            'label' => 'Slide Type',
                            'name' => 'slide_type',
                            'type' => 'select',
                            'choices' => array(
                                'image_text' => 'Image + Text',
                                'accordion' => 'Accordion',
                            ),
                            'default_value' => 'image_text',
                            'instructions' => 'Select the type of slide.',
                        ),
                        array(
                            'key' => 'field_slide_image',
                            'label' => 'Image',
                            'name' => 'image',
                            'type' => 'image',
                            'return_format' => 'url',
                            'preview_size' => 'thumbnail',
                            'library' => 'all',
                            'instructions' => 'Upload an image for the slide.',
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field' => 'field_slide_type',
                                        'operator' => '==',
                                        'value' => 'image_text',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key' => 'field_slide_textarea1',
                            'label' => 'Text Area 1',
                            'name' => 'text_area_1',
                            'type' => 'textarea',
                            'instructions' => 'Add main text for the slide.',
                            'rows' => 3,
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field' => 'field_slide_type',
                                        'operator' => '==',
                                        'value' => 'image_text',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key' => 'field_slide_textarea2',
                            'label' => 'Text Area 2',
                            'name' => 'text_area_2',
                            'type' => 'textarea',
                            'instructions' => 'Add additional text for the slide.',
                            'rows' => 3,
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field' => 'field_slide_type',
                                        'operator' => '==',
                                        'value' => 'image_text',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key' => 'field_slide_link',
                            'label' => 'Link',
                            'name' => 'link',
                            'type' => 'link',
                            'instructions' => 'Add a URL link for the slide.',
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field' => 'field_slide_type',
                                        'operator' => '==',
                                        'value' => 'image_text',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key' => 'field_slide_benefits',
                            'label' => 'List of Benefits',
                            'name' => 'benefits',
                            'type' => 'repeater',
                            'sub_fields' => array(
                                array(
                                    'key' => 'field_slide_benefit_text',
                                    'label' => 'Benefit',
                                    'name' => 'benefit_text',
                                    'type' => 'text',
                                    'instructions' => 'Add a benefit item.',
                                ),
                            ),
                            'layout' => 'table',
                            'instructions' => 'Add benefits for this slide.',
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field' => 'field_slide_type',
                                        'operator' => '==',
                                        'value' => 'image_text',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key' => 'field_slide_accordion_subtitle',
                            'label' => 'Subtitle',
                            'name' => 'accordion_subtitle',
                            'type' => 'text',
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field' => 'field_slide_type',
                                        'operator' => '==',
                                        'value' => 'accordion',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key' => 'field_slide_accordion_title',
                            'label' => 'Title',
                            'name' => 'accordion_title',
                            'type' => 'textarea',
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field' => 'field_slide_type',
                                        'operator' => '==',
                                        'value' => 'accordion',
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'key' => 'field_slide_accordion_items',
                            'label' => 'Accordion Items',
                            'name' => 'accordion_items',
                            'type' => 'repeater',
                            'sub_fields' => array(
                                array(
                                    'key' => 'field_slide_accordion_item_title',
                                    'label' => 'Item Title',
                                    'name' => 'item_title',
                                    'type' => 'text',
                                ),
                                array(
                                    'key' => 'field_slide_accordion_item_content',
                                    'label' => 'Item Content',
                                    'name' => 'item_content',
                                    'type' => 'textarea',
                                ),
                            ),
                            'min' => 1,
                            'layout' => 'table',
                            'instructions' => 'Add items to the accordion.',
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field' => 'field_slide_type',
                                        'operator' => '==',
                                        'value' => 'accordion',
                                    ),
                                ),
                            ),
                        ),
                    ),
                    'button_label' => 'Add Slide',
                    'collapsed' => 'field_slide_type',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'block',
                        'operator' => '==',
                        'value' => 'acf/slider',
                    ),
                ),
            ),
        ));

        // Поля для блока Calculator
        acf_add_local_field_group(array(
            'key' => 'group_calculator',
            'title' => 'Calculator',
            'layout' => 'vertical',
            'fields' => array(
                array(
                    'key' => 'field_calculator_image',
                    'label' => 'Image',
                    'name' => 'image',
                    'type' => 'image',
                    'return_format' => 'url',
                    'preview_size' => 'thumbnail',
                    'instructions' => 'Upload an image for the calculator.',
                ),
                array(
                    'key' => 'field_calculator_image_position',
                    'label' => 'Image position',
                    'name' => 'image_position',
                    'type' => 'select',
                    'choices' => array(
                        'first' => 'first',
                        'second' => 'second',
                    ),
                ),
                array(
                    'key' => 'field_calculator_subtitle',
                    'label' => 'Subtitle',
                    'name' => 'subtitle',
                    'type' => 'text',
                ),
                array(
                    'key' => 'field_calculator_title',
                    'label' => 'Title',
                    'name' => 'title',
                    'type' => 'textarea',
                ),
                array(
                    'key' => 'field_calculator_square_miles',
                    'label' => 'Square Miles',
                    'name' => 'square_miles',
                    'type' => 'text',
                ),
                array(
                    'key' => 'field_calculator_percent',
                    'label' => 'Percent',
                    'name' => 'percent',
                    'type' => 'text',
                ),
                array(
                    'key' => 'field_calculator_animals',
                    'label' => 'Species of plains animals',
                    'name' => 'animals',
                    'type' => 'text',
                ),
                array(
                    'key' => 'field_calculator_birds',
                    'label' => 'Species of birds',
                    'name' => 'birds',
                    'type' => 'text',
                ),
                array(
                    'key' => 'field_calculator_num1',
                    'label' => 'Number 1',
                    'name' => 'num1',
                    'type' => 'number',
                ),
                array(
                    'key' => 'field_calculator_operation',
                    'label' => 'Operation',
                    'name' => 'operation',
                    'type' => 'select',
                    'choices' => array(
                        '+' => '+',
                        '-' => '-',
                        '*' => '*',
                        '/' => '/',
                    ),
                ),
                array(
                    'key' => 'field_calculator_num2',
                    'label' => 'Number 2',
                    'name' => 'num2',
                    'type' => 'number',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'block',
                        'operator' => '==',
                        'value' => 'acf/calculator',
                    ),
                ),
            ),
        ));
    }
}
add_action('acf/init', 'register_acf_field_groups');

// Обработка REST API запроса
function calculate_rest_route(WP_REST_Request $request) {
    $num1 = floatval($request->get_param('num1'));
    $num2 = floatval($request->get_param('num2'));
    $operation = sanitize_text_field($request->get_param('operation'));

    if (!is_numeric($num1) || !is_numeric($num2)) {
        return new WP_Error('invalid_input', 'Некорректные числа', array('status' => 400));
    }

    $result = 0;
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
            if ($num2 == 0) {
                return new WP_Error('division_by_zero', 'Деление на ноль', array('status' => 400));
            }
            $result = $num1 / $num2;
            break;
        default:
            return new WP_Error('invalid_operation', 'Некорректная операция', array('status' => 400));
    }

    return array('result' => $result);
}

function register_calculate_rest_route() {
    register_rest_route('my-custom/v1', '/calculate', array(
        'methods' => 'POST',
        'callback' => 'calculate_rest_route',
        'permission_callback' => '__return_true', // Замените на вашу функцию проверки прав
    ));
}
add_action('rest_api_init', 'register_calculate_rest_route');


function register_menu() {
    register_nav_menu('header-menu', __('Header Menu'));
    register_nav_menu('footer-menu', __('Footer Menu'));
    register_nav_menu('sub-footer-menu', __('Sub Footer Menu'));

}
add_action('init', 'register_menu');

function remove_nav_menu_container($args = array()) {
    if ($args['theme_location'] == 'sub-footer-menu') {
        $args['container'] = false;
    }
    return $args;
}
add_filter('wp_nav_menu_args', 'remove_nav_menu_container');

function allow_webp_uploads($mimes) {
    $mimes['webp'] = 'image/webp';
    return $mimes;
}
add_filter('upload_mimes', 'allow_webp_uploads');

function fix_webp_display($result, $path) {
    $info = @getimagesize($path);
    $mime = $info['mime'];

    if ($mime === 'image/webp') {
        $result['ext'] = 'webp';
        $result['type'] = 'image/webp';
    }
    return $result;
}
add_filter('wp_check_filetype_and_ext', 'fix_webp_display', 10, 2);

function remove_unused_styles() {
    // Удаление стилей WordPress
    wp_dequeue_style('block-library');
    wp_dequeue_style('wp-block-library-theme');

    // Деактивация стандартных стилей
    wp_deregister_style('block-library');
    wp_deregister_style('wp-block-library-theme');
}
add_action('wp_enqueue_scripts', 'remove_unused_styles', 20);