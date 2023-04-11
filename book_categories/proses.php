<?php 
session_start();
require('../database.php');

function getCategory($offset, $perPage){
    global $conn;
    $stmt = $conn->prepare("SELECT book_categories.id, book_categories.name, COUNT(books.id) AS jumlah_buku FROM book_categories LEFT JOIN books ON book_categories.id = books.category_id GROUP BY book_categories.id LIMIT :offset, :perPage");
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// PAGINATE
function countCategory()
{
    global $conn;
    $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM book_categories");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['count'];
}

// Menampilkan tabel category beserta fitur pagination
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$perPage = 5;
$offset = ($page - 1) * $perPage;
$categories = getCategory($offset, $perPage);

$totalCategories = countCategory();
$totalPages = ceil($totalCategories / $perPage);

// Add
if (isset($_POST['addBtnSubmit'])) {
    $name = $_POST['name'];
    $description = trim($_POST['description']);
    $stmt = $conn->prepare("INSERT INTO book_categories (name, description) VALUES (:name, :description)");
    $result = $stmt->execute([
        'name' => $name,
        'description' => $description,
    ]);
    if ($result) {
        $_SESSION['success_category'] = "Berhasil menambahkan data kategori buku";
        header('Location: index.php');
        exit();
    } else {
        $_SESSION['error_category'] = "Gagal menambahkan data kategori buku";
        header('Location: index.php');
        exit();
    }
}

// UPDATE
if (isset($_POST['editBtnSubmit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = trim($_POST['description']);
    
    $stmt = $conn->prepare("UPDATE book_categories SET name = :name, description = :description WHERE id = :id");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':id', $id);
    $result = $stmt->execute();

    if ($result) {
        $_SESSION['success_category'] = "Berhasil mengubah data kategori buku";
        header('Location: index.php');
        exit();
    } else {
        $_SESSION['error_category'] = "Gagal mengubah data kategori buku";
        header('Location: index.php');
        exit();
    }
}

// DELETE
if (isset($_POST['delete_category'])) {
    $id = $_POST['id'];
    $stmt = $conn->prepare("DELETE FROM book_categories WHERE id = ?");
    $result = $stmt->execute([$id]);

    if ($result) {
        $_SESSION['success_category'] = "Berhasil menghapus data kategori buku";
        header('Location: index.php');
        exit();
    } else {
        $_SESSION['serror_category'] = "Gagal mengubah data kategori buku";
        header('Location: index.php');
        exit();
    }
}

?>