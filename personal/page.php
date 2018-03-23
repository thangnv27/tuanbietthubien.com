<?php
/**
 * The template for displaying all pages
 */
get_header();
?>

<div class="container">
    <div class="main">
        <?php
        // Breadcrumbs
        if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<div id="breadcrumbs">','</div>'); }
        ?>
        <div class="row">
            <div class="col-sm-9 col-xs-12">
                <?php
                // Start the Loop.
                while (have_posts()) : the_post();

                    // Include the page content template.
                    get_template_part('content', 'page');

                    // If comments are open or we have at least one comment, load up the comment template.
                    if (comments_open() || get_comments_number()) {
                        comments_template();
                    }
                endwhile;
                ?>
            </div>

            <?php get_sidebar(); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>