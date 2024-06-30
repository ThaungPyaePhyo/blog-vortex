```dql
To serve a Laravel application with Docker, ensure you change the DB_HOST value in your .env file from 127.0.0.1 to mysql.
```
Docker Command

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
Once inside the app container, run the following commands:
Run the database migrations:
```scss
php artisan migrate
```
Create the symbolic link for storage:
```scss
php artisan storage:link
```
