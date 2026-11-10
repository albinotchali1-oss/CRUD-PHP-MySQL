<?php require 'header.php'; ?>

<div class="container">
    <?php
    include('config.php');
        switch (@$_REQUEST["page"]) {
            case 'novo':
                    include('novo-user.php');
                break;
            case 'listar':
                    include('listar-user.php');
                break;
            case 'salvar':
                    include('salvar-user.php');
                break;
            case 'editar':
                    include('editar-user.php');
                break;
            default:
                 include('listar-user.php');
                break;
        }
    ?>
</div>

<?php require 'footer.php'; ?>