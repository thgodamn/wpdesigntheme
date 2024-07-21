<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать файл в "wp-config.php"
 * и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки базы данных
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры базы данных: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'wordpress' );

/** Имя пользователя базы данных */
define( 'DB_USER', 'wordpress' );

/** Пароль к базе данных */
define( 'DB_PASSWORD', 'wordpress' );

/** Имя сервера базы данных */
define( 'DB_HOST', 'mariadb' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу. Можно сгенерировать их с помощью
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}.
 *
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными.
 * Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '/]~KxKwjN4T8NQo$5@Y# *CeSf*5SZ9P>~Z_HI4`d%3HG,E$-882K#vNDMpnW9kU' );
define( 'SECURE_AUTH_KEY',  'XK4PrkU?6R_0_*=<p?=BsgW^G%ms@@@##G??C<PC8pY@<CJsmZIU}s%8}Omu_ZMe' );
define( 'LOGGED_IN_KEY',    'M5J:#y&W5CI:tJx/`:MUD2sKD+#v8{|]Bx=@w]0K6oti*0c&6Rb k<]9L|FrVoRV' );
define( 'NONCE_KEY',        'wJNx45HXiQf_0ORuL)<0]C1N7ZYpI&jHemg^2z9q0j|%EM3BY^W/b`G%rIMbw![2' );
define( 'AUTH_SALT',        'Sz,]n673K$^)}x!e/3[Pgu{.3ct~*|C),^rvJ-NB{/`u<*1jkx:qG{_q^^z[o18&' );
define( 'SECURE_AUTH_SALT', '%i,./{#Gf#Q-7T@@Xz`_<X6GV.+u%^(mbY{|jHdlNlF^g(~6:wzqWM~mxeW^?=zp' );
define( 'LOGGED_IN_SALT',   'GF5nn M1SX..e+{[#kzEOWh{%2$C$uC:cAl=WUg{z_}}ep*bE>+(0AFGA`M2x;}o' );
define( 'NONCE_SALT',       'zM+Y#qS3&=qHnxE&T4Q$%&(%[`Ce*g#qom;{KF80Z}$+8](e`@X~L)A]D,C}$: s' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
//define( 'WP_DEBUG', false );


/* Произвольные значения добавляйте между этой строкой и надписью "дальше не редактируем". */



/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
