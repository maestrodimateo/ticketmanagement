<nav id="sidebarMenu" class="sidebar d-lg-block bg-gray-800 text-white collapse" data-simplebar>
    <div class="sidebar-inner px-4 pt-3">
        <ul class="nav flex-column pt-3 pt-md-0">
            <li class="nav-item">
                <a href="#" class="nav-link d-flex align-items-center">
                    <span class="mt-1 sidebar-text">Gestion des tickets</span>
                </a>
            </li>

            <li class="nav-item">
                <span class="nav-link collapsed d-flex justify-content-between align-items-center">
                    <a href="/nouveau-ticket">
                        <span class="sidebar-icon">
                            <svg class="icon icon-xs me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-plus">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="12" y1="18" x2="12" y2="12"></line><line x1="9" y1="15" x2="15" y2="15"></line>
                            </svg>
                        </span>
                        <span class="sidebar-text">Déclarer un ticket</span>
                    </a>
                </span>
            </li>

            <!-- admin -->
            <?php if(auth()->is_admin()):  ?>
            <li class="nav-item">
                <span class="nav-link collapsed d-flex justify-content-between align-items-center">
                    <a href="/tickets-declares">
                        <span class="sidebar-icon">
                            <svg class="icon icon-xs me-2" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                            </svg>
                        </span>
                        <span class="sidebar-text">Tous les tickets</span>
                    </a>
                </span>
            </li>
            <li class="nav-item">
                <span class="nav-link collapsed d-flex justify-content-between align-items-center">
                    <a href="/mes-tickets-assignes">
                        <span class="sidebar-icon">
                            <svg class="icon icon-xs me-2" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </span>
                        <span class="sidebar-text">Vos tickets assignés</span>
                    </a>
                </span>
            </li>
            <?php endif ?>
            <!-- end admin -->

            <li class="nav-item">
                <span class="nav-link collapsed d-flex justify-content-between align-items-center">
                    <a href="/mes-tickets-declares">
                        <span class="sidebar-icon">
                            <svg class="icon icon-xs me-2" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </span>
                        <span class="sidebar-text">Vos tickets déclarés</span>
                    </a>
                </span>
            </li>
        </ul>
    </div>
</nav>