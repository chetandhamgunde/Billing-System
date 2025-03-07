<style>
    @media (max-width:968px) {
        body.show-sidebar main {
            margin-left: 0px !important;
        }

    }

    aside .side-inner .nav-menu ul li a:hover {
        background: #f3f3f3 !important;
        color: #000 !important;
    }


    aside .side-inner .nav-menu ul li.active a {
        background: #f3f3f3 !important;
        color: #000 !important;
    }
</style>


<aside class="sidebar">
    <div class="toggle">
        <a href="#" class="burger js-menu-toggle" data-toggle="collapse" data-target="#main-navbar">
            <span></span>
        </a>
    </div>
    <div class="side-inner">

        <div class="profile">
            <img src="<?php echo base_url() . 'assets/images/hariom_dhabalogo.png' ?>" alt="Image" class="img-fluid">
            <h3 class="name">HARI OM DHABA</h3>
            <span class="country">Dashboard</span>
        </div>

        <div class="nav-menu">
            <ul>
                <li class="active">
                    <a href="<?php echo base_url() . 'dashboard' ?>" class="d-flex" style="gap:5px;"><i class="bi bi-house-door-fill me-2"></i>Dashboard</a>
                </li>

                <li class="has-submenu">
                    <a href="#" class="toggle-submenu d-flex" style="gap:5px;">
                        <img src="<?php echo base_url() . 'assets/images/services_icon.png' ?>" alt="servicesIcon" class="img-fluid" style="width:20px;height:20px">Services <span class="caret"></span>
                    </a>
                    <ul class="submenu mx-5">
                        <li><a href="<?php echo base_url() . 'offers' ?>" class="d-flex" style="gap:5px;"><i class="bi bi-tags-fill me-2"></i>Offers</a></li>
                        <li><a href="<?php echo base_url() . 'menus' ?>" class="d-flex" style="gap:5px;"><i class="bi bi-card-list me-2"></i>Menus</a></li>
                        <li><a href="<?php echo base_url() . 'table' ?>" class="d-flex" style="gap:5px;"><i class="bi bi-layout-wtf me-2"></i>Tables</a></li>
                        <li><a href="<?php echo base_url() . 'gallery' ?>" class="d-flex" style="gap:5px;"><i class="bi bi-images me-2"></i>Gallery</a></li>
                    </ul>
                </li>

                <li>
                    <a href="<?php echo base_url() . 'bookings' ?>" class="d-flex" style="gap:5px;"><i class="bi bi-calendar2-check-fill me-2"></i>Bookings</a>
                </li>
                <li>
                    <a href="<?php echo base_url() . 'admin/bill' ?>" class="d-flex" style="gap:5px;"><i class="bi bi-cash-coin me-2"></i>Bill Section</a>
                </li>
                <li>
                    <a href="<?php echo base_url() . 'report' ?>" class="d-flex" style="gap:5px;"><i class="bi bi-bar-chart-line-fill me-2"></i>Report</a>
                </li>
                <li>
                    <a href="<?php echo base_url() . 'profile' ?>" class="d-flex" style="gap:5px;"><i class="bi bi-person-fill me-2"></i>Profile</a>
                </li>
                <li>
                    <a href="javascript:void(0);" onclick="confirmLogout()" class="d-flex" style="gap:5px;">
                        <i class="bi bi-box-arrow-right me-2"></i>Log out
                    </a>

                    <script>
                        function confirmLogout() {
                            Swal.fire({
                                title: "Are you sure?",
                                text: "You will be logged out!",
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#d33",
                                cancelButtonColor: "#3085d6",
                                confirmButtonText: "Yes, Logout",
                                cancelButtonText: "Cancel"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "<?php echo base_url() . 'auth/logout' ?>";
                                }
                            });
                        }
                    </script>

                </li>
            </ul>
        </div>
    </div>
</aside>

<!-- Script for active Tabs -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const currentPath = window.location.pathname; // Get the current URL path
        const basePath = '<?php echo rtrim(parse_url(base_url(), PHP_URL_PATH), "/"); ?>'; // Get the relative base path (without domain)

        // Remove basePath from currentPath and trim leading/trailing slashes
        let currentPage = currentPath.replace(basePath, '').replace(/^\/+|\/+$/g, '');

        
        
        // Link references
        const links = {
            'dashboard': document.querySelector(`a[href$="/dashboard"]`),
            'offers': document.querySelector(`a[href$="/offers"]`),
            'menus': document.querySelector(`a[href$="/menus"]`),
            'gallery': document.querySelector(`a[href$="/gallery"]`),
            'bookings': document.querySelector(`a[href$="/bookings"]`),
            'profile': document.querySelector(`a[href$="/profile"]`),
            'report': document.querySelector(`a[href$="/report"]`)
        };

       

        // Loop through links and apply active class/style
        for (const [path, link] of Object.entries(links)) {
            if (currentPage === path && link) {
                link.classList.add('active'); // Apply 'active' class
                link.style.background = '#f3f3f3'; // Active link background
                link.style.color = '#000'; // Active link color

                // Expand submenu if the link is inside one
                const parentSubmenu = link.closest('.submenu');
                if (parentSubmenu) {
                    parentSubmenu.classList.add('show'); // Show the submenu
                    const toggle = parentSubmenu.previousElementSibling;
                    if (toggle && toggle.classList.contains('toggle-submenu')) {
                        toggle.classList.add('active');
                    }
                }
            } else if (link) {
                link.classList.remove('active'); // Remove 'active' class from non-active links
            }
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<!-- Services Toggler -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggles = document.querySelectorAll('.toggle-submenu');

        toggles.forEach(toggle => {
            toggle.addEventListener('click', (e) => {
                e.preventDefault();

                const parent = toggle.parentElement; // Get the parent `<li>` element
                const submenu = parent.querySelector('.submenu'); // Get the submenu

                // Toggle the 'open' class to activate the transition effect
                parent.classList.toggle('open');
            });
        });
    });
</script>