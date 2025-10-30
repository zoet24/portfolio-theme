<?php
/**
 * Template Name: Progress Page
 *
 * This template displays the Progress grid.
 */

get_header(); ?>

<main id="primary" class="site-main">

    <section class="progress-page">
        <h1 class="progress-page-title"><?php the_title(); ?></h1>

        <?php
        // Display the progress grid block
        if ( function_exists( 'do_blocks' ) ) {
            echo do_blocks( '<!-- wp:de/progress-grid /-->' );
        }
        ?>
    </section>

</main><!-- #primary -->

<?php
get_footer();
