<?php
/*
Template Name: Home
*/
get_header();
?>


<?php
$images = get_posts([
  'post_type'      => 'attachment',
  'post_mime_type' => 'image',
  'posts_per_page' => -1,
  'tax_query'      => [
    [
      'taxonomy' => 'category',
      'field'    => 'slug',
      'terms'    => 'homepage-hero',
    ],
  ],
]);

if ( $images ) {
  $image = $images[ array_rand( $images ) ];
  $background_image = wp_get_attachment_image_url( $image->ID, 'full' );
}
?>

<main class="home-hero" style="background-image: url('<?php echo esc_url( $background_image ); ?>');">
  <div class="home-hero__overlay">
    <img
        src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/de-logo-white.png' ); ?>"
        alt="<?php bloginfo( 'name' ); ?>"
        class="home-hero__logo"
        />
  </div>
</main>

<?php
/*
Template Name: Home
*/
get_footer();
?>