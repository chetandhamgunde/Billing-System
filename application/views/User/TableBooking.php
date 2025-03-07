<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="<?php echo base_url() . 'assets/images/hariom_dhabalogo.png' ?>">
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

    <title>Hari-Om-Dhaba TableBooking</title>
    <!-- Base styles -->
    <style>
        body {
            font-family: "Work Sans", serif;

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

        .error-message {
            color: red;
            font-size: 0.9rem;
        }


        .nav-pills .nav-link {
            transition: all 0.3s ease-in-out;
        }

        .nav-pills .nav-link:hover {

            transform: scale(1.1);
            /* Slightly enlarge the button */
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            /* Add a shadow effect */
        }
    </style>
    <!-- Base styles Ends Here -->


    <!-- Table styles -->
    <style>
        .seat {
            width: 20px;
            /* Width of the rectangular seat */
            height: 10px;
            /* Height of the rectangular seat */
            background-color: #ccc;
            position: absolute;
        }

        .table {
            width: 120px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            margin: 20px;
            /* Increased margin for better spacing between tables */
            font-weight: bold;
            cursor: pointer;
            flex-direction: column;
            position: relative;
        }

        .table.free {
            background-color: #d4f8d4;
            border: 2px solid #4caf50;
        }

        .table.booked {
            background-color: #ffd4d4;
            border: 2px solid #f44336;
        }

        .table.user-booked {
            background-color: #fff5cc;
            border: 2px solid #ffc107;
        }

        .status {
            font-size: 0.8rem;
            margin-top: 5px;
        }
    </style>
    <!-- Table styles Ends Here -->


    <!-- Table bg Animation  -->
    <style>
        .table.user-booked {
            animation: glow 0.8s ease-in-out;
        }

        @keyframes glow {

            0%,
            100% {
                box-shadow: 0 0 5px #4caf50;
            }

            50% {
                box-shadow: 0 0 20px #4caf50;
            }
        }

        .hidden {
            display: none;
        }

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: #fff;
            background-color: #ff9500;
        }


        .form-control[readonly] {
            background-color: #fff !important;
        }
    </style>
    <!-- Table bg Animation Ends Here -->

</head>

