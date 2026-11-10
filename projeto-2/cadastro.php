<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Método não permitido.');
}

$campos = ['nome', 'sobrenome', 'data_nasc'];
$valores = [];

foreach ($campos as $campo) {
    $valor = $_POST[$campo] ?? '';

    if (!is_string($valor)) {
        $valor = '';
    }

    $valores[$campo] = trim($valor);
}

$erros = [];

foreach (['nome', 'sobrenome'] as $campo) {
    if ($valores[$campo] === '') {
        $erros[] = 'Preencha o campo ' . $campo . '.';
        continue;
    }

    $tamanho = preg_match_all('/[\s\S]/u', $valores[$campo]);
    if ($tamanho === false || $tamanho > 100) {
        $erros[] = 'Nome e sobrenome devem ter no máximo 100 caracteres válidos.';
        break;
    }
}

if ($valores['data_nasc'] === '') {
    $erros[] = 'Preencha a data de nascimento.';
} else {
    $dataNasc = DateTimeImmutable::createFromFormat('!Y-m-d', $valores['data_nasc']);
    $avisosData = DateTimeImmutable::getLastErrors();

    if (
        !$dataNasc
        || ($avisosData !== false && ($avisosData['warning_count'] > 0 || $avisosData['error_count'] > 0))
        || $dataNasc->format('Y-m-d') !== $valores['data_nasc']
    ) {
        $erros[] = 'Informe uma data de nascimento válida.';
    } elseif ($dataNasc > new DateTimeImmutable('today')) {
        $erros[] = 'A data de nascimento não pode ser futura.';
    }
}

if ($erros) {
    $_SESSION['erros_cadastro'] = $erros;
    $_SESSION['dados_cadastro'] = $valores;
    header('Location: index.php');
    exit;
}

try {
    require_once __DIR__ . '/config/database.php';
    $stmt = $pdo->prepare(
        'INSERT INTO usuarios (nome, sobrenome, data_nasc) VALUES (:nome, :sobrenome, :data_nasc)'
    );
    $stmt->execute([
        ':nome' => $valores['nome'],
        ':sobrenome' => $valores['sobrenome'],
        ':data_nasc' => $valores['data_nasc'],
    ]);

    $_SESSION['sucesso_cadastro'] = 'Cadastro efetuado com sucesso.';
} catch (PDOException $exception) {
    error_log($exception->getMessage());
    $_SESSION['erros_cadastro'] = ['Não foi possível cadastrar o usuário. Tente novamente.'];
    $_SESSION['dados_cadastro'] = $valores;
}

header('Location: index.php');
exit;