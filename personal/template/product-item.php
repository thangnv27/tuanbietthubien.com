<div class="col-sm-4 mb30">
    <div class="item">
        <a href="<?php the_permalink() ?>" title="<?php the_title() ?>" rel="bookmark">
            <?php the_post_thumbnail('600x600') ?>
        </a>
        <h3>
            <a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title(); ?></a>
        </h3>
        <p class="old-price"><?php echo number_format(get_post_meta(get_the_ID(), 'old_price', true), 0, ',', '.') ?> VNĐ</p>
        <p class="price"><?php echo number_format(get_post_meta(get_the_ID(), 'price', true)) ?> VNĐ</p>
    </div>
</div>