<?php 
/*
  Template Name: Home
*/
get_header();

$slider_id = intval(get_option('home_slider'));
if ($slider_id > 0):
?>
<!--BEGIN SLIDER-->
<section id="slider">
    <?php echo do_shortcode('[layerslider id="' . $slider_id . '"]'); ?>
</section>
<!--END SLIDER-->
<?php endif; ?>

<section>
    <div class="container">
        <div class="row pdt30">
            <div class="col-md-4 hidden-sm hidden-xs">
                <div class="product-cats">
                    <h3>Danh mục sản phẩm</h3>
                    <ul>
                    <?php 
                    wp_list_categories(array(
                        'title_li' => '',
                        'hide_empty' => 0,
                        'show_option_none' => '',
                        'taxonomy' => 'product_cat',
                    ));
                    ?>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb15"><?php echo stripslashes_deep(get_option(SHORT_NAME . "_home_ad1")) ?></div>
            <div class="col-md-4 col-sm-6 mb15"><?php echo stripslashes_deep(get_option(SHORT_NAME . "_home_ad2")) ?></div>
        </div>
        <div class="row latest-posts">
            <?php
            $latest_posts = new WP_Query(array(
                'post_type' => 'post',
                'showposts' => 3,
            ));
            while ($latest_posts->have_posts()) : $latest_posts->the_post();
            ?>
            <div class="col-sm-4">
                <div class="item">
                    <a href="<?php the_permalink() ?>" title="<?php the_title() ?>" rel="bookmark">
                        <?php the_post_thumbnail('360x220') ?>
                    </a>
                    <h3>
                        <a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title(); ?></a>
                    </h3>
                    <a href="<?php the_title() ?>" title="Xem thêm" class="btn btn-primary">Xem thêm</a>
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

<section class="services">
    <?php
    $service = get_post(get_option(SHORT_NAME . "_homeServiceID"));
    echo do_shortcode($service->post_content);
    ?>
</section>

<section class="popular-products">
    <div class="container">
        <h2>Sản phẩm nổi bật</h2>
        <div class="row">
            <?php
            $popular_products = new WP_Query(array(
                'post_type' => 'product',
                'showposts' => 8,
                'meta_key' => 'is_most',
                'meta_value' => '1',
            ));
            while ($popular_products->have_posts()) : $popular_products->the_post();
            ?>
            <div class="item_wrap">
                <div class="item">
                    <a href="<?php the_permalink() ?>" title="<?php the_title() ?>" rel="bookmark">
                        <?php the_post_thumbnail('600x600') ?>
                    </a>
                    <h3>
                        <a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title(); ?></a>
                    </h3>
                    <p class="old-price"><?php echo number_format(get_post_meta(get_the_ID(), 'old_price', true), 0, ',', '.') ?> VNĐ</p>
                    <p class="price"><?php echo number_format(get_post_meta(get_the_ID(), 'price', true)) ?> VNĐ</p>
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

<section class="feedbacks">
    <div class="container">
        <h2>Cảm nhận của Khách hàng & Đối tác</h2>
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
                <img src="<?php echo get_post_thumbnail_url(get_the_ID()) ?>" alt="<?php the_title() ?>" />
                <p class="name"><?php the_title() ?></p>
                <p><?php the_content() ?></p>
            </li>
            <?php
            endwhile;
            wp_reset_query();
            ?>
            </ul>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row consultant">
            <div class="col-md-8 col-sm-12">
                <?php
                $consultant_catID = get_option(SHORT_NAME . "_ConsultantID");
                $consultant_cat = get_category($consultant_catID);
                $consultant_posts = new WP_Query(array(
                    'post_type' => 'post',
                    'showposts' => 3,
                    'cat' => $consultant_catID,
                ));
                ?>
                <h2><?php echo $consultant_cat->name ?></h2>
                <?php while ($consultant_posts->have_posts()) : $consultant_posts->the_post(); ?>
                <div class="item">
                    <div class="col-sm-3 thumbnail">
                        <a href="<?php the_permalink() ?>" title="<?php the_title() ?>" rel="bookmark">
                            <?php the_post_thumbnail('360x220') ?>
                        </a>
                    </div>
                    <div class="col-sm-9 meta">
                        <h3><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title(); ?></a></h3>
                        <p class="description"><?php the_excerpt(); ?></p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <?php
                endwhile;
                wp_reset_query();
                ?>
            </div>
            <div class="col-md-4 col-sm-12"><?php echo do_shortcode(stripslashes_deep(get_option(SHORT_NAME . "_frmReg"))) ?></div>
            <div class="clearfix"></div>
        </div>
    </div>
</section>

<section class="partners">
    <div class="container">
        <h2>Đối tác tiêu biểu</h2>
        <div class="flexslider" style="display: none">
            <ul class="slides">
            <?php
            $logos = new WP_Query(array(
                'post_type' => 'logo',
                'showposts' => -1,
                'meta_key' => 'order_item',
                'orderby' => 'meta_value_num',
                'order' => 'ASC',
            ));
            while ($logos->have_posts()) : $logos->the_post();
            ?>
            <li>
                <a title="<?php the_title(); ?>" href="<?php echo get_post_meta(get_the_ID(), 'logo_link', true); ?>" rel="external nofollow" target="_blank">
                    <img alt="<?php the_title() ?>" src="<?php echo get_post_meta(get_the_ID(), 'logo_img', true) ?>" />
                </a>
            </li>
            <?php
            endwhile;
            wp_reset_query();
            ?>
            </ul>
        </div>
    </div>
</section>

<?php get_footer(); ?>