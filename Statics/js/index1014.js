
$(function () {
    roll($('.container>div'));
    $(window).scroll(function () {roll($('.container>div'));});
    function roll(obj) {
        var win_height = $(window).height();
        var scroll_top = $(window).scrollTop();
        obj.each(function (i) {
            var Name = obj.eq(i).attr('class');
            var obj_top = obj.eq(i).offset().top;
            if((scroll_top + win_height) > obj_top&&obj.eq(i).attr('class')==='two anim-start'){
               $('.two_ani i').addClass('ti_add')
            }
            if ((scroll_top + win_height) > obj_top) {
                obj.eq(i).addClass("anim-go anim-end");
            };

        })
    };
    var Index=$('.article_left dd.active').parent('dl').index();
    if( $('.article_left dl').eq(Index).hasClass('active')){
        $('.article_left dl').eq(Index).show()
        $('.article_left dl').eq(Index).find('dd').show();
    }else{
        $('.article_left dl').eq(Index).find('dd').show();
        $('.article_left dl').eq(Index).addClass('active').siblings().removeClass('active');
    }

    $('.main li').css({width:'180px'});
    $('.cover1 li').eq(0).css({width:'153px'}).eq(10).css({width:'147px'})
    $('.cover li').eq(0).css({width:'153px'}).eq(10).css({width:'147px'})
    $('#cover1 li').hover(function () {
        var Index = $(this).index()
        $('#cover li').eq(Index).stop().animate({'opacity':0})
    },function () {
        var Index = $(this).index()
        $('#cover li').eq(Index).stop().animate({'opacity':1})
    })
    $('.hl_admin').hover(function () {
        $(this).find('ul').slideDown()
    },function () {
        $(this).find('ul').stop().slideToggle()
    })
    $('.article_left dt').click(function () {
        var Index = $(this).parent().index();
        $(this).parent().addClass('active').siblings().removeClass('active')
        $(this).siblings('dd').slideDown();
        $(this).parent('dl').siblings().find('dd').slideUp()
    })




})