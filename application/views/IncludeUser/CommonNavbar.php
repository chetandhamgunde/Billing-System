<style>
    /* Sticky and blurred navbar styles */
    .navbar {
        position: fixed !important;
        width: 100%;
        top: 0;
        z-index: 1050;
        background-color: rgba(255, 255, 255);
        /* background-color: #F68822; */
        /* backdrop-filter: blur(10px); */
        /* transition: background-color 0.3s ease, box-shadow 0.3s ease; */
    }

    html {
        scroll-behavior: smooth;
    }

    body {
        margin-top: 4.52rem !important;
        width: 100% !important;
        /* overflow-x:hidden; */
    }

    .navbar.scrolled {
        /* background-color: rgba(255, 255, 255, 0.9); */
        /* box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); */
    }

    /* Link hover effect */
    .nav-link {
        position: relative;
        transition: color 0.3s ease;
        font-size: 1.2rem;
        margin: 0 10px;
    }

    .nav-link::after {
        content: '';
        position: absolute;
        left: 50%;
        bottom: 0;
        width: 0;
        height: 2px;
        background-color: #F68822;
        transition: width 0.3s ease, left 0.3s ease;
    }

    .nav-link:hover::after {
        width: 100%;
        left: 0;
    }

    #profileDropdown:focus,
    #profileDropdown:active,
    #profileDropdown:focus-visible {
        outline: none !important;
        border: none !important;
        box-shadow: none !important;
    }

    .dropdown:focus,
    .dropdown:active,
    .dropdown:focus-visible {
        outline: none !important;
        border: none !important;
        box-shadow: none !important;
    }

    .dropdown-menu-end[data-bs-popper] {
        right: 0;
        left: auto;
    }

    @media (max-width: 767.98px) {
        .dropdown-menu-end[data-bs-popper] {
            left: 0 !important;
            right: auto !important;
        }
    }

    @media (max-width: 992px) {
    /* .dropdown-menu {
        position: static;
        float: none;
    } */

    .dropdown-menu-end[data-bs-popper]{
        left:60px !important;
        /* position: relative; */
        top:100%;
        margin-top:-55px !important;
    }
}

</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light border-bottom py-1 w-100">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand py-0 my-0 ms-3"  style="width:70px;" disabled>
            <!-- <span class="me-2">
                <span class="w-3 h-6 rounded-circle bg-danger d-inline-block"></span>
                <span class="w-3 h-6 rounded-circle bg-pink d-inline-block"></span>
            </span>
            <span>Hari Om Dhaba</span> -->
            <img src="<?php echo base_url() . 'assets/images/hariom_dhabalogo.png' ?>" alt="Hari Om Dhaba Logo" class="img-fluid"
                  style="height: auto; width:90%;">
        </a>

        <!-- Navbar toggler for mobile view -->
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarContent"
            aria-controls="navbarContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar content -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <!-- Centered navigation links -->
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-2">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?php echo base_url() . 'Home' ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url() . 'Home' ?>#about-us">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url() . 'Home' ?>#offer">Offers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url() . 'Menu' ?>">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url() . 'Menu' ?>#footer">Contact Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url() . 'TableBooking' ?>">Book Table</a>
                </li>
            </ul>

            <!-- Right-aligned Login/Signup or Profile Dropdown -->
            <div class="d-flex">
                <?php if ($this->session->userdata('Logged_in')) { ?>
                    <div class="dropdown">
                        <button
                            class="btn btn-white dropdown-toggle py-0"
                            type="button"
                            id="profileDropdown"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >
                            <i class="bi bi-person fs-3"></i>
                        </button>
                        <ul
                            class="dropdown-menu dropdown-menu-end"
                            aria-labelledby="profileDropdown"
                            style="min-width: 200px; max-width: 90%;">
                        <li class="px-3 py-2">
                            <strong>Hello <?php echo $this->session->userdata('name'); ?></strong><br>
                            <span class="text-muted"><?php echo $this->session->userdata('mobile'); ?></span>
                        </li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?php echo base_url() . 'userprofile' ?>">Profile</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?php echo base_url() . 'userbookings' ?>">Bookings</a>
                            </li>
                            <li>
                            <a class="dropdown-item text-danger" href="#" onclick="confirmLogout(event)">Logout</a>

<script>
function confirmLogout(event) {
    event.preventDefault(); // Prevent immediate navigation

    Swal.fire({
        title: "Are you sure?",
        text: "You will be logged out!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, Logout!"
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
                <?php } else { ?>
                    <a href="<?= base_url('login'); ?>" class="btn d-dark-bg-color btn-lg me-2 text-white py-1">
                        Login/SignUp
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
</nav>

<!-- Bootstrap 5 CSS & JS -->
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bsootstrap.bundle.min.js"></script> -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
    var navbarCollapse = document.querySelector('.navbar-collapse');
    var navbarToggler = document.querySelector('.navbar-toggler');

    navbarCollapse.addEventListener('click', function (event) {
        if (event.target.tagName === 'A' && navbarCollapse.classList.contains('show')) {
            // Only toggle if the clicked element is an anchor and the navbar is currently expanded
            navbarToggler.click();
        }
    });
});

</script>