<?php
/**
 * Enqueue front-end theme styles (compiled from Sass)
 */
function portfolio_theme_enqueue_styles() {
    $theme_dir = get_template_directory();
    $theme_uri = get_template_directory_uri();

    // Enqueue main Sass-compiled CSS
    if ( file_exists( $theme_dir . '/style.css' ) ) {
        wp_enqueue_style(
            'portfolio-style',
            $theme_uri . '/style.css',
            [],
            filemtime( $theme_dir . '/style.css' )
        );
    }
}
add_action( 'wp_enqueue_scripts', 'portfolio_theme_enqueue_styles' );

/**
 * Enqueue React block scripts and block styles (for both editor + front-end)
 */
function portfolio_register_blocks() {
    $theme_dir = get_template_directory();
    $theme_uri = get_template_directory_uri();

    // Block JS
    if ( file_exists( $theme_dir . '/build/index.js' ) ) {
        wp_enqueue_script(
            'portfolio-blocks',
            $theme_uri . '/build/index.js',
            [ 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n' ],
            filemtime( $theme_dir . '/build/index.js' ),
            true
        );
    }

    // Block CSS (from wp-scripts build)
    if ( file_exists( $theme_dir . '/build/style-index.css' ) ) {
        wp_enqueue_style(
            'portfolio-blocks-style',
            $theme_uri . '/build/style-index.css',
            [],
            filemtime( $theme_dir . '/build/style-index.css' )
        );
    }
}
add_action( 'enqueue_block_editor_assets', 'portfolio_register_blocks' );
add_action( 'enqueue_block_assets', 'portfolio_register_blocks' );
