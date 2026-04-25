<?php
/**
 * Property Custom Post Type
 *
 * @package EstateIn
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Property CPT
 */
function estatein_register_property_cpt() {
    $labels = array(
        'name'               => _x('Properties', 'post type general name', 'estatein'),
        'singular_name'      => _x('Property', 'post type singular name', 'estatein'),
        'menu_name'          => _x('Properties', 'admin menu', 'estatein'),
        'name_admin_bar'     => _x('Property', 'add new on admin bar', 'estatein'),
        'add_new'            => _x('Add New', 'property', 'estatein'),
        'add_new_item'       => __('Add New Property', 'estatein'),
        'new_item'           => __('New Property', 'estatein'),
        'edit_item'          => __('Edit Property', 'estatein'),
        'view_item'          => __('View Property', 'estatein'),
        'all_items'          => __('All Properties', 'estatein'),
        'search_items'       => __('Search Properties', 'estatein'),
        'parent_item_colon'  => __('Parent Properties:', 'estatein'),
        'not_found'          => __('No properties found.', 'estatein'),
        'not_found_in_trash' => __('No properties found in Trash.', 'estatein'),
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __('Property listings for real estate', 'estatein'),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'properties'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-building',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_graphql'    => true,
    );

    register_post_type('property', $args);
}
add_action('init', 'estatein_register_property_cpt');

/**
 * Register Property Taxonomies
 */
function estatein_register_property_taxonomies() {
    // Property Type
    $labels = array(
        'name'              => _x('Property Types', 'taxonomy general name', 'estatein'),
        'singular_name'     => _x('Property Type', 'taxonomy singular name', 'estatein'),
        'search_items'      => __('Search Property Types', 'estatein'),
        'all_items'         => __('All Property Types', 'estatein'),
        'parent_item'       => __('Parent Property Type', 'estatein'),
        'parent_item_colon' => __('Parent Property Type:', 'estatein'),
        'edit_item'         => __('Edit Property Type', 'estatein'),
        'update_item'       => __('Update Property Type', 'estatein'),
        'add_new_item'      => __('Add New Property Type', 'estatein'),
        'new_item_name'     => __('New Property Type Name', 'estatein'),
        'menu_name'         => __('Property Types', 'estatein'),
    );

    register_taxonomy('property_type', array('property'), array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'property-type'),
    ));

    // Property Location
    $labels = array(
        'name'              => _x('Locations', 'taxonomy general name', 'estatein'),
        'singular_name'     => _x('Location', 'taxonomy singular name', 'estatein'),
        'search_items'      => __('Search Locations', 'estatein'),
        'all_items'         => __('All Locations', 'estatein'),
        'parent_item'       => __('Parent Location', 'estatein'),
        'parent_item_colon' => __('Parent Location:', 'estatein'),
        'edit_item'         => __('Edit Location', 'estatein'),
        'update_item'       => __('Update Location', 'estatein'),
        'add_new_item'      => __('Add New Location', 'estatein'),
        'new_item_name'     => __('New Location Name', 'estatein'),
        'menu_name'         => __('Locations', 'estatein'),
    );

    register_taxonomy('property_location', array('property'), array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'location'),
    ));

    // Property Features
    $labels = array(
        'name'              => _x('Features', 'taxonomy general name', 'estatein'),
        'singular_name'     => _x('Feature', 'taxonomy singular name', 'estatein'),
        'search_items'      => __('Search Features', 'estatein'),
        'all_items'         => __('All Features', 'estatein'),
        'edit_item'         => __('Edit Feature', 'estatein'),
        'update_item'       => __('Update Feature', 'estatein'),
        'add_new_item'      => __('Add New Feature', 'estatein'),
        'new_item_name'     => __('New Feature Name', 'estatein'),
        'menu_name'         => __('Features', 'estatein'),
    );

    register_taxonomy('property_feature', array('property'), array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'feature'),
    ));
}
add_action('init', 'estatein_register_property_taxonomies');

/**
 * Register ACF Field Groups for Property
 */
