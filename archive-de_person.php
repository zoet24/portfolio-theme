<?php
get_header();
?>

<main id="site-content" role="main">
    <div class="container">
        <section class="people-page">
            <?php
            if ( function_exists('de_people_grid_render_callback') ) {
                echo de_people_grid_render_callback([]);
            }
            ?>
        </section>
    </div>
</main>

<?php
get_footer();
