<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/style.css' ?>">
    <link rel="icon" type="image/png" href="<?php echo base_url() . 'assets/images/hariom_dhabalogo.png' ?>">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Include Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Admin-Menus</title>
    <style>
        .btn-orange {
            background-color: orange;
            color: white;

        }

        .btn-orange:hover {
            background-color: darkorange;
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
        <div class="container mt-5">
            <h2 class="text-center">Change Password</h2>

            <div class="card p-4 shadow text-center"> <!-- Center align content -->
                <form id="passwordChangeForm" novalidate>
                    <!-- Current Password -->
                    <div class="mb-3 position-relative text-start">
                        <label for="currentPassword" class="form-label">Current Password</label>
                        <div class="input-group">
                            <input type="password" id="currentPassword" class="form-control" required minlength="6" placeholder="Enter current password">
                            <span class="input-group-text toggle-password" data-target="currentPassword">
                                <i class="fa fa-eye" style="cursor:pointer"></i>
                            </span>
                        </div>
                        <small id="currentPasswordFeedback" class="text-danger"></small>
                    </div>

                    <!-- New Password -->
                    <div class="mb-3 position-relative text-start">
                        <label for="newPassword" class="form-label">New Password</label>
                        <div class="input-group">
                            <input type="password" id="newPassword" class="form-control" required pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$" placeholder="Enter new password">
                            <span class="input-group-text toggle-password" data-target="newPassword">
                                <i class="fa fa-eye" style="cursor:pointer"></i>
                            </span>
                        </div>
                        <small id="newPasswordFeedback" class="text-danger"></small>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3 position-relative text-start">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <div class="input-group">
                            <input type="password" id="confirmPassword" class="form-control" required placeholder="Confirm new password">
                            <span class="input-group-text toggle-password" data-target="confirmPassword">
                                <i class="fa fa-eye" style="cursor:pointer"></i>
                            </span>
                        </div>
                        <small id="confirmPasswordFeedback" class="text-danger"></small>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-orange btn-lg text-white border  mt-3" disabled>Save Changes</button>
                </form>
            </div>


        </div>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            // Function to toggle password visibility
            document.querySelectorAll('.toggle-password').forEach(toggle => {
                toggle.addEventListener('click', function() {
                    const fieldId = this.getAttribute('data-target');
                    const passwordField = document.getElementById(fieldId);
                    const icon = this.querySelector('i');

                    if (passwordField.type === "password") {
                        passwordField.type = "text";
                        icon.classList.remove("fa-eye");
                        icon.classList.add("fa-eye-slash");
                    } else {
                        passwordField.type = "password";
                        icon.classList.remove("fa-eye-slash");
                        icon.classList.add("fa-eye");
                    }
                });
            });


            // Function to validate passwords on the fly
            function validatePasswordFields() {
                const currentPassword = document.getElementById("currentPassword");
                const newPassword = document.getElementById("newPassword");
                const confirmPassword = document.getElementById("confirmPassword");
                const submitButton = document.querySelector("button[type='submit']");

                // Validate Current Password
                const currentPasswordFeedback = document.getElementById("currentPasswordFeedback");
                if (currentPassword.value.length < 6) {
                    currentPasswordFeedback.textContent = "Current password must be at least 6 characters.";
                    currentPassword.setCustomValidity("Invalid");
                } else {
                    currentPasswordFeedback.textContent = "";
                    currentPassword.setCustomValidity("");
                }

                // Validate New Password with additional criteria
                const newPasswordFeedback = document.getElementById("newPasswordFeedback");
                const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
                if (!passwordRegex.test(newPassword.value)) {
                    newPasswordFeedback.textContent = "New password must be at least 8 characters, include 1 letter, 1 number, and 1 special character.";
                    newPassword.setCustomValidity("Invalid");
                } else {
                    newPasswordFeedback.textContent = "";
                    newPassword.setCustomValidity("");
                }

                // Validate Confirm Password
                const confirmPasswordFeedback = document.getElementById("confirmPasswordFeedback");
                if (confirmPassword.value !== newPassword.value) {
                    confirmPasswordFeedback.textContent = "Passwords do not match.";
                    confirmPassword.setCustomValidity("Invalid");
                } else {
                    confirmPasswordFeedback.textContent = "";
                    confirmPassword.setCustomValidity("");
                }

                // Enable Submit Button if all fields are valid
                if (currentPassword.checkValidity() && newPassword.checkValidity() && confirmPassword.checkValidity()) {
                    submitButton.disabled = false;
                } else {
                    submitButton.disabled = true;
                }
            }

            // Function to handle form submission via JavaScript
            document.getElementById('passwordChangeForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent default form submission

                // Collecting form data
                const currentPassword = document.getElementById("currentPassword").value;
                const newPassword = document.getElementById("newPassword").value;
                const confirmPassword = document.getElementById("confirmPassword").value;

                // Prepare the payload for submission
                const formData = {
                    currentPassword: currentPassword,
                    newPassword: newPassword,
                    confirmPassword: confirmPassword
                };
                console.log(formData);
                // Send the form data to the server via fetch
                fetch('<?php echo base_url() . "admin/changePasswordAdmin"; ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(formData)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            // Success - show success message and hide modal
                            Swal.fire({
                                icon: 'success',
                                title: 'Password updated successfully!',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                window.location.href = '<?php echo base_url() . 'admin/dashboard/' ?>'; // Replace with your desired URL
                            });



                        } else {
                            // Error - show error message
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: data.message
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Something went wrong. Please try again later.'
                        });
                    });
            });

            // Call validatePasswordFields() when user types in any of the fields
            document.getElementById("currentPassword").addEventListener('input', validatePasswordFields);
            document.getElementById("newPassword").addEventListener('input', validatePasswordFields);
            document.getElementById("confirmPassword").addEventListener('input', validatePasswordFields);
        </script>
        <!-- Password Change Form Ends Here -->
        </div>
        </div>
        </div>
        </div>
        </div>
    </main>

    <!-- Bootstrap JS (including jQuery and Popper.js for dropdown functionality) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Sidebar Toggler Script -->
    <script src="<?php echo base_url() . 'assets/js/main.js' ?>"></script>
</body>

</html>