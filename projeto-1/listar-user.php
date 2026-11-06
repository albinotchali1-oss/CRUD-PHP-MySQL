<div class="list-content">
    <h2>Usuários cadastrados</h2>
    <?php 
        $sql = "SELECT * FROM usuarios";
        $res = $conn->query($sql);
        $qtd = $res->num_rows;

        if($qtd > 0){
        ?>

        <div class="list-head">
                <div>#</div>
                <div>Nome</div>
                <div>Email</div>
                <div>Data de nascimento</div>
                <div>Ações</div>
        </div>
        <div class="list-body">
        <?php while ($row = $res->fetch_object()) { ?>
        <div class="list-dados">
                <div><?php print $row->id;?></div>
                <div><?php print $row->nome;?></div>
                <div><?php print $row->email;?></div>
                <div><?php print $row->data_nasc;?></div>
                <div class="btn-content">
                    <?php 
                    print "<button class='btn btn-edit' onclick=\"location.href='?page=editar&id=".$row->id."';\"> Editar </button>";

                    print "<button class='btn btn-del' onclick=\"if(confirm('Deseja excluir usuário?')){location.href='?page=salvar&acao=excluir&id=".$row->id."';}else{false;}\">Excluir</button>";
                    ?>
                </div>
        </div>
    <?php }
        print "</div>";
        }else{
            print "<p>Nenhum usuário encontrado</p>";
        }
    ?>
</div>