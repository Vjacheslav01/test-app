# TEST-APP

Тестовое задание

## Требования

- Наличие установленного докера (docker/docker-desktop)
- NodeJS (18.20)/NPM(10.5) (or nvm: nvm user 18)
- PHP 7.4
- Composer

## Установка

В папке сайта выполните следующие команды:

- npm install
- npm run build
- cd api
- composer install
- docker-compose up -d
- docker-compose exec web php api/yii migrate
- добавить в /etc/hosts строки
    - 127.0.0.1 http://test-app.loc,
    - 127.0.0.1 http://api.test-app.loc

## API

- GET http://api.test-app.loc:81/requests      - Список заявок
- POST http://api.test-app.loc:81/requests     - Создание новой заявки
- PUT http://api.test-app.loc:81/requests/{id} - Закрытие заявки

все эндпоинты (кроме создание заявок) требуют авторизации

'Authorization: Bearer auth_key',

## Прочее

- Имеется графический пользовательский интерфейс по адресу http://test-app.loc:81
- Данные для авторизации
    - Email    - admin@example.com
    - Password - password
