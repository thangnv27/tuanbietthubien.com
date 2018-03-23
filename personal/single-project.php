<?php get_header(); ?>

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

                    /*
                     * Include the post format-specific template for the content. If you want to
                     * use this in a child theme, then include a file called called content-___.php
                     * (where ___ is the post format) and that will be used instead.
                     */
                    get_template_part('content', 'project');

                    // Related posts
                    $terms = get_the_category();
                    $terms_id = array();
                    foreach ($terms as $term) {
                        array_push($terms_id, $term->term_id);
                    }
                    $loop = new WP_Query(array(
                        'post_type' => 'project',
                        'post__not_in' => array(get_the_ID()),
                        'showposts' => 2,
                    ));
                    if($loop->post_count > 0):
                ?>
                    <div class="related-projects">
                        <h2 class="title"><?php _e('Dự án liên quan', SHORT_NAME) ?></h2>
                        <div class="related-container">
                            <?php
                            while ($loop->have_posts()) : $loop->the_post();
                                $date_format = get_option( 'date_format' );
                                $time_format = get_option( 'time_format' );
                            ?>
                            <div class="item" itemscope="" itemtype="http://schema.org/Article">
                                <a class="thumbnail" href="<?php the_permalink() ?>" title="<?php the_title() ?>" rel="bookmark" onclick="_gaq.push(['_trackEvent', 'Xem tin', 'Xem tin', '<?php the_title(); ?>']);">
                                    <img src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title(); ?>" itemprop="image" onError="this.src=no_image_src" />
                                </a>
                                <h3><a href="<?php the_permalink() ?>" title="<?php the_title() ?>" rel="bookmark"><?php the_title() ?></a></h3>
                            </div>
                            <?php
                            endwhile;
                            wp_reset_query();
                            ?>
                        </div>
                    </div>
                <?php
                    endif;
                endwhile;
                ?>
            </div>

            <?php get_sidebar(); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>