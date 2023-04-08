<?php 

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'php_perpus';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
} catch (PDOException $e) {
    echo "Connection failed: ".$e->getMessage();
}

?>