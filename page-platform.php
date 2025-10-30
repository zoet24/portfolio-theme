<?php
/**
 * Template Name: Platform Page
 *
 * This template displays the Platform grid.
 */

get_header(); ?>

<main id="primary" class="site-main">

    <section class="platform-page">
        <h1 class="platform-page-title"><?php the_title(); ?></h1>

        <?php
        // Display the platform grid block
        if ( function_exists( 'do_blocks' ) ) {
            echo do_blocks( '<!-- wp:de/platform-grid /-->' );
        }
        ?>
    </section>

</main><!-- #primary -->

<?php
get_footer();
