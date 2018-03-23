<?php

class Category_Posts_First_Thumb_Widget extends WP_Widget {

    function Category_Posts_First_Thumb_Widget() {
        $widget_ops = array('classname' => 'cat-posts-first-thumb-widget', 'description' => __('Show posts by category with first thumbnail.'));
        $control_ops = array('id_base' => 'cat_posts_first_thumb_widget');
        parent::__construct('cat_posts_first_thumb_widget', 'PPO: Category Posts First Thumbnail', $widget_ops, $control_ops);
    }

    /**
     * Displays category posts widget on blog.
     *
     * @param array $instance current settings of widget .
     * @param array $args of widget area
     */
    function widget($args, $instance) {
        global $post;
        extract($args);

        $title = apply_filters('title', $instance['title']);
        $term_id = trim($instance["cat"]);
        if($term_id > 0):
            $category_info = get_category($term_id);
            // If not title, use the name of the category.
            if (!$instance['title']) {
                $title = $category_info->name;
            }

            echo $before_widget;
            // Widget title
            echo $before_title;
            echo $title;
            echo $after_title;
            ?>
            <div class="widget-content">
                <?php
                $cat_posts = new WP_Query(array(
                    'post_type' => 'post',
                    'showposts' => $instance["num"],
                    'cat' => $term_id,
                ));
                $count = 1;
                while ($cat_posts->have_posts()) : $cat_posts->the_post();
                    if($count == 1):
                ?>
                <div class="first">
                    <a class="thumbnail" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" rel="bookmark">
                        <?php the_post_thumbnail('360x220'); ?>
                    </a>
                    <h4><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h4>
                </div>
                <ul>
                <?php else: ?>
                    <li><a href="<?php the_permalink() ?>" title="<?php the_title() ?>">
                            <i class="fa fa-question-circle" aria-hidden="true"></i> <?php the_title() ?>
                        </a></li>
                <?php
                    endif;
                    $count++;
                endwhile;
                if($cat_posts->post_count > 0) {echo "</ul>";}
                wp_reset_query();
                ?>
            </div>
            <?php
            echo $after_widget;
        endif;
    }

    /**
     * Form processing...
     *
     * @param array $new_instance of widget .
     * @param array $old_instance of widget .
     */
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['cat'] = $new_instance['cat'];
        $instance['num'] = $new_instance['num'];
        return $instance;
    }

    /**
     * The configuration form.
     *
     * @param array $instance of widget to display already stored value .
     * 
     */
    function form($instance) {
        ?>		
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', SHORT_NAME) ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
        </p>
        <p>
            <label><?php _e('Category', SHORT_NAME) ?></label><br />
            <?php 
            wp_dropdown_categories(array(
                'name' => $this->get_field_name("cat"), 
                'hide_empty' => 0, 
                'selected' => $instance["cat"],
                'hierarchical' => true,
                'class' => 'widefat',
            ));
            ?>
        </p>
        <p>
            <label><?php _e('Number', SHORT_NAME) ?></label><br />
            <input class="widefat" id="<?php echo $this->get_field_id("num"); ?>" name="<?php echo $this->get_field_name("num"); ?>" type="text" value="<?php echo intval($instance["num"]); ?>" />
        </p>
        <?php
    }

}
