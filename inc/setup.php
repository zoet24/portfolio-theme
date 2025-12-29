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

// Enable categories for media attachments
function enable_media_categories() {
    register_taxonomy_for_object_type( 'category', 'attachment' );
  }
  add_action( 'init', 'enable_media_categories' );