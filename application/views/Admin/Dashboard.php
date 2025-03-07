<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="icon" type="image/png" href="<?php echo base_url() . 'assets/images/hariom_dhabalogo.png' ?>">

    <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/style.css' ?>">

    <!-- <link rel="stylesheet" href="css/owl.carousel.min.css"> -->

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Include Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">



    <title>Admin-Dashboard</title>


    <style>
        /* Top cards */
        .custom-card {
            border-radius: 15px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-text {
            font-size: 1rem;

        }

        .card-number {
            font-size: 2rem;
            font-weight: bold;
        }

        .chart-container {
            width: 80px;
            height: 80px;
        }

        /* Bookings */
        /* .bookingsCard {
            height: 62rem;
        } */

        .Bookings_nav_pills .nav-link {
            background-color: #f8f9fa !important;
            /* Ensure it applies to inactive tabs */
            color: #6c757d !important;
            transition: all 0.3s ease-in-out;
        }

        .Bookings_nav_pills .nav-link.active {
            background-color: #007bff !important;
            /* Ensure it applies to active tabs */
            color: #fff !important;
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Offers */
        .carousel-inner {
            padding: 10px 0;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            padding: 10px;
        }
    </style>

    <!-- Revenue Card Css -->
    <style>
        .revenueCard {
            background-color: #fff;
            border-radius: 15px !important;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .revenueCard .card-header {
            border-bottom: 1px solid #f0f0f0;
        }

        .revenueCard .card-title {
            font-size: 1.5rem;
            color: #333;
            margin: 0;
        }

        .revenueCard .card-subtitle {
            font-size: 0.875rem;
            color: #999;
        }

        .revenueCard .card-body {
            padding-top: 15px;
        }

        .revenueCard .dropdown-menu {
            min-width: auto;
            font-size: 0.875rem;
        }
    </style>

    <style>
        /* Round and centered indicators */
        .carousel-indicators button {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: #ccc;
            border: none;
            margin: 0 5px;
        }

        .carousel-indicators .active {
            background-color: #000;
            /* Change to your desired active color */
        }

        /* Remove background from arrows */
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-image: none;
        }

        .carousel-control-prev-icon::after,
        .carousel-control-next-icon::after {
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            font-size: 24px;
            content: '\f104';
            /* Left arrow */
        }

        .carousel-control-next-icon::after {
            content: '\f105';
            /* Right arrow */
        }

        /* Center the indicators */
        .carousel-indicators {
            justify-content: center;
        }
    </style>

    <style>
        @media (min-width: 768px) and (max-width: 968px) {
            .menuSubCategory .menuIcon {
                font-size: 1rem !important;
            }

            .custom-card {
                height: 9.6rem !important;
            }


        }

        @media (max-width:768px) {
            .cards {
                gap: 10px;
            }

            /* .bookingsCard {
                height: auto !important;
            } */

        }
    </style>

    <style>
        /* .bookingsCard {
            max-width: 100%;
            overflow-x: auto;
        } */

        #bookingsChart,
        #bookingsChartWeekly,
        #bookingsChartToday {
            width: 100% !important;
            height: auto !important;
        }
    </style>


</head>

<body class="show-sidebar bg-light">

    <!-- Sidebar -->
    <?php $this->load->view('IncludeAdmin/CommonSidebar'); ?>
    <!-- SIDEBAR END -->

    <main>

        <!-- Navbar -->
        <?php $this->load->view('IncludeAdmin/CommonNavbar'); ?>
        <!-- Navbar End -->




        <!-- Main Content Container -->
        <div class="site-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="container">
                        <!-- Main Content starts here -->
                        <h2 class="mb-5 text-center">Admin Dashboard</h2>

                        <!-- Top Cards -->
                        <div class="row g-5 cards">
                            <!-- Bookings Card -->
                            <div class="col-md-4">
                                <div class="custom-card bg-white">
                                    <div>
                                        <p class="card-text">Total Bookings</p>
                                        <p class="card-number text-dark fw-bold" id="book">879</p>
                                    </div>
                                    <div class="chart-container position-relative">
                                        <canvas id="topBookingsChart"></canvas>
                                        <i class="bi bi-calendar-check position-absolute  translate-middle text-success" style="font-size: 2rem; z-index: 10;top:50%;left:50%;"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Reviews Card -->
                            <div class="col-md-4">
                                <div class="custom-card bg-white">
                                    <div>
                                        <p class="card-text">Total Reviews</p>
                                        <p class="card-number text-dark fw-bold" id="rew">345</p>
                                    </div>
                                    <div class="chart-container position-relative">
                                        <canvas id="reviewsChart"></canvas>
                                        <i class="bi bi-star-fill position-absolute  translate-middle text-warning" style="font-size: 2rem; z-index: 10;top:50%;left:50%;"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Customers Card -->
                            <div class="col-md-4">
                                <div class="custom-card bg-white">
                                    <div>
                                        <p class="card-text">Total Customers</p>
                                        <p class="card-number text-dark fw-bold" id="custo">1,204</p>
                                    </div>
                                    <div class="chart-container position-relative">
                                        <canvas id="customersChart"></canvas>
                                        <i class="bi bi-people-fill position-absolute  translate-middle text-primary" style="font-size: 2rem; z-index: 10;top:50%;left:50%;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            async function fetchCounts() {
                                try {
                                    let response = await fetch("<?php echo base_url('admin/getcounts'); ?>");
                                    if (!response.ok) {
                                        throw new Error(`HTTP error! Status: ${response.status}`);
                                    }
                                    let result = await response.json();

                                    if (result.status === "success") {
                                        const data = result.data;
                                        console.log("data", data); // Log the correct variable

                                        // Set data to respective IDs
                                        document.getElementById("custo").textContent = data.users;
                                        document.getElementById("rew").textContent = data.feedbacks;
                                        document.getElementById("book").textContent = data.bookings;
                                    } else {
                                        console.error("Error: Invalid response format");
                                    }
                                } catch (error) {
                                    console.error("Error fetching data:", error);
                                }
                            }

                            // Call the function on page load
                            window.onload = fetchCounts();
                        </script>


                        <!-- Top Cards Ends Here -->


                        <div class="row mt-4 g-4 justify-content-center align-items-stretch">
                            <!-- SECTION 1 -->
                            <!-- Bookings Graph -->
                            <div class="col-md-6 ">
                                <div class="card shadow-sm p-4" style="border-radius: 15px; height:100%">
                                    <h5 class="card-title">Bookings Summary</h5>
                                    <p class="text-muted">Check the bookings overview</p>

                                    <!-- Tabs -->
                                    <ul class="nav nav-pills mt-3 mb-3 justify-content-center Bookings_nav_pills" style="gap: 15px;">
                                        <li class="nav-item cursor-pointer">
                                            <button class="nav-link active p-2 border-0" data-bs-toggle="pill" data-bs-target="#monthly" style="border-radius: 10px;">Monthly</button>
                                        </li>
                                        <li class="nav-item cursor-pointer">
                                            <button class="nav-link border-0 p-2" data-bs-toggle="pill" data-bs-target="#weekly" style="border-radius: 10px;">Weekly</button>
                                        </li>
                                        <li class="nav-item cursor-pointer">
                                            <button class="nav-link border-0 p-2" data-bs-toggle="pill" data-bs-target="#today" style="border-radius: 10px;">Today</button>
                                        </li>
                                    </ul>



                                    <!-- Summary Section -->
                                    <div class="bg-light p-3 mt-2 rounded mb-4 d-flex align-items-center justify-content-between">
                                        <h6 class="mb-0">
                                            <span class="badge bg-success me-2" id="new">20</span> New Bookings
                                        </h6>
                                        <a href="<?php echo base_url() . 'bookings' ?>" class="text-primary fw-bold ">Manage bookings &rarr;</a>
                                    </div>

                                    <!-- Stats -->
                                    <div class="row text-center mb-5 stats" id="statsContainer">

                                    </div>

                                    <!-- Chart Section -->
                                    <div class="tab-content mt-2">
                                        <div class="tab-pane fade show active" id="monthly">
                                            <canvas id="bookingsChart" style="margin-top: 10px;"></canvas>
                                        </div>
                                        <div class="tab-pane fade" id="weekly">
                                            <canvas id="bookingsChartWeekly" style="margin-top: 10px;"></canvas>
                                        </div>
                                        <div class="tab-pane fade" id="today">
                                            <canvas id="bookingsChartToday" style="margin-top: 10px;"></canvas>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- Bookings Graph Ends Here -->
                            <!-- SECTION 1 ENDS HERE -->


                            <!-- SECTION 2 -->
                            <div class="col-md-6">
                                <div class="row " style="gap: 10px;">
                                    <!-- Offers Cards -->
                                    <div class="col-12">
                                        <div class="card shadow-sm p-4 position-relative" style="border-radius: 15px;height:15rem;">
                                            <!-- Edit Icon -->
                                            <a href="<?php echo base_url('admin/offers'); ?>" class="position-absolute text-dark" style="top: 10px; right: 10px; z-index: 10;">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            <!-- Card Header -->
                                            <h5 class="fw-bold text-dark mb-3">Exclusive Offers</h5>

                                            <!-- Carousel -->
                                            <div id="offersCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">
                                                <div class="carousel-inner" id="carouselContent">
                                                    <div class="carousel-item active">
                                                        <p class="text-center text-muted">Loading offers...</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                            const apiUrl = "<?php echo base_url('admin/get_offers'); ?>";

                                            fetch(apiUrl)
                                                .then(response => response.json())
                                                .then(data => {
                                                    if (data.status === 'success' && data.data.length > 0) {
                                                        const carouselContent = document.getElementById('carouselContent');
                                                        carouselContent.innerHTML = ''; // Clear the loading message

                                                        data.data.forEach((offer, index) => {
                                                            const isActive = index === 0 ? 'active' : '';

                                                            // Restrict offer description to 100 characters
                                                            const truncatedDesc = offer.offerDesc.length > 100 ?
                                                                offer.offerDesc.substring(0, 100) + "..." :
                                                                offer.offerDesc;

                                                            const offerItem = `
                            <div class="carousel-item ${isActive}">
                                <div class="d-flex align-items-center">
                                    <img src="<?php echo base_url('uploads/images/'); ?>${offer.image}" alt="Offer Image" class="rounded me-3 img-fluid" style="width: 120px; height: 120px; object-fit: cover;">
                                    <div>
                                        <h6 class="fw-bold text-dark">${offer.offerName}</h6>
                                        <p class="text-muted small mb-2">${truncatedDesc}</p>
                                    </div>
                                </div>
                            </div>
                        `;
                                                            carouselContent.innerHTML += offerItem;
                                                        });
                                                    } else {
                                                        document.getElementById('carouselContent').innerHTML = `
                        <div class="carousel-item active">
                            <p class="text-center text-muted">No offers available at the moment.</p>
                        </div>
                    `;
                                                    }
                                                })
                                                .catch(error => {
                                                    console.error('Error fetching offers:', error);
                                                    document.getElementById('carouselContent').innerHTML = `
                    <div class="carousel-item active">
                        <p class="text-center text-danger">Failed to load offers.</p>
                    </div>
                `;
                                                });
                                        });
                                    </script>



                                    <!-- Offers Cards Ends Here-->

                                    <!-- Menu Items Card -->
                                    <div class="col-12">
                                        <div class="card shadow-sm p-4 position-relative" style="border-radius: 15px; height: 15rem;">
                                            <!-- Edit Icon -->
                                            <a href="<?php echo base_url() . 'menus' ?>" class="position-absolute text-dark" style="top: 10px; right: 10px; z-index: 10;">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            <!-- Card Header -->
                                            <h5 class="fw-bold text-dark mb-3">Total Menu Items</h5>
                                            <h1 class="fw-bold text-primary">45</h1>

                                            <!-- Subcategories -->
                                            <div class="mt-3">
                                                <div class="row g-2">
                                                    <div class="col-6">
                                                        <p class="text-muted mb-1 d-flex  align-items-center menuSubCategory" style="gap:8px;">
                                                            <i class="fas fa-utensils text-dark me-4 fs-5 menuSubIcon"></i>Starters: <span class="text-dark fw-bold">10</span>
                                                        </p>
                                                        <p class="text-muted mb-1 d-flex  align-items-center menuSubCategory" style="gap:8px;">
                                                            <i class="fas fa-ice-cream text-dark me-4 fs-5 menuSubIcon"></i>Desserts: <span class="text-dark fw-bold">8</span>
                                                        </p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="text-muted mb-1 d-flex  align-items-center menuSubCategory" style="gap:8px;">
                                                            <i class="fas fa-concierge-bell text-dark me-4 fs-5 menuSubIcon"></i>Main Course: <span class="text-dark fw-bold">20</span>
                                                        </p>
                                                        <p class="text-muted mb-1 d-flex  align-items-center menuSubCategory" style="gap:8px;">
                                                            <i class="fas fa-coffee text-dark me-4 fs-5 menuSubIcon"></i>Beverages: <span class="text-dark fw-bold">7</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        async function fetchMenuCounts() {
                                            try {
                                                let response = await fetch("<?php echo base_url('admin/GetMenuCounts'); ?>");

                                                if (!response.ok) {
                                                    throw new Error(`HTTP error! Status: ${response.status}`);
                                                }

                                                let result = await response.json();

                                                if (result.status === "success") {
                                                    const data = result.data;

                                                    console.log("Fetched Data:", data);

                                                    // Set total menu count
                                                    document.querySelector("h1.fw-bold.text-primary").textContent = data.total_menus;

                                                    // Select all subcategory elements
                                                    let categoryElements = document.querySelectorAll(".menuSubCategory span");

                                                    // Update category counts dynamically (First 4 categories)
                                                    data.category_counts.slice(0, 4).forEach((category, index) => {
                                                        if (categoryElements[index]) {
                                                            categoryElements[index].textContent = category.menu_count;
                                                            categoryElements[index].parentElement.innerHTML = `
                            <i class="fas fa-utensils text-dark me-4 fs-5 menuSubIcon"></i>
                            ${category.category_name}: <span class="text-dark fw-bold">${category.menu_count}</span>
                        `;
                                                        }
                                                    });

                                                } else {
                                                    console.error("Invalid response format");
                                                }
                                            } catch (error) {
                                                console.error("Error fetching menu data:", error);
                                            }
                                        }

                                        // Call function on page load
                                        window.onload = fetchMenuCounts;
                                    </script>



                                    <!-- Menu Items Card Ends Here-->

                                    <!-- Revenue Graph  -->
                                    <div class="col-12">
                                        <div class="revenueCard card ">
                                            <div class="card-header d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h5 class="card-title">Revenue</h5>
                                                    <p class="card-subtitle text-muted">Track earnings across different time periods</p>
                                                </div>
                                                <div class="dropdown">
                                                    <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <span id="current-tab">Today</span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="#" onclick="changeTab('Today')">Today</a></li>
                                                        <li><a class="dropdown-item" href="#" onclick="changeTab('Weekly')">Weekly</a></li>
                                                        <li><a class="dropdown-item" href="#" onclick="changeTab('Monthly')">Monthly</a></li>
                                                        <li><a class="dropdown-item" href="#" onclick="changeTab('Yearly')">Yearly</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between mb-3">
                                                    <div>
                                                        <p class="text-primary fw-bold">Income</p>
                                                        <h5>₹<span id="income">41,512</span></h5>
                                                    </div>
                                                    <!-- <div>
                                                        <p class="text-danger fw-bold">Expense</p>
                                                        <h5>$<span id="expense">41,512</span>k</h5>
                                                    </div> -->
                                                </div>
                                                <canvas id="revenueChart"></canvas>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- Revenue Graph Ends Here -->

                                </div>
                            </div>
                            <!-- SECTION 2 ENDS HERE -->

                        </div>

                        <!-- Reviews Cards -->
                        <div class="row">
                            <div class="col-12">
                                <section class="gradient-custom">
                                    <div class="my-5 py-5">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-md-12">
                                                <div class="card shadow rounded" style="min-height: 20rem; border-radius:12px;">
                                                    <div class="card-body px-4 py-5">
                                                        <div id="carouselDarkVariant" class="carousel slide carousel-dark" data-bs-ride="carousel" data-bs-interval="2000">
                                                            <!-- Indicators -->
                                                            <div class="carousel-indicators" id="carousel-indicators"></div>

                                                            <!-- Inner -->
                                                            <div class="carousel-inner pb-5" id="carousel-inner"></div>

                                                            <!-- Controls -->
                                                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselDarkVariant" data-bs-slide="prev">
                                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                <span class="visually-hidden">Previous</span>
                                                            </button>
                                                            <button class="carousel-control-next" type="button" data-bs-target="#carouselDarkVariant" data-bs-slide="next">
                                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                <span class="visually-hidden">Next</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {
                                        async function fetchFeedbacks() {
                                            try {
                                                let response = await fetch("<?php echo base_url('getFeedbacks'); ?>");
                                                if (!response.ok) {
                                                    throw new Error(`HTTP error! Status: ${response.status}`);
                                                }
                                                let result = await response.json();
                                                if (result.status === "success") {
                                                    populateCarousel(result.data);
                                                }
                                            } catch (error) {
                                                console.error("Error fetching feedbacks:", error);
                                            }
                                        }

                                        function populateCarousel(feedbacks) {
                                            const carouselInner = document.getElementById("carousel-inner");
                                            const indicators = document.getElementById("carousel-indicators");

                                            carouselInner.innerHTML = "";
                                            indicators.innerHTML = "";

                                            feedbacks.forEach((feedback, index) => {
                                                let activeClass = index === 0 ? "active" : "";

                                                // Create indicators
                                                let indicator = document.createElement("button");
                                                indicator.type = "button";
                                                indicator.setAttribute("data-bs-target", "#carouselDarkVariant");
                                                indicator.setAttribute("data-bs-slide-to", index);
                                                indicator.setAttribute("aria-label", `Slide ${index + 1}`);
                                                if (index === 0) {
                                                    indicator.classList.add("active");
                                                    indicator.setAttribute("aria-current", "true");
                                                }
                                                indicators.appendChild(indicator);

                                                // Create carousel item
                                                let carouselItem = `
                    <div class="carousel-item ${activeClass}">
                        <div class="row d-flex justify-content-center">
                            <div class="col-lg-12 col-xl-10">
                                <div class="row">
                                    <div class="col-lg-4 d-flex justify-content-center">
                                        <img src="<?php echo base_url() . 'uploads/images/' ?>${feedback.image}" class="rounded-circle shadow-1 mb-4 mb-lg-0 img-fluid" alt="Customer avatar"style="width: 200px; height: 200px;"/>
                                    </div>
                                    <div class="col-lg-8 text-center text-lg-start">
                                        <h4 class="mb-2">${feedback.name}</h4>
                                        <p class="mb-1 text-muted">Customer</p>
                                        <div class="mb-3">
                                            ${generateStars(feedback.rating)}
                                        </div>
                                        <p>${feedback.comment}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                                                carouselInner.innerHTML += carouselItem;
                                            });
                                        }

                                        function generateStars(rating) {
                                            let stars = "";
                                            for (let i = 1; i <= 5; i++) {
                                                if (i <= rating) {
                                                    stars += `<i class="fas fa-star text-warning"></i> `;
                                                } else {
                                                    stars += `<i class="far fa-star text-warning"></i> `;
                                                }
                                            }
                                            return stars;
                                        }

                                        fetchFeedbacks();
                                    });
                                </script>





                            </div>

                        </div>
                        <!-- Reviews Cards Ends Here -->


                    </div>

                </div>
            </div>
        </div>
    </main>




    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Top Charts script-->
    <script>
        const chartOptions = {
            type: 'doughnut',
            data: {
                labels: ['Completed', 'Remaining'],
                datasets: [{
                    data: [75, 25],
                    backgroundColor: ['#6a5acd', '#e0e0e0'],
                    borderWidth: 0
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                },
                cutout: '75%',
                responsive: true,
                maintainAspectRatio: false
            }
        };

        // Bookings Chart
        new Chart(document.getElementById('topBookingsChart').getContext('2d'), {
            ...chartOptions,
            data: {
                ...chartOptions.data,
                datasets: [{
                    ...chartOptions.data.datasets[0],
                    backgroundColor: ['#4caf50', '#e0e0e0']
                }]
            }
        });

        // Reviews Chart
        new Chart(document.getElementById('reviewsChart').getContext('2d'), {
            ...chartOptions,
            data: {
                ...chartOptions.data,
                datasets: [{
                    ...chartOptions.data.datasets[0],
                    backgroundColor: ['#ffb400', '#e0e0e0']
                }]
            }
        });

        // Customers Chart
        new Chart(document.getElementById('customersChart').getContext('2d'), {
            ...chartOptions,
            data: {
                ...chartOptions.data,
                datasets: [{
                    ...chartOptions.data.datasets[0],
                    backgroundColor: ['#007bff', '#e0e0e0']
                }]
            }
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const statsData = {
                '#today': {
                    inProgress: 0,
                    completed: 0,
                    cancelled: 0
                },
                '#weekly': {
                    inProgress: 0,
                    completed: 0,
                    cancelled: 0
                },
                '#monthly': {
                    inProgress: 0,
                    completed: 0,
                    cancelled: 0
                },
            };

            let charts = {}; // Store chart instances

            function initializeChart(canvasId, labels, data, colors) {
                const ctx = document.getElementById(canvasId);
                if (!ctx) return; // Ensure canvas exists

                if (charts[canvasId]) {
                    charts[canvasId].destroy(); // Destroy existing chart before re-creating
                }

                charts[canvasId] = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            backgroundColor: colors
                        }]
                    },
                    options: {
                        responsive: true
                    }
                });
            }

            function updateStats(target) {
                const stats = statsData[target];
                const statsContainer = document.getElementById('statsContainer');
                statsContainer.innerHTML = ''; // Clear previous stats

                if (stats) {
                    if (target === "#today" && stats.inProgress !== undefined) {
                        statsContainer.innerHTML += `
                <div class="col">
                    <h6 class="mb-1">${stats.inProgress || 0}</h6>
                    <p class="text-muted small">In Progress</p>
                </div>`;
                    }

                    statsContainer.innerHTML += `
            <div class="col">
                <h6 class="mb-1">${stats.completed || 0}</h6>
                <p class="text-muted small">Completed</p>
            </div>`;

                    statsContainer.innerHTML += `
            <div class="col">
                <h6 class="mb-1">${stats.cancelled || 0}</h6>
                <p class="text-muted small">Cancelled</p>
            </div>`;
                }
            }


            // Fetch data once and update charts/stats
            fetch("<?php echo base_url() . 'admin/GetBookingCounts' ?>")
                .then(response => response.json())
                .then(data => {
                    console.log("Fetched Data:", data);

                    if (data.status === "success" && data.data) {
                        statsData["#today"] = {
                            inProgress: data.data.pending + data.data.approved,
                            completed: data.data.completed,
                            cancelled: data.data.cancelled,
                        };
                        statsData["#weekly"] = {
                            inProgress: data.data.pending_weekly + data.data.approved_weekly,
                            completed: data.data.completed_weekly,
                            cancelled: data.data.cancelled_weekly,
                        };
                        statsData["#monthly"] = {
                            inProgress: data.data.pending_monthly + data.data.approved_monthly,
                            completed: data.data.completed_monthly,
                            cancelled: data.data.cancelled_monthly,
                        };
                        document.getElementById('new').textContent = data.data.pending ;

                        // Initialize charts after data is updated
                        initializeChart('bookingsChart', ['Completed', 'Cancelled'],
                            [statsData["#monthly"].completed, statsData["#monthly"].cancelled], ['#28a745', '#dc3545']);

                        initializeChart('bookingsChartWeekly', ['Completed', 'Cancelled'],
                            [statsData["#weekly"].completed, statsData["#weekly"].cancelled], ['#28a745', '#dc3545']);

                        initializeChart('bookingsChartToday', ['In Progress', 'Completed', 'Cancelled'],
                            [statsData["#today"].inProgress, statsData["#today"].completed, statsData["#today"].cancelled], ['#ffc107', '#28a745', '#dc3545']);

                        updateStats('#monthly'); // Default to Today tab
                    }
                })
                .catch(error => console.error("Error fetching booking data:", error));

            document.querySelectorAll('.nav-link').forEach((tab) => {
                tab.addEventListener('shown.bs.tab', (e) => {
                    const target = e.target.getAttribute('data-bs-target');
                    updateStats(target);
                    initializeChart(
                        target === "#monthly" ? 'bookingsChart' :
                        target === "#weekly" ? 'bookingsChartWeekly' : 'bookingsChartToday',
                        target === "#today" ? ['In Progress', 'Completed', 'Cancelled'] : ['Completed', 'Cancelled'],
                        target === "#today" ? [statsData[target].inProgress, statsData[target].completed, statsData[target].cancelled] : [statsData[target].completed, statsData[target].cancelled],
                        target === "#today" ? ['#ffc107', '#28a745', '#dc3545'] : ['#28a745', '#dc3545']
                    );
                });
            });
        });
    </script>




    <!-- SCRIPT DSIALPYING REVENUE DATA -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initializeChart();
            fetchRevenueData(); // Fetch revenue data on page load
        });

        const basePath = "<?= base_url() ?>";
        console.log("Base Path:", basePath);

        let revenueData = {
            Today: Array(8).fill(0), // 8 slots (3-hour each)
            Weekly: Array(7).fill(0), // 7 days (Monday-Sunday)
            Monthly: Array(5).fill(0), // 5 weeks
            Yearly: Array(12).fill(0) // 12 months (Jan-Dec)
        };

        // Function to fetch revenue data from the backend
        function fetchRevenueData() {
            fetch(`${basePath}/admin/getRevenueData`)
                .then(response => response.json())
                .then(data => {
                    console.log("API Response:", data);
                    processRevenueData(data);
                })
                .catch(error => console.error('Error fetching revenue data:', error));
        }

        // Function to process revenue data and update chart
        function processRevenueData(data) {
            if (data) {
                revenueData.Today = data.Today || Array(8).fill(0); // Adjusted for 3-hour slots
                revenueData.Weekly = data.Weekly || Array(7).fill(0);
                revenueData.Monthly = data.Monthly || Array(5).fill(0);
                revenueData.Yearly = data.Yearly || Array(12).fill(0);
            }

            // Update the chart and income with "Today" data as default
            updateChart("Today");
        }

        let revenueChart; // Declare the chart globally

        // Function to initialize the chart
        function initializeChart() {
            const ctx = document.getElementById('revenueChart').getContext('2d');

            const data = {
                labels: [], // Initially empty
                datasets: [{
                    label: 'Revenue',
                    data: [], // Initially empty
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                }]
            };

            const config = {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `₹${context.raw.toLocaleString()}`;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(200, 200, 200, 0.2)'
                            },
                            ticks: {
                                callback: function(value) {
                                    return `₹${value}`;
                                }
                            }
                        }
                    }
                }
            };

            revenueChart = new Chart(ctx, config);
        }

        // Function to update the chart dynamically and update total income
        function updateChart(tabName) {

            let labels = [];
            let dataset = [];

            if (tabName === "Today") {
                labels = ["12-3 AM", "3-6 AM", "6-9 AM", "9-12 PM", "12-3 PM", "3-6 PM", "6-9 PM", "9-12 AM"]; // 3-hour slots
                dataset = revenueData.Today;
            } else if (tabName === "Weekly") {
                labels = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
                dataset = revenueData.Weekly;
            } else if (tabName === "Monthly") {
                labels = ["Week 1", "Week 2", "Week 3", "Week 4", "Week 5"];
                dataset = revenueData.Monthly;
            } else if (tabName === "Yearly") {
                labels = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                dataset = revenueData.Yearly;
            }

            if (revenueChart) {
                revenueChart.data.labels = labels;
                revenueChart.data.datasets[0].data = dataset;
                revenueChart.update();
            }

            updateIncome(dataset);
            document.getElementById('current-tab').textContent = tabName;
        }

        // Function to update total income dynamically
        function updateIncome(dataset) {
            const totalIncome = dataset.reduce((acc, val) => acc + val, 0); // Sum all values
            document.getElementById("income").textContent = formatNumber(totalIncome); // Format with "K", "M", "B"
        }

        // Helper function to convert large numbers into "K", "M", "B" with 4 decimal places
        function formatNumber(num) {
            if (num >= 1_000_000_000) {
                return (num / 1_000_000_000).toFixed(4) + "B"; // Billion
            } else if (num >= 1_000_000) {
                return (num / 1_000_000).toFixed(4) + "M"; // Million
            } else if (num >= 1_000) {
                return (num / 1_000).toFixed(4) + "K"; // Thousand
            }
            return num.toFixed(4); // Less than 1K, show normal number with 4 decimals
        }



        // Function to handle tab changes
        function changeTab(tabName) {
            event.preventDefault(); // Prevents page from jumping to the top
            updateChart(tabName); // Use already processed data
        }
    </script>






    <!-- Bootstrap JS (including jQuery and Popper.js for dropdown functionality) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Sidebar Toggler Script -->
    <script src="<?php echo base_url() . 'assets/js/main.js' ?>"></script>

</body>

</html>