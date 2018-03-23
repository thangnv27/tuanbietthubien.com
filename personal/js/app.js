wow = new WOW({
    mobile: true
})
wow.init();

var viewport_width = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
var viewport_height = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
var PPOFixed = {
    sidebar:function(){
        if(jQuery(".product-cat .product-cats").length > 0){
            var $elm = jQuery(".product-cat .product-cats");
            var minWidth = $elm.width();
            jQuery(".product-cat .product-cats").scrollToFixed( {
                marginTop: jQuery('#wpadminbar').outerHeight(true),
                limit: jQuery('.footer-before').offset().top,
                zIndex: 999,
                fixed: function (){
                    $elm.width(minWidth);
                },
                postFixed: function (){
                    $elm.width(minWidth);
                },
                unfixed: function (){
                    $elm.width(minWidth);
                },
                postAbsolute: function (){
                    $elm.width(minWidth);
                }
            });
        }
    }
};

jQuery(document).ready(function ($) {
//    if(!is_mobile){
//        PPOFixed.sidebar();
//    }

    if(jQuery(".page-template-page-home2 .wrap-header").length > 0){
        jQuery(".page-template-page-home2 .wrap-header").css({
            display: 'block',
            top: jQuery('#wpadminbar').outerHeight(true),
            left: jQuery(".support .search").offset().left
        });
    }
    if(jQuery(".page-template-page-home3 .wrap-header").length > 0){
        jQuery(".page-template-page-home3 .wrap-header").css({
            display: 'block',
            top: jQuery('#wpadminbar').outerHeight(true),
            left: jQuery(".page-template-page-home3 .media .news").offset().left
        });
    }
    
    jQuery(window).bind('load resize', function (){
        viewport_width = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
    });
    
    jQuery(window).load(function () {
        var feedback_items = 4, feedback_margin = 60;
        var partner_items = 6, partner_margin = 10;
        var project_items = 4, project_margin = 30;
        if(viewport_width >= 992 && viewport_width < 1200){
            partner_items = 5;
        } else if(viewport_width >= 768 && viewport_width < 992){
            feedback_items = 3;
            partner_items = 3;
            project_items = 3;
        } else if(viewport_width >= 600 && viewport_width < 768){
            feedback_items = 2;
            partner_items = 2;
            project_items = 2;
        } else if(viewport_width > 360 && viewport_width < 600){
            feedback_items = 1;
            feedback_margin = 0;
            partner_items = 2;
            project_items = 2;
            project_margin = 20;
        } else if(viewport_width <= 360){
            feedback_items = 1;
            feedback_margin = 0;
            partner_items = 1;
            partner_margin = 0;
            project_items = 1;
            project_margin = 0;
        }
        if(jQuery('.popular-projects').length > 0){
            jQuery('.popular-projects .flexslider').show().flexslider({
                animation: "slide",
                pauseOnHover: true,
                mousewheel: true,
                controlNav: false,
                minItems: project_items,
                maxItems: project_items,
                itemWidth: 300,
                itemMargin: project_margin
            });
        }
        if(jQuery('.feedbacks2 .flexslider').length > 0){
            jQuery('.feedbacks2 .flexslider').show().flexslider({
                animation: "slide",
                pauseOnHover: true,
                mousewheel: true,
                controlNav: false,
                minItems: 1,
                maxItems: 1,
                itemWidth: 150
            });
        }
        if(jQuery('.feedbacks .flexslider').length > 0){
            jQuery('.feedbacks .flexslider').show().flexslider({
                animation: "slide",
                pauseOnHover: true,
                mousewheel: true,
                minItems: feedback_items,
                maxItems: feedback_items,
                itemWidth: 400,
                itemMargin: feedback_margin
            });
        }
        if(jQuery('.partners .flexslider').length > 0){
            jQuery('.partners .flexslider').show().flexslider({
                animation: "slide",
                pauseOnHover: true,
                mousewheel: true,
                controlNav: false,
                minItems: partner_items,
                maxItems: partner_items,
                itemWidth: 300,
                itemMargin: partner_margin
            });
        }
        if(jQuery(".single-photo .rs-slider").length > 0){
            jQuery(".single-photo .rs-slider").show().refineSlide({
                useThumbs: false,
                autoPlay: true,
                delay: 5000,
                onInit: function () {
                    var slider = this.slider;
                    jQuery('.slider-nav .right').on('click', function (event) {
                        slider.next();
                    });
                    jQuery('.slider-nav .left').on('click', function (event) {
                        slider.prev();
                    });
                },
                onChange:function(){
                    jQuery('.slide-dots span').removeClass('active');
                    jQuery(".circle-"+this.slider.currentPlace).addClass('active');
                }
            });
        }
        
        // Project slider
        if(jQuery(".project-slide").length > 0){
            jQuery(".project-slide").show();
            jQuery('#carousel').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                itemWidth: 150,
                itemMargin: 23,
                asNavFor: '#slider'
            });
            jQuery('#slider').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                sync: "#carousel"
            });
        }
    });
    
    // Back to top
    jQuery("#back-top").click(function (){
        jQuery("html, body").animate({ scrollTop: 0 }, "slow");
    });

    // Menu mobile
    jQuery('button.left-menu').click(function (){
        var effect = jQuery(this).attr('data-effect');
        if(jQuery(this).parent().parent().hasClass('mobile-clicked')){
            jQuery('.st-menu').animate({
                width: 0
            }).css({
                display: 'none',
                transform: 'translate(0px, 0px)',
                transition: 'transform 400ms ease 0s'
            });
            jQuery(this).parent().parent().addClass('mobile-unclicked').removeClass('mobile-clicked').css({
                transform: 'translate(0px, 0px)',
                transition: 'transform 400ms ease 0s'
            });
            jQuery(this).parent().parent().parent().removeClass('st-menu-open ' + effect);
//            jQuery("#overlay").hide();
        } else {
            jQuery(this).parent().parent().parent().addClass('st-menu-open ' + effect);
            jQuery('.st-menu').animate({
                width: 270
            }).css({
                display: 'block',
                transform: 'translate(270px, 0px)',
                transition: 'transform 400ms ease 0s'
            });
            jQuery(this).parent().parent().addClass('mobile-clicked').removeClass('mobile-unclicked').css({
                transform: 'translate(270px, 0px)',
                transition: 'transform 400ms ease 0s'
            });
//            jQuery("#overlay").show();
        }
    });
    
    jQuery("#search").focusin(function (){
        jQuery(this).prev().hide();
    });
    jQuery("#search").focusout(function (){
        jQuery(this).prev().show();
    });
