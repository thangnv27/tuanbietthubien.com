<section class="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div>
                    <a href="<?php echo home_url(); ?>" title="<?php bloginfo("name"); ?> - <?php bloginfo("description") ?>">
                        <img src="<?php echo get_option("sitefooter"); ?>" alt="<?php bloginfo("name"); ?>" />
                    </a>
                    <div class="mt15"><?php echo wpautop(stripslashes_deep(get_option(SHORT_NAME . "_footerIntro"))) ?></div>
                </div>
            </div>
            <div class="col-sm-4">
                <h3 class="widget-title"><?php _e('Contact Us', SHORT_NAME) ?></h3>
                <p><?php _e('Address', SHORT_NAME) ?>: <?php echo get_option('contact_address') ?></p>
                <?php if(get_option('contact_address2')): ?>
                <p><?php _e('Địa chỉ 2', SHORT_NAME) ?>: <?php echo get_option('contact_address2') ?></p>
                <?php endif; ?>
                <?php if(get_option('contact_address3')): ?>
                <p><?php _e('Địa chỉ 3', SHORT_NAME) ?>: <?php echo get_option('contact_address3') ?></p>
                <?php endif; ?>
                <p><?php _e('Email', SHORT_NAME) ?>: <a href="mailto:<?php echo get_option('contact_email') ?>"><?php echo get_option('contact_email') ?></a></p>
                <p><?php _e('Phone', SHORT_NAME) ?>: <a href="tel:<?php echo get_option('contact_phone') ?>"><?php echo get_option('contact_phone') ?></a></p>
                <ul class="socials">
                    <?php 
                    $fbURL = get_option(SHORT_NAME . "_fbURL");
                    $googlePlusURL = get_option(SHORT_NAME . "_googlePlusURL");
                    $linkedInURL = get_option(SHORT_NAME . "_linkedInURL");
                    $twitterURL = get_option(SHORT_NAME . "_twitterURL");
                    ?>
                    <?php if (!empty($fbURL)): ?>
                    <li><a class="icon icon-fb" href="<?php echo $fbURL; ?>"></a></li>
                    <?php endif; ?>
                    <?php if (!empty($googlePlusURL)): ?>
                    <li><a class="icon icon-gplus" href="<?php echo $googlePlusURL; ?>"></a></li>
                    <?php endif; ?>
                    <?php if (!empty($linkedInURL)): ?>
                    <li><a class="icon icon-in" href="<?php echo $linkedInURL; ?>"></a></li>
                    <?php endif; ?>
                    <?php if (!empty($twitterURL)): ?>
                    <li><a class="icon icon-twitter" href="<?php echo $twitterURL; ?>"></a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="col-sm-4 links">
                <h3 class="widget-title"><?php _e('Links', SHORT_NAME) ?></h3>
                <ul>
                <?php
                $linkCatID = get_option(SHORT_NAME . "_linkCatID");
                get_links($linkCatID, "<li>", "</li>");
                ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="container">
            <div class="pull-left">@ <?php bloginfo('name') ?>. All rights reserved.</div>
            <div class="pull-right">
                <?php
                wp_nav_menu(array(
                    'container' => '',
                    'theme_location' => 'footer',
                    'menu_class' => 'nav',
                    'menu_id' => '',
                ));
                ?>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</section>

<!-- script references -->
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery-migrate.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery-scrolltofixed-min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.flexslider-min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/colorbox/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/wow.min.js"></script>
<?php if(is_singular('photo')): ?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.refineslide.min.js"></script>
<?php endif; ?>
<!--<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/disable-copy.js"></script>-->
<!--<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/prototype.js"></script>-->
<!--<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/effects.js"></script>-->
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/custom.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/app.js"></script>
<?php wp_footer(); ?>
<script src="https://apis.google.com/js/platform.js" async defer></script>
</body>
</html>