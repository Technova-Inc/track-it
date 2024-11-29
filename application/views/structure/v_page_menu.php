<!-- Sidebar -->
<nav class="sidebar d-flex flex-column">
    <ul class="nav flex-column">
        <div class="logo-container text-center py-3">
            <img src="<?php echo  site_url('../assets/logo/track-it-white.png') ?>" alt="Logo" class="logo-img" />
        </div>
        <li class="nav-item">
            <a href="#" class="nav-link active">
                <i class="bi bi-house-door-fill me-2"></i> Dashboard
            </a>
            <a href="#" class="nav-link">
                <i class="bi bi-house-door-fill me-2"></i> Dashboard
            </a>
        </li>
        <div class="accordion" id="sidebarAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button
                        class="accordion-button collapsed"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapseOne"
                        aria-expanded="false"
                        aria-controls="collapseOne"
                        disabled
                    >
                        <i class="bi bi-folder me-2"></i> Indisponible
                    </button>
                </h2>
                <div
                    id="collapseOne"
                    class="accordion-collapse collapse"
                    aria-labelledby="headingOne"
                    data-bs-parent="#sidebarAccordion"
                >
                    <div class="accordion-body">
                        <ul class="list-group">
                            <li><a href="#" class="list-group-item">Sub-item 1</a></li>
                            <li><a href="#" class="list-group-item">Sub-item 2</a></li>
                            <li><a href="#" class="list-group-item">Sub-item 3</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </ul>
    <a href="#" class="logout">
        <i class="bi bi-box-arrow-right me-2"></i>&nbsp;Déconnexion
    </a>
</nav>