<?php
function portfolio_register_blocks() {
  wp_enqueue_script(
    'portfolio-blocks',
    get_template_directory_uri() . '/build/index.js',
    ['wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n'],
    filemtime(get_template_directory() . '/build/index.js')
  );

  wp_enqueue_style(
    'portfolio-blocks-style',
    get_template_directory_uri() . '/build/style-index.css',
    [],
    filemtime(get_template_directory() . '/build/style-index.css')
  );
}
add_action('enqueue_block_editor_assets', 'portfolio_register_blocks');
add_action('enqueue_block_assets', 'portfolio_register_blocks');
