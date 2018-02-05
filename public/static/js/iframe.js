$(window).on('load', function () {
	var height = $(window).outerHeight()-$(".header").height()-40;
	$("#iframe").css('height',height);
})

//导航一级菜单
$(".left_nav .nav_item").on('click',function(){
    $('.nav_item').removeClass('current');
    
    $(this).addClass('current');
    $(this).next('ul').toggle(300).siblings('ul').hide();

    if($("i",this).hasClass('fa-caret-down')){
        $("i",this).removeClass('fa-caret-down').addClass("fa-caret-right");
    }else{
        $("i",this).removeClass('fa-caret-right').addClass("fa-caret-down");
    }
    
    $(this).siblings(".nav_item").find("i").removeClass('fa-caret-down').addClass("fa-caret-right");

});

//导航二级菜单
$(".left_nav a").on("click", function () {
    $(".left_nav a").removeClass('current');
    var url = $(this).attr("href");
    $(this).addClass('current');
    $(".content").find("iframe").hide().attr("src", url);
    $(this).parents('ul').prev('.nav_item').removeClass("current");
    var index = layer.load();

    $("#iframe").on('load', function () {
        layer.close(index);
        $(this).fadeIn();
    })
});



