<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?= $title ?? "Déclarer un ticket" ?></title>
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">

    <link type="text/css" href="/assets/vendors/notyf/notyf.min.css" rel="stylesheet">
    <link type="text/css" href="/assets/css/volt.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-dark navbar-theme-primary px-4 col-12 d-lg-none">
        <a class="navbar-brand me-lg-5" href="#">
            <img class="navbar-brand-dark" src="#" alt="Volt logo">
            <img class="navbar-brand-light" src="#" alt="Volt logo">
        </a>
        <div class="d-flex align-items-center">
            <button class="navbar-toggler d-lg-none collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <?= includes('includes/_sidebar') ?>

    <main class="content">
        <nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-dark ps-0 pe-2 pb-0" aria-label="navigation" >
            <div class="container-fluid px-0">
                <div class="d-flex justify-content-end w-100" id="navbarSupportedContent">
                    <button id="sidebar-toggle"
                        class="sidebar-toggle me-3 btn btn-icon-only d-none d-lg-inline-block align-items-center justify-content-center">
                        <svg class="toggle-icon" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                clip-rule="evenodd">
                            </path>
                        </svg>
                    </button>
                    <ul class="navbar-nav align-items-center">
                        <li class="nav-item dropdown"><a
                                class="nav-link text-dark notification-bell unread dropdown-toggle"
                                data-unread-notifications="true" href="#" role="button" data-bs-toggle="dropdown"
                                data-bs-display="static" aria-expanded="false"><svg class="icon icon-sm text-gray-900"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z">
                                    </path>
                                </svg></a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-center mt-2 py-0">
                                <div class="list-group list-group-flush">
                                    <a href="#"
                                        class="text-center text-primary fw-bold border-bottom border-light py-3">
                                        Notifications
                                    </a>

                                    <a href="#" class="list-group-item list-group-item-action border-bottom">
                                        <div class="row align-items-center">
                                            <div class="col ps-0 ms-2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h4 class="h6 mb-0 text-small"><?= auth()->nom ?></h4>
                                                    </div>
                                                    <div class="text-end"><small>il ya 2hrs</small></div>
                                                </div>
                                                <p class="font-small mt-1 mb-0">
                                                    New message: "We need to improve the
                                                    UI/UX for the landing page."
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="dropdown-item text-center fw-bold rounded-bottom py-3">
                                        <svg class="icon icon-xxs text-gray-400 me-1" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                            <path fill-rule="evenodd"
                                                d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Tout voir
                                    </a>
                                </div>
                            </div>
                        </li>

                        <li class="nav-item dropdown ms-lg-3"><a class="nav-link dropdown-toggle pt-1 px-0" href="#"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="media d-flex align-items-center">
                                    <img class="avatar rounded-circle" alt="Image placeholder" src="#">
                                    <div class="media-body ms-2 text-dark align-items-center d-none d-lg-block">
                                        <span class="mb-0 font-small fw-bold text-gray-900"><?= auth()->u_username .' '. auth()->u_userLname ?></span>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu dashboard-dropdown dropdown-menu-end mt-2 py-1">
                                <div role="separator" class="dropdown-divider my-1"></div>
                                <form class="dropdown-item d-flex align-items-center" action="/logout" method="POST">
                                    <svg class="dropdown-icon text-danger me-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                        </path>
                                    </svg>
                                    <button class="btn btn-sm">Se déconnecter</button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <?= $content ?>
    </main>
    <script src="/assets/vendors/%40popperjs/core/dist/umd/popper.min.js"></script>
    <script src="/assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/assets/vendors/simple-datatables/dist/umd/simple-datatables.js"></script>
    <script src="/assets/vendors/notyf/notyf.min.js"></script>
    <script src="/assets/js/volt.js"></script>
    <script src="/assets/js/perso.js"></script>
</body>

</html>
