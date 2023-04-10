<?php
$title = "Books";
$active = "book";
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
require_once('proses.php');
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
            <!-- Toast-->
            <?php if (isset($_SESSION['success']) || isset($_SESSION['error'])) : ?>
                <div class="bs-toast toast toast-placement-ex m-2 fade show bg-success bottom-0 end-0" id="toastModal" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <i class="bx bx-bell me-2"></i>
                        <div class="me-auto fw-semibold">Notifications</div>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        <p><?php echo isset($_SESSION['success']) ? $_SESSION['success'] : $_SESSION['error'] ?></p>
                    </div>
                </div>

                <script>
                    $(document).ready(function() {
                        $("#toastModal").modal("show");
                    });
                </script>
            <?php endif; ?>
            <?php unset($_SESSION['success']); ?>
            <?php unset($_SESSION['error']); ?>
            <!-- Toast -->

            <!-- Navbar -->
            <?php require('../layouts/nav.php') ?>
            <!-- / Navbar -->

            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="row">
                        <div class="col-lg-12 mb-4 order-0">
                            <div class="card">
                                <div class="d-flex align-items-start row">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h5 class="card-title text-primary ms-2">Books</h5>
                                            <a href="tambah.php" class="btn btn-primary" id="addBtn">+</a>
                                        </div>

                                        <div class="table-responsive text-nowrap">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Title</th>
                                                        <th>Category</th>
                                                        <th>Author</th>
                                                        <th>Publisher</th>
                                                        <th>Publish Year</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-border-bottom-0" id="book-list">
                                                    <?php
                                                    $no = 1;
                                                    $books = getBooks($offset, $perPage);
                                                    ?>
                                                    <?php foreach ($books as $book) : ?>
                                                        <tr>
                                                            <td><?= $no++ ?></td>
                                                            <td><strong><?= $book['title'] ?></strong></td>
                                                            <td><?= ($book['category_id'] = $book['category']) ? $book['category'] : '' ?></td>
                                                            <td><?= $book['author'] ?></td>
                                                            <td><?= $book['publisher'] ?></td>
                                                            <td><?= $book['publish_year'] ?></td>
                                                            <td class="d-flex gap-2">
                                                                <!-- edit -->
                                                                <a href="edit.php?id=<?= $book['id'] ?>" class="dropdown-item p-1" id="editBtn">
                                                                    <i class="bx bx-edit-alt me-1"></i>
                                                                </a>
                                                                <button class="dropdown-item p-1 btn-delete" data-id="<?= $book['id'] ?>">
                                                                    <i class="bx bx-trash me-1"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- Paginate -->
                                <div class="demo-inline-spacing ms-3">
                                    <!-- Basic Pagination -->
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination">
                                            <?php if ($page > 1) : ?>
                                                <li class="page-item prev">
                                                    <a class="page-link" href="?page=<?= $page - 1 ?>"><i class="tf-icon bx bx-chevron-left"></i></a>
                                                </li>
                                            <?php endif ?>
                                            <?php for ($i = 1; $i < $totalPages; $i++) : ?>
                                                <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                                </li>
                                            <?php endfor ?>
                                            <?php if ($page < $totalPages) : ?>
                                                <li class="page-item next">
                                                    <a class="page-link" href="?page=<?= $page + 1 ?>"><i class="tf-icon bx bx-chevron-right"></i></a>
                                                </li>
                                            <?php endif ?>
                                        </ul>
                                    </nav>
                                    <!--/ Basic Pagination -->
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

<!-- modal -->
<div class="modal fade" id="modalCenter" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Delete Book</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <h5>Apakah Kamu yakin ingin menghapus buku ini?</h5>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <form action="proses.php" method="post">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <input type="hidden" name="id" id="delete-book-id">
                    <button type="submit" class="btn btn-primary" name="delete_book">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- / Layout wrapper -->
<?php
$src = [
    '../assets/vendor/libs/jquery/jquery.js',
    'https://code.jquery.com/jquery-3.6.0.min.js',
    '../assets/vendor/libs/popper/popper.js',
    '../assets/vendor/js/bootstrap.js',
    '../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js',
    '../assets/vendor/js/menu.js',
    '../assets/js/main.js',
    'https://buttons.github.io/buttons.js',
    'script.js'
];

$script = "
<script>
    const deleteButtons = document.querySelectorAll('.btn-delete');
    const deleteBookId = document.querySelector('#delete-book-id');

    deleteButtons.forEach(button => {
        button.addEventListener('click', () => {
            const bookId = button.getAttribute('data-id');
            deleteBookId.value = bookId;
            $('#modalCenter').modal('show');
        })
    })
</script>
";

require('../layouts/footer.php')
?>