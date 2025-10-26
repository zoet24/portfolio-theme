<?php
/**
 * Template Name: People Page
 *
 * Displays all 'de_person' posts in a grid.
 */

get_header();
?>

<main id="site-content" role="main">

    <header class="page-header">
        <h1 class="page-title"><?php the_title(); ?></h1>
    </header>

    <div class="page-content">
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
    </div>

</main>

<?php get_footer(); ?>
