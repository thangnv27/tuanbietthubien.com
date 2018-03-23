<?php

function sendOrder() {
    $title = getRequest('title');
    $quantity = getRequest('quantity');
    $fullname = getRequest('fullname');
    $email = getRequest('email');
    $phone = getRequest('phone');
    $address = getRequest('address');
    
    $admin_email = get_option("contact_email");
    if (!is_email($admin_email)) {
        $admin_email = get_settings('admin_email');
    }
    $attributes = array(
        'title' => $title,
        'quantity' => $quantity,
        'fullname' => $fullname,
        'email' => $email,
        'phone' => $phone,
        'address' => $address,
    );
    $bill_html = get_template_html( 'template/mail-order', $attributes );
    $subject = get_bloginfo('name') . " - Xác nhận đơn hàng";

    add_filter('wp_mail_content_type', 'set_html_content_type');
    wp_mail($email, $subject, $bill_html);
    wp_mail($admin_email, $subject, $bill_html);

    // reset content-type to avoid conflicts
    remove_filter('wp_mail_content_type', 'set_html_content_type');
    
    Response(json_encode(array(
        'status' => 'success',
        'message' => __('Đặt hàng thành công! Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất!', SHORT_NAME)
    )));
    exit;
}