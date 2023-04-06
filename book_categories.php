<?php
require('layouts/header.php')
?>

<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->
        <?php require('layouts/aside.php')?>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->
            <?php require('layouts/nav.php')?>
            <!-- / Navbar -->

            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->

                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
                        <div class="col">
                            <div class="card h-100">
                                <img class="card-img-top" src="assets/img/elements/2.jpg" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Categories</h5>
                                    <p class="card-text">
                                        This is a longer card with supporting text below as a natural lead-in to additional content.
                                        This content is a little bit longer.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card h-100">
                                <img class="card-img-top" src="assets/img/elements/13.jpg" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Categories</h5>
                                    <p class="card-text">
                                        This is a longer card with supporting text below as a natural lead-in to additional content.
                                        This content is a little bit longer.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card h-100">
                                <img class="card-img-top" src="assets/img/elements/4.jpg" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Categories</h5>
                                    <p class="card-text">
                                        This is a longer card with supporting text below as a natural lead-in to additional content.
                                    </p>
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
require('layouts/footer.php')
?>