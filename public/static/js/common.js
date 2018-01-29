/**
 * [stopRepetAjax 禁止重复提交ajax请求]
 * @param  {[Boolean]} order [true:放弃先触发;false:放弃后触发]
 */
function stopRepetAjax(order) {
    var pendingRequests = {};
    $.ajaxPrefilter(function(options, originalOptions, jqXHR) {
        var key = options.url;
        if (!pendingRequests[key]) {
            pendingRequests[key] = jqXHR;
        } else {
            order ? pendingRequests[key].abort() : jqXHR.abort();
        }
        var complete = options.complete;
        options.complete = function(jqXHR, textStatus) {
            pendingRequests[key] = null;
            if ($.isFunction(complete)) {
                complete.apply(this, arguments);
            }
        };
    });
}

/*面包屑导航点击*/
$('.crumbs a').on('click',function(e){    
    var title = $(this).text();
    $nav = $(".left_nav ul li",window.parent.document);
    $nav.find('a').removeClass('current');
    $(".left_nav ul li",window.parent.document).each(function(i,j){
        if($(this).text() == title){
            $(this).find('a').addClass('current');
        }
    })
});