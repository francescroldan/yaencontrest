# Yaencontrest

## Prerequisites:
-Git

-Docker-compose(latest version)

## Installation steps:

-Clone repo: 

```zsh
$ git clone git@github.com:francescroldan/yaencontrest.git
```

-Raise docker containers with: 

```zsh
$ docker-compose up -d
```

-Update your composer

```zsh
$ sudo docker exec -it php-fpm composer update
```

-Create this folder: 

```zsh
$ mkdir -p config/jwt
```

-Generate the SSH keys:

```zsh
$ openssl genrsa -out config/jwt/private.pem -aes256 4096
```

```zsh
$ openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout
```

Copy the passphrase into the var JWT_PASSPHRASE in .env file.

-Update db schema:

```zsh
$ sudo docker exec -it php-fpm php bin/console doctrine:schema:update --force
```
 
 
 
## Usage:

Create a user in table users:

**POST** http://yourip:8001/register

```json
{
	"username":"user",
	"password":"pass",
	"email":"email"
}
```

Get the jwt token:

**POST** http://yourip:8001/api/login_check
```json
{
	"username":"user",
	"Password":"pass"
}
```

Paste the token previously obtained in ‘Bearer Token’ field or create a header key Authorization with the value ‘Bearer ’ + token.
You can start to use the API.
 
## End points:

**POST**		http://yourip:8001/api/advertisement
```json
{
	"title" : "new title text",
	"description" : "new description text",
	"price" : "12.5",
	"locality" : "Barcelona",
	"owner" : {
		"type" : 1,
		"name" : "new name",
		"phonenumber" : "new valid spanish phone number",
		"email" : "valid@email.com"
	}
}
```


**GET**		http://yourip:8001/api/advertisement/{id}

**GET**		http://yourip:8001/api/advertisements{locality}{price}{text}

**DELETE** 	http://yourip:8001/api/advertisement/{id}

**PUT**		http://yourip:8001/api/advertisement/{id}
```json
{
	"title" : "updated title text",
	"description" : "updated description text",
	"price" : "12.5",
	"locality" : "Barcelona",
	"owner" : {
		"type" : 1,
		"name" : "updated name",
		"phonenumber" : "updated valid spanish phone number",
		"email" : "updated.valid@email.com"
	}
}
```
**PATCH**		http://yourip:8001/api/advertisement/{id}
```json
{
	"title" : "updated title text",
	"description" : "updated description text",
}
```

## Additional:

I created a command to populate the DB easily:

```zsh
$ sudo docker exec -it php-fpm php bin/console app:populate {#advertisements+owners you want to create}
```

