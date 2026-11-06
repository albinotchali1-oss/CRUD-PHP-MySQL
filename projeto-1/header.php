<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="shortcut icon" href="/imagens/favicon.svg" type="image/svg">
    <link rel="stylesheet" href="src/css/style.css">
    <link rel="stylesheet" href="src/css/style-media-query.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"/>
    <script src="src/js/script.js" defer></script>
</head>
<body onload="changedSize()" onresize="changedSize()">
    <header>
        <nav class="navbar">
            <div>
                <h1>Cadastro</h1>
                <button class="btn-mobile">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <ul id="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="?page=novo">Novo Usuário</a></li>
                <li><a href="?page=listar">Listar Usuário</a></li>
            </ul>
        </nav>
    </header>