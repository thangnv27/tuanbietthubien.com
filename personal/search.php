<?php get_header(); ?>

<div class="container">
    <div class="main">
        <?php
        // Breadcrumbs
        if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<div id="breadcrumbs">','</div>'); }
        ?>
        <div class="row pdb30">
            <div class="col-sm-9 col-xs-12">
                <h1 class="archive-title">
                    <?php // printf(__('Kết quả tìm kiếm cho: "%s"', SHORT_NAME), get_search_query()); ?>
                    <?php _e('Kết quả tìm kiếm', SHORT_NAME) ?>
                </h1>
                <div class="product-grid-container">
                    <div class="row">
                        <?php
                        while (have_posts()) : the_post();
                            get_template_part('template/product-item');
                        endwhile;
                        ?>
                    </div>
                </div>

                <?php getpagenavi(); ?>
            </div>

            <?php get_sidebar(); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>