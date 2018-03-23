<?php 
/*
  Template Name: Projects
*/
get_header();
?>

<section class="project-page">
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>
        <h1><?php the_title(); ?></h1>
        <div class="project-container">
            <div class="row">
                <?php
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $loop = new WP_Query(array(
                    'post_type' => 'project',
                    'posts_per_page' => 9,
                    'paged' => $paged,
                ));
                while ($loop->have_posts()) : $loop->the_post();
                ?>
                <div class="col-sm-4 mb30">
                    <div class="item">
                        <a href="<?php the_permalink() ?>" title="<?php the_title() ?>" rel="bookmark">
                            <?php the_post_thumbnail('360x220') ?>
                        </a>
                        <h3>
                            <a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title(); ?></a>
                        </h3>
                    </div>
                </div>
                <?php
                endwhile;
                wp_reset_query();
                ?>
            </div>
        </div>
        <?php getpagenavi(array( 'query' => $loop )); ?>
        <?php endwhile; ?>
    </div>
</section>

<?php get_footer(); ?>