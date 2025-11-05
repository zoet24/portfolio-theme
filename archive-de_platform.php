<?php
get_header(); ?>

<main id="primary" class="site-main">
    <section class="platform-archive">
        <?php
        $platform_items = new WP_Query([
            'post_type'      => 'de_platform',
            'posts_per_page' => -1,
            'orderby'        => 'date',
            'order'          => 'DESC',
        ]);

        if ($platform_items->have_posts()) : ?>
            <div class="platform-grid">
                <?php while ($platform_items->have_posts()) : $platform_items->the_post(); ?>
                    <?php $mainImage = get_field('main-image'); ?>

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
        <?php else : ?>
            <p>No platform items found.</p>
        <?php endif; ?>
    </section>
</main>

<?php get_footer(); ?>
