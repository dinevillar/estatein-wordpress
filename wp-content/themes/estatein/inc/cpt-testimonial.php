<?php
/**
 * Testimonial Custom Post Type
 *
 * @package EstateIn
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Testimonial CPT
 */
function estatein_register_testimonial_cpt() {
    $labels = array(
        'name'               => _x('Testimonials', 'post type general name', 'estatein'),
        'singular_name'      => _x('Testimonial', 'post type singular name', 'estatein'),
        'menu_name'          => _x('Testimonials', 'admin menu', 'estatein'),
        'name_admin_bar'     => _x('Testimonial', 'add new on admin bar', 'estatein'),
        'add_new'            => _x('Add New', 'testimonial', 'estatein'),
        'add_new_item'       => __('Add New Testimonial', 'estatein'),
        'new_item'           => __('New Testimonial', 'estatein'),
        'edit_item'          => __('Edit Testimonial', 'estatein'),
        'view_item'          => __('View Testimonial', 'estatein'),
        'all_items'          => __('All Testimonials', 'estatein'),
        'search_items'       => __('Search Testimonials', 'estatein'),
        'parent_item_colon'  => __('Parent Testimonials:', 'estatein'),
        'not_found'          => __('No testimonials found.', 'estatein'),
        'not_found_in_trash' => __('No testimonials found in Trash.', 'estatein'),
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __('Customer testimonials and reviews', 'estatein'),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'testimonials'),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-format-quote',
        'supports'           => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'show_in_graphql'    => true,
    );

    register_post_type('testimonial', $args);
}
add_action('init', 'estatein_register_testimonial_cpt');

/**
 * Register ACF Field Group for Testimonials
 */
function estatein_register_testimonial_acf() {
    if (function_exists('acf_add_local_field_group')) {

        acf_add_local_field_group(array(
            'key' => 'group_testimonial_details',
            'title' => 'Testimonial Details',
            'fields' => array(
                array(
                    'key' => 'field_testimonial_rating',
                    'label' => 'Rating',
                    'name' => 'testimonial_rating',
                    'type' => 'number',
                    'required' => 1,
                    'default_value' => 5,
                    'min' => 1,
                    'max' => 5,
                    'step' => 1,
                ),
                array(
                    'key' => 'field_testimonial_author_name',
                    'label' => 'Author Name',
                    'name' => 'testimonial_author_name',
                    'type' => 'text',
                    'required' => 1,
                    'maxlength' => 100,
                ),
                array(
                    'key' => 'field_testimonial_author_role',
                    'label' => 'Author Role / Title',
                    'name' => 'testimonial_author_role',
                    'type' => 'text',
                    'required' => 0,
                    'maxlength' => 100,
                ),
                array(
                    'key' => 'field_testimonial_source',
                    'label' => 'Source (e.g., Google, Zillow, etc.)',
                    'name' => 'testimonial_source',
                    'type' => 'text',
                    'required' => 0,
                    'maxlength' => 50,
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'testimonial',
                    ),
                ),
            ),
        ));
    }
}
add_action('acf/init', 'estatein_register_testimonial_acf');

/**
 * Testimonial meta box for admin
 */
function estatein_testimonial_meta_boxes() {
    add_meta_box(
        'testimonial_details',
        'Testimonial Details',
        'estatein_testimonial_meta_callback',
        'testimonial',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'estatein_testimonial_meta_boxes');

function estatein_testimonial_meta_callback($post) {
    wp_nonce_field('estatein_testimonial_meta', 'estatein_testimonial_meta_nonce');

    $rating = get_post_meta($post->ID, 'testimonial_rating', true);
    $author_name = get_post_meta($post->ID, 'testimonial_author_name', true);
    $author_role = get_post_meta($post->ID, 'testimonial_author_role', true);
    $source = get_post_meta($post->ID, 'testimonial_source', true);

    echo '<table class="form-table">';
    echo '<tr><th><label for="testimonial_rating">Rating (1-5)</label></th><td><input type="number" id="testimonial_rating" name="testimonial_rating" value="' . esc_attr($rating ? $rating : 5) . '" min="1" max="5" step="1" style="width:100px;"></td></tr>';
    echo '<tr><th><label for="testimonial_author_name">Author Name</label></th><td><input type="text" id="testimonial_author_name" name="testimonial_author_name" value="' . esc_attr($author_name) . '" required style="width:100%;"></td></tr>';
    echo '<tr><th><label for="testimonial_author_role">Author Role / Title</label></th><td><input type="text" id="testimonial_author_role" name="testimonial_author_role" value="' . esc_attr($author_role) . '" style="width:100%;"></td></tr>';
    echo '<tr><th><label for="testimonial_source">Source</label></th><td><input type="text" id="testimonial_source" name="testimonial_source" value="' . esc_attr($source) . '" placeholder="e.g., Google, Zillow" style="width:100%;"></td></tr>';
    echo '</table>';
}

function estatein_save_testimonial_meta($post_id) {
    if (!isset($_POST['estatein_testimonial_meta_nonce']) || !wp_verify_nonce($_POST['estatein_testimonial_meta_nonce'], 'estatein_testimonial_meta')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = array('testimonial_rating', 'testimonial_author_name', 'testimonial_author_role', 'testimonial_source');

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post_testimonial', 'estatein_save_testimonial_meta');
