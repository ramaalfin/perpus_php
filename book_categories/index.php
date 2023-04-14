<?php
$title = "Book Categories";
$active = "category";
$href = [
    '../assets/vendor/fonts/boxicons.css',
    '../assets/vendor/css/core.css',
    '../assets/vendor/css/theme-default.css',
    '../assets/css/demo.css',
    '../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css',
    '../assets/vendor/css/pages/page-auth.css',
    '../assets/vendor/css/dataTables.bootstrap5.min.css',
];
require('../layouts/header.php');
?>

<?php require_once('proses.php') ?>

<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->
        <?php
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
            <?php if (isset($_SESSION['success_category']) || isset($_SESSION['error_category'])) : ?>
                <div class="bs-toast toast toast-placement-ex m-2 fade show bg-<?= (isset($_SESSION['success_category'])) ? 'success' : 'danger' ?> bottom-0 end-0" id="toastModal" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <i class="bx bx-bell me-2"></i>
                        <div class="me-auto fw-semibold">Notifications</div>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        <p><?php echo isset($_SESSION['success_category']) ? $_SESSION['success_category'] : $_SESSION['error_category'] ?></p>
                    </div>
                </div>

                <script>
                    $(document).ready(function() {
                        $("#toastModal").modal("show");
                    });
                </script>
            <?php endif; ?>

            <!-- NAVBAR -->
            <?php require('../layouts/nav.php')?>
            <!-- NAVBAR -->

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
                                            <h5 class="card-title text-primary ms-2">Book Categories</h5>
                                            <a href="tambah.php" class="btn btn-primary">+</a>
                                        </div>

                                        <div class="table-responsive text-nowrap">
                                            <table id="example" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Total Book</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-border-bottom-0">
                                                    <?php
                                                    $categories = getCategory($offset, $perPage);
                                                    ?>
                                                    <?php foreach ($categories as $category) : ?>
                                                        <tr>
                                                            <td>
                                                                <a href="edit.php?id=<?= $category['id'] ?>">
                                                                    <?= $category['name'] ?>
                                                                </a>
                                                            </td>
                                                            <td><?= $category['jumlah_buku'] ?></td>
                                                            <td class="d-flex gap-2 ">
                                                                <button type="button" class="dropdown-item w-auto p-1 btn-delete" data-id="<?= $category['id'] ?>">
                                                                    <i class="bx bx-trash"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- Paginate -->
                                        <div class="demo-inline-spacing">
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
                                        </div>
                                        <!--/ Basic Pagination -->
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

                                <div class="content-backdrop fade"></div>
                            </div>
                            <!-- Content wrapper -->
                        </div>
                        <!-- / Layout page -->
                    </div>

                    <!-- Overlay -->
                    <div class="layout-overlay layout-menu-toggle"></div>
                </div>
                <!-- / Layout wrapper -->

                <!-- modal delete -->
                <div class="modal fade" id="modalCenter" tabindex="-1" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalCenterTitle">Delete Book Category</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h5>Apakah Kamu yakin ingin menghapus data kategori buku ini?</h5>
                            </div>
                            <div class="modal-footer">
                                <form action="proses.php" method="post">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                        Close
                                    </button>
                                    <input type="hidden" name="id" id="category-id">
                                    <button type="submit" class="btn btn-primary" name="delete_category">Save changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                $src = [
                    '../assets/vendor/libs/jquery/jquery.js',
                    '../assets/vendor/libs/popper/popper.js',
                    '../assets/vendor/js/bootstrap.js',
                    '../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js',
                    '../assets/vendor/js/menu.js',
                    '../assets/js/main.js',
                    '../assets/vendor/js/jquery.dataTables.min.js',
                    '../assets/vendor/js/dataTables.bootstrap5.min.js',
                    'https://buttons.github.io/buttons.js',
                    '../assets/vendor/js/helpers.js',
                    '../assets/js/config.js',
                ];

                $script = "
<script>
    $(document).ready(function () {
        $('#example').DataTable({
            paging: false,
        });
    });
</script>
<script>
    const deleteBtn = document.querySelectorAll('.btn-delete');
    const deleteCategoryId = document.querySelector('#category-id');

    deleteBtn.forEach(button => {
        button.addEventListener('click', () => {
            const categoryId = button.getAttribute('data-id');
            deleteCategoryId.value = categoryId;
            $('#modalCenter').modal('show');
        });
    });
</script>
";

                require('../layouts/footer.php');
                unset($_SESSION['success_category']);
                unset($_SESSION['error_category']);
                ?>