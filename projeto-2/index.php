<?php

session_start();

require_once __DIR__ . '/config/database.php';
$sql = 'SELECT id, nome, sobrenome, data_nasc FROM usuarios ORDER BY id DESC';
$stmt = $pdo->query($sql);
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
$errosCadastro = $_SESSION['erros_cadastro'] ?? [];
$dadosCadastro = $_SESSION['dados_cadastro'] ?? [];
$sucessoCadastro = $_SESSION['sucesso_cadastro'] ?? '';
unset($_SESSION['erros_cadastro'], $_SESSION['dados_cadastro'], $_SESSION['sucesso_cadastro']);
?>

<?php require __DIR__ . '/includes/header.php'; ?>
<main class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <h1 class="mb-4">Cadastro de usuário</h1>

            <?php if ($errosCadastro): ?>
                <div class="alert alert-danger" role="alert">
                    <ul class="mb-0">
                        <?php foreach ($errosCadastro as $erroCadastro): ?>
                            <li><?= htmlspecialchars($erroCadastro, ENT_QUOTES, 'UTF-8') ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            <?php if ($sucessoCadastro !== ''): ?>
                <div class="alert alert-success" role="status"><?= htmlspecialchars($sucessoCadastro, ENT_QUOTES, 'UTF-8') ?></div>
            <?php endif; ?>

            <section class="mb-5">
                <form action="cadastro.php" method="POST">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" maxlength="100" required
                               value="<?= htmlspecialchars($dadosCadastro['nome'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                    </div>

                    <div class="mb-3">
                        <label for="sobrenome" class="form-label">Sobrenome</label>
                        <input type="text" class="form-control" id="sobrenome" name="sobrenome" maxlength="100" required
                               value="<?= htmlspecialchars($dadosCadastro['sobrenome'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                    </div>

                    <div class="mb-3">
                        <label for="data_nasc" class="form-label">Data de nascimento</label>
                        <input type="date" class="form-control" id="data_nasc" name="data_nasc" max="<?= date('Y-m-d') ?>" required
                               value="<?= htmlspecialchars($dadosCadastro['data_nasc'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                    </div>

                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </form>
            </section>

            <section>
                <h2 class="h4 mb-3">Usuários cadastrados</h2>
                <?php if ($usuarios): ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead>
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Sobrenome</th>
                                    <th scope="col">Data de nascimento</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($usuarios as $usuario): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($usuario['nome'], ENT_QUOTES, 'UTF-8') ?></td>
                                        <td><?= htmlspecialchars($usuario['sobrenome'], ENT_QUOTES, 'UTF-8') ?></td>
                                        <td><?= htmlspecialchars(date('d/m/Y', strtotime($usuario['data_nasc'])), ENT_QUOTES, 'UTF-8') ?></td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a class="btn btn-sm btn-outline-primary" href="usuario.php?id=<?= (int) $usuario['id'] ?>&acao=ver">Ver</a>
                                                <a class="btn btn-sm btn-outline-secondary" href="usuario.php?id=<?= (int) $usuario['id'] ?>&acao=editar">Editar</a>
                                                <form action="excluir.php" method="post" onsubmit="return confirm('Deseja realmente excluir este usuário?');">
                                                    <input type="hidden" name="id" value="<?= (int) $usuario['id'] ?>">
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">Excluir</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="text-body-secondary">Nenhum usuário cadastrado.</p>
                <?php endif; ?>
            </section>
        </div>
    </div>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
