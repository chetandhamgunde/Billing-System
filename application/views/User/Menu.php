<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <link rel="icon" type="image/png" href="<?php echo base_url() . 'assets/images/hariom_dhabalogo.png' ?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Include Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <title>Hari-Om-Dhaba Menu</title>

    <style>
      body {
        font-family: "Work Sans", serif;
        padding: 0;
        margin: 0;
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
    </style>

    <style>
        .menu-container {
            margin: 0 auto;
            padding: 20px;
        }


        .menu-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px dashed #444;
        }

        .menu-item img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin-right: 15px;
        }

        .menu-details {
            display: flex;
            align-items: center;
            flex: 1;
        }

        .menu-details h4 {
            margin: 0;

        }

        .menu-details p {
            margin: 5px 0 0;
            color: #bbb;
            font-size: 0.9em;
        }

        .menu-price {
            color: #ff7315;
            color: white;
            font-weight: bold;
            font-size:1.4rem;
        }

        .menu-actions {
            display: flex;
            gap: 10px;
        }

        .menu-actions button {
            background: transparent;
        }
    </style>
    <style>
        .menu-header a {
            text-decoration: none;
            /* Remove underline */
            color: #333;
            /* Default text color */
            padding: 8px 12px;
            /* Spacing around text */
            border: 2px solid transparent;
            /* Invisible border for consistent spacing */
            border-radius: 5px;
            /* Rounded corners */
            transition: all 0.3s ease;
            /* Smooth transition effect */
            color: white;
        }

        .menu-header a:hover {
            border-color: #ff5722;
            /* Border color on hover */
            background-color: #f5f5f5;
            /* Light background for hover effect */
            color: #ff5722;
            /* Change text color to match border */
        }

        .menu-header a.active {
            border-color: #4caf50 !important;
            /* Active state border color */
            background-color: #e8f5e9 !important;
            /* Light green background for active state */
            color: #4caf50 !important;
            /* Text color for active state */
        }

        .menu-header span {
            font-weight: bold;
            /* Make the text bold */
            color: #555;
            /* Slightly darker color */
            
        }
        
        #searchBox {
        border: 2px solid orange; 
        border-radius: 25px;
        padding: 12px 20px;
        font-size: 16px;
        color: #333;
        
        outline: none;
        transition: 0.3s ease-in-out;
    }

        #searchBox:focus {
        box-shadow: none;
        border-color: darkorange;
    }

    .btn-primary {
        color: #fff;
        background-color: #ff5722;
        border-color: #ff5722;
    }

    .back-img {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            opacity:0.9;
        }

    .content-box {
    background: rgba(0, 0, 0, 0.6); /* Black with 50% transparency */
    padding: 20px;
    border-radius: 10px;
    color: white;
    text-align: center;
    height:100%;
    backdrop-filter: blur(1px);
    min-height: 100vh;
    /* max-width: 500px; */
}

    </style>
</head>

