<?php
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $senha = md5($_POST["senha"]);
        $data_nasc = $_POST["data_nasc"];
        $id = $_REQUEST["id"];
switch ($_REQUEST["acao"]) {
    case 'cadastrar':

        $sql = "INSERT INTO usuarios (nome, email, senha, data_nasc) 
        VALUES ('{$nome}', '{$email}','{$senha}', '{$data_nasc}')";

        $res = $conn->query($sql);

        if ($res) {
            print "<script>alert('Cadastro Efetuado')</script>";
            print "<script>location.href='?page=listar';</script>";
        }
        else{
            print "<script>alert('Cadastro não Efetuado')</script>";
            print "<script>location.href='?page=listar';</script>";
        }
        break;
    case 'editar':

        $sql = "UPDATE usuarios SET nome='{$nome}', email='{$email}', senha='{$senha}', data_nasc='{$data_nasc}' WHERE id='{$id}'";

        $res = $conn->query($sql);

        if ($res) {
            print "<script>alert('Actualização Efetuado')</script>";
            print "<script>location.href='?page=listar';</script>";
        }
        else{
            print "<script>alert('Actualização não Efetuado')</script>";
            print "<script>location.href='?page=listar';</script>";
        }
        break;
    case 'excluir':
            $sql = "DELETE FROM usuarios WHERE id='{$id}'";

            $res = $conn->query($sql);

            if ($res) {
                print "<script>alert('Usuário excluido')</script>";
                print "<script>location.href='?page=listar';</script>";
            }
            else{
                print "<script>alert('Usuário não excluido')</script>";
                print "<script>location.href='?page=listar';</script>";
            }
        break;
    default:
        
        break;
}