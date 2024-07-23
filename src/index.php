<?php
// Подключение к базе данных
$mysqli = new mysqli("localhost", "root", "", "bookshop");

if ($mysqli->connect_error) {
    die("Ошибка подключения: " . $mysqli->connect_error);
}

// Получение данных из базы
$query = "SELECT categories.name as category_name, COUNT(books.id) as book_count, SUM(books.price) as total_price
          FROM categories
          LEFT JOIN books ON categories.id = books.category_id
          GROUP BY categories.id";
$result = $mysqli->query($query);

$categories = [];
while ($row = $result->fetch_assoc()) {
    $categories[] = $row;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Bookshop</title>
</head>
<body>
<h1>Отчет по книгам</h1>
<div id="accordion">
    <?php foreach ($categories as $category): ?>
        <h3><?php echo $category['category_name']; ?> (<?php echo $category['book_count']; ?> книг, <?php echo $category['total_price']; ?> руб.)</h3>
        <div>
            <?php
            $books_query = "SELECT * FROM books WHERE category_id = " . $category['category_id'];
            $books_result = $mysqli->query($books_query);
            while ($book = $books_result->fetch_assoc()) {
                echo "<p>" . $book['name'] . " - " . $book['price'] . " руб.</p>";
            }
            ?>
        </div>
    <?php endforeach; ?>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script>
    $(function() {
        $("#accordion").accordion();
    });
</script>
</body>
</html>
