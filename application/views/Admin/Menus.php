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



    <title>Admin-Menus</title>

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
            font-weight: bold;
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
            border-color: #4caf50;
            /* Active state border color */
            background-color: #e8f5e9;
            /* Light green background for active state */
            color: #4caf50;
            /* Text color for active state */
        }

        .menu-header span {
            font-weight: bold;
            /* Make the text bold */
            color: #555;
            /* Slightly darker color */
        }

        /* code written by chetan */
        .category-dropdown {
            position: absolute;
            top: 20%;
            right: 20%;
            width: 60%;
            z-index: 1000;
            display: none;
        }

        /* code written by chetan ends here */
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
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div style="border-left: #ff7315 5px solid;padding-left:5px;">
                                <h3>Menu Management</h3>
                            </div>
                            <span id="totalCount" class="badge text-primary" style="font-size: large;">Total Items: <span id="totalItems"></span></span>
                        </div>
                        <!-- code written by chetan starts -->
                        <div class="menu-container p-3 border rounded bg-white shadow-sm">
                            <div class="menu-header d-flex justify-content-between align-items-center flex-wrap gap-2">

                                <!-- Category Links for Larger Screens -->
                                <div class="d-flex flex-wrap gap-3 d-none d-md-flex align-items-center">
                                    <a href="#" class="active fw-bold text-dark px-3 py-2 border rounded" onclick="filterMenu('All', this)">All</a>
                                    <?php foreach ($categories as $category): ?>
                                        <a href="#" class="fw-bold text-dark px-3 py-2 border rounded" onclick="filterMenu(<?php echo $category['id']; ?>, this)">
                                            <?php echo $category['name']; ?>
                                        </a>
                                    <?php endforeach; ?>

                                    <!-- Add Category Button -->
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#addCategoryModal" class="text-success fs-5 ms-2">
                                        <i class="fas fa-plus-circle"></i>
                                    </a>
                                </div>

                                <!-- Dropdown for Small Screens -->
                                <div class="d-block d-md-none w-100">
                                    <select class="form-select border-dark fw-bold" id="menuDropdown" onchange="filterMenu(this.value)">
                                        <option value="All">All Categories</option>
                                        <?php foreach ($categories as $category): ?>
                                            <option value="<?php echo $category['id']; ?>">
                                                <?php echo $category['name']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- Edit Category Button -->
                                <button type="button" class="btn btn-outline-primary d-flex align-items-end gap-2 fs-6" onclick="toggleCategoryDropdown()">
                                    <i class="fas fa-edit"></i> Edit Category
                                </button>

                            </div>
                        </div>


                        <!-- Category Management Dropdown -->
                        <div id="categoryDropdown" class="category-dropdown shadow p-3 bg-white rounded">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6>Manage Categories</h6>
                                <button class="btn btn-sm btn-light" onclick="closeCategoryDropdown()">
                                    <i class="fas fa-times text-danger"></i> <!-- Close Icon -->
                                </button>
                            </div>
                            <ul class="list-unstyled">
                                <?php foreach ($categories as $category): ?>
                                    <li class="d-flex justify-content-between align-items-center p-2 border-bottom">
                                        <span><?php echo $category['name']; ?></span>
                                        <div>
                                            <button class="btn btn-sm btn-primary" onclick="confirmEdit(<?php echo $category['id']; ?>,'<?php echo $category['name']; ?>')">
                                                <i class="fas fa-pen"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger" onclick="confirmDelete(<?php echo $category['id']; ?>)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <!-- code written by chetan ends -->
                        <br>
                        <button type="button" class="btn btn-primary d-block ms-auto" data-bs-toggle="modal" data-bs-target="#addItemModal">+ Add Item</button>

                        <div id="menuItems" class="mt-4">
                            <!-- Menu items will be dynamically inserted here -->
                        </div>
                    </div>
                    <div id="paginationControls" class="d-flex justify-content-center mt-4">
                        <!-- Pagination buttons will be dynamically inserted here -->
                    </div>


                    <!-- SCRIPT FOR EDITING THE CATEGORY  -->
                    <script>
                        function confirmEdit(categoryId, currentName) {
                            Swal.fire({
                                title: "Edit Category",
                                input: 'text',
                                inputLabel: 'Category Name',
                                inputValue: currentName, // Pre-fill with current name
                                showCancelButton: true,
                                confirmButtonText: 'Save',
                                cancelButtonText: 'Cancel',
                                inputValidator: (value) => {
                                    if (!value) {
                                        return 'Please enter a category name.';
                                    }
                                }
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    editCategory(categoryId, result.value);
                                }
                            });
                        }

                        function editCategory(categoryId, newName) {
                            fetch('<?php echo base_url() . '/editCategory' ?>', { // Replace with your actual API URL if needed
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify({
                                        id: categoryId,
                                        name: newName
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.status === 'success') {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Updated!',
                                            text: 'Category updated successfully.',
                                            timer: 1500
                                        }).then(() => {
                                            // Reload the page or update the DOM accordingly
                                            location.reload();
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: 'Failed to update category. Please try again later.'
                                        });
                                    }
                                })
                                .catch(error => {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'Something went wrong!'
                                    });
                                });
                        }
                    </script>

                    <!-- chetan script for category management -->
                    <script>
                        function toggleCategoryDropdown() {

                            console.log("hello");
                            let dropdown = document.getElementById("categoryDropdown");

                            if (dropdown) {
                                dropdown.style.display = dropdown.style.display === "none" || dropdown.style.display === "" ? "block" : "none";
                            } else {
                                console.error("categoryDropdown not found!");
                            }
                        }


                        function confirmDelete(categoryId) {
                            console.log("helo theis ", categoryId)
                            Swal.fire({
                                title: "Are you sure?",
                                text: "This category will be permanently deleted!",
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#d33",
                                cancelButtonColor: "#3085d6",
                                confirmButtonText: "Yes, delete it!"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    deleteCategory(categoryId);
                                }
                            });
                        }

                        function deleteCategory(categoryId) {
                            fetch('<?php echo base_url() . '/deleteCategory' ?>', { // Replace with your actual API URL
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify({
                                        id: categoryId
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.status === 'success') {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Deleted!',
                                            text: 'Category has been deleted.',
                                            timer: 1500
                                        }).then(() => {
                                            // Reload the page or remove the deleted category from the DOM
                                            location.reload();
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: 'Failed to delete category. Please try again later.'
                                        });
                                    }
                                })
                                .catch(error => {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'Something went wrong!'
                                    });
                                });
                        }


                      

                        function closeCategoryDropdown() {
                            let dropdown = document.getElementById("categoryDropdown");
                            let editBtn = document.querySelector(".btn-primary");

                            dropdown.style.display = "none";
                          
                        }
                    </script>
                    <!-- chetan script ends here -->
                    <!-- Script for populating the data -->
                    <script>
                        const ImgBaseURL = "<?php echo base_url(); ?>uploads/menu/";
                    </script>

                    <script>
                        const menuData = <?php echo json_encode($menus); ?>;
                        console.log(menuData);
                        console.log("Selected Category:", <?php echo json_encode($categories); ?>);


                        const rowsPerPage = 8;
                        let currentPage = 1;

                        function displayMenuItems(page, data = menuData) {
                            const start = (page - 1) * rowsPerPage;
                            const end = start + rowsPerPage;
                            const paginatedData = data.slice(start, end);
                            const menuContainer = document.getElementById("menuItems");
                            menuContainer.innerHTML = ""; // Clear existing menu items

                            if (paginatedData.length === 0) {
                                menuContainer.innerHTML = "<p>No items available in this category.</p>";
                                paginationContainer = document.getElementById("paginationControls")
                                paginationContainer.innerHTML = "";
                                paginationContainer.style.display = "none";
                                return;

                            }

                            paginatedData.forEach(item => {
                                const menuItem = document.createElement("div");
                                menuItem.className = "menu-item";

                                // Set a maximum length for the description
                                const maxLength = 40; // Adjust this value as needed
                                const description = item.description.length > maxLength ?
                                    item.description.substring(0, maxLength) + '...' :
                                    item.description;

                                menuItem.innerHTML = `
                                        <div class="menu-details">
                                            <img src="${ImgBaseURL}${item.image}" alt="${item.name}">
                                            <div>
                                                <h4>${item.name}</h4>
                                                <p>${description}</p>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column gap-2 align-items-center">
                                        <div>
                                            <span class="menu-price">₹${parseFloat(item.price || 0).toFixed(2)}</span>
                                        </div>
                                        <div class="menu-actions" style="margin-left:10px;">
                                            <button onclick="openEditModal(${item.id})" class="bg-success text-white border-0 rounded-4 cursor-pointer"><i class="fas fa-edit"></i></button>
                                            <button onclick="deleteItem(${item.id})" class="bg-danger text-white border-0 rounded-4 cursor-pointer"><i class="fas fa-trash-alt"></i></button>
                                        </div>
                                        <div>
                                    `;
                                menuContainer.appendChild(menuItem);
                            });

                            updatePagination(Math.ceil(data.length / rowsPerPage), page);
                        }

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

                    <!-- Script for populating the data Ends Here-->



                    <!-- Edit Script and  Modal -->
                    <!-- Edit Item Modal -->
                    <div class="modal" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Item</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="editForm" action="<?php echo base_url() . 'editMenu' ?>" method="post" enctype="multipart/form-data" novalidate>
                                        <!-- Name Field -->
                                        <div class="form-group">
                                            <label for="editName">Name</label>
                                            <input
                                                type="text"
                                                id="editName"
                                                name="name"
                                                class="form-control"
                                                required
                                                pattern=".{3,10}"
                                                title="Name must be at least 3 characters long." />
                                            <small class="form-text text-muted">Minimum 3 characters to Maximum 10 characters allowed.</small>
                                        </div>

                                        <!-- Description Field -->
                                        <div class="form-group">
                                            <label for="editDesc">Description</label>
                                            <textarea
                                                id="editDesc"
                                                name="description"
                                                class="form-control"
                                                rows="3"
                                                required
                                                pattern=".{10,60}"
                                                title="Description must be at least 10 characters long."></textarea>
                                            <small class="form-text text-muted">Minimum 10 characters to Maximum 60 characters allowed.</small>
                                        </div>

                                        <!-- Price Field -->
                                        <div class="form-group">
                                            <label for="editPrice">Price</label>
                                            <input
                                                type="number"
                                                id="editPrice"
                                                name="price"
                                                class="form-control"
                                                step="0.01"
                                                required
                                                min="0.01"
                                                title="Price must be a positive number." />
                                            <small class="form-text text-muted">Must be a positive number.</small>
                                        </div>

                                        <!-- Category Field (New) -->
                                        <div class="form-group">
                                            <label for="editCategory">Category</label>
                                            <select id="editCategory" name="category_id" class="form-control" required>
                                                <option value="" disabled selected>Select a category</option>
                                                <?php foreach ($categories as $category): ?>
                                                    <option value="<?php echo $category['id']; ?>">
                                                        <?php echo $category['name']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <small class="form-text text-muted">Please choose a category.</small>
                                        </div>

                                        <!-- Current Image Field -->
                                        <div class="form-group">
                                            <label>Current Image</label>
                                            <div id="currentImageContainer">
                                                <img
                                                    id="currentImage"
                                                    src=""
                                                    alt="Current Image"
                                                    class="img-fluid mb-2"
                                                    style="max-width: 100px; max-height: 100px;" />
                                            </div>
                                        </div>

                                        <!-- Image Upload Field -->
                                        <div class="form-group">
                                            <label for="editImage">Change Image</label>
                                            <input
                                                type="file"
                                                id="editImage"
                                                name="image"
                                                class="form-control"
                                                accept="image/jpeg, image/png, image/gif"
                                                title="Only JPEG, PNG, or GIF files are allowed." />
                                            <small class="form-text text-muted">Upload JPEG, PNG, or GIF files only.</small>
                                        </div>

                                        <input type="hidden" id="editId" name="id" />
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            const BaseUrl = "<?php echo base_url(); ?>"; // Ensure the URL is wrapped in quotes
                            window.openEditModal = function(menuId) { // Ensure the function is global
                                fetch(`${BaseUrl}/getSingleMenu`, {
                                        method: "POST",
                                        headers: {
                                            "Content-Type": "application/x-www-form-urlencoded"
                                        },
                                        body: new URLSearchParams({
                                            id: menuId
                                        })
                                    })
                                    .then(response => {
                                        if (!response.ok) {
                                            throw new Error(`HTTP error! Status: ${response.status}`);
                                        }
                                        return response.json();
                                    })
                                    .then(data => {
                                        if (data.success) {
                                            document.getElementById("editId").value = data.data.id;
                                            document.getElementById("editName").value = data.data.name;
                                            document.getElementById("editDesc").value = data.data.description;
                                            document.getElementById("editPrice").value = data.data.price;

                                            // Set selected category
                                            document.getElementById("editCategory").value = data.data.category_id;

                                            let imageElement = document.getElementById("currentImage");
                                            if (data.data.image) {
                                                imageElement.src = `${BaseUrl}/uploads/menu/${data.data.image}`;
                                                imageElement.style.display = "block";
                                            } else {
                                                imageElement.style.display = "none";
                                            }

                                            new bootstrap.Modal(document.getElementById("editModal")).show();
                                        } else {
                                            alert(data.message || "Error fetching menu details.");
                                        }
                                    })
                                    .catch(error => console.error("Error:", error));
                            }
                        });
                    </script>
                    <!-- Edit Script and  Modal Ends Here -->

                    <!-- Add Item Modal -->
                    <div class="modal" id="addItemModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add New Item</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="addItemForm" action="<?php echo base_url() . 'addMenu' ?>" method="post" enctype="multipart/form-data">
                                            <!-- Name Field -->
                                            <div class="form-group mt-2">
                                                <label for="addName">Name</label>
                                                <input
                                                    type="text"
                                                    id="addName"
                                                    name="name"
                                                    class="form-control"
                                                    required
                                                    pattern=".{3,}"
                                                    title="Name must be at least 3 characters long." oninput="this.value = this.value.slice(0, 30)"/>
                                                <small class="form-text text-muted">Maximum 30 characters allowed.</small>
                                            </div>

                                            <!-- Description Field -->
                                            <div class="form-group mt-2">
                                                <label for="addDesc">Description</label>
                                                <textarea
                                                    id="addDesc"
                                                    name="description"
                                                    class="form-control"
                                                    rows="3"
                                                    required
                                                    pattern=".{10,60}"
                                                    title="Description must be at least 10 characters long." oninput="this.value = this.value.slice(0, 60)"></textarea>
                                                <small class="form-text text-muted">Maximum 60 characters allowed.</small>
                                            </div>

                                            <!-- Price Field -->
                                            <div class="form-group mt-2">
                                                <label for="addPrice">Price</label>
                                                <input
                                                    type="number"
                                                    id="addPrice"
                                                    name="price"
                                                    class="form-control"
                                                    step="0.01"
                                                    required
                                                    min="0.01"
                                                    title="Price must be a positive number." oninput="this.value = this.value.slice(0, 5)"/>
                                                <small class="form-text text-muted">Must be a positive number.</small>
                                            </div>

                                        <!-- Category Field -->
                                        <div class="form-group mt-2">
                                            <label for="addCategory">Category</label>
                                            <select id="addCategory" name="category_id" class="form-control" required>
                                                <option value="" disabled selected>Select a category</option>
                                                <?php foreach ($categories as $category): ?>
                                                    <option value="<?php echo $category['id']; ?>">
                                                        <?php echo $category['name']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <small class="form-text text-muted">Please choose a category.</small>


                                        </div>

                                        <!-- Image Upload Field -->
                                        <div class="form-group mt-2">
                                            <label for="addImage">Upload Image</label>
                                            <input
                                                type="file"
                                                id="addImage"
                                                name="image"
                                                class="form-control"
                                                accept="image/jpeg, image/png, image/gif"
                                                required
                                                title="Only JPEG, PNG, or GIF files are allowed." />
                                            <small class="form-text text-muted">Upload JPEG, PNG, or GIF files only.</small>
                                        </div>

                                        <!-- Submit Button -->
                                        <button type="submit" class="btn btn-primary mt-3">Add Item</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>


                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                                document.getElementById('currentImage').src = "<?php echo base_url() . 'assets/images/menu/' ?>" + item.image;
                                $('#editModal').modal('show'); // Open modal
                            }
                        }


                        function deleteItem(itemId) {
                            Swal.fire({
                                title: 'Are you sure?',
                                text: "You won't be able to revert this!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#d33',
                                cancelButtonColor: '#3085d6',
                                confirmButtonText: 'Yes, delete it!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "<?php echo base_url(); ?>deleteMenu/" + itemId;
                                }
                            });
                        }
                    </script>

                    <script>
                        <?php if ($this->session->flashdata('success')): ?>
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: '<?php echo $this->session->flashdata('success'); ?>',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        <?php endif; ?>

                        <?php if ($this->session->flashdata('error')): ?>
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: '<?php echo $this->session->flashdata('error'); ?>',
                                showConfirmButton: true
                            });
                        <?php endif; ?>
                    </script>
                </div>
            </div>
        </div>
        </div>
    </main>
    <!-- chetan code strat here -->
    <!-- Modal for Adding Category -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addCategoryForm">
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="categoryName" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- chetan code ends here -->

    <!-- Bootstrap JS (including jQuery and Popper.js for dropdown functionality) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Sidebar Toggler Script -->
    <script src="<?php echo base_url() . 'assets/js/main.js' ?>"></script>


    <!-- SweetAlert2 Library (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.getElementById('addCategoryForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            const categoryName = document.getElementById('categoryName').value;

            fetch('<?php echo base_url() . '/addCategory' ?>', { // Replace with your actual API URL
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        categoryName: categoryName
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Category added successfully!'
                        }).then(() => {
                            // Reload the page or update the DOM accordingly
                            location.reload();
                        });
                    } else if (data.status === 'exists') {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Warning',
                            text: 'Category already exists!'
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to add category. Please try again later.'
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong!'
                    });
                });
        });
    </script>


</body>