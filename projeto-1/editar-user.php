<main>
    <?php
        $sql= "SELECT * FROM usuarios WHERE id=".$_REQUEST['id'];
        $res = $conn->query($sql);

        $row = $res->fetch_object();
    
    ?>
    <form action="?page=salvar" method="post">
        <h2>Editar usuário</h2>
        <input type="hidden" name="acao" value="editar">
        <input type="hidden" name="id" value="<?php print $row->id;?>">
        <div>
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" value="<?php print $row->nome; ?>" placeholder="Digite seu nome" required>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?php print $row->email; ?>" placeholder="Digite seu email" required>
        </div>
        <div>
            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha" placeholder="Digite sua senha" required>
        </div>
        <div>
            <label for="data_nasc">Data de nascimento</label>
            <input type="date" name="data_nasc" id="data_nasc" value="<?php print $row->data_nasc; ?>" required>
        </div>
        <div class="btn-content">
            <button type="submit" class="btn">Editar</button>
        </div>
    </form>
</main>