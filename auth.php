<?php 
session_start();
require('database.php');

if(isset($_POST['login'])) {
    global $conn;
    $username = $_POST['username'];
    $password = $_POST['password'];
    // Cek apakah email dan password cocok dengan data yang ada di tabel users
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Jika data ditemukan, maka simpan informasi pengguna ke dalam session
     if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = [
            'id' => $user['id'],
            'username' => $user['username'],
            'email' => $user['email']
        ];
        header('Location: beranda/index.php');
        exit();
    } else {
        header('Location: index.php');
        exit();
    }
}


if(isset($_POST['addUser'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
    $result = $stmt->execute([
        'username' => $username, 
        'email' => $email,
        'password' => $password
    ]);

    if($result) {
        header('Location: beranda/index.php');
        exit();
    } else {
        header('Location: register.php');
        exit();
    }
}

?>