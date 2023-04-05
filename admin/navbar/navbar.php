<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 me-5 my-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-semibold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"></i>&ensp;Admin
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="<?= $BASE_URL ?>admin/account-pages/kelola-akun/edit?username=<?= $_SESSION['login'] ?>">Settings</a></li>
                        <li><a class="dropdown-item text-danger" href="#" onclick="window.location.replace('<?= $BASE_URL ?>app/functions/log_out.php')">Log Out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>