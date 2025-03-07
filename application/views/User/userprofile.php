<!doctype html>
<html lang="en">

<head>
    <link rel="icon" type="image/png" href="<?php echo base_url() . 'assets/images/hariom_dhabalogo.png' ?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hari-Om-DHaba UserProfile </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        .edit-btn:hover {
            background-color: #F68822 !important;
        }

        .profile-container {
            position: relative;
            display: inline-block;
        }

        .profile-dropdown {
            display: none;
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            background: white;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            z-index: 10;
            width: 150px;
        }

        .profile-container:hover .profile-dropdown {
            display: block;
            margin-left: 90px;
        }

        .profile-dropdown a {
            display: block;
            padding: 8px 12px;
            text-decoration: none;
            color: black;
            cursor: pointer;
        }

        .profile-dropdown a:hover {
            background: #f8f9fa;
        }

        .edit-field {
            border: none;
            background: transparent;
            width: 100%;
            outline: none;
        }

        .profile-container {
            position: relative;
            display: inline-block;
        }

        .edit-icon {
            position: absolute;
            bottom: 5px;
            right: 5px;
            background: #fff;
            border-radius: 50%;
            padding: 6px;
            font-size: 14px;
            color: #333;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            cursor: pointer;
        }

        .edit-icon:hover {
            background: #f0f0f0;
        }


        .input-groupp input {
            border: none;
            flex: 1;
            padding: 8px;
            outline: none;
        }

        .input-groupp-text {
            background: #fff;
            border: none;
            padding: 8px;
        }

        .input-groupp {
            display: flex;
            align-items: center;
            border: 1px solid #ced4da;
            max-width: 100%;
            border-radius: 5px !important;
            overflow: hidden;

        }

        @media(max-width:445px) {
            .input-groupp {
                width: 350px;
            }
        }
    </style>
</head>

<body>
    <?php $this->load->view('IncludeUser/CommonNavbar'); ?>

    <div class="container mt-4 py-5 px-0">
        <?php $this->load->view('IncludeUser/ProfileSidebar'); ?>
        <!-- Profile Details -->
        <div class="container py-4">
    <!-- Profile Header Section -->
    <div class="text-center mb-4">
        <h2 class="fw-bold text-warning">Keep Your Profile Fresh and Tasty!</h2>
        <p class="text-muted">Your profile is like a fine dish; it needs regular seasoning!</p>
    </div>
    
    <!-- Profile Info Card -->
    <div class="card p-4 shadow-sm bg-white border-0 rounded-4 mb-4">
        <!-- Profile Image Section -->
<div class="text-center position-relative" style="width:fit-content; margin:auto;">
    <img id="profileImage" src="assets/images/profile.jpg" 
         class="rounded-circle border border-4 border-warning shadow-lg"
         width="150" height="150">

    <!-- Edit Profile Image -->
    <label id="changeImage" class="edit-icon position-absolute"
           style="cursor:pointer; bottom: 0; right: 15px; background: #ff9500; padding: 6px; border-radius: 50%;">
        <i class="bi bi-pencil text-white"></i>
        <input type="file" id="uploadImage" class="d-none" accept="image/*">
    </label>
</div>

<script>
   document.getElementById('uploadImage').addEventListener('change', function(event) {
    let file = event.target.files[0]; // Get selected file

    if (file) {
        // Allowed file types (JPG, JPEG, PNG) & Disallow JFIF
        const allowedTypes = ['image/jpeg', 'image/png'];
        const maxSize = 4 * 1024 * 1024; // 4MB

        if (!allowedTypes.includes(file.type)) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid File Type',
                text: 'Only JPG, JPEG, and PNG formats are allowed.',
            });
            event.target.value = ''; // Clear file input
            return;
        }

        if (file.size > maxSize) {
            Swal.fire({
                icon: 'error',
                title: 'File Too Large',
                text: 'Please select an image smaller than 4MB.',
            });
            event.target.value = ''; // Clear file input
            return;
        }

        let formData = new FormData();
        formData.append('editImage', file); // The key must match the controller's `$_FILES['editImage']`

        fetch('<?php echo base_url() . 'user/updateProfileImage/' ?>', { 
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            console.log('Upload Response:', data); // Log response in console

            if (data.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Profile Updated!',
                    text: 'Your profile image has been updated successfully.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    location.reload(); // Reload the page after user clicks OK
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Upload Failed',
                    text: data.message
                });
            }
        })
        .catch(error => {
            console.error('Error uploading image:', error);
            Swal.fire({
                icon: 'error',
                title: 'Upload Error',
                text: 'Something went wrong. Please try again later.'
            });
        });
    }
});



