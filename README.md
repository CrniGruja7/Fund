# Fund Laravel Project

Ovo je Laravel projekat za aplikaciju Fund, koja koristi Blade za frontend.

## Zahtevi

- PHP >= 7.3
- Composer
- Docker
- Node.js (za frontend build)

## Instalacija

1. Preuzmite projekat kao zip datoteku sa [GitHub repozitorijuma](https://github.com/vaš_korisničko_ime/ime_repozitorijuma/archive/refs/heads/main.zip).

2. Ekstraktujte zip datoteku:
    ```bash
    unzip ime_repozitorijuma-main.zip
    cd ime_repozitorijuma-main
    ```

3. Instalirajte PHP zavisnosti:
    ```bash
    composer install
    ```

4. Instalirajte JavaScript zavisnosti:
    ```bash
    npm install
    ```

5. Kopirajte `.env.example` u `.env`:
    ```bash
    cp .env.example .env
    ```

6. Generišite aplikacioni ključ:
    ```bash
    php artisan key:generate
    ```

## Povezivanje sa MySQL Bazom Podataka na Dockeru

1. Podignite MySQL kontejner koristeći Docker:
    ```bash
    docker run --name laravel_mysql -e MYSQL_ROOT_PASSWORD=vaša_lozinka -e MYSQL_DATABASE=ime_baze -e MYSQL_USER=vaše_korisničko_ime -e MYSQL_PASSWORD=vaša_lozinka -p 3306:3306 -d mysql:latest
    ```

2. Uredite `.env` fajl sa vašim MySQL podešavanjima:
    ```ini
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=ime_baze
    DB_USERNAME=vaše_korisničko_ime
    DB_PASSWORD=vaša_lozinka
    ```

3. Pokrenite migracije kako biste kreirali tabele u bazi:
    ```bash
    php artisan migrate
    ```

## Pokretanje Servera

1. Pokrenite lokalni razvojni server:
    ```bash
    php artisan serve
    ```

2. Pokrenite Webpack dev server za frontend build:
    ```bash
    npm run dev
    ```

Sada možete otvoriti preglednik i otići na `http://localhost:8000` kako biste videli vašu aplikaciju i koristili korisnički interfejs.

## Kreiranje Podataka za Prvi Put (Seed)

Ako želite kreirati osnovne podatke za aplikaciju, možete koristiti seeder-e:
```bash
php artisan db:seed
