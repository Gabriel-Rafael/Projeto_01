$(function () {

    var open = true;
    var windowSize = $(window)[0].innerWidth;

    var targetSizeMenu = (windowSize <= 400) ? 200 : 250;

    if(windowSize <= 768){
        $('.menu').css('width','0').css('padding','0');
        open = false;
    }

    $('.menu-btn').click(function(){
        if(open){
            $('.menu').animate({'width':0,'padding':0},function(){
                open = false;
            });
            $('.content,header').css('width','100%');
            $('.content,header').animate({'left':0},function(){
                open = false;
            });
        }else{
            $('.menu').css('display','block');
            $('.menu').animate({'width':targetSizeMenu+'px','padding':'10px'},function(){
                open = true;
            });
            //$('.content,header').css('width','calc(100% - 300px)');
            $('.content,header').animate({'left':targetSizeMenu+'px'},function(){
                open = true;
            });
        }
    })

    $(window).resize(function(){
		if($(window)[0].innerWidth != windowSize){
		windowSize = $(window)[0].innerWidth;
		targetSizeMenu = (windowSize <= 400) ? 200 : 250;
		if(windowSize <= 768){
			$('.menu').css('width','0').css('padding','0');
			$('.content,header').css('width','100%').css('left','0');
			open = false;
		}else{
			$('.menu').animate({'width':targetSizeMenu+'px','padding':'10px 0'},function(){
				open = true;
			});

			$('.content,header').css('width','calc(100% - 250px)');
			$('.content,header').animate({'left':targetSizeMenu+'px'},function(){
			open = true;
			});
		}
		}
	})

    $('[formato=data]').mask('99/99/9999');

    $('[actionBtn=delete]').click(function(){
        let text;
        if (confirm("Deseja excluir o registro?") == true) {
            return true;
        } else {
            return false;
        }
    })

})