//    jQuery(".right-menu").click(function (){
//        if(fan_page_url.length > 0){
//            window.open(fan_page_url,'_blank');
//        }
//    });
    
    var cbHeight = jQuery(window).height() - jQuery("#wpadminbar").outerHeight(true);
    jQuery('.fancybox').colorbox({
        fixed: true,
        height: cbHeight
    });
    
    jQuery(".bloglist .thumbnail img").each(function (){
        if(jQuery(this).attr('src').trim().length === 0){
            jQuery(this).attr('src', no_image_src);
        }
    });
    
    // Dat hang
    jQuery("button.btn-cart").click(function (){
        jQuery(".frm-dathang").show('fast');
        jQuery(".frm-content").addClass('swing animated');
        setTimeout(function (){
            jQuery(".frm-content").removeClass('swing animated');
        }, 1000);
    });
    jQuery('.frm-dathang .close').click(function (){
        jQuery('.frm-dathang').fadeOut().hide('slow');
    });
    jQuery(".frm-dathang form").validate({
        rules: {
            quantity: {
                required: true
            },
            fullname: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true
            },
            address: {
                required: true
            }
        },
        errorClass: "help-block",
        errorElement: "span",
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-success');
            $(element).parents('.form-group').addClass('has-error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-error');
            $(element).parents('.form-group').addClass('has-success');
        },
        submitHandler: function (form) {
            displayAjaxLoading(true);
            jQuery.ajax({
                url: ajaxurl, type: 'POST', dataType: 'json', cache: false,
                data: $(form).serialize(),
                success: function (response, textStatus, XMLHttpRequest) {
                    if (response && response.status === 'success') {
                        displayBarNotification(true, "nSuccess", response.message);
                        form.reset();
                    } else if (response.status === 'error') {
                        console.log(response.message);
                    }
                },
                error: function (MLHttpRequest, textStatus, errorThrown) {
                    console.log(errorThrown);
                },
                complete: function () {
                    displayAjaxLoading(false);
                }
            });
        }
    });
});