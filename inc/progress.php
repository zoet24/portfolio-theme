<?php
/**
 * Register 'de_progress' custom post type
 */
function de_register_progress_cpt() {
    $labels = [
        'name'                  => 'Progress',
        'singular_name'         => 'Progress Item',
        'menu_name'             => 'Progress',
        'name_admin_bar'        => 'Progress Item',
        'add_new'               => 'Add New',
        'add_new_item'          => 'Add New Progress Item',
        'edit_item'             => 'Edit Progress Item',
        'new_item'              => 'New Progress Item',
        'view_item'             => 'View Progress Item',
        'all_items'             => 'All Progress',
        'search_items'          => 'Search Progress',
        'not_found'             => 'No progress items found.',
        'not_found_in_trash'    => 'No progress items found in Trash.',
    ];

    $args = [
        'labels'                => $labels,
        'public'                => true,
        'show_in_rest'          => true,
        'has_archive'           => true,
        'rewrite'               => ['slug' => 'progress'],
        'supports'              => ['title', 'editor', 'thumbnail'],
        'menu_icon'             => 'dashicons-chart-bar',
    ];

    register_post_type('de_progress', $args);
}
add_action('init', 'de_register_progress_cpt');

/**
 * Render callback for 'progress-grid' block
 */
function de_progress_grid_render_callback($attributes) {
    ob_start();

    $progress_items = new WP_Query([
        'post_type'      => 'de_progress',
        'posts_per_page' => -1,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ]);

    if ($progress_items->have_posts()) : ?>
        <div class="progress-grid">
            <?php while ($progress_items->have_posts()) : $progress_items->the_post();

                // Get ACF fields
                $mainImage = get_field('main-image');
                $customDate = get_field('custom-date');
                $customTitle = get_field('custom-title');
                $description = get_field('description');

                // Fallbacks
                $date = $customDate ? date_i18n(get_option('date_format'), strtotime($customDate)) : get_the_date();
                $title = $customTitle ? esc_html($customTitle) : get_the_title();
                ?>
                
                <div class="progress-card">
                    <a href="<?php the_permalink(); ?>" class="progress-link">
                        <?php if ($mainImage) : ?>
                            <div class="progress-photo">
                                <img src="<?php echo esc_url($mainImage['url']); ?>" alt="<?php echo esc_attr($mainImage['alt']); ?>" />
                            </div>
                        <?php endif; ?>

                        <div class="progress-content">
                            <p class="progress-date"><?php echo esc_html($date); ?></p>
                            <h3 class="progress-title"><?php echo esc_html($title); ?></h3>

                            <?php if ($description) : ?>
                                <p class="progress-description"><?php echo esc_html($description); ?></p>
                            <?php endif; ?>
                        </div>
                    </a>
                </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    <?php endif;

    return ob_get_clean();
}


/**
 * Register server-side rendered 'progress-grid' block
 */
function de_register_progress_grid_block() {
    if (function_exists('register_block_type')) {
        register_block_type('de/progress-grid', [
            'render_callback' => 'de_progress_grid_render_callback',
        ]);
    }
}
add_action('init', 'de_register_progress_grid_block');
