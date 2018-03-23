<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 */

if (is_single()) :
?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <header class="entry-header">
            <?php the_title('<h1 class="entry-title">', '</h1>'); ?>

            <div class="entry-meta">
                <?php
                if ('post' == get_post_type())
                    ppo_posted_on();

                /*
                if (!post_password_required() && ( comments_open() || get_comments_number() )) :
                    ?>
                    <span class="comments-link"><?php comments_popup_link(__('<i class="fa fa-comment"></i> Comments', SHORT_NAME), __('<i class="fa fa-comment"></i> 1 Comment', SHORT_NAME), __('<i class="fa fa-comment"></i> % Comments', SHORT_NAME)); ?></span>
                    <?php
                endif;
                */

                edit_post_link(__('<i class="fa fa-pencil"></i> Edit', SHORT_NAME), '<span class="edit-link">', '</span>');
                ?>
            </div><!-- .entry-meta -->
        </header><!-- .entry-header -->

        <div class="entry-content">
            <?php
            /* translators: %s: Name of current post */
            the_content( sprintf( __('View more <span class="meta-nav">&rarr;</span>', SHORT_NAME) ) );

            wp_link_pages(array(
                'before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', SHORT_NAME) . '</span>',
                'after' => '</div>',
                'link_before' => '<span>',
                'link_after' => '</span>',
            ));
            ?>
        </div><!-- .entry-content -->
        
        <div class="frmDangky2">
            <h2 class="title"><?php _e('ĐĂNG KÝ TƯ VẤN', SHORT_NAME) ?></h2>
            <?php echo do_shortcode(stripslashes_deep(get_option(SHORT_NAME . "_frmRegInSingle"))) ?>
        </div>

        <?php the_tags('<footer class="entry-meta"><span class="tag-links"><i class="fa fa-tags"></i> ', ', ', '</span></footer>'); ?>
    </article><!-- #post-## -->
<?php
else:
    $date_format = get_option( 'date_format' );
    $time_format = get_option( 'time_format' );
    $thumb_type = get_post_meta(get_the_ID(), 'thumb_type', true);
    $col1 = ($thumb_type == 'large') ? "12" : "4";
    $col2 = ($thumb_type == 'large') ? "12" : "8";
    $thumb_size = ($thumb_type == 'large') ? "full" : "360x220";
?>
    <div class="item" itemscope="" itemtype="http://schema.org/Article">
        <div class="row">
            <div class="col-sm-<?php echo $col1 ?>">
                <a class="thumbnail" href="<?php the_permalink() ?>" title="<?php the_title() ?>" rel="bookmark" onclick="_gaq.push(['_trackEvent', 'Xem tin', 'Xem tin', '<?php the_title(); ?>']);">
                    <img src="<?php the_post_thumbnail_url($thumb_size); ?>" alt="<?php the_title(); ?>" itemprop="image" onError="this.src=no_image_src" />
                </a>
            </div>
            <div class="col-sm-<?php echo $col2 ?>">
                <div class="categories"><?php the_category() ?></div>
                <a href="<?php the_permalink() ?>" title="<?php the_title() ?>" rel="bookmark"><h3><?php the_title() ?></h3></a>
                <div class="entry-meta">
                    <span><?php the_time($time_format); ?></span> | 
                    <span itemprop="datePublished"><?php echo date($date_format, strtotime($post->post_date)); //the_date($date_format); ?></span>
                </div>
                <div class="description"><?php the_excerpt() ?></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
<?php endif; ?>