function estatein_register_property_acf() {
    if (function_exists('acf_add_local_field_group')) {

        acf_add_local_field_group(array(
            'key' => 'group_property_details',
            'title' => 'Property Details',
            'fields' => array(
                array(
                    'key' => 'field_property_price',
                    'label' => 'Price',
                    'name' => 'property_price',
                    'type' => 'number',
                    'required' => 1,
                    'default_value' => 0,
                    'placeholder' => '',
                    'step' => 1000,
                    'min' => 0,
                ),
                array(
                    'key' => 'field_property_bedrooms',
                    'label' => 'Bedrooms',
                    'name' => 'property_bedrooms',
                    'type' => 'number',
                    'required' => 1,
                    'default_value' => 1,
                    'min' => 1,
                    'max' => 20,
                ),
                array(
                    'key' => 'field_property_bathrooms',
                    'label' => 'Bathrooms',
                    'name' => 'property_bathrooms',
                    'type' => 'number',
                    'required' => 1,
                    'default_value' => 1,
                    'min' => 1,
                    'max' => 10,
                ),
                array(
                    'key' => 'field_property_sqft',
                    'label' => 'Square Feet',
                    'name' => 'property_sqft',
                    'type' => 'number',
                    'required' => 1,
                    'default_value' => 0,
                    'min' => 0,
                ),
                array(
                    'key' => 'field_property_address',
                    'label' => 'Address',
                    'name' => 'property_address',
                    'type' => 'text',
                    'required' => 0,
                    'maxlength' => 255,
                ),
                array(
                    'key' => 'field_property_status',
                    'label' => 'Status',
                    'name' => 'property_status',
                    'type' => 'select',
                    'required' => 1,
                    'choices' => array(
                        'sale' => 'For Sale',
                        'rent' => 'For Rent',
                        'sold' => 'Sold',
                    ),
                    'default_value' => 'sale',
                ),
                array(
                    'key' => 'field_property_video',
                    'label' => 'Video URL',
                    'name' => 'property_video',
                    'type' => 'url',
                    'required' => 0,
                ),
                array(
                    'key' => 'field_property_virtual_tour',
                    'label' => 'Virtual Tour URL',
                    'name' => 'property_virtual_tour',
                    'type' => 'url',
                    'required' => 0,
                ),
                array(
                    'key' => 'field_property_build_year',
                    'label' => 'Build Year',
                    'name' => 'property_build_year',
                    'type' => 'number',
                    'required' => 0,
                    'min' => 1800,
                    'max' => 2100,
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'property',
                    ),
                ),
            ),
        ));

        // Property Gallery Field
        acf_add_local_field_group(array(
            'key' => 'group_property_gallery',
            'title' => 'Property Gallery',
            'fields' => array(
                array(
                    'key' => 'field_property_gallery',
                    'label' => 'Gallery Images',
                    'name' => 'property_gallery',
                    'type' => 'gallery',
                    'required' => 0,
                    'insert' => 'append',
                    'library' => 'all',
                    'min' => '',
                    'max' => '',
                    'min_width' => '',
                    'min_height' => '',
                    'min_size' => '',
                    'max_width' => '',
                    'max_height' => '',
                    'max_size' => '',
                    'mime_types' => '',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'property',
                    ),
                ),
            ),
        ));
    }
}
add_action('acf/init', 'estatein_register_property_acf');

/**
 * Property meta box for admin
 */
