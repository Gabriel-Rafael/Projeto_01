$(function(){

    $('nav.mobile').click(function(){
        var listaMenu = $('nav.mobile ul');
        //Abrir menu mobile através do fadeIn
        /*
        if(listaMenu.is(':hidden') == true)
            listaMenu.fadeIn();
        else
            listaMenu.fadeOut();
        */

        //Abrir ou fechar sem efeitos

        /*
        if(listaMenu.is(':hidden') == true)
            listaMenu.fadeIn();
        else
            listaMenu.fadeOut();
        */

        if(listaMenu.is(':hidden') == true){
            var icone = $('.botao-menu-mobile').find('i');
            icone.removeClass('fa-bars');
            icone.addClass('fa-xmark')
            listaMenu.slideToggle();
        }
        else{
            var icone = $('.botao-menu-mobile').find('i');
            icone.removeClass('fa-xmark');
            icone.addClass('fa-bars')
            listaMenu.slideToggle();
        }

    });

    if($('target').length > 0){
        var elemento = '#'+$('target').attr('target');
        
        var divsCroll = $(elemento).offset().top;

        $('html,body').animate({'scrollTop': divsCroll},1000)
    }

    carregarDinamico();
    function carregarDinamico(){
        $('[realtime]').click(function(){
            var pagina = $(this).attr('realtime');
            $('.container-principal').hide();
            $('.container-principal').load(INCLUDE_PATH+'pages/'+pagina+'.php');
            
            setTimeout(function(){
                initialize();
                addMarker()
            });

            $('.container-principal').fadeIn(1000);
            window.hisoty.pushState('','', pagina);

            return false;
        })
    }

})
