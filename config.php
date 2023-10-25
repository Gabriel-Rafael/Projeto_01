<?php   

    session_start();
    date_default_timezone_set('America/Porto_Velho');
    $autoload = function($class){
        if($class == 'Email'){
            include('classes/phpmailer/PHPMailerAutoload.php');
        }
        include('classes/'.$class.'.php');
    };

    spl_autoload_register($autoload);

    define('BASE_DIR_PAINEL',__DIR__.'/painel');
    
    //Conctar com o banco de dados
    define('INCLUDE_PATH','http://localhost/Curso/Projeto_01/');
    define('INCLUDE_PATH_PAINEL',INCLUDE_PATH.'painel/');
    define('HOST','localhost');
    define('USER','root');
    define('PASSWORD','');
    define('DATABASE','projeto_01');

    //Constantes para o painel de controle
    define('NOME_EMPRESA','Projeto_01');

    //Funções do painel
    function pegaCargo($indice){
            return Painel::$cargos[$indice];
    }
    
    function selecionadoMenu($par){
        $url = explode('/',@$_GET['url'])[0];
        if($url == $par){
            echo 'class = "menu-active"';
        } 
    
    }

    function verificaPermissaoMenu($permissao){
        if($_SESSION['cargo'] >= $permissao){
            return;
        }else{
            echo 'style="display:none;"';
        }
    }

    function verificaPermissaoPagina($permissao){
        if($_SESSION['cargo'] >= $permissao){
            return;
        }else{
            include('painel/pages/permissao-negada.php');
            die();
        }
    }

    function recoverPost($post){
        if(isset($_POST[$post])){
            echo $_POST[$post];
        }
    }


?>