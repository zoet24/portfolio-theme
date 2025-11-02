<?php
/**
 * Template Name: People Page
 *
 * Displays all 'de_person' posts in a grid.
 */

get_header();
?>

<main id="site-content" role="main">
    <section class="people-page">
        <?php
        // Output the page content (optional)
        if ( have_posts() ) {
            while ( have_posts() ) {
                the_post();
                the_content();
            }
        }

        // Display the people grid
        if ( function_exists('de_people_grid_render_callback') ) {
            echo de_people_grid_render_callback([]);
        }
        ?>
    </section>

</main>

<?php get_footer(); ?>
