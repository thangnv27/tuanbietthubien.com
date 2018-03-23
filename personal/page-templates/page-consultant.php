<?php 
/*
  Template Name: Consultant
*/
get_header();
?>

<section>
    <div class="container pdt20">
        <div class="row consultant">
            <div class="col-md-8 col-sm-12">
                <?php
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $consultant_catID = get_option(SHORT_NAME . "_ConsultantID");
                $consultant_cat = get_category($consultant_catID);
                $consultant_posts = new WP_Query(array(
                    'post_type' => 'post',
                    'cat' => $consultant_catID,
                    'paged' => $paged,
                ));
                ?>
                <h1><?php echo $consultant_cat->name ?></h1>
                <?php while ($consultant_posts->have_posts()) : $consultant_posts->the_post(); ?>
                <div class="item" itemscope="" itemtype="http://schema.org/Article">
                    <div class="col-sm-3 thumbnail">
                        <a href="<?php the_permalink() ?>" title="<?php the_title() ?>" rel="bookmark" onclick="_gaq.push(['_trackEvent', 'Xem tin', 'Xem tin', '<?php the_title(); ?>']);">
                            <img src="<?php the_post_thumbnail_url('360x220'); ?>" alt="<?php the_title(); ?>" itemprop="image" onError="this.src=no_image_src" />
                        </a>
                    </div>
                    <div class="col-sm-9 meta">
                        <h3><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title(); ?></a></h3>
                        <div class="description"><?php the_excerpt(); ?></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <?php endwhile; ?>
                <?php getpagenavi(array( 'query' => $consultant_posts )); ?>
            </div>
            <div class="col-md-4 col-sm-12"><?php echo do_shortcode(stripslashes_deep(get_option(SHORT_NAME . "_frmReg"))) ?></div>
            <div class="clearfix"></div>
        </div>
    </div>
</section>

<?php get_footer(); ?>