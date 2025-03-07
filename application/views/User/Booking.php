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

    <title>Hari-Om-Dhaba Booking</title>
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
            color:#F68822;
        }

        .nav-pills .nav-link:hover {

            transform: scale(1.1);
            /* Slightly enlarge the button */
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            /* Add a shadow effect */
        }

        .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
            color: #fff;
            background-color: #F68822;
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
            width: 110px !important;
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
    </style>
    <!-- Table bg Animation Ends Here -->



</head>

<body>


    <div class="container mt-5">
        <div class="row">
            <div class="container mb-4">
                

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
                    <div class="tab-pane fade show active" style=" overflow-x:auto;" id="main-area">
                        <div class="border rounded p-4" style=" width:1250px; margin:auto; overflow-x:auto !important;">
                            <h4 class="text-center mb-3">Main Area</h4>
                            <div class="d-flex flex-wrap justify-content-center mt-4" style="gap:4rem;" id="main-area-tables"></div>
                        </div>
                    </div>

                    <!-- VIP Area -->
                    <div class="tab-pane fade" style=" overflow-x:auto;" id="vip-area">
                    <div class="border rounded p-4" style=" width:1250px; margin:auto; overflow-x:auto !important;">
                            <h4 class="text-center mb-3">VIP Area</h4>
                            <div class="d-flex flex-wrap justify-content-center  mt-4" style="gap:4rem;" id="vip-area-tables"></div>
                        </div>
                    </div>

                    <!-- Garden Area -->
                    <div class="tab-pane fade" style=" overflow-x:auto;" id="garden-area">
                        <div class="border rounded p-4" style=" width:1250px; margin:auto; overflow-x:auto !important;">
                            <h4 class="text-center mb-3">Garden Area</h4>
                            <div class="d-flex flex-wrap justify-content-center  mt-4" style="gap:4rem;" id="garden-area-tables"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    </div>
    
    <!-- Script to polpulate Data -->
    <script>
        // Table data
        const tableData = {
            main: {
                prefix: "M",
                count: 12,
                seats: [4, 5, 6, 4, 6, 6, 4, 4, 6, 4, 6, 8],
                statuses: ["free", "booked", "free", "free", "booked", "free", "free", "free", "free", "free", "booked", "free"]
            },
            vip: {
                prefix: "V",
                count: 6,
                seats: [6, 4, 4, 6, 4, 4],
                statuses: ["booked", "free", "free", "booked", "free", "free"]
            },
            garden: {
                prefix: "G",
                count: 9,
                seats: [4, 6, 6, 4, 4, 6, 4, 4, 6],
                statuses: ["free", "free", "booked", "free", "free", "booked", "free", "free", "booked"]
            }
        };


        function createTable(area, prefix, index, seatCount) {
            const div = document.createElement("div");
            div.className = `table ${area.statuses[index] || "free"} mt-3`;

            // Assign data attributes for tracking
            div.setAttribute("data-area", prefix); // Area prefix (e.g., M, V, G)
            div.setAttribute("data-id", `${prefix}-${index + 1}`); // Unique table ID (e.g., M-1, V-2)
            div.setAttribute("data-status", area.statuses[index] || "free"); // Current status (e.g., free, booked)

            // Add table content
            div.innerHTML = `
            <div>${prefix}-${index + 1}</div>
            <div class="status">${area.statuses[index] || "free"}</div>
        `;

            // Adjust table size
            const tableSize = {
                width: 120,
                height: 80
            };
            div.style.width = `${tableSize.width}px`;
            div.style.height = `${tableSize.height}px`;

            // Create seats dynamically around the table
            const seatSize = {
                width: 20,
                height: 10
            }; // Seat dimensions for rectangles
            const padding = 10; // Space between table and seats

            const seatsPerSide = Math.ceil(seatCount / 4);
            for (let i = 0; i < seatCount; i++) {
                const seat = document.createElement("div");
                seat.className = "seat";
                seat.style.width = `${seatSize.width}px`;
                seat.style.height = `${seatSize.height}px`;

                if (i < seatsPerSide) {
                    // Top side
                    seat.style.top = `-${seatSize.height + padding}px`;
                    seat.style.left = `${(tableSize.width / (seatsPerSide + 1)) * (i + 1) - seatSize.width / 2}px`;
                } else if (i < 2 * seatsPerSide) {
                    // Right side
                    seat.style.right = `-${seatSize.width + padding}px`;
                    seat.style.top = `${(tableSize.height / (seatsPerSide + 1)) * (i - seatsPerSide + 1) - seatSize.height / 2}px`;
                } else if (i < 3 * seatsPerSide) {
                    // Bottom side
                    seat.style.bottom = `-${seatSize.height + padding}px`;
                    seat.style.left = `${(tableSize.width / (seatsPerSide + 1)) * (i - 2 * seatsPerSide + 1) - seatSize.width / 2}px`;
                } else {
                    // Left side
                    seat.style.left = `-${seatSize.width + padding}px`;
                    seat.style.top = `${(tableSize.height / (seatsPerSide + 1)) * (i - 3 * seatsPerSide + 1) - seatSize.height / 2}px`;
                }

                div.appendChild(seat);
            }

            return div;
        }

        const populateTables = (areaKey, containerId) => {
            const container = document.getElementById(containerId);
            const data = tableData[areaKey]; // Get the corresponding area object
            for (let i = 0; i < data.count; i++) {
                const table = createTable(data, data.prefix, i, data.seats[i]); // Pass the entire area object

                // Add click event to toggle booking status
                table.addEventListener("click", () => toggleBooking(table));

                container.appendChild(table);
            }
        };

        // Populate tables for each area
        populateTables("main", "main-area-tables");
        populateTables("vip", "vip-area-tables");
        populateTables("garden", "garden-area-tables");
    </script>
    <!-- Script to polpulate Data Ends Here-->



    <!-- Script to change status of table -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
       function toggleBooking() {
    window.location.href = "<?php echo base_url(); ?>TableBooking";
}


    </script>
    <!-- Script to change status of table Ends Here -->

  



</body>

</html>