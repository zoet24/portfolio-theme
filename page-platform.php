<?php
/**
 * Template Name: Platform Page
 *
 * This template displays the Platform grid.
 */

get_header(); ?>

<main id="primary" class="site-main">

    <section class="platform-page">
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
