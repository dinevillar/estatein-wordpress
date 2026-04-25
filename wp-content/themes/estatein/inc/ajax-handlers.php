<?php
/**
 * AJAX Handlers
 *
 * @package EstateIn
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Property search/filter AJAX
 */
function estatein_property_search() {
    check_ajax_referer('estatein_nonce', 'nonce');

    $args = array(
        'post_type' => 'property',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'meta_query' => array(),
        'tax_query' => array(),
    );

    // Filter by price
    if (!empty($_POST['min_price']) || !empty($_POST['max_price'])) {
        $price_query = array('key' => 'property_price', 'value' => array(), 'compare' => 'BETWEEN');
        if (!empty($_POST['min_price'])) {
            $price_query['value'][] = floatval($_POST['min_price']);
        } else {
            $price_query['value'][] = 0;
        }
        if (!empty($_POST['max_price'])) {
            $price_query['value'][] = floatval($_POST['max_price']);
        } else {
            $price_query['value'][] = PHP_INT_MAX;
        }
        $args['meta_query'][] = $price_query;
    }

    // Filter by bedrooms
    if (!empty($_POST['bedrooms'])) {
        $args['meta_query'][] = array(
            'key' => 'property_bedrooms',
            'value' => intval($_POST['bedrooms']),
            'compare' => '>=',
        );
    }

    // Filter by bathrooms
    if (!empty($_POST['bathrooms'])) {
        $args['meta_query'][] = array(
            'key' => 'property_bathrooms',
            'value' => intval($_POST['bathrooms']),
            'compare' => '>=',
        );
    }

    // Filter by property type
    if (!empty($_POST['property_type'])) {
        $args['tax_query'][] = array(
            'taxonomy' => 'property_type',
            'field' => 'slug',
            'terms' => sanitize_text_field($_POST['property_type']),
        );
    }

    // Filter by location
    if (!empty($_POST['location'])) {
        $args['tax_query'][] = array(
            'taxonomy' => 'property_location',
            'field' => 'slug',
            'terms' => sanitize_text_field($_POST['location']),
        );
    }

    $query = new WP_Query($args);
    $properties = array();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $properties[] = estatein_get_property_card_data(get_the_ID());
        }
        wp_reset_postdata();
    }

    wp_send_json_success(array(
        'properties' => $properties,
        'total' => $query->found_posts,
    ));
}
add_action('wp_ajax_property_search', 'estatein_property_search');
add_action('wp_ajax_nopriv_property_search', 'estatein_property_search');

/**
 * Load more properties AJAX
 */
function estatein_load_more_properties() {
    check_ajax_referer('estatein_nonce', 'nonce');

    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $per_page = isset($_POST['per_page']) ? intval($_POST['per_page']) : 6;

    $args = array(
        'post_type' => 'property',
        'post_status' => 'publish',
        'posts_per_page' => $per_page,
        'paged' => $page,
    );

    $query = new WP_Query($args);
    $properties = array();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $properties[] = estatein_get_property_card_data(get_the_ID());
        }
        wp_reset_postdata();
    }

    wp_send_json_success(array(
        'properties' => $properties,
        'has_more' => $page < $query->max_num_pages,
    ));
}
add_action('wp_ajax_load_more_properties', 'estatein_load_more_properties');
add_action('wp_ajax_nopriv_load_more_properties', 'estatein_load_more_properties');

/**
 * Newsletter subscription AJAX
 */
function estatein_newsletter_subscribe() {
    check_ajax_referer('estatein_nonce', 'nonce');

    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';

    if (!is_email($email)) {
        wp_send_json_error(array('message' => 'Please enter a valid email address.'));
    }

    // You can integrate with your email service here (Mailchimp, etc.)
    // For demo, we'll just save to a custom table or option

    // Example: Store in WordPress options (in production, use a proper service)
    $subscribers = get_option('estatein_newsletter_subscribers', array());
    if (!in_array($email, $subscribers)) {
        $subscribers[] = $email;
        update_option('estatein_newsletter_subscribers', $subscribers);
    }

    wp_send_json_success(array(
        'message' => 'Thank you for subscribing to our newsletter!',
    ));
}
add_action('wp_ajax_newsletter_subscribe', 'estatein_newsletter_subscribe');
add_action('wp_ajax_nopriv_newsletter_subscribe', 'estatein_newsletter_subscribe');

/**
 * Property Inquiry form AJAX
 */
function estatein_submit_property_inquiry() {
    check_ajax_referer('estatein_nonce', 'nonce');

    $first_name = isset($_POST['first_name']) ? sanitize_text_field($_POST['first_name']) : '';
    $last_name = isset($_POST['last_name']) ? sanitize_text_field($_POST['last_name']) : '';
    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
    $message = isset($_POST['message']) ? sanitize_textarea_field($_POST['message']) : '';
    
    if (empty($first_name) || empty($last_name) || empty($email) || empty($message)) {
        wp_send_json_error(array('message' => 'Please fill in all required fields.'));
    }
    
    if (!is_email($email)) {
        wp_send_json_error(array('message' => 'Please enter a valid email address.'));
    }

    $to = get_option('admin_email');
    $subject = 'New Property Inquiry from ' . $first_name . ' ' . $last_name;
    $body = "Name: $first_name $last_name\nEmail: $email\nPhone: $phone\nLocation: {$_POST['inquiry_location']}\nType: {$_POST['inquiry_type']}\nMessage: $message";
    $headers = array('Content-Type: text/plain; charset=UTF-8', 'From: ' . get_bloginfo('name') . ' <' . $to . '>', 'Reply-To: ' . $email);
    
    wp_mail($to, $subject, $body, $headers);

    wp_send_json_success(array('message' => 'Thank you! Your inquiry has been sent successfully.'));
}
add_action('wp_ajax_submit_property_inquiry', 'estatein_submit_property_inquiry');
add_action('wp_ajax_nopriv_submit_property_inquiry', 'estatein_submit_property_inquiry');
