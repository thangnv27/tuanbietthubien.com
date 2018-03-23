<?php get_header(); ?>

<section class="product-cat">
    <div class="container main">
        <?php
        // Breadcrumbs
        if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<div id="breadcrumbs">','</div>'); }
        ?>
        <div class="row">
            <div class="col-md-3 hidden-sm hidden-xs" style="position: inherit">
                <div class="product-cats">
                    <h3>Danh mục sản phẩm</h3>
                    <ul>
                    <?php
                    $product_category = 'product_cat';
                    $term = get_queried_object();
                    wp_list_categories(array(
                        'title_li' => '',
                        'hide_empty' => 0,
                        'show_option_none' => '',
                        'taxonomy' => 'product_cat',
                    ));
                    ?>
                    </ul>
                </div>
                <div class="product-filter">
                    <h2>Địa điểm</h2>
                    <div class="content">
                        <ul>
                            <?php
                            $locations = get_terms( array(
                                'taxonomy' => 'product_location',
                                'hide_empty' => false,
                            ) );
                            foreach ($locations as $location):
                                ?>
                                <li><a href="<?php echo get_term_link($term, $product_category); ?>?location=<?php echo $location->term_id; ?>"><?php echo $location->name; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="product-filter">
                    <h2>Giá bán</h2>
                    <div class="content">
                        <ul>
                            <?php
                            $prices = get_terms( array(
                                'taxonomy' => 'product_price',
                                'hide_empty' => false,
                            ) );
                            foreach ($prices as $price):
                                ?>
                                <li><a href="<?php echo get_term_link($term, $product_category); ?>?price=<?php echo $price->term_id; ?>"><?php echo $price->name; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-sm-12 col-xs-12">
                <h1><?php single_cat_title(); ?></h1>
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
        </div>
    </div>
</section>

<?php get_footer(); ?>