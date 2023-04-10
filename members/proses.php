<?php 
require('../database.php');

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

?>