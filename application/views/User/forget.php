<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hari-Om-Dhaba Forget</title>
    <link rel="icon" type="image/png" href="<?php echo base_url() . 'assets/images/hariom_dhabalogo.png' ?>">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
       
    <style>
         .btn:disabled{
            border: none !important;
        }
        .text-center {
            max-width: 100%;
        }

        .form-control {
            background-color: #FFEFDC;
        }

        .back-img {
            display: none;
        }

        .back-img.active {
            display: flex;
        }

        input[type=email]::placeholder {
         color: #A25800;
         font-family: Inter;
         font-size: 20px;
         font-weight: 400;
         line-height: 36.31px;
         text-align: left;
        }

        .back-img {
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    height: 100vh;
    display: flex;
    justify-content: space-evenly;
    align-items: center;
}

.login-form {
    display: block;
    width: 430px;
    padding: 10px 10px 50px 10px;
    position: relative;
    left: 100px;
    top: -50px;
}

@media(max-width:734px) {
    .login-form {
        position: static;
    }
}

.login-form h2 {
    font-size: 30px;
    font-weight: 600;
    line-height: 48.76px;
    text-align: left;
}

.login-form a {
    /* font-size: 20px; */
    font-weight: 600;
    line-height: 30.48px;
    text-align: left;
    text-decoration: none;
}

.login-form .btn {
    background-color: #FF9312;
    display: block;
    margin: auto;
    padding: 0px 40px;
    color: #fff;
    font-size: 20px;
    font-weight: 600;
    line-height: 36.57px;
    text-align: left;
}

.login-form .btn:hover {
    background-color: #FFF;
    color: #FF9312;
}

input {
    height: 45px;
    border-radius: 16px;
}

.input-with-icon {
    position: relative;
}

.input-with-icon i {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    color: #000;
    cursor:pointer;
}

.input-with-icon img {
    position: absolute;
    left: 10px;
    top: 50%;
    transform: translateY(-50%);
    max-width: 6%;
}

.input-with-icon input {
    padding-left: 55px;
    font-weight: 600;
    background-color: #FFEFDC;
    font-size: 20px;
    font-weight: 600;
    line-height: 36.57px;
    text-align: left;
}

.back-img {
    display: none; /* Hide all sections initially */
}

.back-img.active {
    display: flex; /* Only show the active section */
}

.password-container input {
            width: 100%;
            padding-right: 40px;
        }
        .password-container .toggle-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>

<script>
        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const eyeIcon = document.getElementById(iconId);

            if (!passwordInput || !eyeIcon) return;

            const isPasswordVisible = passwordInput.type === "text";
            passwordInput.type = isPasswordVisible ? "password" : "text";
            eyeIcon.classList.toggle("fa-eye-slash", !isPasswordVisible);
            eyeIcon.classList.toggle("fa-eye", isPasswordVisible);
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <!-- Section 1: Validate Email -->
    <section class="active back-img" id="section1" style="background-image: url('<?php echo base_url(); ?>assets/images/cuttlery.jpg');">
        <div>
        </div>
        <div class="login-form">
            <h2 class="text-center mb-4" style="color:#FF9312;">Validate Email</h2>
            <form id="form1">
                <!-- <div class="mb-3">
                    <input type="email" placeholder="Email Address" class="form-control" required>
                </div> -->
                <div class="input-with-icon">
                    <img src="<?php echo base_url(); ?>assets/images/Mask group.png" alt="">
                    <input type="email" placeholder="Email Address" class="form-control" name="email" id="email" required>
                </div>
                <!-- <button type="submit" class="btn btn-lg w-100">Send OTP</button> -->
                <br>
                <input type="submit" value="Send OTP" class="btn btn-lg">
            </form>
        </div>
    </section>

<!-- Section 2: Validate OTP -->
<section class="back-img" style="background-image: url('<?php echo base_url(); ?>assets/images/cuttlery.jpg');" id="section2">
    <div></div>
    <div class="login-form">
        <h2 class="text-center mb-4" style="color:#FF9312;">Validate OTP</h2>
        <form id="form2">
            <div class="input-with-icon">
                <img src="<?php echo base_url(); ?>assets/images/Mask group.png" alt="">
                <input type="text" placeholder="Enter OTP" class="form-control" name="otp" id="otp" maxlength="6"
                       oninput="this.value=this.value.replace(/[^0-9]/g,'');" required>
            </div>
            <br>
            <input type="submit" value="Submit OTP" class="btn btn-lg">
        </form>
        <p id="countdown-timer" style="text-align:center; color:red; font-size:16px;"></p>
        <button id="resend-otp" class="btn " style="padding: 4px 40px;" disabled>Resend OTP</button>
    </div>
</section>




    <!-- Section 3: Change Password -->
    <section class="back-img" style="background-image: url('<?php echo base_url(); ?>assets/images/cuttlery.jpg');" id="section3">
        <div>
        </div>
        <div class="login-form">
            <h2 class="text-center mb-4" style="color:#FF9312;">Change Password</h2>
            <form id="form3" action="">

              
                <br>
                <div class="input-with-icon">
                    <img src="<?php echo base_url(); ?>assets/images/Mask group (1).png" alt="">
                    <input type="password" placeholder="New Password" class="form-control" name="" id="newPassword" required
                            oninput="validatePassword(this)"
                            title="Password must be at least 8 characters long, and include one uppercase letter, one lowercase letter, one number, and one special character.">
                            <i class="fa fa-eye toggle-icon" id="eye-icon-new" onclick="togglePassword('newPassword', 'eye-icon-new')"></i>
                </div>
                <br>
                <div class="input-with-icon">
                    <img src="<?php echo base_url(); ?>assets/images/Mask group (1).png" alt="">
                    <input type="password" placeholder="Re-Enter Password" class="form-control" name="" id="confirmPassword" required oninput="validateConfirmPassword()" title="Passwords must match.">
                    <i class="fa fa-eye toggle-icon" id="eye-icon-confirm" onclick="togglePassword('confirmPassword', 'eye-icon-confirm')"></i>
                </div>
                <br>
                <input type="submit" value="Save" class="btn btn-lg">
            </form>
        </div>
    </section>
