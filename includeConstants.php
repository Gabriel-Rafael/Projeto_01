<?php 
        session_start();
        date_default_timezone_set('America/Porto_Velho');
        require('vendor/autoload.php');
        $autoload = function($class){
            if($class == 'Email'){
                include('classes/phpmailer/PHPMailerAutoload.php');
            }
            include('classes/'.$class.'.php');
        };
    
        spl_autoload_register($autoload);

        define('INCLUDE_PATH','http://localhost/Curso/Projeto_01/');
        define('INCLUDE_PATH_PAINEL',INCLUDE_PATH.'painel/');
        
        define('BASE_DIR_PAINEL',__DIR__.'/painel');
            //Conctar com o banco de dados
            define('HOST','localhost');
            define('USER','root');
            define('PASSWORD','');
            define('DATABASE','projeto_01');
        
            //Constantes para o painel de controle
            define('NOME_EMPRESA','Projeto_01');
?>