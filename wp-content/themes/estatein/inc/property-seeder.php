<?php
/**
 * Property Seeder via WP-CLI
 *
 * @package EstateIn
 */

if (!defined('ABSPATH')) {
    exit;
}

if (defined('WP_CLI') && WP_CLI) {
    class Estatein_Property_Seeder_Command {

        /**
         * Seeds dummy properties for testing.
         *
         * ## OPTIONS
         *
         * [--count=<number>]
         * : Number of properties to generate.
         * ---
         * default: 20
         * ---
         * 
         * [--image=<path>]
         * : Path to an image to use as the featured image and gallery.
         *
         * ## EXAMPLES
         *
         *     wp estatein seed_properties --count=20
         */
        public function seed_properties($args, $assoc_args) {
            $count = isset($assoc_args['count']) ? intval($assoc_args['count']) : 20;
            $image_path = isset($assoc_args['image']) ? $assoc_args['image'] : '';

            WP_CLI::line("Seeding $count properties...");

            $locations = ['New York', 'Los Angeles', 'Chicago', 'Miami', 'Houston', 'Phoenix', 'Philadelphia', 'San Antonio', 'San Diego', 'Dallas'];
            $types = ['Villa', 'Apartment', 'Studio', 'Condo', 'House', 'Mansion', 'Townhouse'];
            $features = ['Pool', 'Garage', 'Garden', 'Security', 'Balcony', 'Gym', 'Spa', 'Fireplace', 'Air Conditioning', 'WiFi'];
            $statuses = ['sale', 'rent', 'sold'];

            // Ensure taxonomy terms exist
            foreach ($locations as $loc) {
                if (!term_exists($loc, 'property_location')) {
                    wp_insert_term($loc, 'property_location');
                }
            }
            foreach ($types as $type) {
                if (!term_exists($type, 'property_type')) {
                    wp_insert_term($type, 'property_type');
                }
            }
            foreach ($features as $feat) {
                if (!term_exists($feat, 'property_feature')) {
                    wp_insert_term($feat, 'property_feature');
                }
            }

            $attachment_id = 0;
            if (!empty($image_path) && file_exists($image_path)) {
                WP_CLI::line("Processing image: $image_path");
                require_once(ABSPATH . 'wp-admin/includes/file.php');
                require_once(ABSPATH . 'wp-admin/includes/image.php');
                require_once(ABSPATH . 'wp-admin/includes/media.php');

                // Check if already uploaded
                $filename = basename($image_path);
                global $wpdb;
                $existing = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE post_title = %s AND post_type = 'attachment'", preg_replace('/\.[^.]+$/', '', $filename)));
                
                if ($existing) {
                    $attachment_id = $existing;
                    WP_CLI::line("Using existing attachment ID: $attachment_id");
                } else {
                    $upload_file = wp_upload_bits($filename, null, file_get_contents($image_path));
                    if (!$upload_file['error']) {
                        $wp_filetype = wp_check_filetype($filename, null);
                        $attachment = array(
                            'post_mime_type' => $wp_filetype['type'],
                            'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
                            'post_content' => '',
                            'post_status' => 'inherit'
                        );
                        $attachment_id = wp_insert_attachment($attachment, $upload_file['file']);
                        if (!is_wp_error($attachment_id)) {
                            $attach_data = wp_generate_attachment_metadata($attachment_id, $upload_file['file']);
                            wp_update_attachment_metadata($attachment_id, $attach_data);
                            WP_CLI::line("Created attachment ID: $attachment_id");
                        }
                    }
                }
            }

            for ($i = 0; $i < $count; $i++) {
                $location = $locations[array_rand($locations)];
                $type = $types[array_rand($types)];
                $status = $statuses[array_rand($statuses)];
                
                $price = rand(100, 2000) * 1000; // 100k to 2M
                $sqft = rand(800, 6000);
                $build_year = rand(1990, 2024);
                $bedrooms = rand(1, 10);
                $bathrooms = rand(1, 6);
                
                $title = "Beautiful $type in $location";
                
                $post_id = wp_insert_post([
                    'post_title'   => $title,
                    'post_content' => "This is a dummy property description for testing purposes. It features a beautiful $type located in the heart of $location, offering $bedrooms bedrooms and $bathrooms bathrooms. It was built in $build_year and has a total area of $sqft sqft.",
                    'post_status'  => 'publish',
                    'post_type'    => 'property',
                ]);

                if (is_wp_error($post_id)) {
                    WP_CLI::warning("Failed to create property: " . $title);
                    continue;
                }

                // Set terms
                wp_set_object_terms($post_id, $location, 'property_location');
                wp_set_object_terms($post_id, $type, 'property_type');
                
                $random_features = (array) array_rand(array_flip($features), rand(3, 7));
                wp_set_object_terms($post_id, $random_features, 'property_feature');

                // Set meta
                update_post_meta($post_id, 'property_price', $price);
                update_post_meta($post_id, 'property_sqft', $sqft);
                update_post_meta($post_id, 'property_build_year', $build_year);
                update_post_meta($post_id, 'property_bedrooms', $bedrooms);
                update_post_meta($post_id, 'property_bathrooms', $bathrooms);
                update_post_meta($post_id, 'property_address', "123 Dummy St, $location, USA");
                update_post_meta($post_id, 'property_status', $status);
                update_post_meta($post_id, 'property_video', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ');
                
                if ($attachment_id) {
                    set_post_thumbnail($post_id, $attachment_id);
                    update_post_meta($post_id, 'property_gallery', array($attachment_id, $attachment_id, $attachment_id)); // Simulate a gallery
                }

                WP_CLI::line("Created: $title (ID: $post_id)");
            }

            WP_CLI::success("Successfully seeded $count properties!");
        }
    }

    WP_CLI::add_command('estatein', 'Estatein_Property_Seeder_Command');
}
