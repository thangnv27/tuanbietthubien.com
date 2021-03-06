<?php

$basename = basename($_SERVER['PHP_SELF']);
//if (!in_array($basename, array('plugins.php', 'update.php', 'upgrade.php'))) {
//    ob_start();
//    ob_start("ob_gzhandler");
//}
/* ----------------------------------------------------------------------------------- */
# Set default timezone
/* ----------------------------------------------------------------------------------- */
date_default_timezone_set('Asia/Ho_Chi_Minh');
/* ----------------------------------------------------------------------------------- */
# Definition
/* ----------------------------------------------------------------------------------- */
if (!defined('THEME_NAME'))
    define('THEME_NAME', "PPO");
if (!defined('SHORT_NAME'))
    define('SHORT_NAME', "ppo");
if (!defined('MENU_NAME'))
    define('MENU_NAME', SHORT_NAME . "_settings");
/* ----------------------------------------------------------------------------------- */
# Theme Options
/* ----------------------------------------------------------------------------------- */
$pages = get_pages();
$page_list = array();
foreach ($pages as $page) {
    $page_list[$page->ID] = $page->post_title;
}
$categories = get_categories(array('hide_empty' => 0));
$category_list = array();
foreach ($categories as $category) {
    $category_list[$category->term_id] = $category->name;
}
$sliders = ppo_find_layersliders();
$slider_list = array(0 => "No Slider");
if(is_array($sliders)){
    foreach ($sliders as $slide) {
        $slider_list[$slide->id] = $slide->name;
    }
}

