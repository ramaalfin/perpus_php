<?php
session_start();
require_once('../database.php');


function countCategories()
{
    global $conn;
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM book_categories");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function countBooks()
{
    global $conn;
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM books");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function countMembers()
{
    global $conn;
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM members");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function countLoans()
{
    global $conn;
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM loans");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}