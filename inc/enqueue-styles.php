<?php
/**
 * Enqueue front-end styles and block scripts
 */

function de_theme_enqueue_styles() {
    $theme_dir = get_template_directory();
    $theme_uri = get_template_directory_uri();

    // Main Sass-compiled CSS
    if ( file_exists( $theme_dir . '/style.css' ) ) {
        wp_enqueue_style(
            'de-style',
            $theme_uri . '/style.css',
            [],
            filemtime( $theme_dir . '/style.css' )
        );
    }
}
add_action( 'wp_enqueue_scripts', 'de_theme_enqueue_styles' );

function de_register_blocks() {
    $theme_dir = get_template_directory();
    $theme_uri = get_template_directory_uri();

    // Block JS
    if ( file_exists( $theme_dir . '/build/index.js' ) ) {
        wp_enqueue_script(
            'de-blocks',
            $theme_uri . '/build/index.js',
            [ 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n' ],
            filemtime( $theme_dir . '/build/index.js' ),
            true
        );
    }

    // Block CSS
    if ( file_exists( $theme_dir . '/build/style-index.css' ) ) {
        wp_enqueue_style(
            'de-blocks-style',
            $theme_uri . '/build/style-index.css',
            [],
            filemtime( $theme_dir . '/build/style-index.css' )
        );
    }
}
add_action( 'enqueue_block_editor_assets', 'de_register_blocks' );
add_action( 'enqueue_block_assets', 'de_register_blocks' );
