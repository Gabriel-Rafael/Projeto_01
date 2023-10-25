<?php 
    $site = Painel::select('tb_site.config',false);
?>
<div class="box-content">
    <h2><i class="fa fa-pencil"></i> Editar Configurações do Site</h2>

    <form method="post" enctype="multipart/form-data">

        <?php 
            if(isset($_POST['acao'])){
                if(Painel::update($_POST,true)){
                    Painel::alert('sucesso','O site foi editado com sucesso!');
                    $site = Painel::select('tb_site.config',false);
                }else{
                    Painel::alert('erro','Campos vazios não são permitidos!');
                }

            }
        ?>

        <div class="form-group">
            <label>Titulo do site:</label>
            <input type="text" name="titulo" value="<?php echo $site['titulo'] ?>">
        </div>
        
        <div class="form-group">
            <label>Logo do site:</label>
            <input type="text" name="logo_nome" value="<?php echo $site['logo_nome'] ?>">
        </div>

        <div class="form-group">
            <label>Nome do autor do site:</label>
            <input type="text" name="nome_autor" value="<?php echo $site['nome_autor'] ?>">
        </div>
        
        <div class="form-group">
            <label>Descrição do autor do site:</label>
            <textarea name="descricao"><?php echo $site['descricao']; ?></textarea>
        </div>

            <?php 
                for ($i=1; $i <= 3; $i++) { 
                    # code...
            ?>

        <div class="form-group">
            <label>ícone <?php echo $i; ?>:</label>
            <input type="text" name="icone<?php echo $i; ?>" value="<?php echo $site['icone'.$i] ?>">
        </div>
        
        <div class="form-group">
            <label>Descrição do ícone <?php echo $i; ?>:</label>
            <textarea name="descricao<?php echo $i; ?>"><?php echo $site['descricao'.$i]; ?></textarea>
        </div>
            <?php } ?>
        

        <div class="form-group">
            <input type="hidden" name="nome_tabela" value="tb_site.config">
            <input type="submit" name="acao" value="Atualizar!">
        </div>
    </form>

</div>