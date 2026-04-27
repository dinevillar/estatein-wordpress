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
define('ESTATEIN_VERSION', '1.0.1');
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
        time()
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
require_once ESTATEIN_DIR . '/inc/property-seeder.php';

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

/**
 * Render simple SVG icon for About page value cards
 *
 * @param string $name Icon name.
 * @return string SVG markup.
 */
function estatein_about_icon( $name ) {
    $icons = [
        'shield-check' => '<svg width="34" height="34" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/></svg>',
        'star'         => '<svg width="34" height="34" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">  <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"/></svg>',
        'academic-cap' => '<svg width="34" height="34" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">  <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" /></svg>',
        'users'        => '<svg width="34" height="34" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">  <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/></svg>',
        'sun'          => '<svg width="34" height="34" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">  <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"/></svg>',
    ];

    return isset( $icons[ $name ] ) ? $icons[ $name ] : $icons['star'];
}

/**
 * Render simple SVG icon for Services page value cards
 *
 * @param string $name Icon name.
 * @return string SVG markup.
 */
function estatein_service_icon( $name ) {
    $icons = [
        'home'           => '<svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">  <path d="M11.6875 14.875C11.6875 13.1161 13.1161 11.6875 14.875 11.6875H19.125C20.8839 11.6875 22.3125 13.1161 22.3125 14.875V25.5C22.3125 27.2589 20.8839 28.6875 19.125 28.6875H14.875C13.1161 28.6875 11.6875 27.2589 11.6875 25.5V14.875ZM3.1875 17L14.478 6.54911C15.9189 5.21503 18.0811 5.21503 19.522 6.54911L30.8125 17V27.625C30.8125 29.3839 29.3839 30.8125 27.625 30.8125H6.375C4.61609 30.8125 3.1875 29.3839 3.1875 27.625V17Z" fill="#703BF7"/></svg>',
        'spark'          => '<svg width="68" height="30" viewBox="0 0 68 30" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 0L17.5 12.5L30 15L17.5 17.5L15 30L12.5 17.5L0 15L12.5 12.5L15 0Z" fill="#703BF7"/><path d="M45 6L46.5 15L54 18L46.5 21L45 30L43.5 21L36 18L43.5 15L45 6Z" fill="#703BF7"/><path d="M64 11L64.7 15L68 16.5L64.7 18L64 22L63.3 18L60 16.5L63.3 15L64 11Z" fill="#703BF7"/></svg>',
        'chart-bar'      => '<svg width="34" height="34" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#703BF7" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 13.125C3 12.5037 3.50368 12 4.125 12H6.375C6.99632 12 7.5 12.5037 7.5 13.125V19.875C7.5 20.4963 6.99632 21 6.375 21H4.125C3.50368 21 3 20.4963 3 19.875V13.125Z"/><path d="M9.75 8.625C9.75 8.00368 10.2537 7.5 10.875 7.5H13.125C13.7463 7.5 14.25 8.00368 14.25 8.625V19.875C14.25 20.4963 13.7463 21 13.125 21H10.875C10.2537 21 9.75 20.4963 9.75 19.875V8.625Z"/><path d="M16.5 4.125C16.5 3.50368 17.0037 3 17.625 3H19.875C20.4963 3 21 3.50368 21 4.125V19.875C21 20.4963 20.4963 21 19.875 21H17.625C17.0037 21 16.5 20.4963 16.5 19.875V4.125Z"/></svg>',
        'chart-pie'      => '<svg width="34" height="34" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#703BF7" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M10.5 6C6.35786 6 3 9.35786 3 13.5C3 17.6421 6.35786 21 10.5 21C14.6421 21 18 17.6421 18 13.5H10.5V6Z"/><path d="M13.5 10.5H21C21 6.35786 17.6421 3 13.5 3V10.5Z"/></svg>',
        'briefcase'      => '<svg width="34" height="34" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#703BF7" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20.25 14.1499V18.4C20.25 19.4944 19.4631 20.4359 18.3782 20.58C16.2915 20.857 14.1624 21 12 21C9.83757 21 7.70854 20.857 5.62185 20.58C4.5369 20.4359 3.75 19.4944 3.75 18.4V14.1499M20.25 14.1499C20.7219 13.7476 21 13.1389 21 12.4889V8.70569C21 7.62475 20.2321 6.69082 19.1631 6.53086C18.0377 6.36247 16.8995 6.23315 15.75 6.14432M20.25 14.1499C20.0564 14.315 19.8302 14.4453 19.5771 14.5294C17.1953 15.3212 14.6477 15.75 12 15.75C9.35229 15.75 6.80469 15.3212 4.42289 14.5294C4.16984 14.4452 3.94361 14.3149 3.75 14.1499M3.75 14.1499C3.27808 13.7476 3 13.1389 3 12.4889V8.70569C3 7.62475 3.7679 6.69082 4.83694 6.53086C5.96233 6.36247 7.10049 6.23315 8.25 6.14432M15.75 6.14432V5.25C15.75 4.00736 14.7426 3 13.5 3H10.5C9.25736 3 8.25 4.00736 8.25 5.25V6.14432M15.75 6.14432C14.5126 6.0487 13.262 6 12 6C10.738 6 9.48744 6.0487 8.25 6.14432M12 12.75H12.0075V12.7575H12V12.75Z"/></svg>',
        'megaphone'      => '<svg width="34" height="34" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#703BF7" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M10.3404 15.8398C9.65153 15.7803 8.95431 15.75 8.25 15.75H7.5C5.01472 15.75 3 13.7353 3 11.25C3 8.76472 5.01472 6.75 7.5 6.75H8.25C8.95431 6.75 9.65153 6.71966 10.3404 6.66022M10.3404 15.8398C10.5933 16.8015 10.9237 17.7317 11.3246 18.6234C11.5721 19.1738 11.3842 19.8328 10.8616 20.1345L10.2053 20.5134C9.6539 20.8318 8.9456 20.6306 8.67841 20.0527C8.0518 18.6973 7.56541 17.2639 7.23786 15.771M10.3404 15.8398C9.95517 14.3745 9.75 12.8362 9.75 11.25C9.75 9.66379 9.95518 8.1255 10.3404 6.66022M10.3404 15.8398C13.5 16.1124 16.4845 16.9972 19.1747 18.3749M10.3404 6.66022C13.5 6.3876 16.4845 5.50283 19.1747 4.12509M19.1747 4.12509C19.057 3.74595 18.9302 3.37083 18.7944 3M19.1747 4.12509C19.7097 5.84827 20.0557 7.65462 20.1886 9.51991M19.1747 18.3749C19.057 18.7541 18.9302 19.1292 18.7944 19.5M19.1747 18.3749C19.7097 16.6517 20.0557 14.8454 20.1886 12.9801M20.1886 9.51991C20.6844 9.93264 21 10.5545 21 11.25C21 11.9455 20.6844 12.5674 20.1886 12.9801M20.1886 9.51991C20.2293 10.0913 20.25 10.6682 20.25 11.25C20.25 11.8318 20.2293 12.4087 20.1886 12.9801"/></svg>',
        'user-group'     => '<svg width="34" height="34" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#703BF7" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17.9999 18.7191C18.2474 18.7396 18.4978 18.75 18.7506 18.75C19.7989 18.75 20.8054 18.5708 21.741 18.2413C21.7473 18.1617 21.7506 18.0812 21.7506 18C21.7506 16.3431 20.4074 15 18.7506 15C18.123 15 17.5403 15.1927 17.0587 15.5222M17.9999 18.7191C18 18.7294 18 18.7397 18 18.75C18 18.975 17.9876 19.1971 17.9635 19.4156C16.2067 20.4237 14.1707 21 12 21C9.82933 21 7.79327 20.4237 6.03651 19.4156C6.01238 19.1971 6 18.975 6 18.75C6 18.7397 6.00003 18.7295 6.00008 18.7192M17.9999 18.7191C17.994 17.5426 17.6494 16.4461 17.0587 15.5222M17.0587 15.5222C15.9928 13.8552 14.1255 12.75 12 12.75C9.87479 12.75 8.00765 13.8549 6.94169 15.5216M6.94169 15.5216C6.46023 15.1925 5.87796 15 5.25073 15C3.59388 15 2.25073 16.3431 2.25073 18C2.25073 18.0812 2.25396 18.1617 2.26029 18.2413C3.19593 18.5708 4.2024 18.75 5.25073 18.75C5.50307 18.75 5.75299 18.7396 6.00008 18.7192M6.94169 15.5216C6.35071 16.4457 6.00598 17.5424 6.00008 18.7192M15 6.75C15 8.40685 13.6569 9.75 12 9.75C10.3431 9.75 9 8.40685 9 6.75C9 5.09315 10.3431 3.75 12 3.75C13.6569 3.75 15 5.09315 15 6.75ZM21 9.75C21 10.9926 19.9926 12 18.75 12C17.5074 12 16.5 10.9926 16.5 9.75C16.5 8.50736 17.5074 7.5 18.75 7.5C19.9926 7.5 21 8.50736 21 9.75ZM7.5 9.75C7.5 10.9926 6.49264 12 5.25 12C4.00736 12 3 10.9926 3 9.75C3 8.50736 4.00736 7.5 5.25 7.5C6.49264 7.5 7.5 8.50736 7.5 9.75Z"/></svg>',
        'wrench'         => '<svg width="34" height="34" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#703BF7" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21.75 6.75C21.75 9.23528 19.7353 11.25 17.25 11.25C17.1206 11.25 16.9925 11.2445 16.8659 11.2338C15.7904 11.1429 14.6016 11.3052 13.9155 12.1383L6.76432 20.8219C6.28037 21.4096 5.55897 21.75 4.79769 21.75C3.39064 21.75 2.25 20.6094 2.25 19.2023C2.25 18.441 2.59044 17.7196 3.1781 17.2357L11.8617 10.0845C12.6948 9.39841 12.8571 8.20956 12.7662 7.13411C12.7555 7.00749 12.75 6.87938 12.75 6.75C12.75 4.26472 14.7647 2.25 17.25 2.25C17.9103 2.25 18.5375 2.39223 19.1024 2.64774L15.8262 5.92397C16.0823 7.03963 16.9605 7.91785 18.0762 8.17397L21.3524 4.89779C21.6078 5.46268 21.75 6.08973 21.75 6.75Z"/><path d="M4.86723 19.125H4.87473V19.1325H4.86723V19.125Z"/></svg>',
        'sparkles'       => '<svg width="34" height="34" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#703BF7" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9.8132 15.9038L9 18.75L8.1868 15.9038C7.75968 14.4089 6.59112 13.2403 5.09619 12.8132L2.25 12L5.09619 11.1868C6.59113 10.7597 7.75968 9.59112 8.1868 8.09619L9 5.25L9.8132 8.09619C10.2403 9.59113 11.4089 10.7597 12.9038 11.1868L15.75 12L12.9038 12.8132C11.4089 13.2403 10.2403 14.4089 9.8132 15.9038Z"/><path d="M18.2589 8.71454L18 9.75L17.7411 8.71454C17.4388 7.50533 16.4947 6.56117 15.2855 6.25887L14.25 6L15.2855 5.74113C16.4947 5.43883 17.4388 4.49467 17.7411 3.28546L18 2.25L18.2589 3.28546C18.5612 4.49467 19.5053 5.43883 20.7145 5.74113L21.75 6L20.7145 6.25887C19.5053 6.56117 18.5612 7.50533 18.2589 8.71454Z"/><path d="M16.8942 20.5673L16.5 21.75L16.1058 20.5673C15.8818 19.8954 15.3546 19.3682 14.6827 19.1442L13.5 18.75L14.6827 18.3558C15.3546 18.1318 15.8818 17.6046 16.1058 16.9327L16.5 15.75L16.8942 16.9327C17.1182 17.6046 17.6454 18.1318 18.3173 18.3558L19.5 18.75L18.3173 19.1442C17.6454 19.3682 17.1182 19.8954 16.8942 20.5673Z"/></svg>',
        'shield-check'   => '<svg width="34" height="34" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#703BF7" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12.7498L11.25 14.9998L15 9.74985M12 2.71411C9.8495 4.75073 6.94563 5.99986 3.75 5.99986C3.69922 5.99986 3.64852 5.99955 3.59789 5.99892C3.2099 7.17903 3 8.43995 3 9.74991C3 15.3414 6.82432 20.0397 12 21.3719C17.1757 20.0397 21 15.3414 21 9.74991C21 8.43995 20.7901 7.17903 20.4021 5.99892C20.3515 5.99955 20.3008 5.99986 20.25 5.99986C17.0544 5.99986 14.1505 4.75073 12 2.71411Z"/></svg>',
        'sun'            => '<svg width="34" height="34" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#703BF7" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"/></svg>',
        'building-storefront' => '<svg width="34" height="34" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#703BF7" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M13.5 21V13.5C13.5 13.0858 13.8358 12.75 14.25 12.75H17.25C17.6642 12.75 18 13.0858 18 13.5V21M13.5 21H2.36088M13.5 21H18M18 21H21.6391M20.25 21V9.34877M3.75 21V9.34902M3.75 9.34902C4.89729 10.0122 6.38977 9.85295 7.37132 8.87141C7.41594 8.82679 7.45886 8.78111 7.50008 8.73446C8.04979 9.35722 8.85402 9.75 9.75 9.75C10.646 9.75 11.4503 9.35718 12 8.73437C12.5497 9.35718 13.354 9.75 14.25 9.75C15.1459 9.75 15.9501 9.35727 16.4998 8.73457C16.541 8.78115 16.5838 8.82676 16.6284 8.87132C17.61 9.85295 19.1027 10.0121 20.25 9.34877M3.75 9.34902C3.52788 9.22064 3.31871 9.06143 3.12868 8.87141C1.95711 7.69983 1.95711 5.80034 3.12868 4.62877L4.31797 3.43948C4.59927 3.15817 4.9808 3.00014 5.37863 3.00014H18.6212C19.019 3.00014 19.4005 3.15818 19.6818 3.43948L20.871 4.62868C22.0426 5.80025 22.0426 7.69975 20.871 8.87132C20.6811 9.06127 20.472 9.22042 20.25 9.34877M6.75 18H10.5C10.9142 18 11.25 17.6642 11.25 17.25V13.5C11.25 13.0858 10.9142 12.75 10.5 12.75H6.75C6.33579 12.75 6 13.0858 6 13.5V17.25C6 17.6642 6.33579 18 6.75 18Z"/></svg>',
        'banknotes'          => '<svg width="34" height="34" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#703BF7" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2.25 18.75C7.71719 18.75 13.0136 19.4812 18.0468 20.8512C18.7738 21.0491 19.5 20.5086 19.5 19.7551V18.75M3.75 4.5V5.25C3.75 5.66421 3.41421 6 3 6H2.25M2.25 6V5.625C2.25 5.00368 2.75368 4.5 3.375 4.5H20.25M2.25 6V15M20.25 4.5V5.25C20.25 5.66421 20.5858 6 21 6H21.75M20.25 4.5H20.625C21.2463 4.5 21.75 5.00368 21.75 5.625V15.375C21.75 15.9963 21.2463 16.5 20.625 16.5H20.25M21.75 15H21C20.5858 15 20.25 15.3358 20.25 15.75V16.5M20.25 16.5H3.75M3.75 16.5H3.375C2.75368 16.5 2.25 15.9963 2.25 15.375V15M3.75 16.5V15.75C3.75 15.3358 3.41421 15 3 15H2.25M15 10.5C15 12.1569 13.6569 13.5 12 13.5C10.3431 13.5 9 12.1569 9 10.5C9 8.84315 10.3431 7.5 12 7.5C13.6569 7.5 15 8.84315 15 10.5ZM18 10.5H18.0075V10.5075H18V10.5ZM6 10.5H6.0075V10.5075H6V10.5Z"/></svg>',
        'building-office'    => '<svg width="34" height="34" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#703BF7" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3.75 21H20.25M4.5 3H19.5M5.25 3V21M18.75 3V21M9 6.75H10.5M9 9.75H10.5M9 12.75H10.5M13.5 6.75H15M13.5 9.75H15M13.5 12.75H15M9 21V17.625C9 17.0037 9.50368 16.5 10.125 16.5H13.875C14.4963 16.5 15 17.0037 15 17.625V21"/></svg>',
        'squares-plus'       => '<svg width="34" height="34" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#703BF7" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M13.5 16.875H16.875M16.875 16.875H20.25M16.875 16.875V13.5M16.875 16.875V20.25M6 10.5H8.25C9.49264 10.5 10.5 9.49264 10.5 8.25V6C10.5 4.75736 9.49264 3.75 8.25 3.75H6C4.75736 3.75 3.75 4.75736 3.75 6V8.25C3.75 9.49264 4.75736 10.5 6 10.5ZM6 20.25H8.25C9.49264 20.25 10.5 19.2426 10.5 18V15.75C10.5 14.5074 9.49264 13.5 8.25 13.5H6C4.75736 13.5 3.75 14.5074 3.75 15.75V18C3.75 19.2426 4.75736 20.25 6 20.25ZM15.75 10.5H18C19.2426 10.5 20.25 9.49264 20.25 8.25V6C20.25 4.75736 19.2426 3.75 18 3.75H15.75C14.5074 3.75 13.5 4.75736 13.5 6V8.25C13.5 9.49264 14.5074 10.5 15.75 10.5Z"/></svg>',
        'swatch'             => '<svg width="34" height="34" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#703BF7" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4.09835 19.9017C5.56282 21.3661 7.93719 21.3661 9.40165 19.9017L15.8033 13.5M6.75 21C4.67893 21 3 19.3211 3 17.25V4.125C3 3.50368 3.50368 3 4.125 3H9.375C9.99632 3 10.5 3.50368 10.5 4.125V8.1967M6.75 21C8.82107 21 10.5 19.3211 10.5 17.25V8.1967M6.75 21H19.875C20.4963 21 21 20.4963 21 19.875V14.625C21 14.0037 20.4963 13.5 19.875 13.5H15.8033M10.5 8.1967L13.3791 5.31757C13.8185 4.87823 14.5308 4.87823 14.9701 5.31757L18.6824 9.02988C19.1218 9.46922 19.1218 10.1815 18.6824 10.6209L15.8033 13.5M6.75 17.25H6.7575V17.2575H6.75V17.25Z"/></svg>',
        'lightbulb'          => '<svg width="34" height="34" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#703BF7" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 18V12.75M12 12.75C12.5179 12.75 13.0206 12.6844 13.5 12.561M12 12.75C11.4821 12.75 10.9794 12.6844 10.5 12.561M14.25 20.0394C13.5212 20.1777 12.769 20.25 12 20.25C11.231 20.25 10.4788 20.1777 9.75 20.0394M13.5 22.422C13.007 22.4736 12.5066 22.5 12 22.5C11.4934 22.5 10.993 22.4736 10.5 22.422M14.25 18V17.8083C14.25 16.8254 14.9083 15.985 15.7585 15.4917C17.9955 14.1938 19.5 11.7726 19.5 9C19.5 4.85786 16.1421 1.5 12 1.5C7.85786 1.5 4.5 4.85786 4.5 9C4.5 11.7726 6.00446 14.1938 8.24155 15.4917C9.09173 15.985 9.75 16.8254 9.75 17.8083V18"/></svg>',
        'fire'               => '<svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M18.3647 3.2382C18.1922 3.00686 17.933 2.85565 17.6468 2.81931C17.3605 2.78298 17.0717 2.86465 16.8469 3.04556C14.1975 5.17739 12.3496 8.27016 11.8337 11.7957C10.9036 11.1214 10.0867 10.2999 9.41743 9.36531C9.23332 9.10821 8.94427 8.94647 8.62884 8.92407C8.31342 8.90167 8.00441 9.02092 7.78581 9.24942C5.5965 11.5379 4.25 14.6438 4.25 18.062C4.25 25.1036 9.95837 30.812 17 30.812C24.0416 30.812 29.75 25.1036 29.75 18.062C29.75 12.8757 26.6536 8.41498 22.213 6.42325C20.6417 5.65613 19.3441 4.55152 18.3647 3.2382ZM22.3125 20.1876C22.3125 23.1216 19.934 25.5001 17 25.5001C14.066 25.5001 11.6875 23.1216 11.6875 20.1876C11.6875 19.6077 11.7804 19.0495 11.9522 18.5271C12.8425 19.1853 13.8659 19.6737 14.9746 19.9448C15.2804 17.9603 16.2726 16.2023 17.7011 14.9209C20.3037 15.264 22.3125 17.4912 22.3125 20.1876Z" fill="#703BF7"/></svg>',
        'arrow-up-right' => '<svg width="34" height="34" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6.375 27.625L27.625 6.375M27.625 6.375L11.6875 6.375M27.625 6.375V22.3125"/></svg>',

    ];

    return isset( $icons[ $name ] ) ? $icons[ $name ] : $icons['home'];
}

/**
 * Add custom favicon
 */
function estatein_favicon() {
    $favicon_url = esc_url(get_template_directory_uri() . '/assets/images/favicon.png');
    echo '<link rel="icon" href="' . $favicon_url . '" type="image/png" />' . "\n";
    echo '<link rel="apple-touch-icon" href="' . $favicon_url . '" />' . "\n";
}
add_action('wp_head', 'estatein_favicon');
add_action('admin_head', 'estatein_favicon');
add_action('login_head', 'estatein_favicon');
