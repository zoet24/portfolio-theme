<?php
get_header(); ?>

<main id="primary" class="site-main">
    <div class="container content-narrow">
        <?php while (have_posts()) : the_post(); ?>
            <article <?php post_class('platform-single'); ?>>
                <h1 class="platform-title"><?php the_title(); ?></h1>

                <?php $mainImage = get_field('main-image'); ?>
                <?php if ($mainImage) : ?>
                    <div class="platform-main-image">
                        <img src="<?php echo esc_url($mainImage['url']); ?>" alt="<?php echo esc_attr($mainImage['alt']); ?>" />
                    </div>
                <?php endif; ?>

                <div class="platform-content">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php endwhile; ?>
    </div>
</main>

<?php get_footer(); ?>
