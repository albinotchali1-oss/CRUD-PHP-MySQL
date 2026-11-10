# Projeto 2 — CRUD de usuários

Aplicação web para cadastrar, consultar, editar e excluir usuários, usando PHP, PDO e MySQL. A interface utiliza Bootstrap 5.3.3 por CDN.

## Funcionalidades

- Cadastrar nome, sobrenome e data de nascimento.
- Listar os usuários cadastrados.
- Consultar e editar os dados de um usuário.
- Excluir um usuário após confirmação.
- Validar os dados enviados e exibir mensagens de sucesso ou erro.

## Requisitos

- PHP com a extensão PDO MySQL (`pdo_mysql`).
- MySQL.
- Acesso à internet para carregar o Bootstrap pela CDN.

## Configuração

1. Inicie o servidor MySQL.
2. Na pasta `projeto-2`, importe o script que cria o banco `projeto2` e a tabela `usuarios`:

   ```sh
   mysql -u root -p < database/database.sql
   ```

   Se o usuário MySQL não tiver senha, remova `-p` do comando.

3. Confira as credenciais de conexão em `config/database.php`. O padrão é `localhost`, banco `projeto2`, usuário `root` e senha vazia. Ajuste esses valores conforme o seu ambiente.
4. Ainda na pasta `projeto-2`, inicie o servidor embutido do PHP:

   ```sh
   php -S localhost:8000
   ```

5. Acesse [http://localhost:8000](http://localhost:8000).

## Estrutura

```text
projeto-2/
├── cadastro.php
├── excluir.php
├── index.php
├── usuario.php
├── config/
│   └── database.php
├── database/
│   └── database.sql
├── includes/
│   ├── footer.php
│   └── header.php

```

O `index.php` apresenta o formulário e a lista de usuários; `cadastro.php` processa novos cadastros; `usuario.php` exibe ou edita um usuário; e `excluir.php` processa exclusões.