</script>

        <h4 id="big_name" class="text-center fw-bold mt-3">Chetan Dhamgunde</h4>
        
        <!-- User Details Form -->
        <form class="mt-4">
            <div class="mb-3">
                <label class="fw-bold text-dark">Full Name</label>
                <input type="text" id="fullName" class="form-control edit-field" value="Chetan Dhamgunde" readonly required 
                        maxlength="50" 
                        oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '').replace(/\s{2,}/g, ' ')" 
                        pattern="^[A-Za-z]+( [A-Za-z]+)*$" 
                        title="Only alphabetic characters and a single space between words are allowed.">
            </div>
            <div class="mb-3">
                <label class="fw-bold text-dark">Mobile</label>
                <input type="text" id="mobile" class="form-control edit-field" value="8080762949" readonly required
                        oninput="(function(element) { 
                            // Remove any non-digit characters
                            element.value = element.value.replace(/[^\d]/g, '').substring(0, 10);

                            // Check if the value has exactly 10 digits
                            if (element.value.length !== 10) {
                                element.setCustomValidity('Please enter a 10-digit number.');
                            } else {
                                element.setCustomValidity('');
                            }
                        })(this)">
            </div>
            <div class="mb-3">
                <label class="fw-bold text-dark">Email</label>
                <input type="email" id="email" class="form-control edit-field" value="demo@gmail.com" readonly required 
                            oninput="validateEmail()"
                           pattern="^[a-zA-Z0-9._%+]+@gmail\.com$"
                            title="Please enter a valid Gmail address. Example: user@gmail.com">
            </div>
            <div class="mb-3">
                <label class="fw-bold text-dark">Location</label>
                <input type="text" id="location" class="form-control edit-field" value="Not Added" readonly>
            </div>
        </form>
    </div>
    
    <!-- Update & Password Section -->
    <div class="text-center">
        <button id="editProfile" class="btn btn-warning px-4 py-2 rounded-pill m-auto">Update Info</button>
        <button id="saveChanges" type="submit" class="btn btn-success px-4 py-2 rounded-pill m-auto" style="display: none;">Save Changes</button>
    </div>

    <!-- Change Password Section -->
    <div class="card p-4 shadow-sm bg-white border-0 rounded-4 mt-4">
        <h4 class="fw-bold text-center text-warning">Change Password</h4>
        <form class="mt-3">
            <div class="mb-3">
                <label class="fw-bold text-dark">Current Password</label>
                <div class="input-groupp p-0">
                    <input type="password" id="currentPassword" name="currentPassword" placeholder="Enter Your Password" required>
                    <span class="input-groupp-text" onclick="togglePasswordVisibility('currentPassword', 'eyeIconCurrent')" style="cursor: pointer;">
                        <i id="eyeIconCurrent" class="fa fa-eye"></i>
                    </span>
                </div>
            </div>
            <div class="mb-3">
                <label class="fw-bold text-dark">New Password</label>
                <div class="input-groupp p-0">
                    <input type="password" id="newpassword" name="newpassword" placeholder="Enter New Password" required oninput="validatePassword(this)" title="Password must be at least 8 characters long, and include one uppercase letter, one lowercase letter, one number, and one special character.">
                    <span class="input-groupp-text" onclick="togglePasswordVisibility('newpassword', 'eyeIconNew')" style="cursor: pointer;">
                        <i id="eyeIconNew" class="fa fa-eye"></i>
                    </span>
                </div>
            </div>
            <div class="mb-3">
                <label class="fw-bold text-dark">Confirm New Password</label>
                <div class="input-groupp p-0">
                    <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm New Password" required oninput="validateConfirmPassword()" title="Password must be at least 8 characters long, and include one uppercase letter, one lowercase letter, one number, and one special character.">
                    <span class="input-groupp-text" onclick="togglePasswordVisibility('confirmPassword', 'eyeIconConfirm')" style="cursor: pointer;">
                        <i id="eyeIconConfirm" class="fa fa-eye"></i>
                    </span>
                </div>
            </div>
            <div class="text-center">
                <button id="savePasswordBtn" type="submit" class="btn btn-warning px-4 py-2 rounded-pill">Update Password</button>
            </div>
        </form>
    </div>

