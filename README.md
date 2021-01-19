# 1. Invillia PHP Challenge

Por Leandro Manzano Merlo

## 1.1. Procedimento de Instalação do Projeto

É necessário ter o Docker e docker-compose instalados para que o projeto funcione de maneira adequada.
As formas de instalar essas ferramentas são encontradas em no site oficial do Docker ([Docker](https://docs.docker.com/desktop/) e [docker-compose](https://docs.docker.com/compose/)).

***Observação***: se a pasta raiz do projeto não se chamar **invillia_php_challenge**, substitua em todos os comandos do docker invillia_php_challenge_app_1 por **sua_pasta**_app_1.Isso se deve ao motivo de que o docker-compose utiliza o nome da pasta raiz do projeto concatenado com o nome do serviço docker. É importante que o nome da pasta não tenha espaços em branco.

a. Despois de instalados o docker e docker-compose, rodar o seguinte comando para subir as imagens do docker

``` bash
docker-compose up -d
```

b. Sobrescreva o conteúdo do arquivo html/laravel/.env pelo conteúdo do arquivo html/laravel/.env.example

Exemplo: cp ./html/laravel/.env.example ./html/laravel/.env

c. Rodar o comando abaixo para instalar as dependências do laravel

``` bash
docker exec -ti invillia_php_challenge_app_1 bash -c "cd ./laravel; composer install"
```

d. Rodar o comando a seguir para configurar o banco de dados e gerar o usuário padrão

``` bash
docker exec -ti invillia_php_challenge_app_1 php laravel/artisan migrate --seed
```

> Usuário Padrão
>   
> email: admin@admin
>   
> senha: 123456

e. Rodar os comandos abaixo para limpar o cache e gerar arquivos da documentação

``` bash
docker exec -ti invillia_php_challenge_app_1 php laravel/artisan config:cache
docker exec -ti invillia_php_challenge_app_1 php laravel/artisan view:cache
docker exec -ti invillia_php_challenge_app_1 php laravel/artisan view:cache l5-swagger:generate
```

## 2. Rodando os Testes


Rode o comando:


``` bash
docker exec -ti invillia_php_challenge_app_1 bash -c "cd ./laravel; ./vendor/bin/phpunit"
```


## 3. Acessando a documentação da API


Acesse no navegador a seguinte url: [http://localhost:8000/api/v1/documentation](http://localhost:8000/api/v1/documentation)


## 4. Acessando a página principal

Acesse no navegador a seguinte url: [http://localhost:8000/](http://localhost:8000/)

Nessa página, você poderá fazer o upload dos arquivos XML para o sistema.
Os arquivos XML de exemplo enviados encontram-se na pasta raiz do projeto.
