<?php
$title = "Members";
$active = "member";
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
                                        <h5 class="card-title text-primary ms-2">Members</h5>
                                        <div class="table-responsive text-nowrap">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Name</th>
                                                        <th>Address</th>
                                                        <th>Phone Number</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-border-bottom-0">
                                                    <?php
                                                    $no = 1;
                                                    $members = getMembers($offset, $perPage);
                                                    ?>
                                                    <?php foreach ($members as $member) : ?>
                                                        <tr>
                                                            <td><?= $no++ ?></td>
                                                            <td><?= $member['name'] ?></td>
                                                            <td><?= $member['address'] ?></td>
                                                            <td><?= $member['phone_number'] ?></td>
                                                            <td class="d-flex">
                                                                <!-- edit -->
                                                                <a href="edit.php?id=<?= $member['id'] ?>" class="dropdown-item p-1" id="editBtn">
                                                                    <i class="bx bx-edit-alt"></i>
                                                                </a>
                                                                <button class="dropdown-item p-1 btn-delete" data-id="<?= $member['id'] ?>">
                                                                    <i class="bx bx-trash "></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
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

<?php
$src = [
    '../assets/vendor/libs/jquery/jquery.js',
    '../assets/vendor/libs/popper/popper.js',
    '../assets/vendor/js/bootstrap.js',
    '../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js',
    '../assets/vendor/js/menu.js',
    '../assets/js/main.js',
    'https://buttons.github.io/buttons.js',
];
require('../layouts/footer.php')
?>