<script>
   document.addEventListener("DOMContentLoaded", function () {
    let editMode = false;
    const inputs = document.querySelectorAll(".edit-field");

    const editProfileBtn = document.getElementById("editProfile");
    const saveChangesBtn = document.getElementById("saveChanges");

    if (editProfileBtn && saveChangesBtn) {
        editProfileBtn.addEventListener("click", toggleEditMode);
        saveChangesBtn.addEventListener("click", saveProfileChanges);
    }

    function toggleEditMode(event) {
        event.preventDefault();
        editMode = !editMode;

        inputs.forEach(input => {
            input.readOnly = !editMode;
            input.style.borderBottom = editMode ? "1px solid #000" : "none";
        });

        saveChangesBtn.style.display = editMode ? "block" : "none";
        editProfileBtn.style.display = editMode ? "none" : "block";
        }
         
        fetch('<?php echo base_url() . 'UserProfile/GetUserInfo'?>', { 
    method: 'GET', 
    headers: {
        'Content-Type': 'application/json'
    }
})
.then(response => response.json())
.then(data => {
    console.log(data);
    if (data.status === 'success') {
        document.getElementById('fullName').value = data.data.name;
        document.getElementById('big_name').innerHTML = data.data.name;
        document.getElementById('mobile').value = data.data.mobile;
        document.getElementById('email').value = data.data.email;
        document.getElementById('location').value = data.data.location;
        document.getElementById('profileImage').src = "<?php echo base_url(); ?>uploads/images/" + data.data.image;

    } else {
        Swal.fire({ icon: 'error', title: 'Oops...', text: data.message });
    }
})
.catch(error => {
    console.error('Error fetching user data:', error);
});


    // Store initial data when the page loads


function saveProfileChanges() {
    if (!validateForm()) return;

    let updatedData = {
        fullName: document.getElementById("fullName").value.trim(),
        mobile: document.getElementById("mobile").value.trim(),
        email: document.getElementById("email").value.trim(),
        location: document.getElementById("location").value.trim()
    };

    // Check if any data has changed
       // Disable save button
    saveChangesBtn.disabled = true;

    fetch("<?php echo base_url() . 'user/updateProfile/' ?>", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(updatedData)
    })
    .then(response => response.json())
    .then(data => {
        saveChangesBtn.disabled = false;
        if (data.status === "success") {
            Swal.fire({ icon: 'success', title: 'Profile updated successfully!', showConfirmButton: false, timer: 1500 });

            // Update initial data to new values after successful update
            initialProfileData = { ...updatedData };
        } else {
            Swal.fire({ icon: 'error', title: 'Oops...', text: data.message });
        }
    })
    .catch(error => {
        console.error("Error:", error);
        Swal.fire({ icon: 'error', title: 'Error', text: 'Something went wrong. Please try again later.' });
        saveChangesBtn.disabled = false;
    });

    // Reset input fields and buttons
    inputs.forEach(input => {
        input.readOnly = true;
        input.style.borderBottom = "none";
    });

    saveChangesBtn.style.display = "none";
    editProfileBtn.style.display = "block";
}

    function validateForm() {
        const fullName = document.getElementById("fullName");
        const mobile = document.getElementById("mobile");
        const email = document.getElementById("email");

        if (!/^[A-Za-z]+( [A-Za-z]+)*$/.test(fullName.value.trim())) {
            Swal.fire({ icon: 'error', title: 'Invalid Name', text: 'Full name should only contain alphabets and single spaces between words.' });
            fullName.focus();
            return false;
        }

        if (!/^\d{10}$/.test(mobile.value.trim())) {
            Swal.fire({ icon: 'error', title: 'Invalid Mobile', text: 'Please enter a valid 10-digit mobile number.' });
            mobile.focus();
            return false;
        }

        if (!/^[a-zA-Z0-9._%+-]+@gmail\.com$/.test(email.value.trim())) {
            Swal.fire({ icon: 'error', title: 'Invalid Email', text: 'Please enter a valid Gmail address (example: user@gmail.com).' });
            email.focus();
            return false;
        }

        return true;
    }
});
</script>

