Instale o Docker e Docker Compose

Entre na pasta do projeto

Suba os containers do projeto
```sh
make up para subir os container
```
Acesse o container back
```sh
make back
```

Instale as dependências do projeto
```sh
composer install

Gere a key do projeto Laravel
```sh
php artisan key:generate
```

copie o arquivo .env.example e mude para .env 

```sh
DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
DB_DATABASE=shipmart
# DB_USERNAME=root
# DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database
SESSION_DRIVER=file
SESSION_LIFETIME=120

NOTIFICATION_MAIL='email de sua prefência'

preencha com sua conta do mail trap de preferência 

MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME="codigo"
MAIL_PASSWORD="senha"
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="nao deixe sem nada"
MAIL_FROM_NAME="não deixe sem nada"

```

crie um env.testing com as mesmas informações acima, só mude o campo DB_CONNECTION=sqlite para DB_CONNECTION=sqliteteste

Acesse o container
```sh
docker-compose exec app bash ou make back
```

Rode os comandos abaixo para gerar as tabelas e o dados:

```sh
php artisan make migration
php artisan sb:seed
```

Rode 
```sh
php artisan jwt:secret
php artisan jwt:secret --env=testing
'''

use o comando para ativar o processamento das filas
php artisan queue:work --queue="back_emails" 

em outro terminal

utilize esse comando para acessar o container do front docker exec -it my_frontend /bin/bash ou make frontend
e rode o npm install e npm run dev
a aplicação vue estará disponível no link http://localhost:9200/


