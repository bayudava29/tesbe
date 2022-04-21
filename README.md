**System Requirements**

***Web Server***

  - `Linux`
  - `Apache >= 2.4.29 / Nginx >= 1.19.10`
  - `Windows`
  - `Xampp >= 7.3.30 / Wamp >= 3.2.x / Laragon >= 5.0.x`

***PHP***

  - `PHP >= 7.3`
  - `Composer >= 2.0.4`

***Laravel***

  - `Laravel >= 7.0`

**Install Laravel**
- `git clone https://github.com/bayudava29/tesbe.git`
- `composer install`
- `cp .env.example .env`
- `php artisan key:generate`
- `php artisan migrate`
- `php artisan serve`

**Generate API Documentation**
- `php artisan scribe:generate`
- `go to http://localhost/docs/`
  