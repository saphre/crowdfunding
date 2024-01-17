## About The Project

This is a very simple and basic crowd funding app and takes into account the following. 

- CRUD on donations.
- Viewing donations and contributions  made by one self.
- Seeders 

This is a good starting point and a lot can be added and ameliorated.

## Running The App

The app uses [Laravel Sanctum](https://laravel.com/docs/10.x/sanctum). In order to run the app
1. ``` git clone git@github.com:saphre/crowdfunding.git ```
2. ``` docker-compose exec app composer install ```
3. Copy ```.env.example``` to ```.env```
4. ```docker-compose build```
5. ```docker compose up -d```
6. You can see the project on ```127.0.0.1:8080```

## How to run Laravel Commands with Docker Compose

1. ```cd web```
2. ```docker-compose exec app php artisan {your command}``` 

- Configure your .env file.
- Migrate with seeders (docker-compose exec app php artisan migrate --seed).
- Serve two (2) applications; one using host 127.0.0.1 and the other using 127.0.0.2
Given that the API and the app are in the same project, by default the API uses the host 127.0.0.2 and port 8080. This can be changed in the WebServiceAPI found in App\Models\Utilities.

## How to use PostgreSQL as a database

1. Copy ```.env.example``` to ```.env```
2. Change ```DB_CONNECTION``` to ```pgsql```
3. Change ```DB_PORT``` to ```5432```
4. Open the ```pgAdmin``` on ```127.0.0.1:5050```

## How to use MySQL as a database

1. Uncomment the MySQL configuration inside the ```docker-compose.yml``` including: ```db``` and ```phpMyAdmin```
2. Copy ```.env.example``` to ```.env```
3. Change ```DB_CONNECTION``` to ```mysql```
4. Change ```DB_PORT``` to ```3306```
5. Open the ```phpMyAdmin``` on ```127.0.0.1:3400```

## Security Vulnerabilities

If you discover a security vulnerability within this project, please send an e-mail to Mohamed Saphir via [mohamedsaphir@gmail.com](mailto:mohamedsaphir@gmail.com). All security vulnerabilities will be promptly addressed.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
