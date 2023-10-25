<?php
	if(isset($_GET['loggout'])){
		Painel::loggout();
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH_PAINEL ?>./css/style.css">
    <title>Painel de Controle</title>
</head>

<body>

<div class="menu">
    <div class="menu-wraper">
    <div class="box-usuario">
        <?php 
            if($_SESSION['img'] == ''){
        ?>
        <div class="avatar-usuario">
            <i class="fa fa-user"></i>
        </div>
        <?php }else{ ?>
            <div class="imagem-usuario">
            <img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $_SESSION['img']; ?>"/>
        </div>
        <?php } ?>
        <div class="nome-usuario">
            <p><?php echo $_SESSION['nome']; ?></p>
            <p><?php echo pegaCargo($_SESSION['cargo']); ?></p>
        </div>
    </div>
    
    <div class="items-menu">
        <h2>Cadastro</h2>
        <a <?php selecionadoMenu('cadastrar-depoimento'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-depoimento">Cadastrar Depoimento</a>
        <a <?php selecionadoMenu('cadastrar-servico'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-servico">Cadastrar Servico</a>
        <a <?php selecionadoMenu('cadastrar-slides'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-slides">Cadastrar Slides</a>
        <h2>Gestão</h2>
        <a <?php selecionadoMenu('listar-depoimentos'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>listar-depoimento">Listar Depoimentos</a>
        <a <?php selecionadoMenu('listar-servicos'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>listar-servicos">Listar Serviços</a>
        <a <?php selecionadoMenu('listar-slides'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>listar-slides">Listar Slides</a>
        <h2>Administração do painel</h2>
        <a <?php selecionadoMenu('editar-usuario'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>editar-usuario">Editar Usuário</a>
        <a <?php selecionadoMenu('adicionar-usuario'); ?> <?php verificaPermissaoMenu(2); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>adicionar-usuario">Adicionar Usuários</a>
        <h2>Configuração Geral</h2>
        <a <?php selecionadoMenu('editar-site'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>editar-site">Editar Site</a>

        <a <?php selecionadoMenu('cadastrar-categorias'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-categorias">Cadastrar Categorias</a>
        <a <?php selecionadoMenu('gerenciar-categorias'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-categorias">Gerenciar Categorias</a>
        <a <?php selecionadoMenu('cadastrar-noticia'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-noticia">Cadastrar Notícias</a>
        <a <?php selecionadoMenu('gerenciar-noticias'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-noticias">Gerenciar Notícias</a>
    </div>
    </div>
</div><!-- menu -->

<header>
    <div class="center">
        <div class="menu-btn">
            <i class="fa fa-bars"></i>
        </div>
        <div class="loggout">
            <a <?php if(@$_GET['url'] == ''){ ?> style="background: #0d47a1;padding: 15px;" <?php } ?>   href="<?php echo INCLUDE_PATH_PAINEL ?>"><i class="fa fa-home"></i><span>Pagina Inicial</span></a>
            <a href="<?php echo INCLUDE_PATH_PAINEL ?>?loggout"><i class="fa fa-window-close"> </i><span>Sair</span></a>
        </div>
        <div class="clear"></div>
    </div>
</header>

<div class="content">
    
    <?php Painel::carregarPagina(); ?>

</div>

<script src="<?php echo INCLUDE_PATH ?>js/jquery.js"></script>
<script src="<?php echo INCLUDE_PATH_PAINEL ?>js/jquery.mask.js"></script>
<script src="<?php echo INCLUDE_PATH_PAINEL ?>js/main.js"></script>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: '.tinymce',
      });
    </script>
</body>
</html>