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
define('DB_NAME', 'avers2016_2017');

/** Имя пользователя MySQL */
define('DB_USER', 'avers2016_admin');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', '2XEnFLkp');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'DYR,h$q[Sjjnm4u!^lq3-N<:xs8W0o1#{w+e3)R0)58@^#f{(_^vy[p[P^SAT5(h');
define('SECURE_AUTH_KEY',  'w[`;/bV1E,pr4T#-q`q<&yTLWrP|7K4y@W**qrl|V,/M~XC0Hs~t~?<?=jEAfL?j');
define('LOGGED_IN_KEY',    'zR|qhH`,GT@q~:C^4#5.eVxA}en[7G{+(=yut4u#-h#!x~`4QuzpC%oCtQY1h<@D');
define('NONCE_KEY',        'd;>u7>m~|s_DZ(etki1:}mKB|ALHs%Q]I,sw}C*?KtqFusrua~!C[{3iC*l/O(/z');
define('AUTH_SALT',        't|j&$v=puS?oEGGdFIv2N7OIkY?m%8zJh,_D#}B_AcS,/D[75WhG r|g6hkgA>-;');
define('SECURE_AUTH_SALT', '7H[a<FiR,t}DgjoTvQ!B><%l0L`<;`6X [Jsgx]W%i`M$mkd+FgtRY5Ax!7?cN`+');
define('LOGGED_IN_SALT',   'Njc+VHzr24qij6UWhRtCYYGLxSx&.|P_[|J~oMQs!qSGGGXeiR&+(yVZ``aZT^~M');
define('NONCE_SALT',       '`PY{g:J4xS/WMUGb0s#`y3jDhbmo6.7.Ofi-$}wo~c0(`?Kj]9F%+)-A-Mb^k{&}');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

define('FS_METHOD','direct');



/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

define( 'WP_HOME', 'http://interavers.com/' );
define( 'WP_SITEURL', 'http://interavers.com/' );

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
