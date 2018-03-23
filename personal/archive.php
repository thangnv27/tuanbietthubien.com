<?php get_header(); ?>

<div class="container">
    <div class="main">
        <?php
        // Breadcrumbs
        if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<div id="breadcrumbs">','</div>'); }
        ?>
        <div class="row">
            <div class="col-sm-9 col-xs-12">
                <h1 class="archive-title"><?php echo single_cat_title() ?></h1>
                <?php
                $cat_description = category_description();
                if(!empty($cat_description)):
                ?>
                <div class="archive-description"><?php echo $cat_description; ?></div>
                <?php endif; ?>
                <div class="bloglist">
                    <?php
                    if(have_posts()):
                        while (have_posts()) : the_post();
                            get_template_part('content', get_post_format());
                        endwhile;
                    else:
                    ?>
                    <p><?php _e('Không có bài viết nào được tìm thấy trong chuyên mục này.', SHORT_NAME) ?></p>
                    <?php get_search_form(); ?>
                    <?php endif; ?>
                </div>

                <?php getpagenavi(); ?>
            </div>

            <?php get_sidebar(); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>