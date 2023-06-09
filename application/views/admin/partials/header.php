<!--  Header Start -->
<header class="app-header shadow" style="background-color: #B2DDED;">
    <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
                <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                </a>
            </li>
        </ul>
        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                <!-- <a href="https://adminmart.com/product/modernize-free-bootstrap-admin-dashboard/" target="_blank" class="btn btn-primary">Download Free</a> -->
                <li class="nav-item dropdown">
                    <a href="<?= site_url('logout'); ?>" class=" mx-3 mt-2 d-block">
                        <h3>Logout</h3>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<!--  Header End -->