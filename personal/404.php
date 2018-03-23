<?php get_header(); ?>

<div class="container">
    <div class="main">
        <?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<div id="breadcrumbs">','</div>'); } ?>

        <div class="t_center" style="padding-bottom: 100px">
            <h1 class="mb50"><?php _e('Trang không tồn tại!', SHORT_NAME) ?></h1>
            <?php get_search_form(); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>