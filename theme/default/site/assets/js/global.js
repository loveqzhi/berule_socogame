$(function(){
    $(".nav-menu").hover(function(){
        $(this).find("ul").slideDown("fast");
    },function(){
        $(this).find("ul").slideUp("fast");
    });

	$('.index-banner').unslider({
        delay: 10000, 
		fluid: true,
		dots: true
	});

    $(".history-line li:nth-child(odd)").addClass("history-right");
	$(".history-line li:nth-child(odd) .history-time").addClass("history-time-right");
	$(".history-line li:nth-child(odd) .history-arrow").addClass("history-arrow-right");

	$("a[rel=example_group]").fancybox({
		'transitionIn'	: 'none',
		'transitionOut'	: 'none',
		'titlePosition' : 'over',
		'titleFormat'	: function(title, currentArray, currentIndex, currentOpts) {
			return '<span id="fancybox-title-over">' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';	
		}
	});

	$(".soco-connect tr:nth-child(odd) td").css("background-color","#edfce9");
    
    $(".add-more").on("click",function(){
        var currentpage = $("#currentpage").val();
        var maxpage = $("#maxpage").val();
        var nowpage = parseFloat(currentpage)+1;
        var model = $(this).data('model');
        var type  = $(this).data('type');
        var size  = $(this).data('size');
        var subtype = $("#subtype").val();
        var data = {page:nowpage,size:size,type:type,model:model,subtype:subtype};

        if(currentpage < maxpage) {
            $.ajax({
                type: "POST",
                url: "/culture/json",
                data: data,
                dataType: "json",
                success: function(data){
                  if (data.status=="success") {
                    $("#currentpage").val(nowpage);
                    $(".add-more-before").before(data.data);
                    var item = $(".soco-masonry").find(".scar-list").not(".masonry-brick");
                    $(".soco-masonry").masonry('appended',item);
                    if (nowpage==maxpage) {
                        $(".content-page").css("display","none");
                    }
                  } else {
                     alert(data.msg);
                     return false;
                  }
                }
            });
            if (nowpage==maxpage) {
                $(this).css("display","none");
            }
        }
    });

    var imgPath = "/theme/default/site/assets/images";
    $('.sns-wechat').hover(
        function(){
            $('.sns-qrcode').show();
            $(this).attr("src",imgPath+"/wechat_show.png");
        },
        function(){
            $('.sns-qrcode').hide();
            $(this).attr("src",imgPath+"/wechat.png");
        }
    );
    $('.sns-weibo').hover(
        function(){
            $(this).attr("src",imgPath+"/weibo_show.png");
        },
        function(){
            $(this).attr("src",imgPath+"/weibo.png");
        }
    );

    //手机导航菜单
    $(".mobile-nav-icon").click(function(){
        var status = $(this).data('status');
        if (status=='none') {
            $(".mobile-nav").slideUp();
            $(this).data('status','block');
        } else {
            $(".mobile-nav").slideDown();
            $(this).data('status','none');
        }
    });
    
});

window.onload = function(){
    $(".soco-masonry").masonry({
        itemSelector: '.scar-list',
        columnWidth: 340
    });

};
