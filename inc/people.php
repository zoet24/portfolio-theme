<?php
/**
 * Register 'de_person' CPT and server-side rendered People Grid block
 */

// Register 'de_person' CPT
function de_register_person_cpt() {
    $labels = [
        'name'               => 'People',
        'singular_name'      => 'Person',
        'menu_name'          => 'People',
        'name_admin_bar'     => 'Person',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Person',
        'edit_item'          => 'Edit Person',
        'new_item'           => 'New Person',
        'view_item'          => 'View Person',
        'all_items'          => 'All People',
        'search_items'       => 'Search People',
        'not_found'          => 'No people found.',
        'not_found_in_trash' => 'No people found in Trash.'
    ];

    $args = [
        'labels'             => $labels,
        'public'             => true,
        'show_in_rest'       => true,
        'has_archive'        => true,
        'rewrite'            => ['slug' => 'people'],
        'supports'           => ['title', 'editor', 'thumbnail'],
        'menu_icon'          => 'dashicons-admin-users',
    ];

    register_post_type('de_person', $args);
}
add_action('init', 'de_register_person_cpt');

// Server-side render callback for People Grid
function de_people_grid_render_callback($attributes) {
    ob_start();
    $people = new WP_Query([
        'post_type' => 'de_person',
        'posts_per_page' => -1,
    ]);

    if ($people->have_posts()) : ?>
        <div class="people-grid">
            <?php while ($people->have_posts()) : $people->the_post(); 
                $image = get_field('image');
                $bio = get_field('bio');
                $category = get_field('category');
                $contact1 = get_field('contact-1');
                $contact2 = get_field('contact-2');
            ?>
                <div class="person-card">
                    <?php if ($image) : ?>
                        <div class="person-photo">
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                        </div>
                    <?php endif; ?>
                    <h3 class="person-name"><?php the_title(); ?></h3>
                    <?php if ($bio) : ?>
                        <p class="person-bio"><?php echo esc_html($bio); ?></p>
                    <?php endif; ?>
                    <?php 
                    $category = get_field('category');
                    if ($category) : 
                        if (is_array($category)) {
                            // Join multiple categories with commas
                            $category_list = implode(', ', array_map('esc_html', $category));
                        } else {
                            $category_list = esc_html($category);
                        }
                    ?>
                        <p class="person-category"><?php echo $category_list; ?></p>
                    <?php endif; ?>
                    <p class="person-links">
                        <?php if ($contact1 && is_array($contact1)) : ?>
                            <a href="<?php echo esc_url($contact1['url']); ?>" target="<?php echo esc_attr($contact1['target'] ?? '_blank'); ?>">
                                <?php echo esc_html($contact1['title'] ?? 'Contact 1'); ?>
                            </a>
                        <?php endif; ?>
                        <?php if ($contact2 && is_array($contact2)) : ?>
                            <a href="<?php echo esc_url($contact2['url']); ?>" target="<?php echo esc_attr($contact2['target'] ?? '_blank'); ?>">
                                <?php echo esc_html($contact2['title'] ?? 'Contact 2'); ?>
                            </a>
                        <?php endif; ?>
                    </p>
                </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    <?php endif;

    return ob_get_clean();
}



// Register server-side rendered block
function de_register_people_grid_block() {
    if ( function_exists('register_block_type') ) {
        register_block_type('de/people-grid', [
            'render_callback' => 'de_people_grid_render_callback',
        ]);
    }
}
add_action('init', 'de_register_people_grid_block');