<script>
    
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    </div>
                </div>
                </div>
    <?php $this->load->view('IncludeUser/CommonFooter'); ?>

   
      <!-- below is script for change password -->
      <script>
                    document.getElementById('savePasswordBtn').addEventListener('click', function() {
                        event.preventDefault(); // Prevent form submission

let currentPassword = document.getElementById('currentPassword').value.trim();
let newPassword = document.getElementById('newpassword').value.trim();
let confirmPassword = document.getElementById('confirmPassword').value.trim();

if (!currentPassword || !newPassword || !confirmPassword) {
    Swal.fire({
        icon: 'warning',
        title: 'Warning',
        text: 'All fields are required!'
    });
    return;
}

if (newPassword.length < 8 || !/[A-Z]/.test(newPassword) || !/[a-z]/.test(newPassword) || 
    !/[0-9]/.test(newPassword) || !/[!@#$%^&*]/.test(newPassword)) {
    Swal.fire({
        icon: 'error',
        title: 'Invalid Password',
        text: 'Password must be at least 8 characters long and include an uppercase letter, a lowercase letter, a number, and a special character.'
    });
    return;
}

if (newPassword !== confirmPassword) {
    Swal.fire({
        icon: 'error',
        title: 'Password Mismatch',
        text: 'New password and confirm password do not match.'
    });
    return;
}
                        // Send data to the server via fetch
                        fetch('<?php echo base_url() . 'user/changePassword/' ?>', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    currentPassword: document.getElementById('currentPassword').value,
                                    newPassword: document.getElementById('newpassword').value,
                                    confirmPassword: document.getElementById('confirmPassword').value
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.status === 'success') {
                                    // Handle success (e.g., show a success message)
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Password updated successfully!',
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then(() => {
                                        location.reload();
                                    })
                                } else {
                                    // Handle error (e.g., show an error message)
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


                    // Password visibility toggle function
                    function togglePasswordVisibility(inputId, iconId) {
                        const passwordField = document.getElementById(inputId);
                        const eyeIcon = document.getElementById(iconId);

                        if (passwordField.type === 'password') {
                            passwordField.type = 'text';
                            eyeIcon.classList.remove('fa-eye');
                            eyeIcon.classList.add('fa-eye-slash');
                        } else {
                            passwordField.type = 'password';
                            eyeIcon.classList.remove('fa-eye-slash');
                            eyeIcon.classList.add('fa-eye');
                        }
                    }

                    // Real-time password validation for password strength
                    function validatePassword(input) {
                        const password = input.value;
                        const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

                        if (!regex.test(password)) {
                            input.setCustomValidity(
                                "Password must be at least 8 characters long, and include one uppercase letter, one lowercase letter, one number, and one special character."
                            );
                        } else {
                            input.setCustomValidity(""); // Clear the error
                        }

                        input.reportValidity(); // Actively display the validation message
                    }

                    // Real-time validation to check if passwords match
                    function validateConfirmPassword() {
                        const newPassword = document.getElementById("newpassword").value;
                        const confirmPassword = document.getElementById("confirmPassword").value;

                        if (newPassword !== confirmPassword) {
                            document.getElementById("confirmPassword").setCustomValidity("Passwords do not match.");
                        } else {
                            document.getElementById("confirmPassword").setCustomValidity(""); // Clear the error
                        }

                        document.getElementById("confirmPassword").reportValidity();
                    }
                </script>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

   
    <!-- this is script for validate email -->
    <script>
    function validateEmail() {
        let emailInput = document.getElementById('email');
        let emailError = document.getElementById('emailError');
        let gmailPattern = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;

        if (!gmailPattern.test(emailInput.value)) {
            emailInput.setCustomValidity("Invalid Gmail Address");
        } else {
            emailError.style.display = "none"; // Hide error message
            emailInput.setCustomValidity(""); // Clear error
        }
    }
</script>
</body>
</html>
