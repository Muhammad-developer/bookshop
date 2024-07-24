<?php

class Author
{
    private $id;
    private $name;

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public static function getAuthorsByBookId($book_id)
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT authors.* FROM authors
                              JOIN book_author ON authors.id = book_author.author_id
                              WHERE book_author.book_id = ?");
        $stmt->bind_param("i", $book_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $authors = [];
        while ($row = $result->fetch_assoc()) {
            $authors[] = new Author($row['id'], $row['name']);
        }
        return $authors;
    }

    public function getName()
    {
        return $this->name;
    }
}
?>
