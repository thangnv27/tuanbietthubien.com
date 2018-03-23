<div class="project-slide" style="display: none">
    <div id="slider" class="flexslider">
        <ul class="slides">
            <?php
            $images = rwmb_meta( 'project_images', array(
                'type' => 'image_advanced',
                'size' => 'full'
            ));
            foreach ($images as $image):
            ?>
            <li><img src="<?php echo $image['full_url'] ?>" alt="<?php echo $image['title'] ?>" /></li>
            <?php
            endforeach;
            ?>
        </ul>
    </div>
    <div id="carousel" class="flexslider">
        <ul class="slides">
            <?php
            $images2 = rwmb_meta( 'project_images', array(
                'type' => 'image_advanced',
                'size' => 'thumbnail'
            ));
            foreach ($images2 as $image):
            ?>
            <li><img src="<?php echo $image['url'] ?>" alt="<?php echo $image['title'] ?>" /></li>
            <?php
            endforeach;
            ?>
        </ul>
    </div>
</div>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php
        /* translators: %s: Name of current post */
        the_content( sprintf( __('View more <span class="meta-nav">&rarr;</span>', SHORT_NAME) ) );
        ?>
    </div><!-- .entry-content -->
    
    <div class="frmDangky2">
        <h2 class="title"><?php _e('ĐĂNG KÝ TƯ VẤN', SHORT_NAME) ?></h2>
        <?php echo do_shortcode(stripslashes_deep(get_option(SHORT_NAME . "_frmRegInSingle"))) ?>
    </div>
</article><!-- #post-## -->