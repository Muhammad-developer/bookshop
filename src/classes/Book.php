<?php

class Book
{
    private $id;
    private $name;
    private $price;
    private $status;
    private $category_id;

    public function __construct($id, $name, $price, $status, $category_id)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->status = $status;
        $this->category_id = $category_id;
    }

    public static function getBooksByCategoryId($category_id)
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM books WHERE category_id = ?");
        $stmt->bind_param("i", $category_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $books = [];
        while ($row = $result->fetch_assoc()) {
            $books[] = new Book($row['id'], $row['name'], $row['price'], $row['status'], $row['category_id']);
        }
        return $books;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }
}
