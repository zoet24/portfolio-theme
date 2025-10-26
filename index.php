<?php get_header(); ?>

<main id="site-content" role="main">
  <?php
  if ( have_posts() ) :
    while ( have_posts() ) : the_post();
      the_content(); // 👉 this outputs your Gutenberg content (including React blocks)
    endwhile;
  else :
    echo '<p>No content found.</p>';
  endif;
  ?>
</main>

<?php get_footer(); ?>
