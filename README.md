Steps For Execution

1. Make clone of the repository using `git clone https://github.com/trivedi-dolly/webmob-app.git`

2. Setup project with all composer dependencies using `composer install`

3. Now Setup .env file. replace .env file with .env.example's contents (I've configure all database and mail settings).

4. Then hitting `php artisan migrate` command for database migrations.

5. Create fake data for joke table using `php artisan db:seed --class=JokeTableSeeder` command.

6. Open terminal and hit `php artisan serve` for project execution.

7. Open chrome and type localhost:8000 URL.

8. Fill up the form details with required fields and send form.

9. Hit `php artisan send:joke` command for running cron job.

Note: There's use of UTC timezone so kindly test according to that.
