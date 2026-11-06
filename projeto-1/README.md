# Projeto 1 — Cadastro de usuários

Aplicação CRUD introdutória, feita em PHP e MySQL, para cadastrar e administrar usuários. A interface está em português e inclui estilos responsivos.

## Funcionalidades

- Cadastrar usuário com nome, e-mail, senha e data de nascimento.
- Listar os usuários cadastrados.
- Editar os dados de um usuário.
- Excluir um usuário após confirmação.

## Requisitos

- PHP com a extensão `mysqli`.
- MySQL.
- PHP disponível no terminal para iniciar o servidor local.

## Configuração

1. Inicie o servidor MySQL.
2. A partir desta pasta (`projeto-1`), importe o script que cria o banco `cadastro` e a tabela `usuarios`:

   ```sh
   mysql -u root -p < src/sql/database.sql
   ```

   Informe a senha do usuário MySQL quando solicitado. O script cria o banco, mas não cria um usuário MySQL.

3. Abra `config.php` e ajuste as constantes `HOST`, `USER`, `PASS` e `BASE` para as credenciais do seu ambiente. `BASE` deve corresponder ao banco `cadastro` criado pelo script.
4. Ainda nesta pasta, inicie o servidor embutido do PHP:

   ```sh
   php -S localhost:8000
   ```

5. Acesse [http://localhost:8000](http://localhost:8000) no navegador.

## Estrutura

```text
projeto-1/
├── config.php
├── index.php
├── novo-user.php
├── listar-user.php
├── editar-user.php
├── salvar-user.php
└── src/
    ├── css/
    ├── js/
    └── sql/
        └── database.sql
```

O `index.php` controla a navegação entre as telas; `config.php` abre a conexão MySQL; e `src/sql/database.sql` define o banco e a tabela.

## Observação de segurança

Este projeto é um exercício didático e não deve ser publicado em produção sem revisão. A implementação atual usa consultas SQL concatenadas com valores recebidos da requisição e `MD5` para armazenar senhas. Esses padrões não protegem adequadamente contra injeção de SQL nem são apropriados para armazenamento de senhas. Use consultas preparadas, `password_hash()` e `password_verify()`, valide os dados no servidor e mantenha credenciais reais fora do código antes de disponibilizar a aplicação.
