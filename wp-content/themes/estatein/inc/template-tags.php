<?php
/**
 * Template Tags
 *
 * @package EstateIn
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Get property card data for AJAX/loops
 */
function estatein_get_property_card_data($post_id) {
    $post = get_post($post_id);

    $price = get_post_meta($post_id, 'property_price', true);
    $bedrooms = get_post_meta($post_id, 'property_bedrooms', true);
    $bathrooms = get_post_meta($post_id, 'property_bathrooms', true);
    $sqft = get_post_meta($post_id, 'property_sqft', true);
    $status = get_post_meta($post_id, 'property_status', true);

    $featured_img = get_the_post_thumbnail_url($post_id, 'property-card');
    if (!$featured_img) {
        $featured_img = ESTATEIN_URL . '/assets/images/property-placeholder.jpg';
    }

    $terms = get_the_terms($post_id, 'property_type');
    $property_type = !is_wp_error($terms) && $terms ? $terms[0]->name : '';

    return array(
        'id' => $post_id,
        'title' => get_the_title($post_id),
        'permalink' => get_permalink($post_id),
        'excerpt' => get_the_excerpt($post),
        'image' => $featured_img,
        'price' => $price,
        'bedrooms' => $bedrooms,
        'bathrooms' => $bathrooms,
        'sqft' => $sqft,
        'status' => $status,
        'type' => $property_type,
    );
}

/**
 * Format price with currency symbol (default USD)
 */
function estatein_format_price($price, $currency = '$') {
    if (empty($price) || $price == 0) {
        return 'Price on request';
    }

    $formatted = number_format($price, 0, '.', ',');
    return $currency . $formatted;
}

/**
 * Format property details icon
 */
function estatein_get_property_icon($type) {
    $icons = array(
        'bed' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 4v16"/><path d="M2 8h18a2 2 0 0 1 2 2v10"/><path d="M2 17h20"/><path d="M6 8v9"/></svg>',
        'bath' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 6c0 2.5 2 4.5 4 4.5s4-2 4-4.5-1.25-2.25-3.5-2.25S9 3.5 9 6z"/><path d="M5 13l4 3-1 3-4-3 1-3zm13 0l-4 3 1 3 5-3-1-3z"/><path d="M7 6v17"/><path d="M17 6v17"/></svg>',
        'sqft' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3h18v18H3z"/><path d="M3 9h18"/><path d="M3 15h18"/><path d="M9 3v18"/><path d="M15 3v18"/></svg>',
    );

    return isset($icons[$type]) ? $icons[$type] : '';
}

/**
 * Get star rating HTML
 */
function estatein_get_star_rating($rating) {
    $output = '';
    for ($i = 1; $i <= 5; $i++) {
        if ($i <= $rating) {
            $output .= '<svg width="20" height="20" viewBox="0 0 24 24" fill="#FFD700" stroke="#FFD700" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>';
        } else {
            $output .= '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#666" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>';
        }
    }
    return $output;
}

/**
 * Build pagination links
 */
function estatein_build_pagination($max_pages, $current_page) {
    if ($max_pages <= 1) return '';

    $output = '<nav class="pagination"><ul class="pagination__list">';

    // Previous
    if ($current_page > 1) {
        $output .= '<li class="pagination__item pagination__prev"><a href="' . get_pagenum_link($current_page - 1) . '">&laquo; Previous</a></li>';
    }

    for ($i = 1; $i <= $max_pages; $i++) {
        if ($i === $current_page) {
            $output .= '<li class="pagination__item active"><span>' . $i . '</span></li>';
        } else {
            $output .= '<li class="pagination__item"><a href="' . get_pagenum_link($i) . '">' . $i . '</a></li>';
        }
    }

    // Next
    if ($current_page < $max_pages) {
        $output .= '<li class="pagination__item pagination__next"><a href="' . get_pagenum_link($current_page + 1) . '">Next &raquo;</a></li>';
    }

    $output .= '</ul></nav>';

    return $output;
}

