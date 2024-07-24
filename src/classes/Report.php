<?php

class Report
{
    public static function generateReport()
    {
        $db = Database::getInstance()->getConnection();
        $query = "SELECT categories.id as category_id, categories.name as category_name, COUNT(books.id) as book_count, SUM(books.price) as total_price
                  FROM categories
                  LEFT JOIN books ON categories.id = books.category_id
                  GROUP BY categories.id";
        $result = $db->query($query);

        $categories = [];
        while ($row = $result->fetch_assoc()) {
            $categories[] = [
                'category_id' => $row['category_id'],
                'category_name' => $row['category_name'],
                'book_count' => $row['book_count'],
                'total_price' => $row['total_price']
            ];
        }
        return $categories;
    }
}
?>
