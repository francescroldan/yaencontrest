# Yaencontrest

## Prerequisites:
-Git
-Docker-compose(latest version)

## Installation steps:

-Clone repo: 

`$ git clone git@github.com:francescroldan/yaencontrest.git`

-Raise docker containers with: 

`$ docker-compose up -d`

-Update your composer

`$ sudo docker exec -it php-fpm composer update`

-Create this folder: 

`$ mkdir -p config/jwt`

-Generate the SSH keys:

`$ openssl genrsa -out config/jwt/private.pem -aes256 4096`

`$ openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout`

Copy the passphrase into the var JWT_PASSPHRASE in .env file.

-Update db schema:

`$ sudo docker exec -it php-fpm php bin/console doctrine:schema:update --force`
 
 
 
## Usage:

Create a user in table users:

**POST** http://yourip:8001/register

{
	"username":"user",
	"password":"pass",
	"email":"email"
}

Get the jwt token:

**POST** http://yourip:8001/api/login_check

{
	"username":"user",
	"Password":"pass"
}

Paste the token previously obtained in ‘Bearer Token’ field or create a header key Authorization with the value ‘Bearer ’ + token.
You can start to use the API.
 
## End points:

**POST**		http://yourip:8001/api/advertisement

**GET**		http://yourip:8001/api/advertisement/{id}

**GET**		http://yourip:8001/api/advertisements{locality}{price}{text}

**DELETE** 	http://yourip:8001/api/advertisement/{id}

**PUT**		http://yourip:8001/api/advertisement/{id}

**PATCH**		http://yourip:8001/api/advertisement/{id}


 
 


