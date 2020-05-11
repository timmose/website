<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'website_db' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'root' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', '' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         ']Jf0<5+|*,!KKjr1tNHIgS-6XAKfJx$o41c:~l=1(d!W?AEUQ1jcDg*-ibE`uW|s' );
define( 'SECURE_AUTH_KEY',  'e(Ln#HT(o=GMv8z/agzd4wHv@&!cr]Y#2 nmWZ^,|*kBdD[kXXCb%-<(k2.G^6vf' );
define( 'LOGGED_IN_KEY',    '~xId B`rQ i.)emyWS,=U82n|WaB9h@#sa3_ebGyeh2/DcG4[p6[>}dDcVzvV9{&' );
define( 'NONCE_KEY',        '4|lu_`bKl,,,4Ni9r!Gaa~PhTZN4|y9pSNJZ;cAqc9(0>u2;b:!oamQm9s*1LTJ,' );
define( 'AUTH_SALT',        'VGJ;w:N^1TtNr. ;M1U;*7]YTJfp`fXk:,#}<m$%mm<^uAVq3dJa@l5-QqSmf#3I' );
define( 'SECURE_AUTH_SALT', '3`K9G6MeBDF`75:_S$i1=r0d78deG @=b`ESU=U#$Z/tm>x<#@)o=53lG2#XU/6A' );
define( 'LOGGED_IN_SALT',   'WOND3XxEfh6#ID0,>>yD!/},ZiK7lYuu}&c1>5,4:o;O/=]C[quEj3e<{s|&^rUc' );
define( 'NONCE_SALT',       'QOyj6hAtR/g0Cbz[TeNuzxM*m~Lw>O_LX$3TY&P<{wrqqyiH4yR[|kE;*tu89eTx' );

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
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once( ABSPATH . 'wp-settings.php' );
