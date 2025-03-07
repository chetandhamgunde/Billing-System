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
                            <h3 class="mb-2 ">Offers</h3>

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
                                Add New Offer
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
                                        <form id="addOfferForm">
                                            <div class="mb-3">
                                                <label for="newOfferName" class="form-label">Offer Name</label>
                                                <input type="text" class="form-control" id="newOfferName" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="newOfferDesc" class="form-label">Description</label>
                                                <textarea class="form-control" id="newOfferDesc" required oninput="this.value = this.value.slice(0, 50)"></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="newOfferValidUpto" class="form-label">Valid Upto</label>
                                                <input type="datetime-local" class="form-control" id="newOfferValidUpto" required>
                                            </div>
                                            <script>
                                                document.addEventListener("DOMContentLoaded", function() {
                                                    const input = document.getElementById("newOfferValidUpto");

                                                    function setMinDateTime() {
                                                        const now = new Date();
                                                        now.setMinutes(now.getMinutes() - now.getTimezoneOffset()); // Adjust for timezone
                                                        input.min = now.toISOString().slice(0, 16);
                                                    }

                                                    setMinDateTime(); // Set the initial min value

                                                    input.addEventListener("focus", setMinDateTime); // Update min when the user interacts
                                                });
                                            </script>
                                            <div class="mb-3">
                                                <label for="newOfferValidUpto" class="form-label">Price</label>
                                                <input type="text" class="form-control" id="newOfferPrice" required
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/^(\d*\.?\d{0,2}).*$/, '$1')">

                                            </div>
                                            <div class="mb-3">
                                                <label for="newOfferDiscount" class="form-label">Discount</label>
                                                <input type="text" class="form-control" id="newOfferDiscount" required oninput="validateDiscount(this)">
                                                <script>
                                                    function validateDiscount(input) {
                                                        input.value = input.value.replace(/[^0-9]/g, ''); // Remove non-numeric characters

                                                        let value = parseInt(input.value, 10);
                                                        if (isNaN(value)) input.value = ""; // Clear if empty
                                                        else if (value <= 0) input.value = "0"; // Enforce minimum value 0
                                                        else if (value > 100) input.value = "100"; // Enforce maximum value 100
                                                    }
                                                </script>
                                            </div>
                                            <div class="mb-3">
                                                <label for="newOfferImage" class="form-label">Image</label>
                                                <input type="file" class="form-control" id="newOfferImage" accept="image/*" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Add Offer</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal for Adding New Offer Ends Here-->

                        <div class="table-responsive">
                            <table class="table table-hover" id="offersTable">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="background-color: #ff7315; color: white;" scope="col">Sr No.</th>
                                        <th class="text-center" style="background-color: #ff7315; color: white;" scope="col">Offer Name</th>
                                        <th class="text-center" style="background-color: #ff7315; color: white;" scope="col">Description</th>
                                        <th class="text-center" style="background-color: #ff7315; color: white;" scope="col">Valid Upto</th>
                                        <th class="text-center" style="background-color: #ff7315; color: white;" scope="col">Image</th>
                                        <th class="text-center" style="background-color: #ff7315; color: white;" scope="col">Discount</th>
                                        <th class="text-center" style="background-color: #ff7315; color: white;" scope="col">Price</th>
                                        <th class="text-center " style="background-color: #ff7315; color: white;" scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="offersTableBody">
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
                            let offerData = []; // Global array to store offer data
                            let currentPage = 1;
                            const rowsPerPage = 2;
                            let filteredOffers = []; // This will be used for filtering

                            // Fetch offer data from the server
                            async function fetchOffers() {
                                try {
                                    const response = await fetch('<?php echo base_url() . 'admin/get_offers'; ?>');
                                    const data = await response.json();

                                    if (data.status === 'success') {
                                        offerData = data.data; // Store the fetched data
                                        filteredOffers = [...offerData]; // Initialize filteredOffers with all data
                                        console.log('Offer Data:', offerData);
                                        displayData(currentPage); // Display the data on the first page
                                    } else {
                                        console.error('No offers found:', data.message);
                                        Swal.fire({
                                            title: 'No Offers',
                                            text: data.message,
                                            icon: 'info',
                                            confirmButtonText: 'OK'
                                        });
                                    }
                                } catch (error) {
                                    console.error('Error fetching offers:', error);
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'Failed to fetch offers. Please try again later.',
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                }
                            }

                            // Function to display offers with pagination
                            function displayData(page) {
                                const start = (page - 1) * rowsPerPage;
                                const end = start + rowsPerPage;
                                const paginatedData = filteredOffers.slice(start, end);
                                const tableBody = document.getElementById("offersTableBody");
                                tableBody.innerHTML = ""; // Clear previous table content

                                paginatedData.forEach((offer, index) => {
                                    const row = `
                                        <tr>
                                            <td class="text-center bg-white">${start + index + 1}</td>
                                            <td class="text-center bg-white">${offer.offerName}</td>
                                            <td class="text-center bg-white">${offer.offerDesc}</td>
                                            <td class="text-center bg-white">${offer.validUpto}</td>
                                            <td class="text-center bg-white">
                                                <img src="<?php echo base_url('uploads/images/'); ?>${offer.image}" alt="${offer.offerName}" width="50" height="50">
                                            </td>
                                            <td class="text-center bg-white">${offer.discount}%</td>
                                            <td class="text-center bg-white">₹${offer.price}</td>
                                            <td class="text-center bg-white d-flex flex-wrap gap-2">
                                                <button class="btn btn-sm btn-info" onclick="viewOffer(${offer.id})"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-danger " onclick="deleteOffer(${offer.id})"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>`;
                                    tableBody.innerHTML += row;
                                });

                                updatePagination(Math.ceil(filteredOffers.length / rowsPerPage), page);
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
                                const totalPages = Math.ceil(filteredOffers.length / rowsPerPage);
                                if (currentPage < totalPages) {
                                    currentPage++;
                                    displayData(currentPage);
                                }
                            }

                            // Function to filter data
                            function filterData() {
                                const query = document.getElementById('searchBar').value.toLowerCase();
                                filteredOffers = offerData.filter(offer =>
                                    Object.values(offer).some(value =>
                                        value.toString().toLowerCase().includes(query)
                                    )
                                );
                                currentPage = 1; // Reset to the first page after filtering
                                displayData(currentPage);
                            }

                            // Fetch offers when the page loads
                            document.addEventListener('DOMContentLoaded', fetchOffers);
                        </script>

                        <!-- Scripts Ends Here -->

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Edit Offer</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="editForm" enctype="multipart/form-data" novalidate>
                                            <input type="hidden" id="editId" name="editId" value="">
                                            <input type="hidden" id="oldImage" name="oldImage" value="">

                                            <div class="mb-3">
                                                <label for="editName" class="form-label">Offer Name</label>
                                                <input type="text" class="form-control" id="editName" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="editDesc" class="form-label">Description</label>
                                                <textarea class="form-control" id="editDesc" required oninput="this.value = this.value.slice(0, 60)"></textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label for="editValidUpto" class="form-label">Valid Upto</label>
                                                <input type="datetime-local" class="form-control" id="editValidUpto" required oninput="validateDate()">
                                                <div id="dateError" class="text-danger" style="display:none;">The date must be later than today.</div>
                                            </div>
                                            <script>
                                                document.addEventListener("DOMContentLoaded", function() {
                                                    const input = document.getElementById("editValidUpto");

                                                    function setMinDateTime() {
                                                        const now = new Date();
                                                        now.setMinutes(now.getMinutes() - now.getTimezoneOffset()); // Adjust for timezone
                                                        input.min = now.toISOString().slice(0, 16);
                                                    }

                                                    setMinDateTime(); // Set the initial min value

                                                    input.addEventListener("focus", setMinDateTime); // Update min when the user interacts
                                                });
                                            </script>

                                            <div class="mb-3">
                                                <label for="editDiscount" class="form-label">Discount</label>
                                                <input type="text" class="form-control" id="editDiscount" required oninput="validateDiscount(this)">
                                            </div>

                                            <div class="mb-3">
                                                <label for="editPrice" class="form-label">Price</label>
                                                <input type="text" class="form-control" id="editPrice" required
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/^(\d*\.?\d{0,2}).*$/, '$1')">
                                            </div>

                                            <div class="mb-3">
                                                <label for="editImage" class="form-label">Current Image</label>
                                                <div id="currentImageContainer" class="mb-3">
                                                    <img id="currentImage" src="" alt="Offer Image" width="100" height="100">
                                                </div>
                                                <label for="newImage" class="form-label">Change Image</label>
                                                <input type="file" class="form-control" id="newImage" accept="image/*">
                                            </div>

                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            let editOfferId = null;

                            async function viewOffer(id) {
                                try {
                                    // Send request to backend to get offer details by ID
                                    const response = await fetch(`<?php echo base_url('admin/get_offer_by_id/'); ?>${id}`);
                                    const data = await response.json();

                                    if (data.status === 'success' && data.offer) {
                                        const offer = data.offer; // Offer data returned from backend

                                        // Populate form fields
                                        document.getElementById("editId").value = offer.id;
                                        document.getElementById("editName").value = offer.offerName;
                                        document.getElementById("editDesc").value = offer.offerDesc;
                                        document.getElementById("editValidUpto").value = offer.validUpto;
                                        document.getElementById("editDiscount").value = offer.discount;
                                        document.getElementById("editPrice").value = offer.price;
                                        document.getElementById("currentImage").src = `<?php echo base_url('uploads/images/'); ?>${offer.image}`;

                                        // Store the old image filename in a hidden input field for later use
                                        document.getElementById("oldImage").value = offer.image;

                                        const editModal = new bootstrap.Modal(document.getElementById("editModal"));
                                        editModal.show();
                                    } else {
                                        Swal.fire("Error!", data.message || "Offer not found.", "error");
                                    }
                                } catch (error) {
                                    console.error("Error fetching offer details:", error);
                                    Swal.fire("Error!", "An error occurred while fetching offer details.", "error");
                                }
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
    <script>
        function deleteOffer(id) {
            console.log(id);
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`<?php echo base_url('admin/delete_offer/') ?>${id}`, {
                            method: 'DELETE'
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === "success") {
                                Swal.fire("Deleted!", "Offer has been deleted.", "success");
                                fetchOffers(); // Refresh the offer list
                            } else {
                                Swal.fire("Error!", data.message || "Failed to delete the offer.", "error");
                            }
                        })
                        .catch((error) => {
                            console.error('Error deleting offer:', error);
                            Swal.fire("Error!", "An error occurred while deleting the offer.", "error");
                        });
                }
            });
        }


        // FUNSTION EDIT THE OFFER
        document.getElementById("editForm").addEventListener("submit", async function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Create a FormData object to handle file upload
            let formData = new FormData();
            formData.append("editId", document.getElementById("editId").value);
            formData.append("editName", document.getElementById("editName").value);
            formData.append("editDesc", document.getElementById("editDesc").value);
            formData.append("editValidUpto", document.getElementById("editValidUpto").value);
            formData.append("editDiscount", document.getElementById("editDiscount").value);
            formData.append("editPrice", document.getElementById("editPrice").value);
            formData.append("oldImage", document.getElementById("oldImage").value); // Add the old image filename

            // If the user has selected a new image, append it to the FormData object
            const newImage = document.getElementById("newImage").files[0];
            if (newImage) {
                formData.append("editImage", newImage);
            }

            try {
                // Send the form data to the backend using Fetch API
                const response = await fetch("<?php echo base_url('admin/update_offer'); ?>", {
                    method: "POST",
                    body: formData,
                });

                const data = await response.json();

                if (data.status === 'success') {
                    // Handle success (you can close the modal, show success message, etc.)
                    Swal.fire({
                        title: 'Success!',
                        text: 'Offer updated successfully',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Reload after the user clicks OK
                            location.reload();
                        }
                    });
                    $('#editModal').modal('hide'); // Hide the modal

                } else {
                    // Handle failure
                    Swal.fire({
                        title: 'Error!',
                        text: data.message || 'Failed to update offer',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            } catch (error) {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error!',
                    text: 'An error occurred while updating the offer.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });





        displayData(currentPage);
    </script>


    <!-- SCRIPT TO ADD NEW OFFER -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var modal = document.getElementById("addOfferModal"); // Replace with your modal ID
            modal.addEventListener("hidden.bs.modal", function () {
                document.getElementById("addOfferForm").reset(); // Resets the form inside the modal
            });
            const form = document.getElementById("addOfferForm");

            // Handle the form submission
            form.addEventListener("submit", function(event) {
                event.preventDefault(); // Prevent the default form submission

                // Create a FormData object to send the form data
                const formData = new FormData(form);
                formData.append("offerName", document.getElementById("newOfferName").value);
                formData.append("offerDesc", document.getElementById("newOfferDesc").value);
                formData.append("validUpto", document.getElementById("newOfferValidUpto").value);
                formData.append("price", document.getElementById("newOfferPrice").value);
                formData.append("discount", document.getElementById("newOfferDiscount").value);
                formData.append("newOfferImage", document.getElementById("newOfferImage").files[0]);
                console.log(formData);
                // Send data using Fetch API
                fetch('<?php echo base_url() . 'admin/save_offers' ?>', {
                        method: 'POST',
                        body: formData,
                    })
                    .then(response => response.json()) // Assuming server returns JSON
                    .then(data => {
                        console.log('Success:', data);
                        // Optionally close modal and show success message
                        $('#addOfferModal').modal('hide');
                        Swal.fire({
                            title: 'Success!',
                            text: 'Offer added successfully',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Reload after the user clicks OK
                                location.reload();
                            }
                        });
                    })

                    .catch((error) => {
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred while adding the offer',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    });
            });
        });
    </script>






    <!-- Bootstrap JS (including jQuery and Popper.js for dropdown functionality) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Sidebar Toggler Script -->
    <script src="<?php echo base_url() . 'assets/js/main.js' ?>"></script>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</body>

</html>