$options = array(
    'general' => array(
        "name" => "General",
        array("id" => "ppo_opt",
            "std" => "general",
            "type" => "hidden"),
        array("name" => "Site Options",
            "type" => "title",
            "desc" => ""),
        array("type" => "open"),
        array("name" => "Keywords meta",
            "desc" => "Enter the meta keywords for all pages. These are used by search engines to index your pages with more relevance.",
            "id" => "keywords_meta",
            "std" => "",
            "type" => "text"),
        array("name" => "Favicon",
            "desc" => "An icon associated with a particular website, and typically displayed in the address bar of a browser viewing the site. Size: 16x16",
            "id" => "favicon",
            "std" => "",
            "type" => "text",
            "btn" => true),
        array("name" => "Avatar",
            "desc" => "Size: width=300, height=300px",
            "id" => "avatar",
            "std" => "",
            "type" => "text",
            "btn" => true),
        array("name" => "Logo",
            "desc" => "Size: width=auto, height=66px",
            "id" => "sitelogo",
            "std" => "",
            "type" => "text",
            "btn" => true),
        array("name" => "Mobile Logo",
            "desc" => "Size: max-width=240px, max-height=49px",
            "id" => "mobilelogo",
            "std" => "",
            "type" => "text",
            "btn" => true),
        array("name" => "Logo Footer",
            "desc" => "Size: width=auto, height=66px",
            "id" => "sitefooter",
            "std" => "",
            "type" => "text",
            "btn" => true),
        array("name" => "Banner Top",
            "desc" => "Size: width=auto, height=66px",
            "id" => "banner_top",
            "std" => "",
            "type" => "text",
            "btn" => true),
        array("name" => "Slider",
            "desc" => "",
            "id" => "home_slider",
            "std" => "",
            "type" => "select",
            "options" => $slider_list),
        array("type" => "close"),

        array("name" => "Thông tin liên hệ",
            "type" => "title",
            "desc" => ""),
        array("type" => "open"),
        array("name" => "Nhân hiệu",
            "desc" => "",
            "id" => "unit_owner",
            "std" => "",
            "type" => "text"),
        array("name" => "Chức danh",
            "desc" => "",
            "id" => "chuc_danh",
            "std" => "",
            "type" => "text"),
        array("name" => "Address",
            "desc" => "Địa chỉ liên hệ",
            "id" => "contact_address",
            "std" => "",
            "type" => "text"),
        array("name" => "Address 2",
            "desc" => "Địa chỉ liên hệ",
            "id" => "contact_address2",
            "std" => "",
            "type" => "text"),
        array("name" => "Address 3",
            "desc" => "Địa chỉ liên hệ",
            "id" => "contact_address3",
            "std" => "",
            "type" => "text"),
        array("name" => "Email",
            "desc" => "Địa chỉ email",
            "id" => "contact_email",
            "std" => "",
            "type" => "text"),
        array("name" => "Phone",
            "desc" => "Số điện thoại",
            "id" => "contact_phone",
            "std" => "",
            "type" => "text"),
        array("name" => "Giới thiệu",
            "desc" => "Hiển thị ở cuối trang",
            "id" => SHORT_NAME . "_footerIntro",
            "std" => "",
            "type" => "textarea",
            "editor" => array(
                "wyswig" => true,
                "rows" => 12,
            )),
        array("name" => "Khẩu hiệu",
            "desc" => "Hiển thị ở home style 2 và 3",
            "id" => SHORT_NAME . "_slogan",
            "std" => "",
            "type" => "textarea",
            "editor" => array(
                "wyswig" => true,
                "rows" => 12,
            )),
        array("type" => "close"),
        array("type" => "submit"),
    ),
    'theme-options' => array(
        "name" => "Theme Options",
        array("id" => "ppo_opt",
            "std" => "theme-options",
            "type" => "hidden"),
        
//        array("name" => "Tùy chọn khác",
//            "type" => "title",
//            "desc" => "Tìm chỉnh website.",
//        ),
        array("type" => "open"),
        array("name" => "Dự án",
            "desc" => "Chuyển mục này hiển thị ở trang chủ kiểu 3",
            "id" => SHORT_NAME . "_projectCatID",
            "std" => "",
            "type" => "select",
            "options" => $category_list),
        array("name" => "Tin tức",
            "desc" => "Chuyển mục này hiển thị ở trang chủ kiểu 3",
            "id" => SHORT_NAME . "_newsCatID",
            "std" => "",
            "type" => "select",
            "options" => $category_list),
        array("name" => "Sự kiện",
            "desc" => "Chuyển mục này hiển thị ở trang chủ kiểu 3",
            "id" => SHORT_NAME . "_eventCatID",
            "std" => "",
            "type" => "select",
            "options" => $category_list),
        array("name" => "Tư vấn & Hỏi đáp",
            "desc" => "Chuyển mục này hiển thị ở trang chủ kiểu 1",
            "id" => SHORT_NAME . "_ConsultantID",
            "std" => "",
            "type" => "select",
            "options" => $category_list),
        array("name" => "Chia sẻ kinh nghiệm",
            "desc" => "Chuyển mục này hiển thị ở trang chủ kiểu 3",
            "id" => SHORT_NAME . "_ChiaSeKnID",
            "std" => "",
            "type" => "select",
            "options" => $category_list),
        array("name" => "Home seervice ID",
            "desc" => "Ví dụ: 22",
            "id" => SHORT_NAME . "_homeServiceID",
            "std" => "",
            "type" => "text"),
        array("name" => "Link Category ID",
            "desc" => "Ví dụ: 22",
            "id" => SHORT_NAME . "_linkCatID",
            "std" => "",
            "type" => "text"),
        array("name" => "Form Đăng ký",
            "desc" => "Hiển thị ở trang chủ",
            "id" => SHORT_NAME . "_frmReg",
            "std" => "",
            "type" => "text"),
        array("name" => "Form Đăng ký 2",
            "desc" => "Hiển thị ở trang chủ kiểu 2 và 3",
            "id" => SHORT_NAME . "_frmReg2",
            "std" => "",
            "type" => "text"),
        array("name" => "Form Đăng ký trong dự án",
            "desc" => "Hiển thị trong chi tiết dự án",
            "id" => SHORT_NAME . "_frmRegInSingle",
            "std" => "",
            "type" => "text"),
        array("name" => "Số lượng dự án",
            "desc" => "Ví dụ: 8",
            "id" => SHORT_NAME . "_projectLimit",
            "std" => "",
            "type" => "text"),
        array("name" => "Subiz License ID",
            "desc" => "Ví dụ: 22038",
            "id" => SHORT_NAME . "_subizID",
            "std" => "",
            "type" => "text"),
        array("name" => "Google Analytics",
            "desc" => "Google Analytics. Ví dụ: UA-40210538-1",
            "id" => SHORT_NAME . "_gaID",
            "std" => "UA-40210538-1",
            "type" => "text"),
        array("name" => "Google maps",
            "desc" => "Dán đoạn mã của Google maps vào đây. Kích thước 500 x 600",
            "id" => SHORT_NAME . "_gmaps",
            "std" => '<iframe width="500" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=vi&amp;geocode=&amp;q=S%E1%BB%91+104+Ng%C3%B5+189+Ho%C3%A0ng+Hoa+Th%C3%A1m,+Ng%C3%B5+189,+Li%E1%BB%85u+Giai,+Ba+Dinh+District,+Hanoi,+Vietnam&amp;aq=&amp;sll=21.040036,105.819889&amp;sspn=0.011656,0.021136&amp;ie=UTF8&amp;hq=S%E1%BB%91+104+Ng%C3%B5+189+Ho%C3%A0ng+Hoa+Th%C3%A1m,&amp;hnear=Ng%C3%B5+189,+%C4%90%E1%BB%99i+C%E1%BA%A5n,+Ba+%C4%90%C3%ACnh,+H%C3%A0+N%E1%BB%99i,+Vi%E1%BB%87t+Nam&amp;ll=21.04172,105.820717&amp;spn=0.046621,0.084543&amp;t=m&amp;z=14&amp;iwloc=A&amp;cid=1398663498302061535&amp;output=embed"></iframe><br /><small><a href="https://maps.google.com/maps?f=q&amp;source=embed&amp;hl=vi&amp;geocode=&amp;q=S%E1%BB%91+104+Ng%C3%B5+189+Ho%C3%A0ng+Hoa+Th%C3%A1m,+Ng%C3%B5+189,+Li%E1%BB%85u+Giai,+Ba+Dinh+District,+Hanoi,+Vietnam&amp;aq=&amp;sll=21.040036,105.819889&amp;sspn=0.011656,0.021136&amp;ie=UTF8&amp;hq=S%E1%BB%91+104+Ng%C3%B5+189+Ho%C3%A0ng+Hoa+Th%C3%A1m,&amp;hnear=Ng%C3%B5+189,+%C4%90%E1%BB%99i+C%E1%BA%A5n,+Ba+%C4%90%C3%ACnh,+H%C3%A0+N%E1%BB%99i,+Vi%E1%BB%87t+Nam&amp;ll=21.04172,105.820717&amp;spn=0.046621,0.084543&amp;t=m&amp;z=14&amp;iwloc=A&amp;cid=1398663498302061535" style="color:#0000FF;text-align:left">Xem Bản đồ cỡ lớn hơn</a></small>',
            "type" => "textarea"),
        array("name" => "Header Code",
            "desc" => "Phần này cho phép đặt các mã code vào đầu trang.",
            "id" => SHORT_NAME . "_headerCode",
            "std" => '',
            "type" => "textarea"),
        array("name" => "Footer Code",
            "desc" => "Phần này cho phép đặt các mã code vào cuối trang.",
            "id" => SHORT_NAME . "_footerCode",
            "std" => '',
            "type" => "textarea"),
        array("type" => "close"),
        array("type" => "submit"),
    ),
    'ads-options' => array(
        "name" => "Ads Options",
        array("id" => "ppo_opt",
            "std" => "ads-options",
            "type" => "hidden"),
        
        array("name" => "Quảng cáo ở trang chủ",
            "type" => "title",
            "desc" => "",
        ),
        array("type" => "open"),
        array("name" => "Ads 1",
            "desc" => "",
            "id" => SHORT_NAME . "_home_ad1",
            "std" => '',
            "type" => "textarea"),
//        array("name" => "Ads 2",
//            "desc" => "",
//            "id" => SHORT_NAME . "_home_ad2",
//            "std" => '',
//            "type" => "textarea"),
        array("type" => "close"),
        array("type" => "submit"),
    ),
    'social-options' => array(
        "name" => "Socials",
        array("id" => "ppo_opt",
            "std" => "social-options",
            "type" => "hidden"),
        array("name" => "Theo dõi trên mạng xã hội",
            "type" => "title",
            "desc" => ""),
        array("type" => "open"),
        array("name" => "Facebook",
            "desc" => "Nhập URL page của bạn trên facebook.",
            "id" => SHORT_NAME . "_fbURL",
            "std" => "",
            "type" => "text"),
        array("name" => "Google plus",
            "desc" => "Nhập URL page của bạn trên Google plus.",
            "id" => SHORT_NAME . "_googlePlusURL",
            "std" => "",
            "type" => "text"),
        array("name" => "Twitter",
            "desc" => "Nhập URL page của bạn trên Twitter.",
            "id" => SHORT_NAME . "_twitterURL",
            "std" => "",
            "type" => "text"),
        array("name" => "Linked In",
            "desc" => "Nhập URL page của bạn trên Linked In.",
            "id" => SHORT_NAME . "_linkedInURL",
            "std" => "",
            "type" => "text"),
        array("name" => "Youtube",
            "desc" => "Nhập URL page của bạn trên Youtube.",
            "id" => SHORT_NAME . "_youtubeURL",
            "std" => "",
            "type" => "text"),
//        array("name" => "Pinterest",
//            "desc" => "Nhập URL page của bạn trên Pinterest.",
//            "id" => SHORT_NAME . "_pinterestURL",
//            "std" => "",
//            "type" => "text"),
//        array("name" => "Instagram",
//            "desc" => "Nhập URL page của bạn trên Instagram.",
//            "id" => SHORT_NAME . "_instagramURL",
//            "std" => "",
//            "type" => "text"),
        array("type" => "close"),
//        array("name" => "Apps",
//            "type" => "title",
//            "desc" => ""),
//        array("type" => "open"),
//        array("name" => "DISQUS Site Shortname",
//            "desc" => "Nhập site shortname của bạn trên DISQUS để theo dõi và quản lý bình luận.",
//            "id" => SHORT_NAME . "_disqus_shortname",
//            "std" => '',
//            "type" => "text"),
//        array("type" => "close"),
        array("type" => "submit"),
    ),
);