<?php
session_start();
require('../database.php');

if(!isset($_SESSION['user'])) {
    header('Location: ../index.php');
    exit();
}

function getLoan($offset, $perPage)
{
    global $conn;

    $stmt = $conn->prepare("SELECT loans.*, books.title AS book, members.name AS name FROM loans JOIN books ON loans.book_id = books.id JOIN members ON loans.member_id = members.id ORDER BY loans.id LIMIT :offset, :perPage");

    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getBooks()
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM books");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getMembers()
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM members");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function countLoan()
{
    global $conn;
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM loans");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['count'];
}

// PAGINATE
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$perPage = 5;
$offset = ($page - 1) * $perPage;
$loans = getLoan($offset, $perPage);
$total_loan = countLoan();
$totalPage = ceil($total_loan / $perPage);

// ADD LOAN
if (isset($_POST['addBtnSubmit'])) {
    $id = $_POST['id'];
    $book_id = $_POST['book_id'];
    $member_id = $_POST['member_id'];
    $loan_date = $_POST['loan_date'];
    $return_date = $_POST['return_date'];

    // jumlah stok buku
    $stok = $conn->prepare("SELECT stok FROM books WHERE id = :book_id AND stok > 0");
    $result_stok = $stok->execute([
        'book_id' => $book_id
    ]);

    if ($stok->rowCount() > 0) {
        $loan = $conn->prepare("INSERT INTO loans (book_id, member_id, loan_date, return_date) VALUES (:book_id, :member_id, :loan_date, :return_date)");
        $result_loan = $loan->execute([
            'book_id' => $book_id,
            'member_id' => $member_id,
            'loan_date' => $loan_date,
            'return_date' => $return_date,
        ]);

        // todo Stok update by id book from table books
        $stok = $conn->prepare("UPDATE books SET stok = stok - 1 WHERE id = :book_id");

        // todo mengirimkan parameter $book_id ke query dan mengembalikan hasil eksekusi sebagai boolean true atau false.
        $result_stok = $stok->execute([
            'book_id' => $book_id
        ]);

        $_SESSION['success_loan'] = "Berhasil menambah data peminjaman buku";
        header('Location: index.php');
        exit();
    } else {
        $_SESSION['error_loan'] = "Stok Buku Kosong";
        header('Location: index.php');
        exit();
    }
}

// UPDATE LOAN
if (isset($_POST['editBtnSubmit'])) {
    // simpan data dari form
    $id = $_POST['id'];
    $book_id = $_POST['book_id'];
    $member_id = $_POST['member_id'];
    $loan_date = $_POST['loan_date'];
    $return_date = $_POST['return_date'];

    // Ambil member_id yang sedang meminjam
    $current_member_id = $conn->prepare("SELECT member_id FROM loans WHERE id = :id");
    $current_member_id->execute(['id' => $id]);
    $result_current_member_id = $current_member_id->fetch(PDO::FETCH_ASSOC);

    // Cek apakah member_id dari tabel loans berbeda dengan member_id yang sedang meminjam
    if ($result_current_member_id['member_id'] != $member_id) {
        // Jika member_id berbeda, maka stok buku tidak akan dikurangi
        $update_loan = $conn->prepare("UPDATE loans SET member_id = :member_id, loan_date = :loan_date, return_date = :return_date WHERE id = :id");
        $result_update_loan = $update_loan->execute([
            'member_id' => $member_id,
            'loan_date' => $loan_date,
            'return_date' => $return_date,
            'id' => $id
        ]);
    } 
    // Jika member_id sama dengan member_id yang sudah ada di data loans, maka stok buku akan dikurangi
    else {
        // cari book_id yang sedang dipinjam berdasarkan id peminjaman ($id) yang diinputkan
        $loaned_book_id = $conn->prepare("SELECT book_id FROM loans WHERE id = :id");
        $loaned_book_id->execute(['id' => $id]);
        $result_loan_book_id = $loaned_book_id->fetch(PDO::FETCH_ASSOC);

        // cek apakah book_id yang sedang dipinjam 
        if ($result_loan_book_id['book_id'] != $book_id) {
            $tambah_stok = $conn->prepare("UPDATE books SET stok = stok + 1 WHERE id = :book_id");
            $result_tambah_stock = $tambah_stok->execute(['book_id' => $result_loan_book_id['book_id']]);

            $kurang_stok = $conn->prepare("UPDATE books SET stok = stok - 1 WHERE id = :book_id");
            $result_kurang_stok = $kurang_stok->execute(['book_id' => $book_id]);
        }

        $update_loan = $conn->prepare("UPDATE loans SET book_id = :book_id, member_id = :member_id, loan_date = :loan_date, return_date = :return_date WHERE id = :id");
        $result_update_loan = $update_loan->execute([
            'book_id' => $book_id,
            'member_id' => $member_id,
            'loan_date' => $loan_date,
            'return_date' => $return_date,
            'id' => $id,
        ]);
    }
    if ($result_update_loan) {
        $_SESSION['success_loan'] = "Berhasil mengubah data peminjaman buku";
    } else {
        $_SESSION['error_loan'] = "Gagal mengubah data peminjaman buku";
    }
    header('Location: index.php');
    exit();
}
