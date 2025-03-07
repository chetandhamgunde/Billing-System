<!doctype html>
<html lang="en">

<head>
  <link rel="icon" type="image/png" href="<?php echo base_url() . 'assets/images/hariom_dhabalogo.png' ?>">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hari-Om-Dhaba UserHistory</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .text-orange {
      color: #F68822;
    }

    .text-orange:hover {
      color: #D97706;
    }

    .card {
      border-radius: 10px;
      overflow: hidden;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .card img {
      height: 180px;
      object-fit: cover;
    }

    .feedback-btn {
      cursor: pointer;
      color: #D9534F;
      font-weight: bold;
    }

    .feedback-btn:hover {
      text-decoration: underline;
    }

    .star-rating {
      display: flex;
      flex-direction: row-reverse;
      justify-content: center;
      gap: 5px;
      font-size: 2rem;
    }

    .star {
      cursor: pointer;
      color: #ccc;
      transition: color 0.3s ease;
    }

    input[type="radio"] {
      display: none;
    }

    input[type="radio"]:checked~label {
      color: gold;
    }

    .star:hover,
    .star:hover~.star {
      color: gold;
    }

    .nav2{
      flex-wrap: nowrap;
      width: 100%;
    }

    .nav2-link{
      margin: -2px 10px !important;
      font-size: 1.1rem !important;
    }
  </style>
</head>

<body>
  <?php $this->load->view('IncludeUser/CommonNavbar'); ?>

  <div class="container mt-4 py-5 px-0">
    <?php $this->load->view('IncludeUser/ProfileSidebar'); ?>
    <div class="container px-lg-4 px-2 pt-0 rounded">
      <h3 class="fw-bold text-dark mb-3">Reservations</h3>
      <ul class="nav nav2" style="margin:0; padding:0; border-bottom: 2px solid #ccc;">
        <li class="nav-item">
          <a class="nav-link nav2-link ms-0 ps-0 text-muted fw-semibold p-1" href="<?php echo base_url() . 'userbookings' ?>">Upcoming&nbsp;Reservations</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav2-link ms-lg-3 ms-0 ps-0 text-muted fw-semibold p-1" style="border-bottom: 2px solid #F68822; margin-bottom:-2px;" href="<?php echo base_url() . 'userhistory' ?>" >Booking&nbsp;History</a>
        </li>
      </ul>
      <div id="bookingContainer" class="row g-4 w-100 mt-2">
      </div>
    </div>
  </div>
</div>
  <?php $this->load->view('IncludeUser/CommonFooter'); ?>
  <!-- Fetch and Render Approved Bookings -->
  <script>
document.addEventListener('DOMContentLoaded', function() {
    fetchApprovedBookings();
});

function fetchApprovedBookings() {
    fetch('<?php echo site_url('user/getBookings'); ?>')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                const filteredBookings = data.data.filter(booking => 
                    booking.status === 'completed' || booking.status === 'cancel'
                );
                renderBookings(filteredBookings);
            } else {
                document.getElementById('bookingContainer').innerHTML = `
                  <p class="text-center text-muted">${data.message}</p>`;
            }
        })
        .catch(error => console.error('Error fetching bookings:', error));
}

function renderBookings(bookings) {
    const container = document.getElementById('bookingContainer');
    container.innerHTML = '';

    if (bookings.length === 0) {
        container.innerHTML = '<p class="text-center text-muted">No completed or cancelled bookings available.</p>';
        return;
    }

    bookings.forEach(booking => {
        let statusBadge = "";
        let tableInfo = "";
        let feedbackButton = "";

        // Define appearance based on status
        if (booking.status === "completed") {
            statusBadge = `<span class="badge bg-success w-50">Completed</span>`;
            tableInfo = `<p class="mb-3"><span class="text-muted">Table: </span><span class="badge bg-light text-orange">${booking.table_numbers}</span></p>`;
            feedbackButton = `
                <p class="feedback-btn text-center text-primary fw-bold mt-3" 
                   data-bs-toggle="modal" data-bs-target="#feedbackModal">
                    <i class="bi bi-chat-left-text me-1"></i> Give Feedback
                </p>`;
        } else if (booking.status === "cancel") {
            statusBadge = `<span class="badge bg-danger w-50">Cancelled</span>`;
            tableInfo = ""; // Hide table info for cancelled bookings
        }

        const card = `
          <div class="col-md-6 col-lg-4 d-flex">
            <div class="card shadow-sm border-0 w-100 d-flex flex-column">
              <img src="${getImage(booking)}" alt="Booking Image" class="card-img-top" style="height: 180px; object-fit: cover;">
              <div class="card-body d-flex flex-column flex-grow-1">
                <h5 class="card-title text-dark">Booking #${booking.id}</h5>
                <p class="text-muted mb-2">
                  <i class="bi bi-calendar3 me-2"></i> ${formatDate(booking.booking_date)} ${booking.start_time} - ${booking.end_time}
                </p>
                ${statusBadge}
                <p class="mt-2"><span class="text-muted">Ref: </span>${booking.id}</p>
                ${tableInfo}
                <div class="">${feedbackButton}</div> <!-- Push feedback button to the bottom -->
              </div>
            </div>
          </div>
        `;
        container.insertAdjacentHTML('beforeend', card);
    });
}

