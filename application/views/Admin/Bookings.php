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


    <style>
        .nav-pills .nav-link {
            border: 1px solid transparent;
            border-radius: 20px;
            transition: all 0.3s ease-in-out;
            padding: 0.5rem 1.2rem;
            font-size: 1rem;
            font-weight: 500;
            text-align: center;
        }

        /* Default Pending (Warning) */
        .nav-link.pending {
            background-color: #fff4e5;
            /* Light orange */
            color: #ff9800;
            /* Vibrant orange */
            border-color: #ffcc80;
            /* Soft orange border */
        }

        /* Default Approved (Success) */
        .nav-link.approved {
            background-color: #e8f5e9;
            /* Light green */
            color: #388e3c;
            /* Deep green */
            border-color: #a5d6a7;
            /* Soft green border */
        }

        .nav-link.cancel {
            background-color: #e3f2fd;
            /* Light blue */
            color: rgb(8, 72, 128);
            /* Deep blue */
            border-color: #90caf9;
            /* Soft blue border */
        }

        /* Active State */
        .nav-pills .nav-link.active {
            color: white;
            /* White text */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* Subtle shadow */
        }

        /* Active Pending (Warning) */
        .nav-link.pending.active {
            background-color: #ffa726;
            /* Bold orange */
            border-color: #ffa726;
        }

        /* Active Approved (Success) */
        .nav-link.approved.active {
            background-color: #66bb6a;
            /* Bold green */
            border-color: #66bb6a;
        }

        .nav-link.cancel.active {
            background-color: #0d47a1;
            /* Bold green */
            border-color: #0d47a1;
        }

        /* Hover Effects */
        .nav-pills .nav-link:hover {
            transform: scale(1.05);
            /* Slight grow effect */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
            /* Gentle shadow */
        }

        /* Hover Pending (Warning) */
        .nav-link.pending:hover {
            background-color: #ffcc80;
            /* Softer orange hover */
            color: #e65100;
            /* Darker orange text */
            border-color: #ffcc80;
        }

        /* Hover Approved (Success) */
        .nav-link.approved:hover {
            background-color: #a5d6a7;
            /* Softer green hover */
            color: #2e7d32;
            /* Darker green text */
            border-color: #a5d6a7;
        }

        .nav-link.cancel:hover {
            background-color: #90caf9;
            /* Softer blue hover */
            color: #0d47a1;
            /* Darker blue text */
            border-color: #90caf9;
            /* Matching border color */
        }

        .nav-link.completed {
            background-color: #f3e5f5;
            /* Light purple */
            color: #6a1b9a;
            /* Deep purple */
            border-color: #ce93d8;
            /* Soft purple border */
        }

        .nav-link.completed:hover {
            background-color: #e1bee7;
            /* Softer purple hover */
            color: #4a148c;
            /* Darker purple text */
            border-color: #ba68c8;
            /* Medium purple border */
        }

        .nav-link.completed.active {
            background-color: #ce93d8;
            /* Active state purple */
            color: #4a148c;
            /* Darker purple */
            border-color: #ab47bc;
            /* More prominent purple border */
        }



        /* Pills Container */
        .nav-pills {
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        @media (max-width: 768px) {
            .nav-pills .nav-link {
                padding: 0.4rem 1rem;
                /* Adjust padding for smaller screens */
                font-size: 0.9rem;
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
                        <div class="d-flex justify-content-between align-items-center">
                            <div style="border-left: #ff7315 5px solid;padding-left:5px;">
                                <h3 class="" style="margin-top: 3px;">Customer Bookings Requests</h3>

                            </div>


                           
                        </div>


                        <div class="filters d-flex justify-content-between mt-3 flex-wrap gap-2">
                            <div class="d-flex gap-2">
                                <input type="text" id="filterTableInput" class="form-control " placeholder="Filter by TableNo." onkeyup="filterData()">
                                <input type="date" id="filterDateInput" class="form-control " onchange="filterData()">

                            </div>
                            <div class="d-flex agp-2">
                                <!-- Nav Pills -->
                                <ul class="nav nav-pills gap-2">
                                    <li class="nav-item">
                                        <button class="nav-link active pending" id="pendingTab" onclick="filterByStatus('pending')">Pending</button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link approved" id="approvedTab" onclick="filterByStatus('approved')">Approved</button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link cancel" id="cancelTab" onclick="filterByStatus('cancel')">Cancelled</button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link completed" id="completedTab" onclick="filterByStatus('completed')">completed</button>
                                    </li>
                                </ul>

                            </div>

                        </div>

                        <div class="table-responsive mt-3">
                            <table class="table table-hover" id="userTable">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="background-color: #ff7315; color: white;" scope="col">Sr No.</th>
                                        <th class="text-center" style="background-color: #ff7315; color: white;" scope="col">Table No.</th>
                                        <th class="text-center" style="background-color: #ff7315; color: white;" scope="col">Customer Name</th>
                                        <th class="text-center" style="background-color: #ff7315; color: white;" scope="col">Contact</th>
                                        <th class="text-center" style="background-color: #ff7315; color: white;" scope="col">Booking Time</th>
                                        <th class="text-center" style="background-color: #ff7315; color: white;" scope="col">Number of Guests</th>
                                        <th class="text-center" style="background-color: #ff7315; color: white;" scope="col">Special Request</th>
                                        <th class="text-center" style="background-color: #ff7315; color: white;" scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody"></tbody>
                            </table>
                            <div id="noDataMessage" class="text-center mt-4 text-muted" style="display: none;">No records available</div>
                        </div>


                        <div class="d-flex justify-content-end align-items-center" id="paginationTabs">
                            <div class="pagination">
                                <button class="btn btn-sm btn-secondary me-1" id="prevBtn" onclick="previousPage()">Previous</button>
                                <div id="pageNumbers" class="btn-group mx-1"></div>
                                <button class="btn btn-sm btn-secondary ms-1" id="nextBtn" onclick="nextPage()">Next</button>
                            </div>
                        </div>


                        <script>
                            let dummyData = []; // Define dummyData globally
                            let currentPage = 1;
                            const rowsPerPage = 4;
                            let currentFilter = "pending";
                            let filteredData = []; // Initialize filteredData globally

                            function formatBookingTime(booking_time) {
                                if (!booking_time) return "";

                                // Extract date, start time, and end time from booking_time
                                let [date, startTime, , endTime] = booking_time.split(" ");

                                return `${date} ${convertTo12HourFormat(startTime)} - ${convertTo12HourFormat(endTime)}`;
                            }

                            // Function to convert 24-hour time to 12-hour AM/PM format
                            function convertTo12HourFormat(time) {
                                if (!time) return "";

                                let [hours, minutes] = time.split(":").map(Number);
                                let period = hours >= 12 ? "PM" : "AM";

                                hours = hours % 12 || 12; // Convert 0 to 12 for AM

                                return `${hours}:${minutes.toString().padStart(2, "0")} ${period}`;
                            }


                            window.addEventListener('DOMContentLoaded', async () => {
                                try {
                                    const response = await fetch('<?php echo base_url() . "getBookingData"; ?>');
                                    const backendData = await response.json();

                                    console.log("Backend Data:", backendData);

                                    // Map backend data to match the structure of dummyData
                                    dummyData = backendData.map(booking => ({
                                        id: parseInt(booking.id),
                                        customer_name: booking.customer_name,
                                        contact: booking.contact,
                                        booking_time: formatBookingTime(booking.booking_time),
                                        guests: parseInt(booking.guests),
                                        special_request: booking.special_request,
                                        table_no: booking.table_no,
                                        status: booking.status.toLowerCase(),
                                        start_time: convertTo12HourFormat(booking.start_time), // Convert start time
                                        end_time: convertTo12HourFormat(booking.end_time) // Convert end time
                                    }));

                                    // Initialize filteredData with pending status and display data
                                    filteredData = dummyData.filter(item => item.status === currentFilter);
                                    displayData(currentPage); // Now it will work as expected
                                } catch (error) {
                                    console.error('Error fetching booking data:', error);
                                }
                            });

                            // Helper function to format booking time to 'YYYY/MM/DD hh:mm A'
                            function formatBookingTime(dateTime) {
                                const date = new Date(dateTime);
                                const year = date.getFullYear();
                                const month = String(date.getMonth() + 1).padStart(2, '0');
                                const day = String(date.getDate()).padStart(2, '0');

                                let hours = date.getHours();
                                const minutes = String(date.getMinutes()).padStart(2, '0');
                                const ampm = hours >= 12 ? 'PM' : 'AM';
                                hours = hours % 12 || 12; // Convert to 12-hour format and handle midnight (0 -> 12)

                                return `${year}-${month}-${day} ${hours}:${minutes} ${ampm}`;
                            }


                            function displayData(page, data = filteredData) {
                                const start = (page - 1) * rowsPerPage;
                                const end = start + rowsPerPage;
                                const paginatedData = data.slice(start, end);
                                const totalPages = Math.ceil(data.length / rowsPerPage);

                                console.log(`Displaying data from ${start} to ${end}. Total Pages: ${totalPages}`);

                                const tableBody = document.getElementById("tableBody");
                                tableBody.innerHTML = "";

                                if (paginatedData.length === 0) {
                                    document.getElementById("noDataMessage").style.display = "block";
                                    document.querySelector(".pagination").style.display = "none";
                                } else {
                                    document.getElementById("noDataMessage").style.display = "none";
                                    document.querySelector(".pagination").style.display = "flex";
                                    paginatedData.forEach((item, index) => {
                                        tableBody.innerHTML += `
                <tr>
                    <td class="text-center bg-white">${start + index + 1}</td>
                  <td class="text-center bg-white">
  ${item.status === "cancel" ? "Tables Freed" : item.table_no}
</td>

                    <td class="text-center bg-white">${item.customer_name}</td>
                    <td class="text-center bg-white">${item.contact}</td>
                    <td class="text-center bg-white">${item.booking_time}</td>
                    <td class="text-center bg-white">${item.guests}</td>
                    <td class="text-center bg-white">${item.special_request}</td>
                    <td class="text-center d-flex flex-wrap justify-content-center bg-white h-100" style="gap:10px;">
                ${item.status === "pending" 
  ? `<i class="fas fa-eye bg-primary text-white p-2" onclick="viewRequest(${item.id})"></i>
     <i class="fas fa-check bg-success text-white p-2" onclick="approveRequest(${item.id})"></i>
     <i class="fas fa-times bg-danger text-white p-2" onclick="rejectRequest(${item.id})"></i>`

  : item.status === "cancel" 
  ? `<i class="fas fa-trash bg-warning text-white p-2" onclick="freeTable(${item.id})"></i>` 

  : item.status === "completed" 
  ? `<i class="fas fa-eye bg-primary text-white p-2" onclick="viewRequest(${item.id})"></i>` 

  : `<i class="fas fa-eye bg-primary text-white p-2" onclick="viewRequest(${item.id})"></i>
     <i class="fas fa-check bg-success text-white p-2" onclick="completeRequest(${item.id})"></i>
     <i class="fas fa-trash bg-warning text-white p-2" onclick="freeTable(${item.id})"></i>`}

                    </td>
                </tr>`;
                                    });
                                }

                                updatePagination(totalPages);
                            }


                            // Other functions (filterByStatus, filterData, updatePagination, previousPage, nextPage) remain unchanged



                            function filterByStatus(status) {
                                currentFilter = status;
                                filteredData = dummyData.filter(item => item.status === currentFilter);
                                document.querySelectorAll(".nav-link").forEach(link => link.classList.remove("active"));
                                document.getElementById(`${status}Tab`).classList.add("active");
                                currentPage = 1;
                                displayData(currentPage);
                            }

                            function filterData() {
                                const tableInput = document.getElementById("filterTableInput").value.toLowerCase();
                                const dateInput = document.getElementById("filterDateInput").value;

                                filteredData = dummyData.filter(item => {
                                    const matchesStatus = item.status === currentFilter;
                                    const matchesTable = tableInput ? item.table_no.toLowerCase().includes(tableInput) : true;
                                    const matchesDate = dateInput ? item.booking_time.startsWith(dateInput) : true;
                                    console.log(dateInput, item.booking_time)
                                    return matchesStatus && matchesTable && matchesDate;
                                });

                                currentPage = 1;
                                displayData(currentPage, filteredData);
                            }

                            function updatePagination(totalPages) {
                                const pageNumbers = document.getElementById("pageNumbers");
                                pageNumbers.innerHTML = "";

                                if (totalPages <= 1) {
                                    document.querySelector(".pagination").style.display = "none"; // Hide pagination if there's only one page
                                    return;
                                } else {
                                    document.querySelector(".pagination").style.display = "flex";
                                }

                                for (let i = 1; i <= totalPages; i++) {
                                    const button = document.createElement("button");
                                    button.className = `btn btn-sm ${i === currentPage ? "btn-primary" : "btn-secondary"}`;
                                    button.textContent = i;
                                    button.onclick = () => {
                                        currentPage = i;
                                        displayData(currentPage, filteredData);
                                    };
                                    pageNumbers.appendChild(button);
                                }

                                document.getElementById("prevBtn").disabled = currentPage === 1;
                                document.getElementById("nextBtn").disabled = currentPage === totalPages;
                            }

                            function previousPage() {
                                if (currentPage > 1) {
                                    currentPage--;
                                    displayData(currentPage, filteredData);
                                }
                            }

                            function nextPage() {
                                const totalPages = Math.ceil(filteredData.length / rowsPerPage);
                                if (currentPage < totalPages) {
                                    currentPage++;
                                    displayData(currentPage, filteredData);
                                }
                            }

                            displayData(currentPage);
                        </script>

                        <!-- Add Table Modal -->
                        <div class="modal fade" id="addTableModal" tabindex="-1" aria-labelledby="addTableModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addTableModalLabel">Add Table</h5>
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



                    </div>
                </div>
            </div>

        </div>

    </main>

    <!-- Modal for Viewing Request Details -->
    <div class="modal fade" id="viewRequestModal" tabindex="-1" aria-labelledby="viewRequestModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewRequestModalLabel">Request Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Customer Name:</strong> <span id="modalCustomerName"></span></p>
                    <p><strong>Contact:</strong> <span id="modalContact"></span></p>
                    <p><strong>Booking Time:</strong> <span id="modalBookingTime"></span></p>
                    <p><strong>Guests:</strong> <span id="modalGuests"></span></p>
                    <p><strong>Special Request:</strong> <span id="modalSpecialRequest"></span></p>
                    <p><strong>Start time:</strong> <span id="modalStartTime"></span></p>
                    <p><strong>End time:</strong> <span id="modalEndTime"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!--End of Modal for Viewing Request Details -->

    <!-- SWEET ALERTS -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // SweetAlert for Approve Request
        async function approveRequest(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to approve this request?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, approve it!'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    try {
                        const response = await fetch('<?php echo base_url("approveBooking"); ?>', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                id: id,
                                status: 'approved'
                            })
                        });

                        const data = await response.json();

                        if (data.status === 'success') {
                            Swal.fire(
                                'Approved!',
                                `Request with ID ${id} has been approved.`,
                                'success'
                            ).then(() => {
                                location.reload(); // ✅ Corrected reload syntax
                            });
                            // Optionally, refresh the table or update the UI
                            filterByStatus('approved'); // Or call a function to refresh data
                        } else {
                            Swal.fire(
                                'Error!',
                                data.message || 'An error occurred while approving the request.',
                                'error'
                            );
                        }
                    } catch (error) {
                        console.error('Error approving request:', error);
                        Swal.fire(
                            'Error!',
                            'An unexpected error occurred.',
                            'error'
                        );
                    }
                }
            });
        }

        // status completed 
        async function completeRequest(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to complete this request?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, complete it!'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    try {
                        const response = await fetch('<?php echo base_url("approveBooking"); ?>', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                id: id,
                                status: 'completed'
                            })
                        });

                        const data = await response.json();

                        if (data.status === 'success') {
                            Swal.fire(
                                'Completed!',
                                `Request with ID ${id} has been Completed.`,
                                'success'
                            ).then(() => {
                                location.reload(); // ✅ Corrected reload syntax
                            });

                        } else {
                            Swal.fire(
                                'Error!',
                                data.message || 'An error occurred while Completed the request.',
                                'error'
                            );
                        }
                    } catch (error) {
                        console.error('Error Completed request:', error);
                        Swal.fire(
                            'Error!',
                            'An unexpected error occurred.',
                            'error'
                        );
                    }
                }
            });
        }

        // completed 
        async function rejectRequest(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to reject this request?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, reject it!'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    try {
                        const response = await fetch('<?php echo base_url("approveBooking"); ?>', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                id: id,
                                status: 'cancel'
                            })
                        });

                        const data = await response.json();

                        if (data.status === 'success') {
                            Swal.fire(
                                'Cancelled!',
                                `Request with ID ${id} has been cancelled.`,
                                'success'
                            ).then(() => {
                                location.reload(); // ✅ Corrected reload syntax
                            });
                            // Optionally, refresh the table or update the UI

                        } else {
                            Swal.fire(
                                'Error!',
                                data.message || 'An error occurred while cancelling the request.',
                                'error'
                            );
                        }
                    } catch (error) {
                        console.error('Error cancelling request:', error);
                        Swal.fire(
                            'Error!',
                            'An unexpected error occurred.',
                            'error'
                        );
                    }
                }
            });
        }


        // SweetAlert for Free Table
        async function freeTable(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "This will free up the table and remove the booking.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, free it!",
                cancelButtonText: "Cancel",
            }).then(async (result) => {
                if (result.isConfirmed) {
                    try {
                        const response = await fetch('<?php echo base_url("BookingController/deleteBooking"); ?>', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                id: id
                            })
                        });

                        const data = await response.json();

                        if (data.status === 'success') {
                            dummyData = dummyData.filter(item => item.id !== id); // Remove the booking from dummyData
                            Swal.fire("Freed!", "The table has been freed.", "success");
                            filterByStatus("approved"); // Refresh the table to show updated data
                        } else {
                            Swal.fire("Error!", data.message, "error");
                        }
                    } catch (error) {
                        console.error("Error deleting booking:", error);
                        Swal.fire("Error!", "An unexpected error occurred.", "error");
                    }
                }
            });
        }

        // Populate and Show Modal for View Request
        function viewRequest(id) {
            const request = dummyData.find(item => item.id === id);
            if (request) {
                document.getElementById('modalCustomerName').textContent = request.customer_name;
                document.getElementById('modalContact').textContent = request.contact;
                document.getElementById('modalBookingTime').textContent = request.booking_time;
                document.getElementById('modalGuests').textContent = request.guests;
                document.getElementById('modalSpecialRequest').textContent = request.special_request;
                document.getElementById('modalStartTime').textContent = request.start_time;
                document.getElementById('modalEndTime').textContent = request.end_time;

                const viewModal = new bootstrap.Modal(document.getElementById('viewRequestModal'));
                viewModal.show();
            }
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