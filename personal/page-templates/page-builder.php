<?php 
/*
  Template Name: Page Builder
 */
get_header(); 
?>

<section class="main">
    <?php while (have_posts()) : the_post(); ?>

        <?php the_content(); ?>

    <?php endwhile; ?>
</section>

<?php get_footer(); ?>