<?php
/**
 * Custom Navigation Walker
 *
 * @package EstateIn
 */

if (!defined('ABSPATH')) {
    exit;
}

class EstateIn_Nav_Walker extends Walker_Nav_Menu {
    /**
     * Starts the element output.
     */
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        // Build class attribute
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        // Build ID attribute
        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        // Build list item
        $output .= '<li' . $id . $class_names . '>';

        // Build anchor attributes
        $attributes = '';
        !empty($item->attr_title) and $attributes .= ' title="' . esc_attr($item->attr_title) . '"';
        !empty($item->target) and $attributes .= ' target="' . esc_attr($item->target) . '"';
        !empty($item->xfn) and $attributes .= ' rel="' . esc_attr($item->xfn) . '"';
        !empty($item->url) and $attributes .= ' href="' . esc_attr($item->url) . '"';

        // Add aria-current for current page
        if (in_array('current-menu-item', $classes) || in_array('current-page-ancestor', $classes)) {
            $attributes .= ' aria-current="page"';
        }

        // Build anchor tag
        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}