<body>
    <!-- Navbar -->
    <?php $this->load->view('IncludeUser/CommonNavbar'); ?>
    <!-- Navbar End -->
    <section class="back-img" style="background-image: url('<?php echo base_url(); ?>assets/images/sss.jpg'); background-attachment:fixed;">
        <div class="content-box">
            <div class="container pt-2">
                <div class="row">
                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                        <div class="border-start border-5 border-warning ps-2 mb-2">
                            <h3>Menu</h3>
                        </div>
                        <div class="col-12 col-md-6 mx-auto mb-2">
                            <input type="text" id="searchBox" class="form-control" placeholder="Search by name..." onkeyup="searchMenu()">
                        </div>
                        <span id="totalCount" class="badge text-light fs-5">Total Items: <span id="totalItems"></span></span>
                    </div>

                    <div class="menu-container">
                        <div class="menu-header d-flex justify-content-between flex-wrap gap-2">
                            <div class="d-flex flex-wrap gap-3 d-none d-md-flex">
                                <a href="#" class="active" onclick="filterMenu('All', this)">All</a>
                                <?php foreach ($categories as $category): ?>
                                    <a href="#" onclick="filterMenu(<?php echo $category['id']; ?>, this)">
                                        <?php echo $category['name']; ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>

                            <!-- Dropdown for Small Screens -->
                            <div class="d-block d-md-none">
                                <select class="form-control" id="menuDropdown" onchange="filterMenu(this.value)">
                                    <option value="All">All</option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?php echo $category['id']; ?>">
                                            <?php echo $category['name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div id="menuItems" class="mt-4 table text-light" style="">
                            <!-- Menu items will be dynamically inserted here -->
                             
                        </div>
                    </div>
                    <div id="paginationControls" class="d-flex justify-content-center mt-4">
                        <!-- Pagination buttons will be dynamically inserted here -->
                    </div>
                </div>
            </div>
        </div>
    </section>


        <script>
            const menuData = <?php echo json_encode($menus) ?>;
            const ImgBaseURL = "<?php echo base_url(); ?>uploads/menu/";

            const rowsPerPage = 8; // Number of items per page
            let currentPage = 1;

            let filteredMenuData = menuData; // To hold the currently filtered data

            // chetan script
            function displayMenuItems(page, data = menuData) {
    if (!Array.isArray(data) || data.length === 0) {
        document.getElementById("menuItems").innerHTML = 
            "<p style='color: red; text-align: center;'>No menu items found.</p>";
        return;
    }

    const start = (page - 1) * rowsPerPage;
    const end = start + rowsPerPage;
    const paginatedData = data.slice(start, end);
    const menuContainer = document.getElementById("menuItems");

    let tableHTML = `<div class="table-responsive">
        <table class="table text-light">
            <thead class="thead-dark">
                <tr>
                    <th class="text-start" style="min-width:250px;">Item</th>
                    <th class="text-start" style="min-width:250px;">Description</th>
                    <th class="text-start" style="min-width:100px;">Price</th>
                </tr>
            </thead>
            <tbody>`;

    paginatedData.forEach(item => {
        tableHTML += `
            <tr>
                <td class="align-middle" style="overflow:hidden;">
                    <div class="d-flex align-items-center">
                        <img src="${ImgBaseURL}${item.image}" alt="${item.name}" 
                             class="img-fluid rounded" style="width: 60px; height: 60px; margin-right: 10px;">
                        <h5 class="mb-0" style="font-size: 1rem; text-align:start;">${item.name}</h5>
                    </div>
                </td>
                <td class="align-middle text-left" style=" text-align:start;">${item.description}</td>
                <td class="align-middle text-left font-weight-bold" style=" text-align:start;">
                    ₹${parseFloat(item.price || 0).toFixed(2)}
                </td>
            </tr>`;
    });

    tableHTML += `</tbody></table></div>
     <!-- "No items found" message (Add this after the table) -->
    <p id="noItemsMessage" class="text-center text-danger mt-3" style="display: none;">No items found.</p>`; // Closing .table-responsive
    menuContainer.innerHTML = tableHTML;

    updatePagination(Math.ceil(data.length / rowsPerPage), page);
}

// chetan ended

            function updatePagination(totalPages, current) {
                const paginationContainer = document.getElementById("paginationControls");
                paginationContainer.innerHTML = ""; // Clear existing pagination buttons

                for (let i = 1; i <= totalPages; i++) {
                    const button = document.createElement("button");
                    button.textContent = i;
                    button.className = `btn btn-sm ${i === current ? "btn-primary" : "btn-secondary"}`;
                    button.onclick = () => {
                        currentPage = i;
                        displayMenuItems(currentPage);
                    };
                    paginationContainer.appendChild(button);
                }

                const prevButton = document.createElement("button");
                prevButton.textContent = "Previous";
                prevButton.className = "btn btn-sm btn-secondary me-2";
                prevButton.disabled = current === 1;
                prevButton.onclick = () => {
                    if (currentPage > 1) {
                        currentPage--;
                        displayMenuItems(currentPage);
                    }
                };

                const nextButton = document.createElement("button");
                nextButton.textContent = "Next";
                nextButton.className = "btn btn-sm btn-secondary ms-2";
                nextButton.disabled = current === totalPages;
                nextButton.onclick = () => {
                    if (currentPage < totalPages) {
                        currentPage++;
                        displayMenuItems(currentPage);
                    }
                };

                paginationContainer.prepend(prevButton);
                paginationContainer.appendChild(nextButton);
            }

            function filterMenu(category, element = null) {
                // Remove 'active' class from all links
                const links = document.querySelectorAll(".d-flex a");
                links.forEach(link => link.classList.remove("active"));

                // Add 'active' class to the clicked link
                if (element) {
                    element.classList.add("active");
                }

                // Reset current page
                currentPage = 1;

                // Filter menu items based on category_id
                const filteredData = category === "All" ?
                    menuData :
                    menuData.filter(item => item.category_id == category);

                console.log("Filtered Data:", filteredData); // Debugging

                // Display filtered menu items
                displayMenuItems(currentPage, filteredData);
            }

            // Initialize
            displayMenuItems(currentPage);
        </script>




        <script>
            // Function to update the total count
            function updateTotalCount() {
                const totalItems = menuData.length; // Calculate the total items from the menuData array
                document.getElementById("totalItems").textContent = totalItems; // Update the span with the total count
            }
            updateTotalCount();
            // Function to open the edit modal with item data
            function editItem(itemId) {
                const item = menuData.find(menuItem => menuItem.id === itemId);
                if (item) {
                    document.getElementById('editId').value = item.id;
                    document.getElementById('editName').value = item.name;
                    document.getElementById('editDesc').value = item.desc;
                    document.getElementById('editPrice').value = item.price;
                    document.getElementById('currentImage').src = "<?php echo base_url() . 'assets/images/' ?>" + item.image;
                    $('#editModal').modal('show'); // Open modal
                }
            }
        </script>



    </div>
    </div>




    <!-- Bootstrap JS (including jQuery and Popper.js for dropdown functionality) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
             <!-- script added by chetan for searches -->
    <script>
     function searchMenu() {
    let input = document.getElementById("searchBox").value.toLowerCase();
    let rows = document.querySelectorAll("#menuItems table tbody tr");
    let noItemsMessage = document.getElementById("noItemsMessage");
    let found = false;

    rows.forEach(row => {
        let name = row.querySelector("td h5").innerText.toLowerCase();
        if (name.includes(input)) {
            row.style.display = ""; // Show matching rows
            found = true;
        } else {
            row.style.display = "none"; // Hide non-matching rows
        }
    });

    // Show/hide "No items found" message
    if (found) {
        noItemsMessage.style.display = "none";
    } else {
        noItemsMessage.style.display = "block";
    }
  }
    </script>
      <div id="footer">
    <?php $this->load->view('IncludeUser/CommonFooter'); ?>
    </div>
</body>

</html>