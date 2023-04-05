<nav class="navbar navbar-expand-xl navbar-light fixed-top bg-white border-bottom border-5 fancy-border">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= $BASE_URL ?>"> <img src="<?= $BASE_URL ?>img/logo.png" alt="Logo" width="64" class="d-inline-block align-text-middle py-1 ms-sm-5 me-3">
            <h5 class="d-inline">EBS FM UNHAS</h5>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse me-md-5 mx-5 my-3" id="navbarCollapse">
            <ul class="navbar-nav ms-auto mb-2 mb-md-0 align-items-start align-items-lg-center">
                <li class="nav-item" id="nav-item-news">
                    <a class="nav-link px-lg-2 px-xxl-4" aria-current="page" href="<?= $BASE_URL ?>news" id="nav-link-news">
                        <h6 class="m-0 p-0 d-inline">News</h6>
                    </a>
                </li>
                <?php if (authority_check() !== 'editor') : ?>
                    <li class="nav-item" id="nav-item-about">
                        <a class="nav-link px-lg-2 px-xxl-4" href="<?= $BASE_URL ?>about" id="nav-link-about">
                            <h6 class="m-0 p-0 d-inline">About Us</h6>
                        </a>
                    </li>
                <?php endif ?>
                <?php if (authority_check() !== 'editor') : ?>
                    <li class="nav-item" id="nav-item-listen">
                        <a class="nav-link px-lg-2 px-xxl-4" href="<?= $BASE_URL ?>listen" id="nav-link-listen">
                            <h6 class="m-0 p-0 d-inline">Listen</h6>
                        </a>
                    </li>
                <?php endif ?>
                <li class="nav-item" id="nav-item-chart">
                    <a class="nav-link px-lg-2 px-xxl-4" href="<?= $BASE_URL ?>chart" id="nav-link-chart">
                        <h6 class="m-0 p-0 d-inline">Chart</h6>
                    </a>
                </li>
                <?php if (authority_check() !== 'editor') : ?>
                    <li class="nav-item" id="nav-item-programs">
                        <a class="nav-link px-lg-2 px-xxl-4" href="<?= $BASE_URL ?>programs" id="nav-link-programs">
                            <h6 class="m-0 p-0 d-inline">Programs</h6>
                        </a>
                    </li>
                <?php endif ?>
                <?php if (authority_check() === 'user') : ?>
                    <li class="nav-item" id="nav-item-support">
                        <a class="nav-link px-lg-2 px-xxl-4 me-2 me-xxl-4" href="<?= $BASE_URL ?>user/support" id="nav-link-support">
                            <h6 class="m-0 p-0 d-inline">Support</h6>
                        </a>
                    </li>
                <?php endif ?>

                <?php if (authority_check() !== 'guest') : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle px-lg-2 px-xxl-4 me-2 me-xxl-4" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="nav-link-user">
                            <h6 class="m-0 p-0 d-inline text-primary"><i class="bi bi-person-fill h5"></i>&ensp;<?= fullname_check() ?></h6>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item fw-semibold" href="#"><i class="bi bi-gear-fill"></i>&ensp;Settings</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item text-danger fw-semibold" href="#" onclick="window.location.replace('<?= $BASE_URL ?>app/functions/log_out.php')"><i class="bi bi-box-arrow-right"></i>&ensp;Log Out</a></li>
                        </ul>
                    </li>
                <?php endif ?>

                <?php if (authority_check() === 'guest') : ?>
                    <li class="nav-item" id="nav-item-account">
                        <a class="mt-lg-0 btn btn-outline-primary border-1 rounded-pill fw-bold px-5 px-md-3 px-xl-3 px-xxl-4 ms-0 ms-lg-3 me-0 mt-3" href="<?= $BASE_URL ?>login">
                            Log In
                        </a>
                        <a class="btn btn-primary rounded-pill fw-bold border-1 px-5 px-md-3 px-xl-3 px-xxl-4 mt-lg-0 mt-3" href="<?= $BASE_URL ?>sign-up">
                            Sign Up
                        </a>
                    </li>
                <?php endif ?>

            </ul>
        </div>

    </div>
</nav>