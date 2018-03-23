<?php 
/*
  Template Name: Contact
*/
get_header();
?>

<section class="contact-page">
    <div class="container main">
        <?php
        // Breadcrumbs
        if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<div id="breadcrumbs">','</div>'); }
        ?>
        <div class="row mb30">
            <div class="col-sm-7">
                <div class="img"><img src="<?php get_image_url() ?>" alt="<?php the_title() ?>" /></div>
                <div class="info">
                    <?php
                    // Start the Loop.
                    while (have_posts()) : the_post();
                        the_content();
                    endwhile;
                    ?>
                </div>
            </div>
            <div class="col-sm-5 consultant">
                <?php echo do_shortcode(stripslashes_deep(get_option(SHORT_NAME . "_frmReg"))) ?>
            </div>
        </div>
        <div class="maps">
            <?php echo stripslashes_deep(get_option(SHORT_NAME . "_gmaps")) ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>