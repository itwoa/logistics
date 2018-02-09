$(window).on('load', function () {
	var height = $(window).outerHeight()-$(".header").height()-10;
	$("#iframe").css('height',height);
})

//导航菜单点击
var nav_index = 0;
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

    nav_index = $(".left_nav .nav_item").index($(this));
    $(".simple_nav ul").eq(nav_index).show().siblings(".simple_nav ul").hide();
});
$(".left_nav a").on("click", function () {
    $(".left_nav a,.simple_nav a").removeClass('current');
    var url = $(this).attr("href");
    $(this).addClass('current');
    $(".content").find("iframe").hide().attr("src", url);
    $(this).parents('ul').prev('.nav_item').removeClass("current");
    if(url != 'javascript:;'){
        var index = layer.load();
        $("#iframe").on('load', function () {
            layer.close(index);
            $(this).fadeIn(10);
        })
    }
   
    $(".simple_nav a").eq($(".left_nav a").index($(this))).addClass('current');
});

//精简菜单点击
var simple_index = 0;
$(".simple_nav .nav_item").on('click',function(){
    $('.nav_item').removeClass('current'); 
    $(this).addClass('current');
    $(this).next('ul').toggle(300).siblings('ul').hide();

    if($("i",this).hasClass('fa-caret-down')){
        $("i",this).removeClass('fa-caret-down').addClass("fa-caret-right");
    }else{
        $("i",this).removeClass('fa-caret-right').addClass("fa-caret-down");
    }         
    $(this).siblings(".nav_item").find("i").removeClass('fa-caret-down').addClass("fa-caret-right");

    simple_index = $(".simple_nav .nav_item").index($(this));
    $(".left_nav ul").eq(simple_index).show().siblings(".left_nav ul").hide();
});

$(".simple_nav a").on("click", function () {
    $(".simple_nav a,.left_nav a").removeClass('current');
    var url = $(this).attr("href");
    $(this).addClass('current');
    $(".content").find("iframe").hide().attr("src", url);
    $(this).parents('ul').prev('.nav_item').removeClass("current");
    if(url != 'javascript:;'){
        var index = layer.load();
        $("#iframe").on('load', function () {
            layer.close(index);
            $(this).fadeIn(10);
        })
    }
    
    $(".left_nav a").eq($(".simple_nav a").index($(this))).addClass('current');
});

//菜单的tip提示
$(".simple_nav .nav_item,.simple_nav ul li").hover(function(){
    var tit = $(this).attr('title');
    var index = layer.tips(tit, $(this));
},function(){
    layer.closeAll();
});
//导航菜单切换显示
$(".logo .fa-bars").unbind().on("click",function(){
    $(this).toggleClass("show");
    $(".left_nav,.simple_nav").toggleClass('dn');
    var left = $(this).hasClass('show')?40:180;
    $(".main_box .content .iframe").css("marginLeft",left);

});
//管理控制台跳转
$("#control").on("click",function(){
    $(".left_nav a,.nav_item").removeClass('current');
    $(".left_nav ul").hide();
});
//显示用户信息
$(".user_name").off().hover(function(){
    $(".topbar").toggleClass("dn");
})


