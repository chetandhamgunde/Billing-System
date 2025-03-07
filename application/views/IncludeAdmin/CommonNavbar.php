<style>
    @media (max-width:768px) {
        .profileNav {
            margin-right: 0px !important;
        }

    }

    body {
        font-family: "Work Sans", serif;
    }

    .notification-card {
        display: flex;
        align-items: center;
        background: #f9f9f9;
        padding: 10px;
        border-radius: 8px;
        margin-bottom: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        /* Make it clickable */
        transition: background 0.3s;
    }

    .notification-card.read {
        background: #e0e0e0;
        /* Light gray background for read messages */
        opacity: 0.7;
    }

    .notification-icon {
        font-size: 20px;
        color: #ff9800;
        margin-right: 12px;
    }

    .notification-content {
        display: flex;
        flex-direction: column;
        gap: 3px;
    }

    .notification-message {
        font-weight: 600;
        color: #333;
    }

    .notification-time {
        font-size: 12px;
        color: #777;
    }

    .brand-name {
        
        font-size: 1.7rem;
    
    }

    @media screen and (max-width:768px) {
        .brand-name{
            font-size:1.2rem
        }
        
    }
</style>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">


<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm p-4">
    <div class="container-fluid">
        <!-- Centered Brand -->
        <a class="navbar-brand mx-auto fw-bold text-center brand-name"
            href="<?php echo base_url() . 'dashboard' ?>"
            style="
             color: #ff7315;
        font-family: 'Montserrat', serif;
        /* text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.2);  */
        letter-spacing: 1px;" >
            Hari Om Dhaba
        </a>



        <!-- Right Section: Icons -->
        <ul class="navbar-nav d-flex align-items-center justify-content-end flex-row gap-2 profileNav" style="margin-right: 2rem;">
            <!-- Notification Icon with Badge -->
            <li class="nav-item">
                <div class="position-relative" id="notificationIcon">
                    <i class="bi bi-bell-fill text-dark" style="font-size: 1.2rem;"></i>
                    <span id="notificationBadge"
                        class="badge bg-danger text-white position-absolute top-0 start-100 translate-middle p-1 rounded-circle">0</span>
                </div>
            </li>
        </ul>
    </div>
</nav>


<!-- Notification Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetchNotifications(); // Fetch notifications when the page loads (but don't show modal)

        document.getElementById('notificationIcon').addEventListener('click', function() {
            fetchNotifications(true); // Fetch and show modal on click
        });
    });

    function fetchNotifications(showModal = false) {
        fetch("<?php echo base_url('notification/fetch'); ?>")
            .then(response => response.json())
            .then(notifications => {
                var notificationBadge = document.getElementById('notificationBadge');
                var notificationList = document.getElementById('notificationList');
                notificationList.innerHTML = '';

                if (notifications.length > 0) {
                    notificationBadge.textContent = notifications.length;

                    notifications.forEach(notification => {
                        var notificationCard = document.createElement('div');
                        notificationCard.classList.add('notification-card');

                        // If the notification is read, add a "read" class
                        if (notification.status === 'read') {
                            notificationCard.classList.add('read');
                        }

                        // Icon
                        var icon = document.createElement('i');
                        icon.classList.add('fas', 'fa-bell', 'notification-icon', 'default-icon');

                        var content = document.createElement('div');
                        content.classList.add('notification-content');

                        var message = document.createElement('div');
                        message.classList.add('notification-message');
                        message.textContent = notification.message;

                        var time = document.createElement('div');
                        time.classList.add('notification-time');
                        time.textContent = formatTimestamp(notification.created_at);

                        content.appendChild(message);
                        content.appendChild(time);

                        notificationCard.appendChild(icon);
                        notificationCard.appendChild(content);
                        notificationList.appendChild(notificationCard);

                        // Mark notification as read when clicked
                        notificationCard.addEventListener('click', function() {
                            markNotificationAsRead(notification.id, notificationCard);
                        });
                    });

                } else {
                    notificationBadge.textContent = "0";
                    notificationList.innerHTML = '<div class="no-notifications">No new notifications</div>';
                }

                // Show modal only when clicking the bell icon
                if (showModal) {
                    var modal = new bootstrap.Modal(document.getElementById('notificationModal'));
                    modal.show();
                }
            })
            .catch(error => console.error("Error fetching notifications:", error));
    }

    // Function to mark a notification as read
    function markNotificationAsRead(notificationId, notificationCard) {
        fetch("<?php echo base_url('notification/mark_read/'); ?>" + notificationId, {
                method: 'POST'
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    notificationCard.classList.add('read'); // Visually mark as read
                }
            })
            .catch(error => console.error("Error marking notification as read:", error));
    }

    // Helper function to format timestamp
    function formatTimestamp(timestamp) {
        let date = new Date(timestamp);
        return date.toLocaleString(); // Includes both date and time
    }
</script>

<!-- Notification Modal -->
<div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notificationModalLabel">Notifications</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="notificationContent">
                <div id="notificationList"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Notification Model Ends -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var modal = document.getElementById('notificationModal'); // Replace 'yourModalID' with your actual modal ID
        modal.addEventListener('hidden.bs.modal', function () {
            location.reload();
        });
    });
</script>
