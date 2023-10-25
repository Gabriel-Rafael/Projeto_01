<?php
    if(isset($_GET['id'])){
        $id = (int)$_GET['id'];
        $noticia = Painel::select('tb_site.noticias','id = ?',array($id));
    }else{
        Painel::alert('erro','Você precisa passar o parametro ID.');
        die();
    }
?>
<div class="box-content">
    <h2><i class="fa fa-pencil"></i> Editar Notícia</h2>

    <form method="post" enctype="multipart/form-data">

        <?php 
            if(isset($_POST['acao'])){
                
                
                $nome = $_POST['titulo'];
                $conteudo = $_POST['conteudo'];
                $imagem = $_FILES['capa'];
                $imagem_atual = $_POST['imagem_atual'];
                $verifica = MySql::conectar()->prepare("SELECT `id` FROM `tb_site.noticias` WHERE titulo = ? AND categoria_id = ? AND id != ?");
                $verifica->execute(array($nome,$_POST['categoria_id'],$id));
                if($verifica->rowCount() == 0){
                if($imagem['name'] != ''){
                    //Existe o upload de imagem.
                    if(Painel::imagemValida($imagem)){
                        Painel::deleteFile($imagem_atual);
                        $imagem = Painel::uploadFile($imagem);
                        $slug = Painel::generateSlug($nome);
                        $arr = ['titulo'=>$nome,'data'=>date('Y-m-d'),'categoria_id'=>$_POST['categoria_id'],'conteudo'=>$conteudo,'capa'=>$imagem,'slug'=>$slug,'id' => $id,'nome_tabela'=>'tb_site.noticias'];
                        Painel::update($arr);
                        $noticia = Painel::select('tb_site.noticias','id = ?',array($id));
                        Painel::alert('sucesso','O notícia foi editada junto com a imagem');
                    }else{
                        Painel::alert('erro','O formato da imagem não é valido');
                    }
                }else{
                    $imagem = $imagem_atual;
                    $slug = Painel::generateSlug($nome);
                    $arr = ['titulo'=>$nome,'categoria_id'=>$_POST['categoria_id'],'conteudo'=>$conteudo,'capa'=>$imagem,'slug'=>$slug,'id' => $id,'nome_tabela'=>'tb_site.noticias'];
                    Painel::update($arr);
                    $noticia = Painel::select('tb_site.noticias','id = ?',array($id));
                    Painel::alert('sucesso','O notícia foi editada com sucesso');
                }
                }else{
                    Painel::alert('erro','Já existe uma notícia com este nome!');
                }
            }
        ?>

        <div class="form-group">
            <label>Nome:</label>
            <input type="text" name="titulo" required value="<?php echo $noticia['titulo']; ?>" >
        </div>

        <div class="form-group">
            <label>Couteúdo:</label>
            <textarea class="tinymce" name="conteudo"><?php echo $noticia['conteudo'] ?></textarea>
        </div>

        <div class="form-group">
            <label>Categoria:</label>
            <select name="categoria_id">
                <?php 
                    $categorias = Painel::selectAll('tb_site.categorias');
                    foreach($categorias as $key => $value){
                ?>
                <option <?php if($value['id'] == $noticia['categoria_id']) echo 'selected'; ?> value="<?php echo $value['id'] ?>"><?php echo $value['nome']; ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label>Imagem</label>
            <input type="file" name="capa" >
            <input type="hidden" name="imagem_atual" value="<?php echo $noticia['capa']; ?>">
        </div>

        <div class="form-group">
            <input type="submit" name="acao" value="Atualizar!" required>
        </div>
    </form>

</div>