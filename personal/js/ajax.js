var reload = false;
var paged = 2;
var loading = false;
function displayBarNotification(n,c,m){
    var nNote = jQuery("#nNote");
    if(n){
        nNote.attr('class', '').addClass("nNote " + c).fadeIn().html(m);
        setTimeout(function(){
            nNote.attr('class', '').hide("slow").html("");
        }, 10000);
    }else{
        nNote.attr('class', '').hide("slow").html("");
    }
}
function displayAjaxLoading(n){
    n?jQuery(".ajax-loading-block-window").show():jQuery(".ajax-loading-block-window").hide("slow");
}
var AjaxCart = {
    loadCart: function () {
        jQuery(".cart").html("<img  src='" + themeUrl + "/images/loadingSmall.gif' />");
        jQuery.ajax({
            url: ajaxurl, type: 'GET', dataType: 'json', cache: false,
            data: {
                action: 'loadCartAjax'
            },
            success: function (response, textStatus, XMLHttpRequest) {
                if (response && response.status === 'success') {
                    jQuery(".cart").html(response.message);
                    jQuery(".cart").show();
                } else if (response.status === 'error') {
                    console.log(response.message);
                }
            },
            error: function (MLHttpRequest, textStatus, errorThrown) {
                console.log(errorThrown);
            },
            complete: function () {
            }
        });
    }
};
jQuery(document).ready(function($){
    $("#nNote").click(function(){
        $(this).attr('class', '').hide("slow").html("");
    });
});