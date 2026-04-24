<?php
/**
 * Service Custom Post Type
 *
 * @package EstateIn
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Service CPT
 */
function estatein_register_service_cpt() {
    $labels = array(
        'name'               => _x('Services', 'post type general name', 'estatein'),
        'singular_name'      => _x('Service', 'post type singular name', 'estatein'),
        'menu_name'          => _x('Services', 'admin menu', 'estatein'),
        'name_admin_bar'     => _x('Service', 'add new on admin bar', 'estatein'),
        'add_new'            => _x('Add New', 'service', 'estatein'),
        'add_new_item'       => __('Add New Service', 'estatein'),
        'new_item'           => __('New Service', 'estatein'),
        'edit_item'          => __('Edit Service', 'estatein'),
        'view_item'          => __('View Service', 'estatein'),
        'all_items'          => __('All Services', 'estatein'),
        'search_items'       => __('Search Services', 'estatein'),
        'parent_item_colon'  => __('Parent Services:', 'estatein'),
        'not_found'          => __('No services found.', 'estatein'),
        'not_found_in_trash' => __('No services found in Trash.', 'estatein'),
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __('Services offered by the real estate company', 'estatein'),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'services'),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 7,
        'menu_icon'          => 'dashicons-admin-tools',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_graphql'    => true,
    );

    register_post_type('service', $args);
}
add_action('init', 'estatein_register_service_cpt');

/**
 * Register ACF Field Group for Services
 */
function estatein_register_service_acf() {
    if (function_exists('acf_add_local_field_group')) {

        acf_add_local_field_group(array(
            'key' => 'group_service_details',
            'title' => 'Service Details',
            'fields' => array(
                array(
                    'key' => 'field_service_icon',
                    'label' => 'Icon',
                    'name' => 'service_icon',
                    'type' => 'select',
                    'required' => 1,
                    'choices' => array(
                        'home' => 'Home / House',
                        'building' => 'Building',
                        'key' => 'Key',
                        'search' => 'Search / Magnifier',
                        'heart' => 'Heart',
                        'star' => 'Star',
                        'shield' => 'Shield / Security',
                        'chart' => 'Chart / Graph',
                        'users' => 'Users / People',
                        'phone' => 'Phone',
                        'email' => 'Email',
                        'location' => 'Location / Pin',
                        'calculator' => 'Calculator',
                        'file' => 'File / Document',
                        'handshake' => 'Handshake',
                        'trophy' => 'Trophy',
                    ),
                    'default_value' => 'home',
                ),
                array(
                    'key' => 'field_service_icon_color',
                    'label' => 'Icon Color',
                    'name' => 'service_icon_color',
                    'type' => 'color_picker',
                    'required' => 0,
                    'default_value' => '#703BF7',
                ),
                array(
                    'key' => 'field_service_link',
                    'label' => 'Service Link',
                    'name' => 'service_link',
                    'type' => 'url',
                    'required' => 0,
                ),
                array(
                    'key' => 'field_service_external',
                    'label' => 'Open Link in New Tab',
                    'name' => 'service_external',
                    'type' => 'true_false',
                    'required' => 0,
                    'default_value' => 0,
                    'ui' => 1,
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'service',
                    ),
                ),
            ),
        ));
    }
}
add_action('acf/init', 'estatein_register_service_acf');

/**
 * Service meta box for admin (fallback if ACF not available)
 */
function estatein_service_meta_boxes() {
    add_meta_box(
        'service_details',
        'Service Details',
        'estatein_service_meta_callback',
        'service',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'estatein_service_meta_boxes');

function estatein_service_meta_callback($post) {
    wp_nonce_field('estatein_service_meta', 'estatein_service_meta_nonce');

    $icon = get_post_meta($post->ID, 'service_icon', true);
    $link = get_post_meta($post->ID, 'service_link', true);
    $external = get_post_meta($post->ID, 'service_external', true);

    $icons = array(
        'home' => 'Home / House',
        'building' => 'Building',
        'key' => 'Key',
        'search' => 'Search / Magnifier',
        'heart' => 'Heart',
        'star' => 'Star',
        'shield' => 'Shield / Security',
        'chart' => 'Chart / Graph',
        'users' => 'Users / People',
        'phone' => 'Phone',
        'email' => 'Email',
        'location' => 'Location / Pin',
        'calculator' => 'Calculator',
        'file' => 'File / Document',
        'handshake' => 'Handshake',
        'trophy' => 'Trophy',
    );

    echo '<table class="form-table">';
    echo '<tr><th><label for="service_icon">Icon</label></th><td><select id="service_icon" name="service_icon" style="width:100%;">';
    foreach ($icons as $value => $label) {
        $selected = selected($icon, $value, false);
        echo '<option value="' . esc_attr($value) . '"' . $selected . '>' . esc_html($label) . '</option>';
    }
    echo '</select></td></tr>';
    echo '<tr><th><label for="service_link">Link URL</label></th><td><input type="url" id="service_link" name="service_link" value="' . esc_attr($link) . '" style="width:100%;"></td></tr>';
    echo '<tr><th><label for="service_external">Open in new tab</label></th><td><input type="checkbox" id="service_external" name="service_external" value="1" ' . checked($external, '1', false) . '></td></tr>';
    echo '</table>';
}

function estatein_save_service_meta($post_id) {
    if (!isset($_POST['estatein_service_meta_nonce']) || !wp_verify_nonce($_POST['estatein_service_meta_nonce'], 'estatein_service_meta')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = array('service_icon', 'service_link', 'service_external');

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            $value = ($field === 'service_external') ? 1 : sanitize_text_field($_POST[$field]);
            update_post_meta($post_id, $field, $value);
        } elseif ($field === 'service_external') {
            delete_post_meta($post_id, 'service_external');
        }
    }
}
add_action('save_post_service', 'estatein_save_service_meta');
