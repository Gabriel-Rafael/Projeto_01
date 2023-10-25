$(function() {
    var curSlide = 0;

    var maxSlide = $('.banner-single').length - 1;

    initSlider();
    function initSlider() {
        $('.banner-single').hide();
        $('.banner-single').eq(0).show();
        for(var i = 0; i < maxSlide+1; i++) {
            var content = $('.bullets').html();
            if(i == 0)
                content+='<span class="active-slider"></span>';
            else
                content+='<span></span>';
            $('.bullets').html(content);
        }
    }

    changeSlide();
        function changeSlide(){
            setInterval(function(){
                $('.banner-single').eq(curSlide).stop().fadeOut();
                curSlide++;
                if(curSlide > maxSlide)
                    curSlide = 0;
                $('.banner-single').eq(curSlide).stop().fadeIn();
                //Trocar bullets da navegação do slider
                $('.bullets span').removeClass('active-slider');
                $('.bullets span').eq(curSlide).addClass('active-slider');
            },3000);
        }
  
        $('body').on('click','.bullets span',function(){
            var currentBullet = $(this);
            $('.banner-single').eq(curSlide).stop().fadeOut();
            curSlide = currentBullet.index();
            $('.banner-single').eq(curSlide).stop().fadeIn();
            $('.bullets span').removeClass('active-slider');
            currentBullet.addClass('active-slider');
        })
        
})