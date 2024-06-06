# BookshelfAPI

Це шаблон README.md для вашого проекту. Змініть цей опис проекту на свій власний.

## Запуск проекту за допомогою Laravel Sail

[Laravel Sail](https://laravel.com/docs/sail) - це зручний спосіб запуску Laravel-проектів з використанням Docker. Для
запуску проекту за допомогою Laravel Sail, виконайте наступні кроки:

1. Збережіть файл `.env.example` як `.env` та вкажіть необхідні змінні оточення (наприклад, базу даних, інші
   конфігураційні
   параметри).

2. Відкрийте термінал або командний рядок у кореневій директорії проекту та виконайте команду для встановлення
   залежностей через Composer:

   ```bash
    composer install
   ```
3. Після встановлення залежностей виконайте наступну команду для запуску Sail:

    ```bash
    ./vendor/bin/sail up -d
    ```
4. Виконайте міграції бази даних для створення таблиць:
    ```bash
   ./vendor/bin/sail artisan migrate
    ```

5. Є фабрика для засіювання даних. Виконайте команду нижче, щоб заповнити базу даних тестовими даними:
    ```bash
    ./vendor/bin/sail php artisan db:seed
   ```
   
6. Після успішного запуску Sail, ви можете відкрити свій проект у веб-браузері за адресою http://localhost:8000.


7. Всі роути знаходяться в /web/app.php. Наприклад, для доступу до API автора з id=1, використовуйте: http://localhost:8000/api/api-author/1
