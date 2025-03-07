
<style>
        body {
            font-family: "Work Sans", serif;
            margin: 0;
            padding: 0;
        }

        .d-dark-color {
            color: #F68822;
        }

        .d-dark-bg-color {
            background-color: #F68822;
        }

        .d-light-color {
            color: #FF9500;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 340px;
            min-height: 100vh;
            background-color: #fff !important;
            padding: 0px 2px;
            transition: transform 0.3s ease-in-out;
        }

        /* Sidebar Hidden on Mobile */
        @media (max-width: 1200px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                transform: translateX(-100%);
                height: 100%;
                z-index: 1000;
                padding: 20px 2px;
                box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            }

            .sidebar.show {
                transform: translateX(0);
            }
        }

        /* Toggle Button (Visible on Small Screens Only) */
        .toggle-btn {
            display: none;
            background-color: #F68822;
            color: white;
            border: none;
            padding: 10px 15px;
            font-size: 1.2rem;
            cursor: pointer;
            z-index: 1000;
        }

        @media (max-width: 768px) { 
            .toggle-btn {
                display: block;
                position:absolute;
                top:5rem;
                left:0.5rem;
                margin-bottom: 10px;
            }
        }

        .nav-pills{
            margin-top:2rem;
        }

        @media(max-width:769px){
            .nav-pills{
            margin-top:4.1rem;
        }
        }

        .nav-pills .nav-link::after {
            display:none;
        }

        .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
            background-color: #FFE6D6;
            color: #000;
        }
        
        .nav-pills .nav-link:hover {
            background-color: #FFE6D6;
            color: #000;
        }

       
    </style>

<!-- Sidebar Toggle Button (Visible on Small Screens) -->
<!-- <button class="toggle-btn" id="sidebarToggle"><i class="bi bi-list"></i></button> -->

<div class="d-flex">
    <!-- Sidebar (Always Visible on Large Screens) -->
    <div class="sidebar border bg-light" id="sidebar" style="min-height: 500px;">
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item mb-1">
                <a href="<?php echo base_url() . 'userprofile' ?>" class="nav-link text-dark" id="profileLink">
                    <i class="bi bi-person-circle me-2"></i> Profile
                </a>
            </li>
            <li>
                <a href="<?php echo base_url() . 'userbookings' ?>" class="nav-link text-dark mb-1" id="bookingsLink">
                    <i class="bi bi-calendar-check me-2"></i> Upcoming Bookings
                </a>
            </li>
            <li>
                <a href="<?php echo base_url() . 'userhistory' ?>" class="nav-link text-dark mb-1" id="historyLink">
                    <i class="bi bi-clock-history me-2"></i> Reservations History
                </a>
            </li>
            <li>
            <a href="<?php echo base_url() . 'auth/logout' ?>" class="nav-link text-dark mb-1" id="logoutLink">
                <i class="bi bi-box-arrow-right me-2"></i> Log Out
            </a>

<script>
document.getElementById("logoutLink").addEventListener("click", function(event) {
    event.preventDefault(); // Prevent direct navigation

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
});
</script>

            </li>
        </ul>
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        function removeActiveClass() {
            document.querySelectorAll('.nav-link').forEach(link => link.classList.remove('active'));
        }

        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function (event) {
                removeActiveClass();
                this.classList.add('active');
            });
        });

        // Preserve active state after page reload (Optional)
        let currentPath = window.location.pathname;
        document.querySelectorAll('.nav-link').forEach(link => {
            if (link.href.includes(currentPath)) {
                link.classList.add('active');
            }
        });
    });
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.getElementById("sidebar");
    const toggleButton = document.getElementById("sidebarToggle");

    // Toggle sidebar when button is clicked
    toggleButton.addEventListener("click", function (event) {
        sidebar.classList.toggle("show");
        event.stopPropagation(); // Prevent the event from bubbling up to the document
    });

    // Close sidebar when clicking outside of it
    document.addEventListener("click", function (event) {
        if (!sidebar.contains(event.target) && !toggleButton.contains(event.target)) {
            sidebar.classList.remove("show");
        }
    });
});

    </script>

