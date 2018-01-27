$(window).on('load', function () {
	var height = $(window).outerHeight()-$(".header").height()-40;
	$("#iframe").css('height',height);
	console.log($(window).outerHeight());
})
/*左侧导航点击*/
$(".left_nav a").on("click", function () {
    $(".left_nav a").removeClass('current');
    var url = $(this).attr("href");
    $(this).addClass('current');
    $(".content").find("iframe").hide().attr("src", url);
    var index = layer.load();

    $("#iframe").on('load', function () {
        layer.close(index);
        $(this).fadeIn();
    })
});



