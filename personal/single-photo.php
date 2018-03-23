<?php get_header(); ?>

<div class="single-photo">
    <div class="container slider-wrapper">
        <ul class="rs-slider" style="display: none">
            <?php
            while (have_posts()) : the_post();
                $images = rwmb_meta( 'photo_images', array(
                    'type' => 'image_advanced',
                    'size' => 'full'
                ));
                foreach ($images as $image):
                ?>
                <li><img src="<?php echo $image['full_url'] ?>" alt="<?php echo $image['title'] ?>" /></li>
                <?php
                endforeach;
            endwhile; ?>
        </ul>
        <div class="slider-nav">
            <span class="right">Right</span>
            <span class="left">Left</span>
        </div>
        <div class="slide-dots">
            <span class="circle-0 active">&bull;</span>
            <span class="circle-1">&bull;</span>
            <span class="circle-2">&bull;</span>
            <span class="circle-3">&bull;</span>
        </div>
    </div>
</div>

<?php get_footer(); ?>