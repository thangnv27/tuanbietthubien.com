<?php 
/*
  Template Name: Home 2
*/
get_header('home2');
?>

<?php
$slider_id = intval(get_option('home_slider'));
if ($slider_id > 0):
?>
<!--BEGIN SLIDER-->
<section id="slider">
    <?php echo do_shortcode('[layerslider id="' . $slider_id . '"]'); ?>
</section>
<!--END SLIDER-->
<?php endif; ?>

<section class="popular-projects">
    <div class="container">
        <h2><?php _e('Dự án nổi bật', SHORT_NAME) ?></h2>
        <div class="row">
            <?php
            $projects = new WP_Query(array(
                'post_type' => 'project',
                'showposts' => 4,
            ));
            while ($projects->have_posts()) : $projects->the_post();
            ?>
            <div class="col-md-3 col-sm-6">
                <div class="item">
                    <a href="<?php the_permalink() ?>" title="<?php the_title() ?>" rel="bookmark">
                        <?php the_post_thumbnail('360x220') ?>
                    </a>
                    <h3>
                        <a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title(); ?></a>
                    </h3>
                </div>
            </div>
            <?php
            endwhile;
            wp_reset_query();
            ?>
            <div class="clearfix"></div>
        </div>
    </div>
</section>

<section class="support">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="search">
                    <h3><?php _e('Tìm kiếm', SHORT_NAME) ?></h3>
                    <form action="<?php bloginfo('siteurl') ?>" method="get">
                        <?php wp_dropdown_categories( array(
                            'show_option_all' => __('Loại sản phẩm', SHORT_NAME),
                            'taxonomy' => 'product_cat',
                            'hide_empty' => 0,
                            'hierarchical' => true,
                            'name' => 'pcat',
                            'selected' => intval(getRequest('pcat')),
                            'class' => 'form-control',
                        ) ); ?>
                        <?php wp_dropdown_categories( array(
                            'show_option_all' => __('Giá sản phẩm', SHORT_NAME),
                            'taxonomy' => 'product_price',
                            'hide_empty' => 0,
                            'hierarchical' => true,
                            'name' => 'price',
                            'selected' => intval(getRequest('price')),
                            'class' => 'form-control',
                        ) ); ?>
                        <?php wp_dropdown_categories( array(
                            'show_option_all' => __('Địa điểm', SHORT_NAME),
                            'taxonomy' => 'product_location',
                            'hide_empty' => 0,
                            'hierarchical' => true,
                            'name' => 'location',
                            'selected' => intval(getRequest('location')),
                            'class' => 'form-control',
                        ) ); ?>
                        <input type="hidden" name="s" value="" />
                        <input type="submit" value="<?php _e('Tìm kiếm', SHORT_NAME) ?>" />
                    </form>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="feedbacks2">
                    <h3><?php _e('Cảm nhận khách hàng', SHORT_NAME) ?></h3>
                    <div class="flexslider" style="display: none">
                        <ul class="slides">
                        <?php
                        $feedbacks = new WP_Query(array(
                            'post_type' => 'feedback',
                            'showposts' => -1,
                        ));
                        while ($feedbacks->have_posts()) : $feedbacks->the_post();
                        ?>
                        <li>
                            <img src="<?php echo get_post_thumbnail_url(get_the_ID(), 'thumbnail') ?>" alt="<?php the_title() ?>" />
                            <p class="name"><?php the_title() ?></p>
                            <?php the_content() ?>
                        </li>
                        <?php
                        endwhile;
                        wp_reset_query();
                        ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="tuvan">
                    <h3><?php _e('Đăng ký tư vấn', SHORT_NAME) ?></h3>
                    <?php echo do_shortcode(stripslashes_deep(get_option(SHORT_NAME . "_frmReg2"))) ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="latest-posts">
    <div class="container">
        <h2><?php _e('Tin tức & Sự kiện', SHORT_NAME) ?></h2>
        <div class="row">
            <?php
            $date_format = get_option( 'date_format' );
            $time_format = get_option( 'time_format' );
            $latest_posts = new WP_Query(array(
                'post_type' => 'post',
                'showposts' => 4,
            ));
            while ($latest_posts->have_posts()) : $latest_posts->the_post();
            ?>
            <div class="col-md-3 col-sm-6">
                <div class="item">
                    <a href="<?php the_permalink() ?>" title="<?php the_title() ?>" rel="bookmark">
                        <?php the_post_thumbnail('360x220') ?>
                    </a>
                    <h3>
                        <a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title(); ?></a>
                    </h3>
                    <div class="entry-meta">
                        <span><?php the_time($time_format); ?></span> | 
                        <span itemprop="datePublished"><?php echo date($date_format, strtotime($post->post_date)); //the_date($date_format); ?></span>
                    </div>
                </div>
            </div>
            <?php
            endwhile;
            wp_reset_query();
            ?>
            <div class="clearfix"></div>
        </div>
    </div>
</section>

<section class="slogan">
    <div class="container">
        <?php echo wpautop(stripslashes_deep(get_option(SHORT_NAME . "_slogan"))) ?>
    </div>
</section>

<?php get_footer(); ?>