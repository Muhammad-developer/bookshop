<?php
require 'classes/Database.php';

$db = Database::getInstance()->getConnection();

// Создание базы данных
$db->query("CREATE DATABASE IF NOT EXISTS bookshop");
$db->select_db("bookshop");

// Создание таблиц
$db->query("
    CREATE TABLE IF NOT EXISTS categories (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL
    )
");

$db->query("
    CREATE TABLE IF NOT EXISTS books (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        price DECIMAL(10, 2) NOT NULL,
        status ENUM('В наличии', 'Нет на складе', 'Снято с продажи') NOT NULL,
        category_id INT,
        FOREIGN KEY (category_id) REFERENCES categories(id)
    )
");

$db->query("
    CREATE TABLE IF NOT EXISTS authors (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL
    )
");

$db->query("
    CREATE TABLE IF NOT EXISTS book_author (
        book_id INT,
        author_id INT,
        PRIMARY KEY (book_id, author_id),
        FOREIGN KEY (book_id) REFERENCES books(id),
        FOREIGN KEY (author_id) REFERENCES authors(id)
    )
");

// Вставка тестовых данных
$db->query("INSERT INTO categories (name) VALUES ('Фантастика'), ('Роман'), ('Научная литература')");
$db->query("INSERT INTO books (name, price, status, category_id) VALUES ('Книга 1', 500, 'В наличии', 1), ('Книга 2', 300, 'Нет на складе', 2)");
$db->query("INSERT INTO authors (name) VALUES ('Автор 1'), ('Автор 2')");
$db->query("INSERT INTO book_author (book_id, author_id) VALUES (1, 1), (1, 2)");

echo "Тестовые данные загружены!";
