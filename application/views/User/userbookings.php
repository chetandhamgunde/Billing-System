<!doctype html>
<html lang="en">

<head>
    <link rel="icon" type="image/png" href="<?php echo base_url() . 'assets/images/hariom_dhabalogo.png' ?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hari-Om-Dhaba UserBookings</title>
    
    <!-- Bootstrap CSS and Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        .text-orange { color: #F68822; }
        .text-orange:hover { color: #D97706; }
        .border-orange { border-color: #F68822 !important; }
        .border-orange:hover { background-color: #F68822 !important; color: white !important; }
        .proceed-btn:hover { background-color: #F68822; }
        .card-title { font-weight: 700; }

        
    .nav2{
      flex-wrap: nowrap;
      width: 100%;
    }
    
    .nav2-link{
      margin: -2px 10px !important;
      font-size: 1.1rem !important;
    }

    .card{
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    </style>
</head>

<body>
    <?php $this->load->view('IncludeUser/CommonNavbar'); ?>
        
    <div class="container mt-4 py-5 px-0">
        <?php $this->load->view('IncludeUser/ProfileSidebar'); ?>
        
        <!-- Profile Details -->
        <div class="container px-lg-4 px-2 pt-0 rounded">
            <h3 class="fw-bold text-dark mb-3">Reservations</h3>
            <ul class="nav nav2" style="margin:0; padding:0; border-bottom: 2px solid #ccc;">
        <li class="nav-item">
          <a class="nav-link nav2-link ms-0 ps-0 text-muted fw-semibold p-1" style="border-bottom: 2px solid #F68822; margin-bottom:-2px;" href="<?php echo base_url() . 'userbookings' ?>">Upcoming&nbsp;Reservations</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav2-link ms-lg-3 ms-0 ps-0 text-muted fw-semibold p-1" href="<?php echo base_url() . 'userhistory' ?>" >Booking&nbsp;History</a>
        </li>
      </ul>
            <div id="loadingSpinner" class="text-center my-4" style="display: none;">
                <div class="spinner-border text-orange" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div id="bookingCards" class="row g-4 w-100 mt-2"></div>
        </div>
    </div>

        <script>
    document.addEventListener('DOMContentLoaded', function () {
        fetchBookings();
    });

    function fetchBookings() {
    document.getElementById('loadingSpinner').style.display = 'block';

    fetch('<?php echo site_url('user/getBookings') ?>')
        .then(response => response.json())
        .then(data => {
            document.getElementById('loadingSpinner').style.display = 'none';
            if (data.status === 'success') {
                const filteredBookings = data.data.filter(booking => 
                    booking.status.toLowerCase() === 'approved' || booking.status.toLowerCase() === 'pending'
                );
                renderCards(filteredBookings);
            } else {
                document.getElementById('bookingCards').innerHTML = `<p class="text-center text-muted">${data.message}</p>`;
            }
        })
        .catch(error => {
            document.getElementById('loadingSpinner').style.display = 'none';
            console.error('Error fetching bookings:', error);
        });
}

function renderCards(bookings) {
    const bookingContainer = document.getElementById('bookingCards');
    bookingContainer.innerHTML = ''; // Clear existing content

    if (bookings.length === 0) {
        bookingContainer.innerHTML = `<p class="text-center text-muted">No approved or pending bookings found.</p>`;
        return;
    }

    bookings.forEach(booking => {
        const statusBadge = booking.status.toLowerCase() === 'pending' 
            ? `<span class="badge bg-warning text-dark">Pending</span>` 
            : `<span class="badge bg-success">Approved</span>`;

        const card = `
            <div class="col-sm-6 col-md-4 mb-4">
                <div class="card shadow-sm border-0" style="border-radius: 10px; overflow: hidden; display: flex; flex-direction: column; height: 100%;">
                    <div style="height: 150px; background-color: #e9ecef;" class="d-flex align-items-center justify-content-center">
                        <img src="${getImage(booking)}" alt="Booking Image" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-dark">Booking @ Id ${booking.id}</h5>
                        <p class="text-muted mb-3">
                            <i class="bi bi-calendar3 me-2"></i> ${formatDate(booking.booking_date)} ${booking.start_time} - ${booking.end_time}
                        </p>
                        <!-- Status Badge -->
                        <p class="mb-2">${statusBadge}</p>

                        <!-- Icons Section -->
                        <div class="d-flex justify-content-start align-items-center gap-3 mb-3">
                            <!-- Share Icon -->
                            <a href="#" class="shareBtn d-flex align-items-center justify-content-center rounded-circle border border-orange text-orange"
                               style="width: 40px; height: 40px;">
                               <i class="bi bi-share fs-5"></i>
                            </a>
                            
                            <!-- Location Icon -->
                            <a href="https://maps.app.goo.gl/ZRdBKWL5Kp3e6Agc8" target="_blank"
                               class="d-flex align-items-center justify-content-center rounded-circle border border-orange text-orange"
                               style="width: 40px; height: 40px;">
                               <i class="bi bi-geo-alt fs-5"></i>
                            </a>

                            <!-- Phone Icon -->
                            <a href="tel:7020563359" class="d-flex align-items-center justify-content-center rounded-circle border border-orange text-orange"
                               style="width: 40px; height: 40px;">
                               <i class="bi bi-telephone fs-5"></i>
                            </a>
                        </div>

                        <p class="mb-1 text-orange"><span class="text-muted">Booking Id: </span>${booking.id}</p>
                        <p class="mb-1">
                            <span class="text-muted">Tables: </span>
                            <span class="badge bg-light text-orange fs-5 text-wrap d-inline-block w-100">
                                ${booking.table_numbers}
                            </span>
                        </p>

                        ${booking.status.toLowerCase() === 'pending' ? `
                        <p class="text-danger text-center fw-semibold mt-2" style="cursor:pointer;" 
                           data-bs-toggle="modal" 
                           data-bs-target="#cancelModal" 
                           data-id="${booking.id}" 
                           data-status="${booking.status}">
                           <i class="bi bi-x-circle me-2"></i>Cancel
                        </p>` : ''}
                    </div>
                </div>
            </div>
        `;
        bookingContainer.insertAdjacentHTML('beforeend', card);
    });
}

function getImage(booking) {
    return booking.image ? booking.image : '<?php echo base_url() . "assets/images/maha.jpg" ?>';
}

function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toDateString();
}

</script>

    </div>



    <!-- Cancel Modal -->
    <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3 shadow">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-muted m-auto ps-5 fw-semibold">
                        <i class="bi bi-emoji-frown me-2"></i>We are Sorry to See You Cancel
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="cancelForm" class="text-muted">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="cancelReason" id="reason1" value="appointments">
                            <label class="form-check-label" for="reason1">I have other appointments</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="cancelReason" id="reason2" value="timing">
                            <label class="form-check-label" for="reason2">I won't be able to make it on time</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="cancelReason" id="reason3" value="mistake">
                            <label class="form-check-label" for="reason3">Booked by mistake</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="cancelReason" id="reason4" value="other">
                            <label class="form-check-label" for="reason4">Other</label>
                        </div>
                    </form>
                    <div class="text-center mt-3">
                        <button type="button" class="btn btn-lg proceed-btn text-black   py-1" onclick="submitCancellation()" style="background-color:darkorange;">Proceed to Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
   
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
    let bookingId = '';
    let bookingStatus = '';

    // Capture booking id and status when the modal opens
    document.getElementById('cancelModal').addEventListener('show.bs.modal', function (event) {
        const triggerElement = event.relatedTarget;
        bookingId = triggerElement.getAttribute('data-id');
        bookingStatus = triggerElement.getAttribute('data-status');
    });

    async function submitCancellation() {
        let selectedReason = document.querySelector('input[name="cancelReason"]:checked');
        if (!selectedReason) {
            Swal.fire({
                title: "Error!",
                text: "Please select a reason for cancellation.",
                icon: "error",
                confirmButtonText: "OK"
            });
            return;
        }

        let cancelModal = bootstrap.Modal.getInstance(document.getElementById('cancelModal'));
        cancelModal.hide();

        // Send id, status, and reason to the backend
        try {
            let response = await fetch('<?php echo site_url("approveBooking") ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id: bookingId,
                    status: 'cancel',
                    
                })
            });

            if (response.ok) {
                Swal.fire({
                    title: "Cancellation Submitted!",
                    text: `Your cancellation for booking ID: ${bookingId} has been submitted.`,
                    icon: "success",
                    confirmButtonText: "OK"
                }).then(() => {
                    document.querySelectorAll('input[name="cancelReason"]').forEach(input => input.checked = false);
                    location.reload();
                });
            } else {
                throw new Error("Failed to submit cancellation. Please try again.");
            }
        } catch (error) {
            Swal.fire({
                title: "Error!",
                text: error.message,
                icon: "error",
                confirmButtonText: "OK"
            });
        }
    }
</script>

 
 <!-- script for web share API-->
 <script>
document.addEventListener("click", function (event) {
    if (event.target.closest(".shareBtn")) {  
        event.preventDefault();

        // Find the closest card and extract booking details
        const card = event.target.closest(".card");
        if (!card) return; // Safety check

        const bookingId = card.querySelector(".card-title").textContent.replace("Booking @ Id ", "").trim();
        const bookingDate = card.querySelector(".bi-calendar3").parentElement.textContent.trim();
        const tableNumber = card.querySelector(".badge") ? card.querySelector(".badge").textContent.trim() : "N/A";
        const status = card.querySelector(".text-danger") ? "Pending" : "Confirmed";

        // Create the message text
        const shareText = `📅 Booking Date: ${bookingDate}\n📍 Table No: ${tableNumber}\n🆔 Booking ID: ${bookingId}\n📌 Status: ${status}`;

        // Encode the text for URL
        const encodedText = encodeURIComponent(shareText);

        // Open WhatsApp share link
        const whatsappUrl = `https://wa.me/?text=${encodedText}`;
        window.open(whatsappUrl, "_blank");
    }
});


</script>

    </div>
    <?php $this->load->view('IncludeUser/CommonFooter'); ?>
</body>
</html>
