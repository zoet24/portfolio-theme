<?php
/**
 * Register main navigation menu
 */
function de_register_menus() {
    register_nav_menus([
        'primary' => __('Primary Menu', 'design-everything'),
    ]);
}
add_action('init', 'de_register_menus');