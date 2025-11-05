<?php
get_header();

while ( have_posts() ) : the_post(); ?>

<main id="primary" class="site-main single-progress">

  <article <?php post_class(); ?>>
    <header class="progress-header">
      <?php
      $mainImage = get_field('main-image');
      $customDate = get_field('custom-date');
      $customTitle = get_field('custom-title');
      $date = $customDate ? date_i18n(get_option('date_format'), strtotime($customDate)) : get_the_date();
      $title = $customTitle ? esc_html($customTitle) : get_the_title();
      ?>

      <?php if ($mainImage) : ?>
        <div class="progress-hero">
          <img src="<?php echo esc_url($mainImage['url']); ?>" alt="<?php echo esc_attr($mainImage['alt']); ?>">
        </div>
      <?php endif; ?>

      <h1 class="progress-title"><?php echo $title; ?></h1>
      <p class="progress-date"><?php echo esc_html($date); ?></p>
    </header>

    <div class="progress-body">
      <?php the_content(); // Displays Gutenberg blocks ?>
    </div>
  </article>

</main>

<?php endwhile;
get_footer();
