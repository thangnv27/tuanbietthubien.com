<?php get_header(); ?>

<div class="container">
    <div class="main">
        <?php
        // Breadcrumbs
        if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<div id="breadcrumbs">','</div>'); }
        ?>
        <div class="row">
            <div class="col-sm-9 col-xs-12">
                <?php while (have_posts()) : the_post(); ?>
                <article id="product-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/Product">
                    <div class="product-view">
                        <div class="product-essential">
                            <div class="product-name show-small">
                                <h2 class="product-title"><?php the_title(); ?></h2>
                            </div>
                            <div class="product-img-box">
                                <?php
                                $images = rwmb_meta( 'product_images', array(
                                    'type' => 'image_advanced',
                                    'size' => '150x150'
                                ));
                                ?>
                                <div class="product-image product-image-zoom">
                                    <a rel="gallery1" class="fancybox" id="main-image" title="" href="<?php get_image_url(); ?>">
                                        <img id="image" src="<?php get_image_url(); ?>" alt="<?php the_title(); ?>" itemprop="image" />
                                    </a>
                                    <?php foreach ($images as $image) { ?>
                                    <a rel="gallery1" class="fancybox" href="<?php echo $image['full_url']; ?>"></a>
                                    <?php } ?>
                                </div>
                            </div><!--/.product-img-box-->

                            <div class="product-shop">
                                <div class="product-main-info">
                                    <div class="product-name hide-small">
                                        <h1 class="entry-title" itemprop="name"><?php the_title(); ?></h1>
                                    </div>
                                    <?php
                                    $code = get_post_meta(get_the_ID(), 'code', true);
                                    $old_price = floatval(get_post_meta(get_the_ID(), "old_price", true));
                                    $price = floatval(get_post_meta(get_the_ID(), "price", true));

                                    if(!empty($code)):
                                    ?>
                                    <p class="product-code">
                                        <strong><?php _e('Code', SHORT_NAME) ?>: </strong><span itemprop="sku"><?php echo $code ?></span>
                                    </p>
                                    <?php endif; ?>
                                    <span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                        <div class="price-box">
                                            <p class="special-price">
                                                <span class="price">
                                                    <span itemprop="price"><?php echo number_format($price, 0, ',', '.'); ?></span> đ
                                                </span>
                                                <?php if($old_price > 0): ?>
                                                <span class="old-price"><?php echo number_format($old_price, 0, ',', '.'); ?> đ</span>
                                                <?php endif; ?>
                                            </p>
                                        </div>
                                        <meta content="₫" itemprop="priceCurrency" />
                                        <link itemprop="availability" href="http://schema.org/InStock" />
                                    </span>
                                </div>

                                <div class="add-to-box">
                                    <div class="add-to-cart">
                                        <button type="button" title="<?php _e('Đặt mua', SHORT_NAME) ?>" class="button btn-cart"><?php _e('Đặt mua', SHORT_NAME) ?></button>
                                    </div>
                                </div>
                                <div class="rating"><?php if(function_exists('the_ratings')) { the_ratings(); } ?></div>
                                <div class="share-social-box">
                                    <div class="fb-like" data-href="<?php echo getCurrentRquestUrl() ?>" data-layout="button" data-action="like" data-show-faces="true" data-share="true" style="margin-right: 5px;float: left;margin-top: 3px;"></div>
                                    <g:plusone></g:plusone>
                                </div>
                                <div class="short-description"><?php echo get_short_content(get_the_content(), 300); ?></div>
                            </div><!--/.product-shop-->
                            <div class="clearfix"></div>
                        </div><!--/.product-essential-->

                        <h3 class="content-title"><?php _e('Giới thiệu sản phẩm', SHORT_NAME) ?></h3>
                        <div class="full-content">
                            <?php the_content(); ?>
                            <?php the_tags('<div class="mt15"><span class="tag-links"><i class="fa fa-tags"></i> ', ', ', '</span></div>'); ?>
                        </div><!--/.full-content-->
                        <?php
                        // If comments are open or we have at least one comment, load up the comment template.
                        if (comments_open() || get_comments_number()) {
                            comments_template();
                        }
                        ?>
                    </div><!--/.product-view-->
                </article><!-- #product-## -->

                <?php
                $taxonomy = 'product_cat';
                $terms = get_the_terms(get_the_ID(), $taxonomy);
                $terms_id = array();
                foreach ($terms as $term) {
                    array_push($terms_id, $term->term_id);
                }
                $loop = new WP_Query(array(
                    'post_type' => 'product',
                    'tax_query' => array(
                        array(
                            'taxonomy' => $taxonomy,
                            'field' => 'id',
                            'terms' => $terms_id,
                        )
                    ),
                    'post__not_in' => array(get_the_ID()),
                    'showposts' => 3,
                ));
                if($loop->post_count > 0):
                ?>
                <div class="related-posts">
                    <h3 class="widget-title"><?php _e('Sản phẩm liên quan', SHORT_NAME) ?></h3>
                    <div class="product-grid-container">
                        <div class="row">
                            <?php
                            while ($loop->have_posts()) : $loop->the_post();
                                get_template_part('template/product-item');
                            endwhile;
                            wp_reset_query();
                            ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php endwhile; ?>
            </div>

            <?php get_sidebar(); ?>
        </div>
    </div>
</div>

<div class="frm-dathang" style="display: none">
    <div class="frm-content">
        <span class="close closex"></span>
        <form action="" method="post">
            <input type="hidden" name="action" value="sendOrder" />
            <input type="hidden" name="title" value="<?php the_title() ?>" />
            <div class="form-group">
                <label><?php _e('Sản phẩm', SHORT_NAME) ?>:</label>
                <input type="text" value="<?php the_title() ?>" class="form-control" disabled />
            </div>
            <div class="form-group">
                <label for="quantity"><?php _e('Số lượng', SHORT_NAME) ?>:</label>
                <input type="number" value="1" min="1" max="100" class="form-control" name="quantity" id="quantity" required />
            </div>
            <div class="form-group">
                <label for="fullname"><?php _e('Họ và tên*', SHORT_NAME) ?>:</label>
                <input type="text" class="form-control" name="fullname" id="fullname" placeholder="<?php _e('Họ tên đầy đủ của bạn', SHORT_NAME) ?>" required />
            </div>
            <div class="form-group">
                <label for="email"><?php _e('Địa chỉ Email*', SHORT_NAME) ?>:</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="<?php _e('Địa chỉ Email', SHORT_NAME) ?>" required />
            </div>
            <div class="form-group">
                <label for="phone"><?php _e('Số điện thoại*', SHORT_NAME) ?>:</label>
                <input type="text" class="form-control" name="phone" id="phone" placeholder="<?php _e('Số điện thoại', SHORT_NAME) ?>" required />
            </div>
            <div class="form-group">
                <label for="address"><?php _e('Địa chỉ*', SHORT_NAME) ?>:</label>
                <input type="text" class="form-control" name="address" id="address" placeholder="<?php _e('Địa chỉ nhận hàng', SHORT_NAME) ?>" required />
            </div>
            <button type="submit" class="btn btn-primary"><?php _e('Đặt hàng', SHORT_NAME) ?></button>
        </form>
    </div>
</div>

<?php get_footer(); ?>