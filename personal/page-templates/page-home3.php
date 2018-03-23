<?php 
/*
  Template Name: Home 3
*/
get_header('home3');
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

<section class="support">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="home-ad">
                    <?php echo stripslashes_deep(get_option(SHORT_NAME . "_home_ad1")) ?>
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
                <div class="videos">
                    <h3><?php _e('VIDEO CLIP', SHORT_NAME) ?></h3>
                    <?php
                    $videos = new WP_Query(array(
                        'post_type' => 'post',
                        'showposts' => 1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'post_format',
                                'field' => 'slug',
                                'terms' => array('post-format-video'),
                            ),
                        ),
                    ));
                    while ($videos->have_posts()) : $videos->the_post();
                    ?>
                    <div class="item">
                        <?php
                        $content = apply_filters( 'the_content', get_the_content() );
                        $embeds = get_media_embedded_in_content($content);
                        if (!empty($embeds)) {
                            echo $embeds[0];
                        } else {
                        ?>
                        <a href="<?php the_permalink() ?>" title="<?php the_title() ?>">
                            <img alt="<?php the_title() ?>" src="<?php the_post_thumbnail_url('large') ?>" />
                        </a>
                        <?php } ?>
                        <a href="<?php the_permalink() ?>" title="<?php the_title() ?>">
                            <h4><?php the_title() ?></h4>
                        </a>
                    </div>
                    <?php
                        $count++;
                    endwhile;
                    wp_reset_query();
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="media">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="news">
                    <h3><?php _e('Sự kiện', SHORT_NAME) ?></h3>
                    <?php
                    $date_format = get_option( 'date_format' );
                    $time_format = get_option( 'time_format' );
                    $eventCatID = get_option(SHORT_NAME . "_eventCatID");
                    $events = new WP_Query(array(
                        'post_type' => 'post',
                        'showposts' => 6,
                        'cat' => $eventCatID,
                    ));
                    $count = 1;
                    while ($events->have_posts()) : $events->the_post();
                        if($count == 1):
                    ?>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="item" itemscope="" itemtype="http://schema.org/Article">
                                <a href="<?php the_permalink(); ?>" onclick="_gaq.push(['_trackEvent', 'Xem tin', 'Xem tin', '<?php the_title(); ?>']);">
                                    <img src="<?php the_post_thumbnail_url('360x220'); ?>" alt="<?php the_title(); ?>" itemprop="image" />
                                </a>
                                <div class="itemTitle mt10" itemprop="name">
                                    <a href="<?php the_permalink(); ?>" itemprop="url" onclick="_gaq.push(['_trackEvent', 'Xem tin', 'Xem tin', '<?php the_title(); ?>']);"><?php the_title(); ?></a>
                                </div>
                                <div class="entry-meta">
                                    <span><?php the_time($time_format); ?></span> 
                                    | <span itemprop="datePublished"><?php echo date($date_format, strtotime($post->post_date)); //the_date($date_format); ?></span>
                                </div>
                                <div class="description"><?php echo get_short_content(get_the_content(), 250) ?></div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 second">
                    <?php else: ?>
                            <div class="item" itemscope="" itemtype="http://schema.org/Article">
                                <div class="col-sm-4 pdl0 pdr0">
                                    <a href="<?php the_permalink(); ?>" onclick="_gaq.push(['_trackEvent', 'Xem tin', 'Xem tin', '<?php the_title(); ?>']);">
                                        <img src="<?php the_post_thumbnail_url('360x220'); ?>" alt="<?php the_title(); ?>" itemprop="image" />
                                    </a>
                                </div>
                                <div class="col-sm-8 pdr0">
                                    <div class="itemTitle" itemprop="name">
                                        <a href="<?php the_permalink(); ?>" itemprop="url" onclick="_gaq.push(['_trackEvent', 'Xem tin', 'Xem tin', '<?php the_title(); ?>']);"><?php the_title(); ?></a>
                                    </div>
                                    <div class="entry-meta">
                                        <span><?php the_time($time_format); ?></span> 
                                        | <span itemprop="datePublished"><?php echo date($date_format, strtotime($post->post_date)); //the_date($date_format); ?></span>
                                    </div>
                                </div>
                            </div>
                    <?php
                        endif;
                        $count++;
                    endwhile;
                    if($events->post_count > 0){ echo '</div>'; }
                    wp_reset_query();
                    ?>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="chiasekn">
                    <?php
                    $ChiaSeKnID = intval(get_option(SHORT_NAME . "_ChiaSeKnID"));
                    $ChiaSeKnIDCat = get_category($ChiaSeKnID);
                    ?>
                    <h3><?php echo $ChiaSeKnIDCat->name; ?></h3>
                    <?php
                    $posts = new WP_Query(array(
                        'post_type' => 'post',
                        'showposts' => 5,
                        'cat' => $ChiaSeKnID,
                    ));
                    while ($posts->have_posts()) : $posts->the_post();
                    ?>
                    <div class="item" itemscope="" itemtype="http://schema.org/Article">
                        <div class="col-sm-4 pdl0 pdr0">
                            <a href="<?php the_permalink(); ?>" onclick="_gaq.push(['_trackEvent', 'Xem tin', 'Xem tin', '<?php the_title(); ?>']);">
                                <img src="<?php the_post_thumbnail_url('360x220'); ?>" alt="<?php the_title(); ?>" itemprop="image" />
                            </a>
                        </div>
                        <div class="col-sm-8 pdr0">
                            <div class="itemTitle" itemprop="name">
                                <a href="<?php the_permalink(); ?>" itemprop="url" onclick="_gaq.push(['_trackEvent', 'Xem tin', 'Xem tin', '<?php the_title(); ?>']);"><?php the_title(); ?></a>
                            </div>
                            <div class="entry-meta">
                                <span><?php the_time($time_format); ?></span> 
                                | <span itemprop="datePublished"><?php echo date($date_format, strtotime($post->post_date)); //the_date($date_format); ?></span>
                            </div>
                        </div>
                    </div>
                    <?php
                    endwhile;
                    wp_reset_query();
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="slogan">
    <div class="container">
        <?php echo wpautop(stripslashes_deep(get_option(SHORT_NAME . "_slogan"))) ?>
    </div>