function estatein_property_meta_boxes() {
    add_meta_box(
        'property_details',
        'Property Details',
        'estatein_property_meta_callback',
        'property',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'estatein_property_meta_boxes');

function estatein_property_meta_callback($post) {
    wp_nonce_field('estatein_property_meta', 'estatein_property_meta_nonce');

    $price = get_post_meta($post->ID, 'property_price', true);
    $bedrooms = get_post_meta($post->ID, 'property_bedrooms', true);
    $bathrooms = get_post_meta($post->ID, 'property_bathrooms', true);
    $sqft = get_post_meta($post->ID, 'property_sqft', true);
    $build_year = get_post_meta($post->ID, 'property_build_year', true);
    $address = get_post_meta($post->ID, 'property_address', true);

    echo '<table class="form-table">';
    echo '<tr><th><label for="property_price">Price</label></th><td><input type="number" id="property_price" name="property_price" value="' . esc_attr($price) . '" min="0" step="1000" style="width:100%;"></td></tr>';
    echo '<tr><th><label for="property_bedrooms">Bedrooms</label></th><td><input type="number" id="property_bedrooms" name="property_bedrooms" value="' . esc_attr($bedrooms) . '" min="1" max="20" style="width:100%;"></td></tr>';
    echo '<tr><th><label for="property_bathrooms">Bathrooms</label></th><td><input type="number" id="property_bathrooms" name="property_bathrooms" value="' . esc_attr($bathrooms) . '" min="1" max="10" style="width:100%;"></td></tr>';
    echo '<tr><th><label for="property_sqft">Square Feet</label></th><td><input type="number" id="property_sqft" name="property_sqft" value="' . esc_attr($sqft) . '" min="0" style="width:100%;"></td></tr>';
    echo '<tr><th><label for="property_build_year">Build Year</label></th><td><input type="number" id="property_build_year" name="property_build_year" value="' . esc_attr($build_year) . '" min="1800" max="2100" style="width:100%;"></td></tr>';
    echo '<tr><th><label for="property_address">Address</label></th><td><input type="text" id="property_address" name="property_address" value="' . esc_attr($address) . '" style="width:100%;"></td></tr>';
    echo '<tr><th><label for="property_status">Status</label></th><td>';
    echo '<select id="property_status" name="property_status" style="width:100%;">';
    echo '<option value="sale"' . selected($status, 'sale', false) . '>For Sale</option>';
    echo '<option value="rent"' . selected($status, 'rent', false) . '>For Rent</option>';
    echo '<option value="sold"' . selected($status, 'sold', false) . '>Sold</option>';
    echo '</select></td></tr>';
    echo '</table>';
}

function estatein_save_property_meta($post_id) {
    if (!isset($_POST['estatein_property_meta_nonce']) || !wp_verify_nonce($_POST['estatein_property_meta_nonce'], 'estatein_property_meta')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = array('property_price', 'property_bedrooms', 'property_bathrooms', 'property_sqft', 'property_build_year', 'property_address', 'property_status');

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post_property', 'estatein_save_property_meta');

/**
 * Filter properties archive via pre_get_posts
 */
function estatein_filter_properties_archive($query) {
    if (!is_admin() && $query->is_main_query() && is_post_type_archive('property')) {
        $meta_query = array();
        $tax_query = array();

        if (!empty($_GET['location'])) {
            $location = sanitize_text_field($_GET['location']);
            $meta_query[] = array(
                'key' => 'property_address',
                'value' => $location,
                'compare' => 'LIKE'
            );
        }

        if (!empty($_GET['property_type'])) {
            $tax_query[] = array(
                'taxonomy' => 'property_type',
                'field' => 'slug',
                'terms' => sanitize_text_field($_GET['property_type'])
            );
        }

        if (!empty($_GET['price_range'])) {
            $range = sanitize_text_field($_GET['price_range']);
            if ($range === '0-500000') {
                $meta_query[] = array('key' => 'property_price', 'value' => array(0, 500000), 'type' => 'NUMERIC', 'compare' => 'BETWEEN');
            } elseif ($range === '500000-1000000') {
                $meta_query[] = array('key' => 'property_price', 'value' => array(500000, 1000000), 'type' => 'NUMERIC', 'compare' => 'BETWEEN');
            } elseif ($range === '1000000+') {
                $meta_query[] = array('key' => 'property_price', 'value' => 1000000, 'type' => 'NUMERIC', 'compare' => '>=');
            }
        }

        if (!empty($_GET['property_size'])) {
            $size = sanitize_text_field($_GET['property_size']);
            if ($size === 'small') {
                $meta_query[] = array('key' => 'property_sqft', 'value' => 1500, 'type' => 'NUMERIC', 'compare' => '<=');
            } elseif ($size === 'medium') {
                $meta_query[] = array('key' => 'property_sqft', 'value' => array(1500, 3000), 'type' => 'NUMERIC', 'compare' => 'BETWEEN');
            } elseif ($size === 'large') {
                $meta_query[] = array('key' => 'property_sqft', 'value' => 3000, 'type' => 'NUMERIC', 'compare' => '>');
            }
        }

        if (!empty($_GET['build_year'])) {
            $year = sanitize_text_field($_GET['build_year']);
            if ($year === '2020+') {
                $meta_query[] = array('key' => 'property_build_year', 'value' => 2020, 'type' => 'NUMERIC', 'compare' => '>=');
            } elseif ($year === '2010-2020') {
                $meta_query[] = array('key' => 'property_build_year', 'value' => array(2010, 2020), 'type' => 'NUMERIC', 'compare' => 'BETWEEN');
            } elseif ($year === 'pre-2010') {
                $meta_query[] = array('key' => 'property_build_year', 'value' => 2010, 'type' => 'NUMERIC', 'compare' => '<');
            }
        }

        if (!empty($meta_query)) {
            $meta_query['relation'] = 'AND';
            $query->set('meta_query', $meta_query);
        }

        if (!empty($tax_query)) {
            $tax_query['relation'] = 'AND';
            $query->set('tax_query', $tax_query);
        }
    }
}
add_action('pre_get_posts', 'estatein_filter_properties_archive');
