<?php
// ...
require_once('../database.php');

function getCategory()
{
    global $conn;
    $query = "SELECT * FROM book_categories";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $categories;
}
function getBooks()
{
    global $conn;
    $query = "SELECT books.*, book_categories.name as category FROM books JOIN book_categories ON books.category_id = book_categories.id ORDER BY title";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $books;
}

// Add a book
if (isset($_POST['addBtnSubmit'])) {
    $title = $_POST['title'];
    $category_id = $_POST['category_id'];
    $author = $_POST['author'];
    $publisher = $_POST['publisher'];
    $publish_year = $_POST['publish_year'];

    $sql = "INSERT INTO books (title, category_id, author, publisher, publish_year) VALUES (:title, :category_id, :author, :publisher, :publish_year)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        'title' => $title,
        'category_id' => $category_id,
        'author' => $author,
        'publisher' => $publisher,
        'publish_year' => $publish_year,
    ]);

    header("Location: index.php");
    exit();
}

// Update a book
if (isset($_POST['editBtnSubmit'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $category_id = $_POST['category_id'];
    $author = $_POST['author'];
    $publisher = $_POST['publisher'];
    $publish_year = $_POST['publish_year'];

    // Update book
    $stmt = $conn->prepare("UPDATE books SET title = :title, category_id = :category_id, author = :author, publisher = :publisher, publish_year = :publish_year WHERE id = :id");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':category_id', $category_id);
    $stmt->bindParam(':author', $author);
    $stmt->bindParam(':publisher', $publisher);
    $stmt->bindParam(':publish_year', $publish_year);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    header('Location: index.php');
    exit();
}

// Get a book by id
function getBookById($id)
{
    global $conn;
    $sql = "SELECT * FROM books WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch();
}