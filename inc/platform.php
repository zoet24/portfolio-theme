<?php
/**
 * Register 'de_platform' custom post type
 */
function de_register_platform_cpt() {
    $labels = [
        'name'                  => 'Platform',
        'singular_name'         => 'Platform Item',
        'menu_name'             => 'Platform',
        'name_admin_bar'        => 'Platform Item',
        'add_new'               => 'Add New',
        'add_new_item'          => 'Add New Platform Item',
        'edit_item'             => 'Edit Platform Item',
        'new_item'              => 'New Platform Item',
        'view_item'             => 'View Platform Item',
        'all_items'             => 'All Platform',
        'search_items'          => 'Search Platform',
        'not_found'             => 'No platform items found.',
        'not_found_in_trash'    => 'No platform items found in Trash.',
    ];

    $args = [
        'labels'                => $labels,
        'public'                => true,
        'show_in_rest'          => true,
        'has_archive'           => true,
        'rewrite'               => ['slug' => 'platform'],
        'supports'              => ['title', 'editor', 'thumbnail'],
        'menu_icon'             => 'dashicons-format-chat',
    ];

    register_post_type('de_platform', $args);
}
add_action('init', 'de_register_platform_cpt');

/**
 * Render callback for 'platform-grid' block
 */
function de_platform_grid_render_callback($attributes) {
    ob_start();

    $platform_items = new WP_Query([
        'post_type'      => 'de_platform',
        'posts_per_page' => -1,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ]);

    if ($platform_items->have_posts()) : ?>
        <div class="platform-grid">
            <?php while ($platform_items->have_posts()) : $platform_items->the_post();

                // Get ACF fields
                $mainImage = get_field('main-image');
                ?>
                <div class="platform-card">
                    <a href="<?php the_permalink(); ?>" class="platform-link">
                        <?php if ($mainImage) : ?>
                            <div class="platform-photo">
                                <img src="<?php echo esc_url($mainImage['url']); ?>" alt="<?php echo esc_attr($mainImage['alt']); ?>" />
                            </div>
                        <?php endif; ?>

                        <h3 class="platform-title"><?php the_title(); ?></h3>
                    </a>
                </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    <?php endif;

    return ob_get_clean();
}


/**
 * Register server-side rendered 'platform-grid' block
 */
function de_register_platform_grid_block() {
    if (function_exists('register_block_type')) {
        register_block_type('de/platform-grid', [
            'render_callback' => 'de_platform_grid_render_callback',
        ]);
    }
}
add_action('init', 'de_register_platform_grid_block');
