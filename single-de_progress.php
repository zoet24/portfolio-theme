<?php
/**
 * Single template for individual Progress Items
 */

get_header();
?>

<main id="site-content" role="main">
    <article class="progress-item">
        <?php while (have_posts()) : the_post();

            $mainImage = get_field('main-image');
            $customDate = get_field('custom-date');
            $customTitle = get_field('custom-title');
            $description = get_field('description');

            $date = $customDate ? date_i18n(get_option('date_format'), strtotime($customDate)) : get_the_date();
            $title = $customTitle ? esc_html($customTitle) : get_the_title();
        ?>

            <div class="progress-header">
                <h1 class="progress-title"><?php echo esc_html($title); ?></h1>
                <p class="progress-date"><?php echo esc_html($date); ?></p>
            </div>

            <?php if ($mainImage) : ?>
                <div class="progress-photo">
                    <img src="<?php echo esc_url($mainImage['url']); ?>" alt="<?php echo esc_attr($mainImage['alt']); ?>" />
                </div>
            <?php endif; ?>

            <div class="progress-description">
                <?php the_content(); ?>
                <?php if ($description) : ?>
                    <p><?php echo esc_html($description); ?></p>
                <?php endif; ?>
            </div>

        <?php endwhile; ?>
    </article>
</main>

<?php get_footer(); ?>
