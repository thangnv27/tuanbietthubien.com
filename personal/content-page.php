<?php
/**
 * The template used for displaying page content
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php the_title('<h1 class="page-title">', '</h1>'); ?>

    <div class="entry-content">
        <?php
        the_content();
        show_share_socials();
        
        wp_link_pages(array(
            'before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', SHORT_NAME) . '</span>',
            'after' => '</div>',
            'link_before' => '<span>',
            'link_after' => '</span>',
        ));

        edit_post_link(__('<i class="fa fa-pencil"></i> Edit', SHORT_NAME), '<span class="edit-link">', '</span>');
        ?>
    </div><!-- .entry-content -->
    
    <div class="frmDangky2">
        <h2 class="title"><?php _e('ĐĂNG KÝ TƯ VẤN', SHORT_NAME) ?></h2>
        <?php echo do_shortcode(stripslashes_deep(get_option(SHORT_NAME . "_frmRegInSingle"))) ?>
    </div>
</article><!-- #post-## -->
