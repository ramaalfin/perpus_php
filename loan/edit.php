<?php
require_once('proses.php');
if(!isset($_SESSION['user']['username']) == "admin") {
    header('Location: ../index.php');
    exit();
}

$title = "Edit Loan";
$active = "loan";
$href = [
    'https://fonts.googleapis.com',
    'https://fonts.gstatic.com',
    'https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap',
    '../assets/vendor/fonts/boxicons.css',
    '../assets/vendor/css/core.css',
    '../assets/vendor/css/theme-default.css',
    '../assets/css/demo.css',
    '../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css',
    '../assets/vendor/css/pages/page-auth.css',
];
require('../layouts/header.php');
?>

<?php 
$id = $_GET['id'];
$query = $conn->prepare("SELECT * FROM loans WHERE id = :id");
$query->bindParam(':id', $id);
$query->execute();
$loan = $query->fetch(PDO::FETCH_ASSOC);
?>

<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->
        <?php
        // ASIDE
        $href = [
            '../beranda/index.php',
            '../book_categories/index.php',
            '../book/index.php',
            '../members/index.php',
            '../loan/index.php',
        ];
        require('../layouts/aside.php')
        ?>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">

            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="row">
                        <div class="col-lg-12 mb-4 order-0">
                            <div class="card" style="width: 50%;">
                                <div class="d-flex align-items-start row">
                                    <div class="card-body">
                                        <h5 class="card-title text-primary ms-2">Edit Loan</h5>
                                        <form action="proses.php" method="POST">
                                            <div class="p-2">
                                                <input type="hidden" name="id" value="<?= $loan['id'] ?>">
                                                <div class="row">
                                                    <div class="col mb-3">
                                                        <label for="member" class="form-label">Member</label>
                                                        <select name="member_id" id="member_id" class="form-select">
                                                            <?php 
                                                            $members = getMembers();
                                                            foreach ($members as $member) :?>
                                                                <option value="<?= $member['id'] ?>" <?= $member['id'] == $loan['member_id'] ? 'selected' : '' ?> ><?= $member['name'] ?></option>
                                                            <?php endforeach?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col mb-3">
                                                        <label for="book" class="form-label">Book</label>
                                                        <select name="book_id" id="book_id" class="form-select">
                                                            <?php 
                                                            $books = getBooks();
                                                            foreach ($books as $book) :?>
                                                                <option value="<?= $book['id'] ?>" <?= $book['id'] == $loan['book_id'] ? 'selected' : '' ?> ><?= $book['title'] ?></option>
                                                            <?php endforeach?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col mb-3">
                                                        <label for="loan_date" class="form-label">Loan Date</label>
                                                        <input type="date" id="loan_date" class="form-control" name="loan_date" value="<?= $loan['loan_date'] ?>" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col mb-3">
                                                        <label for="return_date" class="form-label">Return Date</label>
                                                        <input type="date" id="return_date" class="form-control" name="return_date" value="<?= $loan['return_date'] ?>" required>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary" id="btnSubmit" name="editBtnSubmit">Edit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- / Content -->

                <!-- Footer -->
                <footer class="content-footer footer bg-footer-theme">
                    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                        <div class="mb-2 mb-md-0">
                            ©
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            , made with ❤️ by
                            <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">ThemeSelection</a>
                        </div>
                        <div>
                            <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                            <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>

                            <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/" target="_blank" class="footer-link me-4">Documentation</a>

                            <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues" target="_blank" class="footer-link me-4">Support</a>
                        </div>
                    </div>
                </footer>
                <!-- / Footer -->
            </div>
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
</div>

<!-- / Layout wrapper -->
<?php
$src = [
    '../assets/vendor/libs/jquery/jquery.js',
    '../assets/vendor/libs/popper/popper.js',
    '../assets/vendor/js/bootstrap.js',
    '../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js',
    '../assets/vendor/js/menu.js',
    '../assets/js/main.js',
    'https://buttons.github.io/buttons.js',
    'script.js'
];

require('../layouts/footer.php')
?>