</section>

<section class="popular-projects">
    <div class="container">
        <h2><?php _e('Dự án biệt thự biển nổi bật', SHORT_NAME) ?></h2>
        <div class="flexslider" style="display: none">
            <ul class="slides">
            <?php
            $projectCatID = intval(get_option(SHORT_NAME . "_projectCatID"));
            $project_limit = intval(get_option(SHORT_NAME . "_projectLimit"));
            $projects = new WP_Query(array(
//                'post_type' => 'project',
                'post_type' => 'post',
                'showposts' => $project_limit,
                'cat' => $projectCatID,
            ));
            while ($projects->have_posts()) : $projects->the_post();
            ?>
            <li>
                <div class="item">
                    <a href="<?php the_permalink() ?>" title="<?php the_title() ?>" rel="bookmark">
                        <?php the_post_thumbnail('360x220') ?>
                    </a>
                    <h3>
                        <a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title(); ?></a>
                    </h3>
                </div>
            </li>
            <?php
            endwhile;
            wp_reset_query();
            ?>
            </ul>
        </div>
    </div>
</section>

<section class="media pdt30" style="background: #0a0928;">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="news">
                    <h3><?php _e('Tin tức', SHORT_NAME) ?></h3>
                    <?php
                    $newsCatID = get_option(SHORT_NAME . "_newsCatID");
                    $news = new WP_Query(array(
                        'post_type' => 'post',
                        'showposts' => 5,
                        'cat' => $newsCatID,
                    ));
                    $count = 1;
                    while ($news->have_posts()) : $news->the_post();
                        if($count == 1):
                    ?>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="item" itemscope="" itemtype="http://schema.org/Article">
                                <a href="<?php the_permalink(); ?>" onclick="_gaq.push(['_trackEvent', 'Xem tin', 'Xem tin', '<?php the_title(); ?>']);">
                                    <img src="<?php the_post_thumbnail_url('360x220'); ?>" alt="<?php the_title(); ?>" itemprop="image" />
                                </a>
                                <div class="itemTitle mt10" itemprop="name">
                                    <a href="<?php the_permalink(); ?>" itemprop="url" onclick="_gaq.push(['_trackEvent', 'Xem tin', 'Xem tin', '<?php the_title(); ?>']);"><?php the_title(); ?></a>
                                </div>
                                <div class="entry-meta">
                                    <span><?php the_time($time_format); ?></span> 
                                    | <span itemprop="datePublished"><?php echo date($date_format, strtotime($post->post_date)); //the_date($date_format); ?></span>
                                </div>
                                <div class="description"><?php echo get_short_content(get_the_content(), 250) ?></div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 second">
                    <?php else: ?>
                            <div class="item" itemscope="" itemtype="http://schema.org/Article">
                                <div class="col-sm-4 pdl0 pdr0">
                                    <a href="<?php the_permalink(); ?>" onclick="_gaq.push(['_trackEvent', 'Xem tin', 'Xem tin', '<?php the_title(); ?>']);">
                                        <img src="<?php the_post_thumbnail_url('360x220'); ?>" alt="<?php the_title(); ?>" itemprop="image" />
                                    </a>
                                </div>
                                <div class="col-sm-8 pdr0">
                                    <div class="itemTitle" itemprop="name">
                                        <a href="<?php the_permalink(); ?>" itemprop="url" onclick="_gaq.push(['_trackEvent', 'Xem tin', 'Xem tin', '<?php the_title(); ?>']);"><?php the_title(); ?></a>
                                    </div>
                                    <div class="entry-meta">
                                        <span><?php the_time($time_format); ?></span> 
                                        | <span itemprop="datePublished"><?php echo date($date_format, strtotime($post->post_date)); //the_date($date_format); ?></span>
                                    </div>
                                </div>
                            </div>
                    <?php
                        endif;
                        $count++;
                    endwhile;
                    if($news->post_count > 0){ echo '</div>'; }
                    wp_reset_query();
                    ?>
                    <div class="clearfix"></div>
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

<section class="partners">
    <div class="container">
        <h2><?php _e('Đối tác tiêu biểu', SHORT_NAME) ?></h2>
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