/**
 * Get SVG icon by name
 */
function estatein_get_icon($icon_name, $size = 24, $class = '') {
    $icons = array(
        'menu' => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>',
        'close' => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>',
        'search' => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>',
        'arrow-right' => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>',
        'arrow-left' => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>',
        'bed' => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 4v16"/><path d="M2 8h18a2 2 0 0 1 2 2v10"/><path d="M2 17h20"/><path d="M6 8v9"/></svg>',
        'bath' => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 6c0 2.5 2 4.5 4 4.5s4-2 4-4.5-1.25-2.25-3.5-2.25S9 3.5 9 6z"/><path d="M5 13l4 3-1 3-4-3 1-3zm13 0l-4 3 1 3 5-3-1-3z"/><path d="M7 6v17"/><path d="M17 6v17"/></svg>',
        'sqft' => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3h18v18H3z"/><path d="M3 9h18"/><path d="M3 15h18"/><path d="M9 3v18"/><path d="M15 3v18"/></svg>',
        'home' => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>',
        'building' => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="2" width="16" height="20" rx="2" ry="2"/><line x1="9" y1="22" x2="9" y2="22.01"/><line x1="15" y1="22" x2="15" y2="22.01"/><line x1="12" y1="22" x2="12" y2="22.01"/><line x1="12" y1="2" x2="12" y2="22"/><line x1="4" y1="10" x2="20" y2="10"/><line x1="4" y1="14" x2="20" y2="14"/><line x1="4" y1="18" x2="20" y2="18"/></svg>',
        'key' => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="7.5" cy="15.5" r="5.5"/><path d="M21 12h-5"/><path d="M15 7v5"/></svg>',
        'heart' => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>',
        'star' => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>',
        'shield' => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>',
        'chart' => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>',
        'users' => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
        'location' => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>',
        'phone' => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>',
        'email' => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>',
        'calculator' => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="2" width="16" height="20" rx="2"/><line x1="8" y1="6" x2="16" y2="6"/><line x1="8" y1="10" x2="8" y2="10"/><line x1="12" y1="10" x2="12" y2="10"/><line x1="16" y1="10" x2="16" y2="10"/><line x1="8" y1="14" x2="8" y2="14"/><line x1="12" y1="14" x2="12" y2="14"/><line x1="16" y1="14" x2="16" y2="14"/><line x1="8" y1="18" x2="8" y2="18"/><line x1="12" y1="18" x2="12" y2="18"/><line x1="16" y1="18" x2="16" y2="18"/></svg>',
        'file' => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>',
        'trophy' => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"/><path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"/><path d="M4 22h16"/><path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"/><path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"/><path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"/></svg>',
        'handshake' => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 20a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2Z"/><path d="M20 20a2 2 0 0 1 2-2v-6a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v6a2 2 0 0 1 2 2Z"/><path d="M12 14v-2"/><path d="M8 14v-2"/><path d="M16 14v-2"/></svg>',
    );

    return isset($icons[$icon_name]) ? '<span class="icon ' . $class . '">' . $icons[$icon_name] . '</span>' : '';
}

/**
 * Get service icon by type (since ACF might store different values)
 */
function estatein_get_service_icon($icon_type) {
    $icons = array(
        'home' => 'home',
        'building' => 'building',
        'key' => 'key',
        'search' => 'search',
        'heart' => 'heart',
        'star' => 'star',
        'shield' => 'shield',
        'chart' => 'chart',
        'users' => 'users',
        'phone' => 'phone',
        'email' => 'email',
        'location' => 'location',
        'calculator' => 'calculator',
        'file' => 'file',
        'handshake' => 'handshake',
        'trophy' => 'trophy',
    );

    $icon_key = isset($icons[$icon_type]) ? $icons[$icon_type] : 'home';
    return estatein_get_icon($icon_key);
}
