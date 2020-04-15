<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

# Descrição do projeto

Projeto desenvolvido para teste do pacote [Laravel Excel](https://laravel-excel.com/).

---

## Iniciar o projeto

1. (obrigatório) Execute a instalação do composer:

    ```bash
    # bash

    composer install
    ```

2. (opcional) Para esse projeto foi utilizado o `sqlite`, para isso edite o `.env` na variável de ambiente `DB_CONNECTION`, troque de `mysql` para `sqlite`.

3. (opcional se o _passo 2_ foi feito) Crie o arquivo `database.sqlite` na pasta `database`:

    ```bash
    # bash

    touch database/database.sqlite
    ```

4. Execute o comando para criar a tabela `command_errors` e executar a `seeder`:

    ```bash
    #bash

    php artisan migrate --seed
    ```

5. Start o projeto, caso não esteja usando [Docker](https://www.docker.com/):

    ```bash
    #bash

    php artisan serve
    ```

6. Acesse pelo browser o projeto:
    1. A rota para testar a exportação é `/export`;
        > Irá exportar para excel todos os registros.
    2. Passando parâmetro opcional `/export/2020`.
        > Irá exportar para excel somente os registro com base no ano informado.

---

## Informações estruturais

1. Model:
    - CommandError
2. Controller:
    - CommandErrorController
3. Exports:
    - CommandErrorExport
4. QueryFilters:
    - Filter _(abstract)_;
    - Yaer
