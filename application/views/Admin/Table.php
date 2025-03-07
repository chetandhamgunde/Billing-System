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



    <title>Admin-Bookings</title>

    <style>
        #timeFilterPills .nav-link {
            background-color: #fff !important;
            /* For inactive tabs */
            color: #6c757d !important;
            transition: all 0.3s ease-in-out;
            /* Smooth hover/active transition */
        }

        #timeFilterPills .nav-link:hover {
            background-color: #e9ecef !important;
            /* Subtle hover effect */
            color: #495057 !important;
        }

        #timeFilterPills .nav-link.active {
            background-color: #007bff !important;
            /* Primary color for active tab */
            color: #fff !important;
            /* White text for contrast */
            font-weight: bold;
            /* Make the active tab more prominent */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* Add a shadow for depth */
        }


        @media (max-width:968px) {
            body.show-sidebar main {
                margin-left: 0px !important;
            }

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
                        <!-- Main Content -->
                        <div style="border-left: #ff7315 5px solid;padding-left:5px;">
                            <h3 class="mb-2 ">Manage Tables</h3>
                        </div>

                        <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap  mb-3">
                            <input
                                type="text"
                                id="searchBar"
                                class="form-control w-25"
                                placeholder="Search..."
                                onkeyup="filterData()" />
                            <!-- Button to Add New Offer -->
                            <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#addOfferModal">
                                Add New Table
                            </button>

                        </div>


                        <!-- Modal for Adding New Offer -->
                        <div class="modal fade" id="addOfferModal" tabindex="-1" aria-labelledby="addOfferModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addOfferModalLabel">Add New Offer</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="addTableForm">
                                            <!-- Table Number -->
                                            <div class="mb-3">
                                                <label for="tableNo" class="form-label">Table Number</label>
                                                <input type="text" class="form-control" id="tableNo" name="tableNo" required oninput="(function(element) { 
                                                    // Remove any non-digit characters
                                                    element.value = element.value.replace(/[^\d]/g, '').substring(0, 2);
                                                })(this)">
                                                <small class="text-danger d-none" id="tableNoError">Table Number must be alphanumeric.</small>
                                            </div>

                                            <!-- Capacity -->
                                            <div class="mb-3">
                                                <label for="capacity" class="form-label">Capacity</label>
                                                <input type="number" class="form-control" id="capacity" name="capacity" min="1" max="8" required
                                                    oninput="if(this.value < 1) this.value = 1; if(this.value > 8) this.value = 8;">

                                                <small class="text-danger d-none" id="capacityError">Capacity must be a positive number.</small>
                                            </div>

                                            <!-- Section -->
                                            <div class="mb-3">
                                                <label for="section" class="form-label">Section</label>
                                                <select class="form-select" id="section" name="section" required>

                                                </select>
                                            </div>
                                            <script>
                                                window.addEventListener('DOMContentLoaded', async () => {
                                                    try {
                                                        const response = await fetch('<?php echo base_url() . 'getAreas' ?>');
                                                        const areas = await response.json();

                                                        const sectionSelect = document.getElementById('section');
                                                        areas.forEach(area => {
                                                            const option = document.createElement('option');
                                                            option.value = area.name;
                                                            option.textContent = area.name;
                                                            sectionSelect.appendChild(option);
                                                        });
                                                    } catch (error) {
                                                        console.error('Error fetching areas:', error);
                                                    }
                                                });

                                                document.getElementById('addTableForm').addEventListener('submit', async (e) => {
                                                    e.preventDefault();

                                                    const formData = new FormData(e.target);
                                                    const tableNo = formData.get('tableNo');
                                                    const capacity = formData.get('capacity');
                                                    const section = formData.get('section');

                                                    try {
                                                        const response = await fetch('<?php echo base_url() . 'addTable'; ?>', {
                                                            method: 'POST',
                                                            body: formData
                                                        });

                                                        const result = await response.json();
                                                        if (result.status === 'success') {
                                                            Swal.fire({
                                                                icon: 'success',
                                                                title: 'Table Added',
                                                                text: result.message,
                                                                showConfirmButton: false,
                                                                timer: 2000
                                                            }).then(() => {
                                                                location.reload(); // Reload the page after the alert closes
                                                            });


                                                            // Reset the form
                                                            document.getElementById('addTableForm').reset();

                                                            // Close the modal
                                                            const addTableModal = bootstrap.Modal.getInstance(document.getElementById('addTableModal'));
                                                            if (addTableModal) {
                                                                addTableModal.hide();
                                                            }
                                                        } else {
                                                            Swal.fire({
                                                                icon: 'error',
                                                                title: 'Error',
                                                                text: result.message
                                                            });
                                                        }
                                                    } catch (error) {
                                                        console.error('Error submitting form:', error);
                                                        Swal.fire({
                                                            icon: 'error',
                                                            title: 'Oops!',
                                                            text: 'An error occurred while adding the table.'
                                                        });
                                                    }
                                                });
                                            </script>

                                            <button type="submit" class="btn btn-success">Add Table</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal for Adding New Offer Ends Here-->

                        <div class="table-responsive">
                            <table class="table table-hover" id="ManageTable">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="background-color: #ff7315; color: white;" scope="col">Sr No.</th>
                                        <th class="text-center" style="background-color: #ff7315; color: white;" scope="col">Table Name</th>
                                        <th class="text-center" style="background-color: #ff7315; color: white;" scope="col">Capacity</th>
                                        <th class="text-center" style="background-color: #ff7315; color: white;" scope="col">Section</th>
                                        <!-- <th class="text-center" style="background-color: #ff7315; color: white;" scope="col">Date Added</th> -->
                                        <th class="text-center " style="background-color: #ff7315; color: white;" scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="Tables">
                                    <!-- Data will be dynamically populated -->
                                </tbody>
                            </table>
                        </div>


                        <div class="d-flex justify-content-end align-items-center">
                            <div class="pagination">
                                <button class="btn btn-sm btn-secondary me-1" id="prevBtn" onclick="previousPage()">Previous</button>
                                <div id="pageNumbers" class="btn-group mx-1"></div>
                                <button class="btn btn-sm btn-secondary ms-1" id="nextBtn" onclick="nextPage()">Next</button>
                            </div>
                        </div>
                        <!-- Script to Disply the data -->
                        <script>
                            let tableData = []; // Store table data globally
                            let currentPage = 1;
                            const rowsPerPage = 5;
                            let filteredTables = []; // Filtered list for pagination

                            // Fetch table data from API
                            async function fetchTables() {
                                try {
                                    const response = await fetch('<?php echo base_url() . 'TablesController/GetAllTables'; ?>');
                                    const data = await response.json();

                                    if (data.status === 'success') {
                                        tableData = data.data;
                                        filteredTables = [...tableData]; // Initialize filtered data
                                        console.log('Table Data:', tableData);
                                        displayData(currentPage);
                                    } else {
                                        console.error('No tables found:', data.message);
                                        Swal.fire({
                                            title: 'No Tables',
                                            text: data.message,
                                            icon: 'info',
                                            confirmButtonText: 'OK'
                                        });
                                    }
                                } catch (error) {
                                    console.error('Error fetching tables:', error);
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'Failed to fetch tables. Please try again later.',
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                }
                            }

                            // Function to display tables with pagination
                            function displayData(page) {
                                const start = (page - 1) * rowsPerPage;
                                const end = start + rowsPerPage;
                                const paginatedData = filteredTables.slice(start, end);
                                const tableBody = document.getElementById("Tables");
                                tableBody.innerHTML = ""; // Clear previous data

                                paginatedData.forEach((table, index) => {
                                    const row = `
                                        <tr>
                                            <td class="text-center bg-white">${start + index + 1}</td>
                                            <td class="text-center bg-white">${table.table_number}</td>
                                            <td class="text-center bg-white">${table.seats}</td>
                                            <td class="text-center bg-white"> ${table.area_name}</td>
                                            <td class="text-center bg-white flex-wrap gap-2 px-auto">
                                                <button class="btn btn-sm btn-info" onclick="editTable(${table.id})"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-danger" onclick="deleteTable(${table.id})"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>`;
                                    tableBody.innerHTML += row;
                                });

                                updatePagination(Math.ceil(filteredTables.length / rowsPerPage), page);
                            }

                            // Function to update pagination controls
                            function updatePagination(totalPages, current) {
                                const pageNumbersContainer = document.getElementById("pageNumbers");
                                pageNumbersContainer.innerHTML = "";

                                for (let i = 1; i <= totalPages; i++) {
                                    const button = document.createElement("button");
                                    button.textContent = i;
                                    button.className = `btn btn-sm ${i === current ? "btn-primary" : "btn-secondary"}`;
                                    button.onclick = () => {
                                        currentPage = i;
                                        displayData(currentPage);
                                    };
                                    pageNumbersContainer.appendChild(button);
                                }

                                document.getElementById("prevBtn").disabled = current === 1;
                                document.getElementById("nextBtn").disabled = current === totalPages;
                            }

                            // Functions to handle previous and next page
                            function previousPage() {
                                if (currentPage > 1) {
                                    currentPage--;
                                    displayData(currentPage);
                                }
                            }

                            function nextPage() {
                                const totalPages = Math.ceil(filteredTables.length / rowsPerPage);
                                if (currentPage < totalPages) {
                                    currentPage++;
                                    displayData(currentPage);
                                }
                            }

                            // Function to filter table data
                            function filterData() {
                                const query = document.getElementById('searchBar').value.toLowerCase();
                                filteredTables = tableData.filter(table =>
                                    Object.values(table).some(value =>
                                        value.toString().toLowerCase().includes(query)
                                    )
                                );
                                currentPage = 1; // Reset to the first page after filtering
                                displayData(currentPage);
                            }

                            // Fetch tables when the page loads
                            document.addEventListener('DOMContentLoaded', fetchTables);
                        </script>
                        <!-- script to delete the table -->
                        <script>
                            function deleteTable(tableId) {
                                Swal.fire({
                                    title: "Are you sure?",
                                    text: "You won't be able to revert this!",
                                    icon: "warning",
                                    showCancelButton: true,
                                    confirmButtonColor: "#d33",
                                    cancelButtonColor: "#3085d6",
                                    confirmButtonText: "Yes, delete it!"
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        $.ajax({
                                            url: "<?= base_url('TablesController/DeleteTable') ?>",
                                            type: "POST",
                                            data: {
                                                table_id: tableId
                                            },
                                            dataType: "json",
                                            success: function(response) {
                                                if (response.status) {
                                                    Swal.fire({
                                                        title: "Deleted!",
                                                        text: response.message,
                                                        icon: "success",
                                                        timer: 2000, // Auto close after 2 seconds
                                                        showConfirmButton: false
                                                    }).then(() => {
                                                        location.reload(); // Reload after alert closes automatically
                                                    });
                                                } else {
                                                    Swal.fire("Error!", response.message, "error");
                                                }
                                            },
                                            error: function() {
                                                Swal.fire("Error!", "Something went wrong!", "error");
                                            }
                                        });
                                    }
                                });
                            }
                        </script>


                        <!-- Scripts Ends Here -->

                        <!-- Edit Modal -->
                        <!-- Edit Table Modal -->
                        <div class="modal fade" id="editTableModal" tabindex="-1" aria-labelledby="editTableModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editTableModalLabel">Edit Table</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="editTableForm">
                                            <input type="hidden" id="editTableId" name="tableId">

                                            <!-- Table Number -->
                                            <div class="input-group">
                                                <span class="input-group-text" id="tablePrefix"></span>
                                                <input type="number" class="form-control" id="editTableNo" name="tableNo" required  oninput="(function(element) { 
                                                    // Remove any non-digit characters
                                                    element.value = element.value.replace(/[^\d]/g, '').substring(0, 2);
                                                })(this)">  
                                            </div>

                                            <!-- Capacity -->
                                            <div class="mb-3">
                                                <label for="editCapacity" class="form-label">Capacity</label>
                                                <input type="number" class="form-control" id="editCapacity" name="capacity" min="1" max="8" required  oninput="if(this.value < 1) this.value = 1; if(this.value > 8) this.value = 8;">
                                            </div>

                                            <!-- Section -->


                                            <button type="submit" class="btn btn-primary">Update Table</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <script>
                            async function editTable(tableId) {
                                try {
                                    const response = await fetch('<?php echo base_url() . 'TablesController/get_table_by_Id/'; ?>' + tableId);
                                    const data = await response.json();

                                    if (data.status === 'success') {
                                        const table = data.data;
                                        console.log('Table:', table);
                                        let parts = table.table_number.split('-'); // Split the value
                                        let prefix = parts[0] + '-'; // Extract prefix (e.g., "M-")
                                        let numberPart = parts[1];
                                        document.getElementById('editTableId').value = table.id;
                                        document.getElementById('tablePrefix').innerText = prefix; // Set prefix as static
                                        document.getElementById('editTableNo').value = numberPart;
                                        document.getElementById('editCapacity').value = table.seats;






                                        // Show modal
                                        const editTableModal = new bootstrap.Modal(document.getElementById('editTableModal'));
                                        editTableModal.show();
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: data.message
                                        });
                                    }
                                } catch (error) {
                                    console.error('Error fetching table:', error);
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops!',
                                        text: 'An error occurred while fetching table details.'
                                    });
                                }
                            }

                            document.getElementById('editTableForm').addEventListener('submit', async (e) => {
                                e.preventDefault();

                                // Get full table number with prefix
                                let fullTableNumber = getFullTableNumber();
                                let tableId = document.getElementById('editTableId').value;
                                // Create FormData object
                                const formData = new FormData(e.target);

                                // Append the full table number to FormData
                                formData.set("tableNo", fullTableNumber);

                                console.log([...formData.entries()]); // Debugging FormData

                                try {
                                    const response = await fetch(`<?php echo base_url('TablesController/update_table/'); ?>${tableId}`, {

                                        method: 'POST',
                                        body: formData
                                    });

                                    const result = await response.json();
                                    if (result.status === 'success') {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Table Updated',
                                            text: result.message,
                                            showConfirmButton: false,
                                            timer: 2000
                                        });

                                        // Close the modal
                                        const editTableModal = bootstrap.Modal.getInstance(document.getElementById('editTableModal'));
                                        if (editTableModal) {
                                            editTableModal.hide();
                                        }

                                        // Refresh table data
                                        fetchTables();
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: result.message
                                        });
                                    }
                                } catch (error) {
                                    console.error('Error updating table:', error);
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops!',
                                        text: 'An error occurred while updating the table.'
                                    });
                                }
                            });

                            // Function to get full table number
                            function getFullTableNumber() {
                                let prefix = document.getElementById('tablePrefix').innerText.trim();
                                let numberPart = document.getElementById('editTableNo').value;
                                return prefix + numberPart; // Combine prefix with new number
                            }
                        </script>
                        <!-- Edit Modal Ends Here -->
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Sweet Alerts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <!-- Bootstrap JS (including jQuery and Popper.js for dropdown functionality) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Sidebar Toggler Script -->
    <script src="<?php echo base_url() . 'assets/js/main.js' ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>