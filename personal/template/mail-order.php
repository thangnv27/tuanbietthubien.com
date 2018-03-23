<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<div style="font-family: Calibri,sans-serif;line-height: 13px;font-size: 14px;">
    <h1 style="text-align: center; font-size: 20px;text-transform: uppercase;margin-top: 5px;padding-top: 5px">
        <?php _e('XÁC NHẬN THÔNG TIN ĐẶT HÀNG', SHORT_NAME) ?>
    </h1>
    <div style="margin-bottom: 15px;padding-bottom: 15px">
        <p><strong><?php _e('Sản phẩm', SHORT_NAME) ?></strong>: <?php echo $attributes['title'] ?></p>
        <p><strong><?php _e('Số lượng', SHORT_NAME) ?></strong>: <?php echo $attributes['quantity'] ?></p>
        <p><strong><?php _e('Họ và tên', SHORT_NAME) ?></strong>: <?php echo $attributes['fullname'] ?></p>
        <p><strong><?php _e('Địa chỉ Email', SHORT_NAME) ?></strong>: <?php echo $attributes['email'] ?></p>
        <p><strong><?php _e('Số điện thoại', SHORT_NAME) ?></strong>: <?php echo $attributes['phone'] ?></p>
        <p><strong><?php _e('Địa chỉ', SHORT_NAME) ?></strong>: <?php echo $attributes['address'] ?></p>
    </div>
    <div>
        <table width="100%" border="0" cellpadding="0" cellspacing="0" style="border: none;width: 100%">
            <tr>
                <td style="vertical-align: top" valign="top">
                    <p><strong><?php _e('Khách hàng', SHORT_NAME) ?></strong></p>
                    <h3 style="text-transform: uppercase"><?php echo $attributes['fullname'] ?></h3>
                </td>
                <td style="text-align: right;vertical-align: top" align="right" valign="top">
                    <p style="text-align: right;">Hà Nội, <?php echo date("d/m/Y") ?></p>
                    <h3 style="text-transform: uppercase"><?php echo get_option('unit_owner') ?></h3>
                </td>
            </tr>
        </table>
    </div>
</div>