<!-- SweetAlert CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const sections = document.querySelectorAll(".back-img");

    // Initial setup: Show only section 1
    showSection(0);
});

// Move this function outside so it's globally accessible
function showSection(index) {
    const sections = document.querySelectorAll(".back-img");
    sections.forEach((section, i) => {
        if (i === index) {
            section.style.display = "flex";  // Show the section
        } else {
            section.style.display = "none";  // Hide other sections
        }
    });
}

// Validate Password
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

// Validate Confirm Password
function validateConfirmPassword() {
    const password = document.getElementById("newPassword").value;
    const confirmPassword = document.getElementById("confirmPassword").value;

    if (password !== confirmPassword) {
        document.getElementById("confirmPassword").setCustomValidity("Passwords do not match.");
    } else {
        document.getElementById("confirmPassword").setCustomValidity(""); // Clear the error
    }

    document.getElementById("confirmPassword").reportValidity();
}

// jQuery AJAX for Request OTP
$(document).ready(function() {
    let timer;
    
    function startTimer(duration) {
        let timeLeft = duration;
        $("#resend-otp").prop("disabled", true); // Disable Resend OTP button
        
        timer = setInterval(function() {
            let minutes = Math.floor(timeLeft / 60);
            let seconds = timeLeft % 60;
            seconds = seconds < 10 ? "0" + seconds : seconds; // Format seconds
            
            $("#countdown-timer").text("Resend OTP in " + minutes + ":" + seconds);
            
            if (timeLeft <= 0) {
                clearInterval(timer);
                $("#countdown-timer").text(""); // Clear timer text
                $("#resend-otp").prop("disabled", false); // Enable Resend OTP button
            }
            
            timeLeft--;
        }, 1000);
    }

    // Trigger OTP request on form submission
    $("#form1").submit(function(e) {
        e.preventDefault();
        let email = $("#email").val();

        $.ajax({
            url: "<?php echo base_url() . 'auth/request_otp'?>",
            type: "POST",
            data: { email: email },
            dataType: "json",
            success: function(response) {
                if (response.status) {
                    Swal.fire({
                        icon: "success",
                        title: "OTP Sent!",
                        text: response.message
                    }).then(() => {
                        showSection(1);
                        startTimer(120); // Start 2-minute countdown
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: response.message
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Something went wrong. Please try again later."
                });
            }
        });
    });

    // Handle Resend OTP button click
    $("#resend-otp").click(function() {
        let email = $("#email").val();

        $.ajax({
            url: "<?php echo base_url() . 'auth/request_otp'?>",
            type: "POST",
            data: { email: email },
            dataType: "json",
            success: function(response) {
                if (response.status) {
                    Swal.fire({
                        icon: "success",
                        title: "OTP Resent!",
                        text: response.message
                    });
                    startTimer(120); // Restart countdown
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: response.message
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Something went wrong. Please try again later."
                });
            }
        });
    });
});


// Verify OTP
$("#form2").submit(function(e) {
    event.preventDefault(); // Prevent default form submission

    let otp = $("#otp").val(); // Get OTP input

    $.ajax({
        url: "<?php echo base_url() . 'auth/verify_otp_forget'?>",
        type: "POST",
        data: { otp: otp },
        dataType: "json",
        success: function(response) {
            if (response.status) {
                Swal.fire({
                    icon: "success",
                    title: "OTP Verified!",
                    text: response.message
                }).then(() => {
                    showSection(2); // Show password reset section
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Invalid OTP",
                    text: response.message
                });
            }
        },
        error: function() {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong. Please try again later."
            });
        }
    });

    return false; // Prevent form from reloading the page
})


$("#form3").submit(function(e) {
    event.preventDefault(); // Prevent default form submission

    let newPassword = $("#newPassword").val();
    let confirmPassword = $("#confirmPassword").val();
    console.log(newPassword,confirmPassword) 

    if (newPassword !== confirmPassword) {
        Swal.fire({
            icon: "error",
            title: "Passwords Do Not Match here ",
            text: "Please ensure both passwords are the same."
        });
        return false;
    }

    $.ajax({
        url: "<?php echo base_url() . 'auth/reset_password' ?>", // Change to your actual endpoint
        type: "POST",
        data: { new_password: newPassword, confirm_password: confirmPassword },
        dataType: "json",
        success: function(response) {
            if (response.status) {
                Swal.fire({
                    icon: "success",
                    title: "Password Reset Successful!",
                    text: response.message
                }).then(() => {
                   window.location.href="<?php echo base_url() . 'login' ?>"
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Reset Failed",
                    text: response.message
                });
            }
        },
        error: function() {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong. Please try again later."
            });
        }
    });

    return false; // Prevent form from reloading the page
})

</script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>