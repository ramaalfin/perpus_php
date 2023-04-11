<?php
session_start();
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
function getBooks($offset, $perPage)
{
    global $conn;
    $stmt = $conn->prepare("SELECT books.*, book_categories.name as category FROM books JOIN book_categories ON books.category_id = book_categories.id ORDER BY title LIMIT :offset, :perPage");
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function countBooks()
{
    global $conn;
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM books");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['count'];
}

// Menampilkan tabel buku beserta fitur pagination
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$perPage = 5;
$offset = ($page - 1) * $perPage;
$books = getBooks($offset, $perPage);

$totalBooks = countBooks();
$totalPages = ceil($totalBooks / $perPage);


// Add a book
if (isset($_POST['addBtnSubmit'])) {
    $title = $_POST['title'];
    $category_id = $_POST['category_id'];
    $author = $_POST['author'];
    $publisher = $_POST['publisher'];
    $publish_year = $_POST['publish_year'];
    $stok = $_POST['stok'];

    $query = "INSERT INTO books (title, category_id, author, publisher, publish_year, stok) VALUES (:title, :category_id, :author, :publisher, :publish_year, :stok)";
    $stmt = $conn->prepare($query);
    $result = $stmt->execute([
        'title' => $title,
        'category_id' => $category_id,
        'author' => $author,
        'publisher' => $publisher,
        'publish_year' => $publish_year,
        'stok' => $stok,
    ]);

    if ($result) {
        $_SESSION['success_book'] = "Berhasil menambah data buku";
        header('Location: index.php');
        exit();
    } else {
        $_SESSION['error_book'] = "Gagal menambah data buku";
        header('Location: index.php');
        exit();
    }
}

// Update a book
if (isset($_POST['editBtnSubmit'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $category_id = $_POST['category_id'];
    $author = $_POST['author'];
    $publisher = $_POST['publisher'];
    $publish_year = $_POST['publish_year'];
    $stok = $_POST['stok'];

    // Update book
    $stmt = $conn->prepare("UPDATE books SET title = :title, category_id = :category_id, author = :author, publisher = :publisher, publish_year = :publish_year, stok = :stok WHERE id = :id");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':category_id', $category_id);
    $stmt->bindParam(':author', $author);
    $stmt->bindParam(':publisher', $publisher);
    $stmt->bindParam(':publish_year', $publish_year);
    $stmt->bindParam(':stok', $stok);
    $stmt->bindParam(':id', $id);
    $result = $stmt->execute();

    if ($result) {
        $_SESSION['success_book'] = "Berhasil mengubah data buku";
        header('Location: index.php');
        exit();
    } else {
        $_SESSION['error_book'] = "Gagal mengubah data buku";
        header('Location: index.php');
        exit();
    }
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

// Delete book by id
if (isset($_POST['delete_book'])) {
    $id = $_POST['id'];
    $stmt = $conn->prepare("DELETE FROM books WHERE id = ?");
    $result = $stmt->execute([$id]);

    if ($result) {
        $_SESSION['success_book'] = "Berhasil menghapus data buku";
        header('Location: index.php');
        exit();
    } else {
        $_SESSION['error_book'] = "Gagal menghapus data buku";
        header('Location: index.php');
        exit();
    }
}
