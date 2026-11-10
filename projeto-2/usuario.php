<?php
require_once __DIR__ . '/config/database.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$acao = $_GET['acao'] ?? '';
$erro = '';
$usuario = null;

if (!$id || !in_array($acao, ['ver', 'editar'], true)) {
    http_response_code(400);
    $erro = 'Solicitação inválida.';
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $acao === 'editar') {
        $nomeEnviado = $_POST['nome'] ?? '';
        $sobrenomeEnviado = $_POST['sobrenome'] ?? '';
        $dataNascEnviada = $_POST['data_nasc'] ?? '';

        if (!is_string($nomeEnviado) || !is_string($sobrenomeEnviado) || !is_string($dataNascEnviada)) {
            $erro = 'Preencha os campos com valores válidos.';
        } else {
            $nome = trim($nomeEnviado);
            $sobrenome = trim($sobrenomeEnviado);
            $dataNasc = trim($dataNascEnviada);
            $dataValida = DateTime::createFromFormat('!Y-m-d', $dataNasc);

            $tamanhoNome = preg_match_all('/[\s\S]/u', $nome);
            $tamanhoSobrenome = preg_match_all('/[\s\S]/u', $sobrenome);

            if ($nome === '' || $sobrenome === '' || !$dataValida || $dataValida->format('Y-m-d') !== $dataNasc) {
                $erro = 'Preencha todos os campos com valores válidos.';
            } elseif ($dataValida > new DateTime('today')) {
                $erro = 'A data de nascimento não pode ser futura.';
            } elseif (
                $tamanhoNome === false
                || $tamanhoSobrenome === false
                || $tamanhoNome > 100
                || $tamanhoSobrenome > 100
            ) {
                $erro = 'Nome e sobrenome devem ter no máximo 100 caracteres válidos.';
            } else {
                try {
                    $stmt = $pdo->prepare(
                        'UPDATE usuarios SET nome = :nome, sobrenome = :sobrenome, data_nasc = :data_nasc WHERE id = :id'
                    );
                    $stmt->execute([
                        ':nome' => $nome,
                        ':sobrenome' => $sobrenome,
                        ':data_nasc' => $dataNasc,
                        ':id' => $id,
                    ]);
                    header('Location: index.php');
                    exit;
                } catch (PDOException $exception) {
                    error_log($exception->getMessage());
                    $erro = 'Não foi possível atualizar o usuário.';
                }
            }
        }
    }

    $stmt = $pdo->prepare('SELECT id, nome, sobrenome, data_nasc FROM usuarios WHERE id = :id');
    $stmt->execute([':id' => $id]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        http_response_code(404);
        $erro = 'Usuário não encontrado.';
    }
}

$nomeForm = is_string($_POST['nome'] ?? null) ? $_POST['nome'] : ($usuario['nome'] ?? '');
$sobrenomeForm = is_string($_POST['sobrenome'] ?? null) ? $_POST['sobrenome'] : ($usuario['sobrenome'] ?? '');
$dataNascForm = is_string($_POST['data_nasc'] ?? null) ? $_POST['data_nasc'] : ($usuario['data_nasc'] ?? '');

require __DIR__ . '/includes/header.php';
?>
<main class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <?php if ($erro !== ''): ?>
                <div class="alert alert-danger" role="alert"><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></div>
            <?php elseif ($acao === 'ver'): ?>
                <h1 class="mb-4">Dados do usuário</h1>
                <dl class="row">
                    <dt class="col-sm-4">Nome</dt>
                    <dd class="col-sm-8"><?= htmlspecialchars($usuario['nome'], ENT_QUOTES, 'UTF-8') ?></dd>
                    <dt class="col-sm-4">Sobrenome</dt>
                    <dd class="col-sm-8"><?= htmlspecialchars($usuario['sobrenome'], ENT_QUOTES, 'UTF-8') ?></dd>
                    <dt class="col-sm-4">Data de nascimento</dt>
                    <dd class="col-sm-8"><?= htmlspecialchars(date('d/m/Y', strtotime($usuario['data_nasc'])), ENT_QUOTES, 'UTF-8') ?></dd>
                </dl>
            <?php else: ?>
                <h1 class="mb-4">Editar usuário</h1>
                <form method="post" action="usuario.php?id=<?= (int) $usuario['id'] ?>&acao=editar">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" maxlength="100" required
                               value="<?= htmlspecialchars($nomeForm, ENT_QUOTES, 'UTF-8') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="sobrenome" class="form-label">Sobrenome</label>
                        <input type="text" class="form-control" id="sobrenome" name="sobrenome" maxlength="100" required
                               value="<?= htmlspecialchars($sobrenomeForm, ENT_QUOTES, 'UTF-8') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="data_nasc" class="form-label">Data de nascimento</label>
                        <input type="date" class="form-control" id="data_nasc" name="data_nasc" max="<?= date('Y-m-d') ?>" required
                               value="<?= htmlspecialchars($dataNascForm, ENT_QUOTES, 'UTF-8') ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar alterações</button>
                </form>
            <?php endif; ?>
            <a class="btn btn-link mt-3 px-0" href="index.php">Voltar para a lista</a>
        </div>
    </div>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
