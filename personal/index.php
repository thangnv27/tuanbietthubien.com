<?php get_header(); ?>

<div class="container">
    <div class="main">
        <div class="bloglist">
            <?php
            while (have_posts()) : the_post();
                get_template_part('content', get_post_format());
            endwhile;
            ?>
        </div>

        <?php getpagenavi(); ?>
    </div>
</div>

<?php get_footer(); ?>