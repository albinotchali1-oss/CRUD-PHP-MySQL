<?php
require_once __DIR__ . '/config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Método não permitido.');
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    http_response_code(400);
    exit('Identificador de usuário inválido.');
}

try {
    $stmt = $pdo->prepare('DELETE FROM usuarios WHERE id = :id');
    $stmt->execute([':id' => $id]);
    header('Location: index.php');
    exit;
} catch (PDOException $exception) {
    error_log($exception->getMessage());
    http_response_code(500);
    exit('Não foi possível excluir o usuário.');
}
