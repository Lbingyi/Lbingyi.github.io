// JavaScript Document
//===TAB切换===
$(function(){
	$('.tabPanel ul li').click(function(){
		$(this).addClass('hit').siblings().removeClass('hit');
		$('.leng-amount>div:eq('+$(this).index()+')').show().siblings().hide();
	})
});
$(function(){
	$('.tabPay ul li').click(function(){
		$(this).addClass('selected').siblings().removeClass('selected');
		$('.pay-container>div:eq('+$(this).index()+')').show().siblings().hide();
	})
});


//===向上滚动===
!function(o){"use strict";o.fn.toTop=function(t){var i=this,e=o(window),s=o("html, body"),n=o.extend({autohide:!0,speed:500,position:!0,right:0},t);i.css({cursor:"pointer"}),n.autohide&&i.css("display","block"),n.position&&i.css({position:"fixed",right:n.right}),i.click(function(){s.animate({scrollTop:0},n.speed)}),e.scroll(function(){var o=e.scrollTop();n.autohide&&(o>n.offset?i.fadeIn(n.speed):i.fadeOut(n.speed))})}}(jQuery);


//===会员ID下拉信息===
$(document).ready(function(){
	//$("ul.subnav").parent().append("<a></a>"); 只显示下拉时已启用 js-触发后 ul.subnav 添加空 a 标记
		$(".topnav a.username").hover(function() { //在单击(.click)触发器时......
		//下列事件应用于 subnav 本身 （向上和向下移动 subnav)
		$(this).parent().parent().find("ul.subnav").slideDown(200).show(200); //下拉列表上单击 subnav.slideDown
		$("#tabs ul li a.first").click(function(){
		$(this).addClass("a.first").siblings().removeClass("a.first");
		})

		$(this).parent().hover(function() {
		}, function(){
			$(this).parent().parent().find("ul.subnav").slideUp(200) //当鼠标悬停从 subnav 时，将其移动备份
		});

		//以下事件被适用于 （悬停事件触发器） 的触发器
		}).hover(function() {
			$(this).addClass("subhover"); //上悬停，添加类"subhover"
		}, function(){	//悬停时出
			$(this).removeClass("subhover"); //悬停时出去，删除"subhover"类
	});

});
var timerCountDown ;
var validCode=true;
var time=120;
//====获取短信验证码====
$(function  () {
	//获取短信验证码

	$(".countdown").click (function  () {
		var code=$(this);
		if (validCode) {
			validCode=false;
			code.addClass("countdown1");
			timerCountDown =setInterval(function  () {
			time--;
			code.html(time+"秒");
			if (time<=0) {
				clearInterval(timerCountDown);
				code.html("重新获取");
				validCode=true;
				code.removeClass("countdown1");
			}
		},1000)
		}
	});

});
function cancel_count_down()
{
	time = 120;
	window.clearInterval(timerCountDown);
	var code = $(".countdown");
	code.html("重新获取");
	validCode=true;
}
//====充值卡选择对象====
$(function(){
	$(".price-list ol li").click(function(){
		$(this).addClass("Listrclickem").siblings().removeClass("Listrclickem");
	})
});
$(function(){
	$(".leng-section ul li.leng-detail").click(function(){
		$(this).addClass("leng-selected").siblings().removeClass("leng-selected");
	})
});

//====选择对象对应数值====
$(function(){
	$('.platform ul li').click(function(){
		var thisToggle = $(this).is('.type') ? $(this) : $(this).prev();
		var checkBox = thisToggle.prev();
		checkBox.trigger('click');
		$('.type').removeClass('checked');
		thisToggle.addClass('checked');
		return false;
	});
});


function getSelectedValue(id){
	return ;
	$("#" + id).find(".pay-summary em#paymoney.value").html();
};


//=====会员升级，银行展开=====
$(function(){
    $(".openBank").click(function(){
        $(".floorBank").slideToggle("fast",function(){ });
    });
});



