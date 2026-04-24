<?php
/**
 * EstateIn Theme Functions
 *
 * @package EstateIn
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

// Theme version
define('ESTATEIN_VERSION', '1.0.0');
define('ESTATEIN_DIR', get_template_directory());
define('ESTATEIN_URL', get_template_directory_uri());

/**
 * Theme Setup
 */
function estatein_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height'      => 48,
        'width'       => 160,
        'flex-width'  => true,
        'flex-height' => true,
    ));
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    add_theme_support('customize-selective-refresh-widgets');

    // Register navigation menus
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'estatein'),
        'footer'  => esc_html__('Footer Menu', 'estatein'),
    ));

    // Add image sizes
    add_image_size('property-card', 432, 318, true);
    add_image_size('property-featured', 800, 600, true);
    add_image_size('testimonial-avatar', 60, 60, true);
}
add_action('after_setup_theme', 'estatein_setup');

/**
 * Enqueue Scripts and Styles
 */
function estatein_scripts() {
    // Google Fonts
    wp_enqueue_style(
        'estatein-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;500;600;700&family=Urbanist:wght@400;500;600;700&display=swap',
        array(),
        null
    );

    // Main theme stylesheet (base + variables)
    wp_enqueue_style(
        'estatein-style',
        get_stylesheet_uri(),
        array('estatein-fonts'),
        ESTATEIN_VERSION
    );

    // Additional styles (partials)
    wp_enqueue_style(
        'estatein-main',
        ESTATEIN_URL . '/css/main.css',
        array('estatein-style'),
        ESTATEIN_VERSION
    );

    // Main JavaScript
    wp_enqueue_script(
        'estatein-script',
        ESTATEIN_URL . '/js/main.js',
        array(),
        ESTATEIN_VERSION,
        true
    );

    // Localize script for AJAX
    wp_localize_script('estatein-script', 'estatein_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('estatein_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'estatein_scripts');

/**
 * Include required files
 */
require_once ESTATEIN_DIR . '/inc/cpt-property.php';
require_once ESTATEIN_DIR . '/inc/cpt-testimonial.php';
require_once ESTATEIN_DIR . '/inc/cpt-service.php';
require_once ESTATEIN_DIR . '/inc/ajax-handlers.php';
require_once ESTATEIN_DIR . '/inc/template-tags.php';
require_once ESTATEIN_DIR . '/inc/class-nav-walker.php';

/**
 * ACF JSON save location
 */
add_filter('acf/settings/save_json', function() {
    return ESTATEIN_DIR . '/acf/json';
});

add_filter('acf/settings/load_json', function($paths) {
    unset($paths[0]);
    $paths[] = ESTATEIN_DIR . '/acf/json';
    return $paths;
});

/**
 * Widgets area
 */
function estatein_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Footer Widget Area', 'estatein'),
        'id'            => 'footer-widgets',
        'description'   => esc_html__('Add widgets for footer column display.', 'estatein'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'estatein_widgets_init');

/**
 * Custom excerpt length
 */
function estatein_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'estatein_excerpt_length', 999);

/**
 * Pagination
 */
function estatein_pagination() {
    global $wp_query;

    $big = 999999999;

    $paginate_links = paginate_links(array(
        'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format'    => '?paged=%#%',
        'current'   => max(1, get_query_var('paged')),
        'total'     => $wp_query->max_num_pages,
        'type'      => 'array',
        'prev_text' => __('&laquo; Previous', 'estatein'),
        'next_text' => __('Next &raquo;', 'estatein'),
    ));

    if ($paginate_links) {
        echo '<nav class="pagination"><ul class="pagination__list">';
        foreach ($paginate_links as $link) {
            if (strpos($link, 'current') !== false) {
                echo '<li class="pagination__item active">' . $link . '</li>';
            } else {
                echo '<li class="pagination__item">' . $link . '</li>';
            }
        }
        echo '</ul></nav>';
    }
}
