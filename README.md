```dql
To serve a Laravel application with Docker, ensure you change the DB_HOST value in your .env file from 127.0.0.1 to mysql.
```
### Docker Command

Build the Docker images:
```scss
docker compose build
```

Start the Docker containers in detached mode:
```scss
docker compose up -d 
```

Start the Docker containers in detached mode:
```scss
docker compose up
```

Stop and remove the Docker containers:
```scss
docker compose down
```

To access the app container and open a bash shell within it, use the following command:
```scss
docker compose exec 'container name' bash
```

Docker Compose Help Command
```scss
docker compose --help
```
Once inside the app container, run the following commands:
Run the database migrations:
```scss
php artisan migrate
```
Create the symbolic link for storage:
```scss
php artisan storage:link
```
### For Laravel Test

```scss
php artisan test
```

### Running Tests

To run tests using `php artisan test`, you need to set up a test database. Follow these steps:

1. **Create a Test Database**: Ensure you have a database specifically for testing purposes.
2. **Configure the Test Database in `phpunit.xml`**: Open the `phpunit.xml` file in the root of your project. Update the `DB_DATABASE` environment variable with the name of your test database.

```xml
<php>
    <env name="DB_DATABASE" value="test_database"/>
    <!-- Other environment variables -->
</php>

