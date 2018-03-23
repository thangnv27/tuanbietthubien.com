<?php 
/*
  Template Name: Products
*/
get_header();
?>

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
                            $locations = get_categories(array(
                                'title_li' => '',
                                'show_option_none' => '',
                                'taxonomy' => 'product_location',
                                'hide_empty' => 0,
                                'show_count' => 1,
                            ));
                            foreach ($locations as $location):
                                ?>
                                <li><a href="<?php echo get_page_link($term); ?>?location=<?php echo $location->term_id; ?>"><?php echo $location->name; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="product-filter">
                    <h2>Giá bán</h2>
                    <div class="content">
                        <ul>
                            <?php
                            $prices = get_categories(array(
                                'title_li' => '',
                                'show_option_none' => '',
                                'taxonomy' => 'product_price',
                                'hide_empty' => 0,
                                'show_count' => 1,
                            ));
                            foreach ($prices as $price):
                                ?>
                                <li><a href="<?php echo get_page_link($term); ?>?price=<?php echo $price->term_id; ?>"><?php echo $price->name; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-sm-12 col-xs-12">
                <?php while (have_posts()) : the_post(); ?>
                <h1><?php the_title(); ?></h1>
                <div class="product-grid-container">
                    <div class="row">
                        <?php
                        $location = intval(getRequest('location'));
                        $price = intval(getRequest('price'));
                        $tax_query = array(
                            'relation' => 'AND',
                        );
                        if($location > 0){
                            array_push($tax_query, array(
                                'taxonomy' => 'product_location',
                                'field' => 'id',
                                'terms' => $location,
                            ));
                        }
                        if($price > 0){
                            array_push($tax_query, array(
                                'taxonomy' => 'product_price',
                                'field' => 'id',
                                'terms' => $price,
                            ));
                        }
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                        $args = array(
                            'post_type' => 'product',
                            'posts_per_page' => 9,
                            'paged' => $paged,
                        );
                        if(!empty($location) or !empty($price)){
                            $args['tax_query'] = $tax_query;
                        }
                        $loop = new WP_Query($args);
                        while ($loop->have_posts()) : $loop->the_post();
                            get_template_part('template/product-item');
                        endwhile;
                        wp_reset_query();
                        ?>
                    </div>
                </div>
                <?php getpagenavi(array( 'query' => $loop )); ?>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>