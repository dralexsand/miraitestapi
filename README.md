
Примеры запросов:

Получения локального времени в городе
по переданному идентификатору города

Запрос:

http://miraiapitest.local/api/?action=utc&id=040efa6e-3512-4523-a4dc-33e29aece663&gmt=10800

Ответ:
```json
{
"result": {
"status": "OK",
"message": "",
"countryCode": "US",
"countryName": "United States of America",
"zoneName": "America/Phoenix",
"abbreviation": "MST",
"gmtOffset": -25200,
"dst": "0",
"zoneStart": -68659200,
"zoneEnd": null,
"nextAbbreviation": null,
"timestamp": 1637724315,
"formatted": "2021-11-24 03:25:15"
},
"error": null
}
```
Локальное время - в поле 'formatted'


Обратное преобразование из локального времени
и идентификатора города
в метку времени по UTC+0.

Запрос:

http://miraiapitest.local/api/?action=gmt&id=040efa6e-3512-4523-a4dc-33e29aece663&utc=10800

Ответ:
```json
{
"result": {
"status": "OK",
"message": "",
"countryCode": "US",
"countryName": "United States of America",
"zoneName": "America/Phoenix",
"abbreviation": "MST",
"gmtOffset": -25200,
"dst": "0",
"zoneStart": -68659200,
"zoneEnd": null,
"nextAbbreviation": null,
"timestamp": 1637724315,
"formatted": "2021-11-24 03:25:15"
},
"error": null
}
```
Метка времени - в поле 'gmtOffset'

id города можно взять в файле /doc/cities.json

sample config for nginx:

```

server {
listen 80;
server_name miraiapitest.local;
root /var/www/html/miraitest.local/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}

```
