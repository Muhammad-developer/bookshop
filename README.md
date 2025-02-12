# Bookshop Project

Этот проект представляет собой простое приложение книжного магазина, подготовленное для работы в контейнере Docker.

## Структура проекта
```
project/
|-- apache-config/
| |-- bookshop.conf
|-- src/
| |-- index.php
| |-- install.php
| |-- classes/
| | |-- Database.php
| | |-- Book.php
| | |-- Category.php
| | |-- Author.php
| | |-- Report.php
|-- Dockerfile
|-- README.md
```

## Требования

- Docker
- DNS запись для `bookshop.loc`, указывающая на локальный хост

## Установка и запуск

1. Склонируйте репозиторий:

    ```sh
    git clone https://github.com/Muhammad-developer/bookshop.git
    cd project
    ```

2. Постройте Docker образ:

    ```sh
    docker build -t bookshop .
    ```

3. Запустите контейнер:

    ```sh
    docker run -d -p 80:80 -p 2222:22 --name bookshop-container bookshop
    ```

4. Откройте браузер и перейдите по адресу [http://bookshop.loc](http://bookshop.loc)

5. Для загрузки тестовых данных откройте в браузере [http://bookshop.loc/install.php](http://bookshop.loc/install.php)

## Структура файлов

- `Dockerfile`: Файл для создания Docker образа с необходимыми конфигурациями.
- `apache-config/bookshop.conf`: Конфигурационный файл для виртуального хоста Apache.
- `src/index.php`: Главная страница проекта, отображающая отчет по книгам.
- `src/install.php`: Скрипт для создания структуры базы данных и загрузки тестовых данных.
- `src/classes/Database.php`: Класс для управления соединением с базой данных.
- `src/classes/Book.php`: Класс для управления книгами.
- `src/classes/Category.php`: Класс для управления категориями.
- `src/classes/Author.php`: Класс для управления авторами.
- `src/classes/Report.php`: Класс для генерации отчетов.

## Вход в контейнер через SSH

Для подключения к контейнеру по SSH используйте следующие данные:

- Пользователь: `admin`
- Пароль: `trust`

Команда для подключения:

```sh
ssh admin@localhost -p 2222
```

## Примечания
- Проект следует принципам SOLID для обеспечения качественной архитектуры.
- База данных нормализована для обеспечения целостности данных.

## Контакты
Если у вас возникли вопросы или предложения, пожалуйста, свяжитесь с нами по электронной почте: [muhammadjonvafoev@gmail.com](mailto:muhammadjonvafoev@gmail.com).
