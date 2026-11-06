
<main>
    <form action="?page=salvar" method="post">
        <h2>Novo usuário</h2>
        <input type="hidden" name="acao" value="cadastrar">
        <div>
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" placeholder="Digite seu nome" required>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Digite seu email" required>
        </div>
        <div>
            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha" placeholder="Digite sua senha" required>
        </div>
        <div>
            <label for="data_nasc">Data de nascimento</label>
            <input type="date" name="data_nasc" id="data_nasc" required>
        </div>
        <div class="btn-content">
            <button type="submit" class="btn">Enviar</button>
        </div>
    </form>
</main>