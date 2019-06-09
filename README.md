# Sistema para manejo  de inventario 

```

###Backend

Crear base de datos:

    ```
    mysql -uroot -p
    CREATE DATABASE inventario CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
    quit
    ```

Copiar `.env` file:

    ```
    cd back
    cp .env.example .env
    ```

Put the database details in the `.env` file:

    ```
    DB_DATABASE=inventario
    DB_USERNAME=root
    DB_PASSWORD=***
    ```

Instalar dependencias:

    ```
    composer install
    php artisan key:generate
    php artisan migrate
    php artisan serve
```

Loading [127.0.0.1:8000](127.0.0.1:8000)

### Set up the Frontend

    ```
    cd frond-vue
    yarn install
    yarn serve
    ```

Loading [127.0.0.1:8080](127.0.0.1:8080) 