<body>

    <!-- Navbar -->
    <?php $this->load->view('IncludeUser/CommonNavbar'); ?>
    <!-- Navbar End -->
    <div class="container-fluid pt-3">
        <!--chetan code of Reservation Form -->
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

        <div id="reservation-form" class="p-4 rounded" style="min-height:80vh;">
            <div class="text-center mb-4">
                <h3 style="border-left: #ff7315 5px solid; padding-left: 15px; display: inline;">Table Booking System</h3>
            </div>
            <form id="userForm" class="row g-3 justify-content-center mt-3">
                <div class="col-md-3 col-12">
                    <label for="date" class="form-label">📅 Select Date</label>
                    <input type="text" class="form-control datepicker" id="date" placeholder="Choose a date" required>
                </div>
                <div class="col-md-3 col-12">
                    <label for="startTime" class="form-label">⏰ Start Time</label>
                    <input type="text" class="form-control timepicker" id="startTime" placeholder="Choose start time" required>
                </div>
                <div class="col-md-3 col-12">
                    <label for="endTime" class="form-label">⌛ End Time</label>
                    <input type="text" class="form-control timepicker" id="endTime" placeholder="Choose end time" required>
                </div>
                <div class="col-md-2 col-12 d-grid" style="position:relative; top:3px; max-width:170px;">
                    <button type="submit" class="btn btn-warning fw-bold mt-4">Reserve</button>
                </div>
            </form>
            <p class="text-center text-muted mt-3">Please select date and time to proceed.</p>
        </div>

        <script>
            // Initialize Flatpickr for date and time pickers
            flatpickr(".datepicker", {
                dateFormat: "Y-m-d",
                minDate: "today",
                disableMobile: true // Forces the Flatpickr UI on mobile
            });

            flatpickr(".timepicker", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: false,
                disableMobile: true // Forces Flatpickr time picker on mobile
            });
        </script>


        <!-- Reservation System (Initially Hidden) -->
        <div id="reservation-system" class="hidden mt-4" style="min-height:80vh;">
            <!-- chetan ends here -->
            <div class="row">
                <div class="container mb-4">
                    <div class="row d-flex align-items-center justify-content-between px-2 flex-wrap">
                        <div class="col-12 col-md-auto mb-2 mb-md-0" style="border-left: #ff7315 5px solid; padding-left: 15px;">
                            <h3 class="m-0">Table Booking System</h3>
                        </div>
                        <div id="timer" class="text-danger col-auto m-auto" style="font-size: 20px; font-weight: bold; display: none;"></div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#bookingModal">
                                Confirm Booking
                            </button>
                        </div>
                    </div>


                    <!-- Nav Pills -->
                    <ul class="nav nav-pills justify-content-center mb-4 gap-3 mt-3" id="sectionTabs">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#main-area" type="button">Main Area</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#vip-area" type="button">VIP Area</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#garden-area" type="button">Garden Area</button>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content">
                        <!-- Main Area -->
                        <div class="tab-pane fade show active" id="main-area">
                            <div class="border rounded p-4">
                                <h4 class="text-center mb-3">Main Area</h4>
                                <div class="d-flex flex-wrap justify-content-center  mt-4" style="gap:4rem;" id="main-area-tables"></div>
                            </div>
                        </div>

                        <!-- VIP Area -->
                        <div class="tab-pane fade" id="vip-area">
                            <div class="border rounded p-4">
                                <h4 class="text-center mb-3">VIP Area</h4>
                                <div class="d-flex flex-wrap justify-content-center  mt-4" style="gap:4rem;" id="vip-area-tables"></div>
                            </div>
                        </div>

                        <!-- Garden Area -->
                        <div class="tab-pane fade" id="garden-area">
                            <div class="border rounded p-4">
                                <h4 class="text-center mb-3">Garden Area</h4>
                                <div class="d-flex flex-wrap justify-content-center  mt-4" style="gap:4rem;" id="garden-area-tables"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>


    <!-- New Script for Table Bookings and popluating tables-->
    <script>
        document.getElementById('userForm').addEventListener('submit', async function(event) {
            event.preventDefault();



            let response = await fetch('<?php echo base_url() . 'Auth/Check_login'?>');
            let data = await response.json();

            if (!data.logged_in) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Not Logged In!',
                    text: 'Please log in to continue.',
                    confirmButtonText: 'Go to Login',
                    allowOutsideClick: false
                }).then(() => {
                    window.location.href = '<?php echo base_url() . 'login'?>'; // Change to your actual login URL
                });
                return; // Stop form submission
            }

        

            const date = document.getElementById('date').value.trim();
            const startTime = document.getElementById('startTime').value.trim();
            const endTime = document.getElementById('endTime').value.trim();
            console.log(startTime, endTime)
            if (!date || !startTime || !endTime) {
                Swal.fire('Oops!', 'Please fill in all fields.', 'warning');
                return;
            }

            const start = new Date(`2000-01-01T${startTime}`);
            const end = new Date(`2000-01-01T${endTime}`);

            const minStartTime = new Date(`2000-01-01T09:00`);
            const maxStartTime = new Date(`2000-01-01T23:00`);
            console.log(start, end, minStartTime, maxStartTime);

            // Validate Start Time (Must be between 9 AM and 11 PM)
            if (start < minStartTime || start > maxStartTime) {
                Swal.fire('Invalid Start Time!', 'Start time must be between 9 AM and 11 PM.', 'error');
                return;
            }

            // Validate End Time (Must be after Start Time)
            if (end <= start) {
                Swal.fire('Invalid End Time!', 'End time must be after start time.', 'error');
                return;
            }

            // Ensure at least a 30-minute gap between start and end times
            const timeDifference = (end - start) / (1000 * 60); // Convert milliseconds to minutes
            if (timeDifference < 30) {
                Swal.fire('Invalid Duration!', 'End time must be at least 30 minutes after start time.', 'error');
                return;
            }

            try {
                const response = await fetch(`<?php echo base_url() ?>/getAvailableTables?booking_date=${date}&start_time=${startTime}&end_time=${endTime}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                });

                const result = await response.json();
                console.log(result);
                if (result.status === 'success') {
                    populateTablesFromAPI(result.available_tables);
                    document.getElementById('reservation-form').classList.add('hidden');
                    document.getElementById('reservation-system').classList.remove('hidden');
                } else {
                    Swal.fire('No Tables Available', result.message, 'warning');
                }
            } catch (error) {
                console.error('Error fetching tables:', error);
                Swal.fire('Error', 'Could not fetch table availability.', 'error');
            }
        });

        function createTable(area, prefix, tableNumber, seatCount, status) {
            const div = document.createElement("div");
            const tableStatus = (status || "free").trim();


            div.classList.add("table", "mt-3", tableStatus);
            div.setAttribute("data-id", tableNumber);
            div.setAttribute("data-area", prefix);
            div.setAttribute("data-status", tableStatus);

            div.innerHTML = `
            <div>${prefix}</div>
            <div class="status ">${tableStatus}</div>`;

            div.style.width = "120px";
            div.style.height = "80px";

            const seatsPerSide = Math.ceil(seatCount / 4);
            for (let i = 0; i < seatCount; i++) {
                const seat = document.createElement("div");
                seat.className = "seat";
                seat.style.width = "20px";
                seat.style.height = "10px";

                if (i < seatsPerSide) {
                    seat.style.top = "-20px";
                    seat.style.left = `${(120 / (seatsPerSide + 1)) * (i + 1) - 10}px`;
                } else if (i < 2 * seatsPerSide) {
                    seat.style.right = "-30px";
                    seat.style.top = `${(80 / (seatsPerSide + 1)) * (i - seatsPerSide + 1) - 5}px`;
                } else if (i < 3 * seatsPerSide) {
                    seat.style.bottom = "-20px";
                    seat.style.left = `${(120 / (seatsPerSide + 1)) * (i - 2 * seatsPerSide + 1) - 10}px`;
                } else {
                    seat.style.left = "-30px";
                    seat.style.top = `${(80 / (seatsPerSide + 1)) * (i - 3 * seatsPerSide + 1) - 5}px`;
                }

                div.appendChild(seat);
            }

            div.addEventListener("click", () => toggleBooking(div));

            return div;
        }



        function getAreaName(areaId) {
            const areaMap = {
                "1": "Main",
                "2": "Garden",
                "3": "VIP"
            };
            return areaMap[areaId] || "Unknown";
        }

        function populateTablesFromAPI(tables) {
            document.getElementById('main-area-tables').innerHTML = '';
            document.getElementById('vip-area-tables').innerHTML = '';
            document.getElementById('garden-area-tables').innerHTML = '';

            tables.forEach(table => {
                const areaName = getAreaName(table.area_id).toLowerCase();
                const tableDiv = createTable(areaName, table.table_number, table.id, table.seats, table.status === 'available' ? 'free' : table.status);

                if (areaName === 'main') {
                    document.getElementById('main-area-tables').appendChild(tableDiv);
                } else if (areaName === 'vip') {
                    document.getElementById('vip-area-tables').appendChild(tableDiv);
                } else if (areaName === 'garden') {
                    document.getElementById('garden-area-tables').appendChild(tableDiv);
                } else {
                    console.warn("Unknown area:", table.area_id);
                }
            });
        }
    </script>
    <!-- New Script for Table Bookings and popluating tables Ends Here-->


    <!-- Confirm Booking Modal -->
    <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookingModalLabel">Online Reservation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Remove nonvalidate after testing -->
                    <form id="bookingForm" action="" method="post" noValidate>
                        <!-- Other form fields -->
                        <input type="hidden" id="tableData" name="tableData" value="">


                        <div class="mb-3">
                            <label for="guests" class="form-label">Number of guests</label>
                            <input type="number" id="guests" class="form-control" placeholder="Number of guests" min="1" max="99" required
                                oninput="this.value = this.value > 99 ? 99 : (this.value < 1 ? 1 : this.value);">




                        </div>


                        <div class="mb-3">
                            <label for="special_request" class="form-label">Add special request</label>
                            <textarea id="special_request" class="form-control" placeholder="Add special request" maxlength="200"
                                oninput="limitCharacters(this)"></textarea>
                            <small id="charCount">0/200</small>

                            <script>
                                function limitCharacters(textarea) {
                                    if (textarea.value.length > 200) {
                                        textarea.value = textarea.value.substring(0, 200); // Trim extra characters
                                    }
                                    document.getElementById("charCount").textContent = textarea.value.length + "/200";
                                }
                            </script>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-warning" id="confirmBookingBtn">Book Table</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Confirm Booking Modal Ends Here -->

    <!-- Confirm Booking Script -->
    <script>
        document.getElementById("confirmBookingBtn").addEventListener("click", async function(event) {
            event.preventDefault(); // Prevent default form submission
            const button = this; // Reference to the button
            button.disabled = true; // Disable the button to prevent multiple clicks
            button.innerHTML = 'Booking...'; // Optional: Show loading state

            // const bookedTabless = [...document.querySelectorAll('.table.selected')].map(table => table.dataset.id);
            console.log(bookedTables)
            if (bookedTables.length === 0) {
                Swal.fire('Oops!', 'Please select at least one table.', 'warning');
                button.disabled = false; // Re-enable the button
                button.innerHTML = 'Book Table';
                return;
            }

            try {
                let start_time2 = document.getElementById('startTime').value.trim();
                let end_time2 = document.getElementById('endTime').value.trim();
                console.log(start_time2);
                console.log(end_time2);
                const response = await fetch('<?php echo base_url() ?>createBooking', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        booking_date: document.getElementById('date').value.trim(),
                        start_time: document.getElementById('startTime').value.trim(),
                        end_time: document.getElementById('endTime').value.trim(),
                        guests: document.getElementById('guests').value.trim(),
                        special_request: document.getElementById('special_request').value.trim(),
                        tables: bookedTables
                    })

                });

                const result = await response.json();

                if (result.status === 'success') {
                    Swal.fire('Success!', 'Your table has been booked successfully.', 'success').then(() => {
                        document.getElementById('reservation-system').classList.add('hidden');
                        document.getElementById('reservation-form').classList.remove('hidden');
                        document.getElementById('userForm').reset();
                        document.getElementById('bookingForm').reset();
                        document.querySelectorAll('.table.selected').forEach(table => {
                            table.classList.remove('selected');
                        });

                        var bookingModal = document.getElementById('bookingModal');
                        var modalInstance = bootstrap.Modal.getInstance(bookingModal);
                        if (modalInstance) {
                            modalInstance.hide();
                        }
                    });
                    button.disabled = false; // Re-enable the button on error
                    button.innerHTML = 'Book Table';
                } else {
                    if (result.message === 'User not logged in.') {
                        Swal.fire('Error!', result.message, 'error').then(() => {
                            window.location.href = '<?php echo base_url() . 'login' ?>';
                        });
                    } else {
                        Swal.fire('Error!', result.message, 'error');
                    }
                    button.disabled = false; // Re-enable the button on error
                    button.innerHTML = 'Book Table';
                }

            } catch (error) {
                console.error('Error creating booking:', error);
                Swal.fire('Error!', 'Could not process your booking.', 'error');
                button.disabled = false; // Re-enable the button on error
                button.innerHTML = 'Book Table';
                return;
            }
        });
    </script>

    <!-- Confirm Booking Script Ends Here -->



    <!-- Script for Timer -->
    <script>
        let timerInterval;
        var bookedTables = []; // Store booked table IDs

        // Function to start the timer
        function startTimer(duration, display) {
            let timer = duration; // Time in seconds

            // Show the timer display if it's hidden
            display.style.display = "inline"; // Ensure the timer is visible
            clearInterval(timerInterval); // Clear any existing timer
            timerInterval = setInterval(() => {
                const minutes = Math.floor(timer / 60);
                const seconds = timer % 60;

                // Update the display
                display.textContent = `Time Remaining: ${minutes}:${seconds < 10 ? "0" : ""}${seconds}`;

                // Check if time has run out
                if (--timer < 0) {
                    clearInterval(timerInterval);
                    releaseBookedTables();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Time Expired!',
                        text: 'Your reserved tables have been released. Please rebook if needed.',
                        timer: 1500,
                    });

                    // Hide the timer after time expires
                    display.style.display = "none"; // Hide the timer
                }
            }, 1000);
        }

        // Function to release booked tables
        function releaseBookedTables() {
            // Iterate over all booked tables
            bookedTables.forEach((tableId) => {
                const tableElement = document.querySelector(`[data-id="${tableId}"]`); // Find table by data-id
                if (tableElement) {
                    // Reset table status
                    tableElement.classList.remove("booked", "user-booked");
                    tableElement.classList.add("free");

                    // Update status text
                    const statusElement = tableElement.querySelector(".status");
                    if (statusElement) {
                        statusElement.textContent = "free";
                    }

                    // Update the data-status attribute
                    tableElement.setAttribute("data-status", "free");

                    // Remove checkmark
                    const checkmarkElement = tableElement.querySelector(".booking-checkmark");
                    if (checkmarkElement) {
                        checkmarkElement.remove();
                    }
                }
            });

            // Clear the bookedTables array
            bookedTables = [];

            // Update the hidden input value
            updateHiddenInput();

            console.log(bookedTables, "Tables released!");
        }

        // Example: When the user clicks a table, start the timer
        document.querySelectorAll(".table").forEach((tableElement) => {
            tableElement.addEventListener("click", () => {
                if (bookedTables.length === 0) { // Only start the timer if no tables are booked
                    startTimer(300, document.getElementById("timer")); // 300 seconds = 5 minutes
                }
            });
        });
    </script>
    <!-- Script for Timer Ends Here -->

    <!-- Script to change status of table -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function toggleBooking(tableElement) {
            const tableId = tableElement.getAttribute("data-id");

            if (tableElement.classList.contains("free")) {
                tableElement.classList.remove("free");
                tableElement.classList.add("booked", "user-booked", "selected"); // ✅ Add "selected" class
                tableElement.querySelector(".status").textContent = "Selected";
                tableElement.querySelector(".status").style.textAlign = "center";

                let checkmarkElement = tableElement.querySelector(".booking-checkmark");
                if (!checkmarkElement) {
                    checkmarkElement = document.createElement("span");
                    checkmarkElement.className = "booking-checkmark";
                    checkmarkElement.textContent = " ✔";
                    tableElement.appendChild(checkmarkElement);
                }

                bookedTables.push(tableId);
                updateHiddenInput();
                console.log("Current bookedTables array:", bookedTables);

                if (bookedTables.length === 1) {
                    startTimer(300, document.getElementById("timer"));
                }

                Swal.fire({
                    title: "Pending Confirmation!",
                    text: "Please confirm booking within 5 minutes by clicking confirm booking button, or it will be released.",
                    icon: "info",
                    timer: 5500,
                    showConfirmButton: false
                });
            } else if (tableElement.classList.contains("booked")) {
                if (tableElement.classList.contains("user-booked")) {
                    tableElement.classList.remove("booked", "user-booked", "selected"); // ✅ Remove "selected" class
                    tableElement.classList.add("free");
                    tableElement.querySelector(".status").textContent = "free";

                    const checkmarkElement = tableElement.querySelector(".booking-checkmark");
                    if (checkmarkElement) checkmarkElement.remove();

                    const index = bookedTables.indexOf(tableId);
                    if (index !== -1) bookedTables.splice(index, 1);
                    updateHiddenInput();

                    if (bookedTables.length === 0) {
                        clearInterval(timerInterval);
                        document.getElementById("timer").textContent = "";
                    }

                    Swal.fire({
                        title: "Table Freed!",
                        text: "You have successfully freed this table.",
                        icon: "success",
                        timer: 1500,
                        showConfirmButton: false
                    });
                } else {
                    Swal.fire({
                        title: "Action Not Allowed!",
                        text: "This table is booked and cannot be freed.",
                        icon: "warning",
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            }
        }
    </script>
    <!-- Script to change status of table Ends Here -->

    <!-- Script to add tables in Input Field -->
    <script>
        function updateHiddenInput() {
            const hiddenInput = document.getElementById("tableData");
            hiddenInput.value = bookedTables.join(","); // This will be an empty string if bookedTables is empty

            // console.log("Hidden Input Value (inside updateHiddenInput):", hiddenInput.value);
        }
    </script>
    <!-- Script to add tables in Input Field Ends Here  -->


    <!-- script written by chetan for form and content hiding -->
    <!-- <script>
        document.getElementById('userForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const date = document.getElementById('date').value.trim();
            const startTime = document.getElementById('startTime').value.trim();
            const endTime = document.getElementById('endTime').value.trim();

            if (!date || !startTime || !endTime) {
                Swal.fire('Oops!', 'Please fill in all fields.', 'warning');
                return;
            }

            // Convert time to Date objects for easy comparison
            const start = new Date(`2000-01-01T${startTime}`);
            const end = new Date(`2000-01-01T${endTime}`);

            // Define allowed start time range (9 AM - 9 PM)
            const minStartTime = new Date(`2000-01-01T09:00`);
            const maxStartTime = new Date(`2000-01-01T21:00`);

            if (start < minStartTime || start > maxStartTime) {
                Swal.fire('Invalid Start Time!', 'Start time must be between 9 AM and 9 PM.', 'error');
                return;
            }

            // Ensure end time is at least 30 minutes after start time
            const minEndTime = new Date(start.getTime() + 30 * 60000); // Add 30 minutes

            if (end < minEndTime) {
                Swal.fire('Invalid End Time!', 'End time must be at least 30 minutes after start time.', 'error');
                return;
            }

            Swal.fire({
                icon: 'success',
                title: 'Reservation Confirmed!',
                text: `Your table is reserved for ${date} from ${startTime} to ${endTime}.`,
                timer: 2000,
                showConfirmButton: false
            });

            document.getElementById('userForm').classList.add('hidden');
            document.getElementById('reservation-system').classList.remove('hidden');
        });
        // chetan ends here
    </script> -->









    <!-- Bootstrap JS (including jQuery and Popper.js for dropdown functionality) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <div id="footer">
        <?php $this->load->view('IncludeUser/CommonFooter'); ?>
    </div>
</body>

</html>