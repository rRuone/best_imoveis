# Master Dog

Master Dog é uma aplicação para gerenciamento de pedidos e cardápio de uma lanchonete de hotdogs.

## Requisitos

Para rodar a aplicação, você precisará dos seguintes requisitos:

### 1. Pré-requisitos

- **PHP:** Versão 8.0 ou superior
- **Composer:** Para gerenciar dependências PHP
- **Node.js:** Versão 18 ou superior
- **npm ou yarn:** Para gerenciar dependências JavaScript
- **MySQL:** Ou outro banco de dados compatível

### 2. Configuração do Ambiente

1. **Clone o Repositório**

   ```bash
   git clone https://github.com/username/master-dog.git
   cd master-dog

2. Instale as Dependências PHP

```
composer install 
```

3.Duplicar o arquivo ".env.example" e renomear para ".env"

4.Gerar a chave 

```
php artisan key:generate
```
5.Configure o Banco de Dados

No arquivo .env, defina suas credenciais do banco de dados:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=usuario
DB_PASSWORD=senha

6.Execute as Migrações

```
php artisan migrate
```

7.Instale as Dependências JavaScript

```
npm install
```

8.Compile os Recursos


```
npm run dev
```

9.Inicie o Servidor

```
php artisan serve
```

10 Instalar o liveware 

```
composer require livewire/livewire
``` 

