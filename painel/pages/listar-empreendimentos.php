
<div class="box-content">
    <h2><i class="fa fa-pencil"></i> Empreendimentos</h2>
    <div class="busca">
        <form method="post">
            <h4><i class="fa fa-search"></i> Realizar uma busca</h4>
            <input style="font-size: 15px;" placeholder="Procure pelo nome do empreendimento" type="text" name="busca">
            <input type="submit" name="acao" value="Buscar!">
        </form>
    </div><!--busca-->
    <?php

        if(isset($_GET['deletar'])){
            $id = (int)$_GET['deletar'];
            $imagens = MySql::conectar()->prepare("SELECT `imagem` FROM `tb_admin.empreendimentos` WHERE id = $id");
            $imagens->execute();
            $imagens = $imagens->fetch();
            @unlink(BASE_DIR_PAINEL.'/uploads/'.$imagens['imagem']);
            
            $imoveis = MySql::conectar()->prepare("SELECT * FROM `tb_admin.imoveis` WHERE empreend_id = $id");
            $imoveis->execute();
            $imoveis = $imoveis->fetchAll();
            foreach ($imoveis as $key => $value) {
                $imagens = MySql::conectar()->prepare("SELECT * FROM `tb_admin.imagens_imoveis` WHERE imovel_id = $value[id]");
                $imagens->execute();
                $imagens = $imagens->fetchAll();
                foreach ($imagens as $key2 => $value2) {
                    @unlink(BASE_DIR_PAINEL.'/uploads/'.$value2['imagem']);
                    MySql::conectar()->exec("DELETE FROM `tb_admin.imagens_imoveis` WHERE id = $value2[id]");
                }
                
            }
            MySql::conectar()->exec("DELETE FROM `tb_admin.imoveis` WHERE empreend_id = $id");
            MySql::conectar()->exec("DELETE FROM `tb_admin.empreendimentos` WHERE id = $id");
            Painel::alert('sucesso',"O empreendimento foi deletado com sucesso!");
        }


    ?>
    <div class="boxes">
    <?php 
        $query = "";
        if(isset($_POST['acao']) && $_POST['acao'] == 'Buscar!'){
            $nome = $_POST['busca'];
            $query = "WHERE (nome LIKE '%$nome%')";
        }
        if($query == ''){
            $query2 = "";
        }else{
            $query2 = "";
        }
        $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.empreendimentos` $query ORDER BY order_id ASC");

        $sql->execute();
        $produtos = $sql->fetchAll();
        if($query != ''){
            echo '<div style="width:100%;" class = "busca-result"><p>Foram encontrados <b>'.count($produtos).'</b> resultado(s)</p></div>';
        }
        foreach ($produtos as $key => $value) {

    ?>
    
        <div id="item-<?php echo $value['id']; ?>" class="box-single-wraper">
            <div style="border: 1px solid #ccc;height:100%;">
            <div style="width: 100%;float:left;" class="box-imgs">

            <img class="img-square" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value['imagem'] ?>" alt="">

            </div>
            <div style="width: 70%;float:left;border:0;" class="box-single">
                <div class="body-box">
                    <p><b><i class="fa-solid fa-circle-info"></i> Nome:</b> <?php echo $value['nome'] ?></p>
                    <p><b><i class="fa-solid fa-circle-info"></i> Tipo:</b> <?php echo ucfirst($value['tipo']) ?></p>

                    <div class="group-btn">
                        <a class="btn delete" item_id="<?php echo $value['id'] ?>" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-empreendimentos?deletar=<?php echo $value['id']; ?>"><i class="fa fa-times"></i> Excluir</a>
                        <a style="background: #0091ea;" class="btn" href="<?php echo INCLUDE_PATH_PAINEL ?>visualizar-empreendimento/<?php echo $value['id']; ?>"><i class="fa-solid fa-eye"></i> Visualizar</a>
                    </div>
                </div><!--body-box-->
            </div><!--box-single-->
            <div class="clear"></div>
            </div>
        </div><!--box-single-wraper-->

        <?php } ?>


        <div class="clear"></div>

    </div><!--boxes-->

</div><!--box-content-->