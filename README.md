# 1. Invillia PHP Challange

Por Leandro Manzano Merlo

## 1.1. Procedimento de Instalação do Projeto

É necessário ter o Docker e docker-compose instalados para que o projeto funcione de maneira adequada.
As formas de instalar essas ferramentas são encontradas em no site oficial do Docker ([Docker](https://docs.docker.com/desktop/) e [docker-compose](https://docs.docker.com/compose/)).

***Observação***: se a pasta raiz do projeto não se chamar **invillia_php_challange**, substitua em todos os comandos do docker invillia_php_challange_app_1 por **sua_pasta**_app_1.Isso se deve ao motivo de que o docker-compose utiliza o nome da pasta raiz do projeto concatenado com o nome do serviço docker. É importante que o nome da pasta não tenha espaços em branco.

Para realizar os procedimentos, abra um terminal (no Windows, se estiver usando o prompt, substituir o comando *cp* por *copy* e as barras dos caminhos de arquivo devem ser invertidas). Dentro do terminal, acessar a pasta raiz do projeto

``` bash
git clone https://github.com/leandro-merlo/invillia_php_challange.git
cd invillia_php_challange
```

Alterar dentro do arquivo docker-compose.yml o conteúdo das variáveis services->app->build->args->user e services->app->build->args->uid para o nome do usuário do computador e seu id, respectivamente. Isso é necessário para criar as pastas com as permissões corretas dentro do docker.

a. Despois de instalados o docker e docker-compose, rodar o seguinte comando para subir e construir as imagens do docker

``` bash
docker-compose up -d --build
```

b. Sobrescreva o conteúdo do arquivo html/laravel/.env pelo conteúdo do arquivo html/laravel/.env.example

Exemplo: cp ./html/laravel/.env.example ./html/laravel/.env

c. Rodar o comando abaixo para instalar as dependências do laravel

``` bash
docker exec -ti invillia_php_challange_app_1 bash -c "cd ./laravel; composer install"
docker exec -ti invillia_php_challange_app_1 bash -c "cd ./laravel; npm install"
docker exec -ti invillia_php_challange_app_1 bash -c "cd ./laravel; npm run prod"
```

d. Rodar o comando a seguir para configurar o banco de dados e gerar o usuário padrão

``` bash
docker exec -ti invillia_php_challange_app_1 php laravel/artisan migrate --seed
```

> Usuário Padrão
>   
> email: admin@admin
>   
> senha: 123456

e. Rodar os comandos abaixo para limpar o cache e gerar arquivos da documentação

``` bash
docker exec -ti invillia_php_challange_app_1 php laravel/artisan config:cache
docker exec -ti invillia_php_challange_app_1 php laravel/artisan view:cache
docker exec -ti invillia_php_challange_app_1 php laravel/artisan l5-swagger:generate
```

## 2. Rodando os Testes

Copie os arquivos XML da pasta raiz do projeto para a pasta ./html/laravel/storage/app/public

``` bash
cp ./*.xml ./html/laravel/storage/app/public/
```

Rode o comando:


``` bash
docker exec -ti invillia_php_challange_app_1 bash -c "cd ./laravel; ./vendor/bin/phpunit"
```


## 3. Acessando a documentação da API


Acesse no navegador a seguinte url: [http://localhost:8000/api/v1/documentation](http://localhost:8000/api/v1/documentation)

Como as rotas são todas protegidas, aparecerá um cadeado na frente das mesmas, e um botão "Authorize". Ao clicar em um deles, aparece um campo para inserção do token de autenticação. Ao inserir o token e clicar em Authorize, as rotas protegidas poderão ser acessadas normalmente.

Esse token deve ser adiquirido utilizando a rota [http://localhost:8000/api/v1/auth/login](http://localhost:8000/api/v1/auth/login) que pode ser acessada diretamente dentro da documentação, ou via aplicativos como o Postman, que podem fazer requisições web. Essa rota deve receber os parametros ***email*** e ***password*** e utilizar o verbo http ***POST***, com as credenciais do usuário gerado na seção 1.1.d.

A resposta desta rota traz as informações de acesso em formato JSON, contendo o ***access_token*** (esse token que deve ser inserido no passo acima, para fazer o login), o token_type e expires_in.


## 4. Acessando a página principal

Acesse no navegador a seguinte url: [http://localhost:8000/](http://localhost:8000/)

Nessa página, você poderá fazer o upload dos arquivos XML para o sistema.
Os arquivos XML de exemplo enviados encontram-se na pasta raiz do projeto.
