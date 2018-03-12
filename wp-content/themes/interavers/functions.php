<?php
/**
 * interavers functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package interavers
 */

/*update_option( 'siteurl', 'http://interavers.zzz.com.ua/' );
update_option( 'home', 'http://interavers.zzz.com.ua/' );*/

if (!function_exists('interavers_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function interavers_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on interavers, use a find and replace
         * to change 'interavers' to the name of your theme in all the template files.
         */
        load_theme_textdomain('interavers', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');
        add_image_size('partners-small', '100', '100', true);
        add_image_size('contacts-label', '20', '13', true);
        add_image_size('property-small', '143', '143', true);
        add_image_size('offers', '370', '250', true);
        add_image_size('single-programms', '250', '250', true);
        add_image_size('blog-small', '370', '250', true);
        add_image_size('education-small', '409', '276', true);
        add_image_size('blog-single-thumb', '600', '450', true);
        add_image_size('slider', '1140', '400', true);
        add_image_size('slider-country', '1140', '538', true);
        add_image_size('image-gallery-small', '229', '330', true);
        add_image_size('image-gallery-small-country', '82', '52', true);

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'menu-1' => esc_html__('Главное', 'interavers'),
            'menu-2' => esc_html__('Подменю', 'interavers'),
            'menu-3' => esc_html__('Навигация', 'interavers'),
            'menu-4' => esc_html__('Футер', 'interavers'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        /*
         * Enable support for Post Formats.
         * See https://developer.wordpress.org/themes/functionality/post-formats/
         */
        add_theme_support('post-formats', array(
            'aside',
            'image',
            'video',
            'quote',
            'link',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('interavers_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');
    }
endif;
add_action('after_setup_theme', 'interavers_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function interavers_content_width()
{
    $GLOBALS['content_width'] = apply_filters('interavers_content_width', 640);
}

add_action('after_setup_theme', 'interavers_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function interavers_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'interavers'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'interavers'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}

add_action('widgets_init', 'interavers_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function interavers_scripts()
{
    wp_enqueue_style('bts-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
    wp_enqueue_style('interavers-style', get_stylesheet_uri());
    wp_enqueue_style('main-css', get_template_directory_uri() . '/assets/css/main.css');
    wp_enqueue_style('fa-css', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css');
    wp_enqueue_style('mp-css', get_template_directory_uri() . '/assets/magnific-popup/magnific-popup.css');
    wp_enqueue_style('slick-css', 'https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css');

    /*AJAX*/
    wp_register_script("my_ajax", get_stylesheet_directory_uri() . '/assets/js/my_ajax.js', array('jquery'));
    wp_localize_script('my_ajax', 'myAjax', array('ajaxurl' => admin_url('admin-ajax.php')));
    /*AJAX*/
    wp_enqueue_script('fa-js', 'https://use.fontawesome.com/0a2d6dd2d3.js',null,null,false);
    wp_enqueue_script('interavers-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true);
    wp_enqueue_script('interavers-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true);
    wp_enqueue_script('jquery');
    wp_enqueue_script('accounting-js', get_template_directory_uri() . '/assets/js/accounting.js', null, null, true);
    wp_enqueue_script('bts-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', null, null, true);
    wp_enqueue_script('acf-map-api', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAOyozoRirlDm95ykBr2DeTQTey0BBhnAA', null, null, true);
    wp_enqueue_script('acf-map', get_template_directory_uri() . '/assets/js/acf-map.js');
    wp_enqueue_script('equalheight', get_template_directory_uri() . '/assets/js/jquery.matchHeight.js', null, null, true);
    wp_enqueue_script('my_ajax');
    wp_enqueue_script('global', get_template_directory_uri() . '/assets/js/global.js');
    wp_enqueue_script('slick-js', 'https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js', 'jquery', null,true);
    wp_enqueue_script('mp-js', get_template_directory_uri() . '/assets/magnific-popup/jquery.magnific-popup.min.js');


    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'interavers_scripts');

if (function_exists('acf_add_options_page')) {

    acf_add_options_page();

}

function cut_my_post($post_text, $long)
{
    if ($post_text != "") {
        $l = iconv_strlen($post_text);
        if ($long >= $l) {
            $cutted_text = mb_substr(htmlspecialchars(strip_tags($post_text)), 0, $long);
            return $cutted_text;
        } else {
            $cutted_text = mb_substr(htmlspecialchars(strip_tags($post_text)), 0, $long) . "...";
            return $cutted_text;
        }
    }
    return false;
}

/*
 * "Хлебные крошки" для WordPress
*/

require get_template_directory() . '/inc/custom-breadcrumbs.php';

/*
 * "End Хлебные крошки" для WordPress
*/

/* Отключаем админ панель для всех пользователей. */
if (is_user_logged_in()) {
    show_admin_bar(true);
}

/* Выравниваем высоту Титулов */

add_filter('post_thumbnail_html', 'remove_width_attribute', 10);
add_filter('image_send_to_editor', 'remove_width_attribute', 10);

function remove_width_attribute($html)
{
    $html = preg_replace('/(width|height)="\d*"\s/', "", $html);
    return $html;
}

/* Конец высоты Титула */

/* ACF map */

function my_acf_init()
{

    acf_update_setting('google_api_key', 'AIzaSyAOyozoRirlDm95ykBr2DeTQTey0BBhnAA');
}

add_action('acf/init', 'my_acf_init');

/**
 *  Разрешить загрузку файлов
 */
function add_svg_to_upload_mimes( $upload_mimes ) {
    $upload_mimes['svg'] = 'image/svg+xml';
    $upload_mimes['svgz'] = 'image/svg+xml';
    return $upload_mimes;
}
add_filter( 'upload_mimes', 'add_svg_to_upload_mimes', 10, 1 );

//* Add support for custom flexible header
add_theme_support( 'custom-header', array(
    'flex-width'    => true,
    'width'           => 560,
    'flex-height'    => true,
    'height'          => 500,
    'header-selector' => '',
    'header-text'     => false

) );

/* End ACF amp */

/*Search Property by ID*/
// Filter the search page

require get_template_directory() . '/inc/custom-filter-search.php';

/*End of search by ID*/

/* Rewrite rules for Education */

require get_template_directory() . '/inc/custom-rewrite-rules.php';

/*End rewrite rules*/

/**
 * AJAX
 */

require get_template_directory() . '/inc/custom-ajax.php';

/*End AJAX*/

/* Remove attachments from Mediafiles*/

function filter_media_comment_status( $open, $post_id ) {
    $post = get_post( $post_id );
    if( $post->post_type == 'attachment' ) {
        return false;
    }
    return $open;
}
add_filter( 'comments_open', 'filter_media_comment_status', 10 , 2 );

/* End remove attachments from Mediafiles*/


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
