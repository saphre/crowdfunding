## About The Project

This is a very simple and basic crowd funding app and takes into account the following. 

- CRUD on donations.
- Viewing donations and contributions  made by one self.
- Seeders 

This is a good starting point and a lot can be added and ameliorated.

## Running The App

The app uses [Laravel Sanctum](https://laravel.com/docs/10.x/sanctum). In order to run the app

- Configure your .env file.
- Migrate with seeders (php artisan migrate --seed).
- Serve two (2) applications; one using host 127.0.0.1 and the other using 127.0.0.2
Given that the API and the app are in the same project, by default the API uses the host 127.0.0.2 and port
8000. This can be changed in the WebServiceAPI found in App\Models\Utilities.

## Security Vulnerabilities

If you discover a security vulnerability within this project, please send an e-mail to Mohamed Saphir via [mohamedsaphir@gmail.com](mailto:mohamedsaphir@gmail.com). All security vulnerabilities will be promptly addressed.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
