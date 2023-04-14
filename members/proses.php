<?php 
session_start();
require('../database.php');

if(!isset($_SESSION['user'])) {
    header('Location: ../index.php');
    exit();
}

function getMembers($offset, $perPage)
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM members ORDER BY name LIMIT :offset, :perPage");
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function countMembers()
{
    global $conn;
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM members");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['count'];
}

// Menampilkan tabel buku beserta fitur pagination
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$perPage = 5;
$offset = ($page - 1) * $perPage;
$members = getMembers($offset, $perPage);

$totalMembers = countMembers();
$totalPages = ceil($totalMembers / $perPage);

// Add Member
if (isset($_POST['addBtnSubmit'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];

    $query = "INSERT INTO members (name, address, phone_number) Values (:name, :address, :phone_number)";
    $stmt = $conn->prepare($query);
    $result = $stmt->execute([
        'name' => $name,
        'address' => $address,
        'phone_number' => $phone_number
    ]);
    if ($result) {
        $_SESSION['success_member'] = "Berhasil menambah member";
        header('Location: index.php');
        exit();
    } else {
        $_SESSION['error_member'] = "Gagal menambah member";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
}

// Update Member
if (isset($_POST['editBtnSubmit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];

    $stmt = $conn->prepare("UPDATE members SET name = :name, address = :address, phone_number = :phone_number WHERE id = :id");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':phone_number', $phone_number);
    $stmt->bindParam(':id', $id);
    $result = $stmt->execute();

    if ($result) {
        $_SESSION['success_member'] = "Berhasil mengubah data member";
        header('Location: index.php');
        exit();
    } else {
        $_SESSION['error_member'] = "Gagal mengubah data member";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
}

// Delete member
if (isset($_POST['delete_member'])) {
    $id = $_POST['id'];
    $stmt = $conn->prepare("DELETE FROM members WHERE id = ?");
    $result = $stmt->execute([$id]);

    if ($result) {
        $_SESSION['success_member'] = "Berhasil menghapus data member";
        header('Location: index.php');
        exit();
    } else {
        $_SESSION['error_member'] = "Gagal menghapus data member";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
}

?>