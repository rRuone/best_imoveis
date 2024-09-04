## Requisitos 

* PHP 8.3.4 ou superior
* Composer
* Node.js 20 ou superior

# Como rodar o projeto baixado 
Instalar as dependências 
```
composer install 
```

Duplicar o arquivo ".env.example" e renomear para ".env"

Gerar a chave 
```
php artisan key:generate
```


Iniciar o projeto criado com Laravel 
```
php artisan serve 
```
Executar as migration 
```
php artisan migrate 
```

Criar a migration
```
php artisan make:migration create_nomeDaMigration_table 
``` 
Criar a model 
```
php artisan make:model Cidade
```

Criar o arquivo Request com validações 
```
php artisan make:request CidadeRequest
```