function getImage(booking) {
    return booking.image ? booking.image : '<?php echo base_url() . "assets/images/maha.jpg"; ?>';
}

function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toDateString();
}

  </script>

  <!-- Feedback Modal -->
  <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="feedbackModalLabel">Feedback Form</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="feedbackForm">
            <div class="mb-3">
              <label for="comments" class="form-label">Comments:</label>
              <textarea id="comments" name="comments" rows="4" class="form-control" maxlength="200" oninput="limitText(this, 200)"></textarea>
              <small id="charCount" class="text-muted">200 characters remaining</small>

              <script>
                function limitText(field, maxChars) {
                  if (field.value.length > maxChars) {
                    field.value = field.value.substring(0, maxChars); // Trim extra characters
                  }
                  document.getElementById("charCount").textContent = (maxChars - field.value.length) + " characters remaining";
                }
              </script>

            </div>
            <div class="mb-3">
              <label class="form-label">Rating:</label>
              <div class="star-rating">
                <input type="radio" id="star5" name="rating" value="5">
                <label for="star5" class="star">&#9733;</label>

                <input type="radio" id="star4" name="rating" value="4">
                <label for="star4" class="star">&#9733;</label>

                <input type="radio" id="star3" name="rating" value="3">
                <label for="star3" class="star">&#9733;</label>

                <input type="radio" id="star2" name="rating" value="2">
                <label for="star2" class="star">&#9733;</label>

                <input type="radio" id="star1" name="rating" value="1">
                <label for="star1" class="star">&#9733;</label>
              </div>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-orange btn-lg proceed-btn text-black bg-warning py-1">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- SweetAlert Script -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    document.getElementById("feedbackForm").addEventListener("submit", function(event) {
      event.preventDefault();

      let rating = document.querySelector('input[name="rating"]:checked');
      let comments = document.getElementById("comments").value.trim();

      if (!rating || !comments) {
        Swal.fire({
          title: "Error!",
          text: "Please select a rating and fill in the comment before submitting your feedback.",
          icon: "error",
          confirmButtonText: "OK"
        });
        return;
      }

      // Make an AJAX request to the backend
      fetch('<?php echo site_url('submitFeedback'); ?>', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            rating: rating.value,
            comments: comments
          })
        })
        .then(response => response.json())
        .then(data => {
          if (data.status === 'success') {
            Swal.fire({
              title: "Feedback Submitted!",
              html: `<p>Thank you for your feedback!</p>
                 <p><strong>Rating:</strong> ${rating.value} stars</p>
                 <p><strong>Comments:</strong> ${comments}</p>`,
              icon: "success",
              confirmButtonText: "OK"
            }).then(() => {
              var feedbackModal = bootstrap.Modal.getInstance(document.getElementById("feedbackModal"));
              feedbackModal.hide();
              document.getElementById("feedbackForm").reset();
            });
          } else {
            throw new Error(data.message);
          }
        })
        .catch(error => {
          Swal.fire({
            title: "Error!",
            text: error.message,
            icon: "error",
            confirmButtonText: "OK"
          });
        });
    });
  </script>

  <!-- script for web share API-->
  <script>
    document.addEventListener("click", function(event) {
      if (event.target.closest("#shareBtn")) { // Check if the clicked element or its parent is #shareBtn
        event.preventDefault();

        const shareData = {
          title: "Hari Om Dhaba",
          text: "Check out this amazing place!",
          url: window.location.href // Get the current page URL dynamically
        };

        if (navigator.share) {
          navigator.share(shareData)
            .then(() => console.log("Shared successfully!"))
            .catch((error) => console.log("Sharing failed:", error));
        } else {
          alert("Web Share API is not supported on this device.");
        }
      }
    });
  </script>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>