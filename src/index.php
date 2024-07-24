<?php
require 'classes/Database.php';
require 'classes/Book.php';
require 'classes/Category.php';
require 'classes/Author.php';
require 'classes/Report.php';

$categories = Report::generateReport();
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
            $books = Book::getBooksByCategoryId($category['category_id']);
            foreach ($books as $book) {
                echo "<p>" . $book->getName() . " - " . $book->getPrice() . " руб.</p>";
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
