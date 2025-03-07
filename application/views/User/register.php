<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hari-Om-Dhaba Register</title>
    <link rel="icon" type="image/png" href="<?php echo base_url() . 'assets/images/hariom_dhabalogo.png' ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

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

        .login-form,
        .otp-form {
            top: -10px;
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

        .login-form,
        .otp-form {
            display: block;
            width: 430px;
            padding: 10px 10px 50px 10px;
            position: relative;
            left: 100px;
            top: -50px;
        }

        @media(max-width:734px) {
            .login-form,
            .otp-form {
                position: static;
            }
        }

        .login-form h2,
        .otp-form h2 {
            font-size: 30px;
            font-weight: 600;
            text-align: left;
        }

        .login-form .btn,
        .otp-form .btn {
            background-color: #FF9312;
            display: block;
            margin: auto;
            padding: 0px 40px;
            color: #fff;
            font-size: 20px;
            font-weight: 600;
            text-align: left;
        }

        .login-form .btn:hover,
        .otp-form .btn:hover {
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
            text-align: left;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .back-img {
            background-image: url('<?php echo base_url() . 'assets/images/cuttlery.jpg' ?>');
        }

        .section2 {
            display: none;
            position: relative;
            width: 100%;
        }
    </style>
</head>

<body>
    <section class="back-img register section1">
        <div></div>
        <div class="login-form mt-5">
            <h2 class="text-center text-light mb-4 mt-5" style="color:#FF9312 !important">Register Here!!</h2>
            <form id="registerForm">
                <div class="input-with-icon">
                    <img src="<?php echo base_url() . 'assets/images/email.png'?>" alt="">
                    <input type="email" placeholder="Email" class="form-control" id="email" required>
                </div>
                <br>
                <div class="input-with-icon">
                    <img src="<?php echo base_url() . 'assets/images/phone.png'?>" alt="Phone Icon"> <!-- Mobile icon -->
                    <input type="text" placeholder="Mobile Number" class="form-control" id="mobile" required 
                        maxlength="10" pattern="[0-9]{10}" title="Enter a valid 10-digit mobile number"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);">
                </div>
                <br>
                <div class="input-with-icon">
                    <img src="<?php echo base_url() . 'assets/images/Mask group.png'?>" alt="">
                    <input type="text" placeholder="Name" class="form-control" oninput="restrictInput(this)" id="name" required>
                </div>
                <br>
                <div class="input-with-icon">
                    <img src="<?php echo base_url() . 'assets/images/Mask group (1).png'?>" alt="">
                    <input type="password" placeholder="Password" class="form-control" id="password" required oninput="validatePassword(this)" title="Password must be at least 8 characters long, and include one uppercase letter, one lowercase letter, one number, and one special character.">
                    <span class="toggle-password" onclick="togglePassword('password')">👁</span>
                </div>
                <br>
                <div class="input-with-icon">
                    <img src="<?php echo base_url() . 'assets/images/Mask group (1).png'?>" alt="">
                    <input type="password" placeholder="Confirm Password" class="form-control" id="confirmPassword" required>
                    <span class="toggle-password" onclick="togglePassword('confirmPassword')">👁</span>
                </div>
                <br><br>
                <input type="submit" value="Sign Up" class="btn btn-lg">
                <p class="text-center text-light"> Have an account? <a href="<?php echo base_url() . 'login' ?>" class="text-light fw-bold text-decoration-underline" style="color:#FF9312 !important">Login</a></p>
            </form>
        </div>
    </section>

    <section class="back-img section2" style="background-image: url('<?php echo base_url(); ?>assets/images/cuttlery.jpg');" id="section2">
        <div></div>
        <div class="otp-form">
            <h2 class="text-center mb-4" style="color:#FF9312;">Validate OTP</h2>
            <form id="form2" onsubmit="return verifyOTP(event)">
                <div class="input-with-icon">
                    <img src="<?php echo base_url(); ?>assets/images/Mask group.png" alt="">
                    <input type="number" placeholder="Enter OTP" class="form-control" name="otp" id="otp" maxlength="6" required>
                </div>
                <br>
                <p id="otpTimer" style="color: red; font-weight: bold;">Time remaining: 60s</p>
                <input type="submit" value="Submit OTP" class="btn btn-lg">
            </form>
            <button id="resendOtpBtn" onclick="resendOtp()" class="btn btn-secondary mt-3" style="padding: 6px 40px;" disabled>Resend OTP</button>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function validatePassword(input) {
            const password = input.value;
            const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%?&])[A-Za-z\d@$!%?&]{8,}$/;

            if (!regex.test(password)) {
                input.setCustomValidity(
                    "Password must be at least 8 characters long, and include one uppercase letter, one lowercase letter, one number, and one special character."
                );
            } else {
                input.setCustomValidity(""); // Clear the error
            }

            input.reportValidity(); // Actively display the validation message
        }

        function restrictInput(input) {
            // If the first character is a space, remove it
            if (input.value.charAt(0) === ' ') {
                input.value = input.value.trimStart();
            }

            // Remove numbers and special characters (except spaces)
            input.value = input.value.replace(/[^a-zA-Z\s]/g, '');
        }

        function togglePassword(id) {
            const input = document.getElementById(id);
            if (input.type === 'password') {
                input.type = 'text'; // Change type to 'text' to show the password
            } else {
                input.type = 'password'; // Change type back to 'password' to hide it
            }
        }

        let countdownInterval;
        let timeLeft = 120; // 1-minute countdown

        function startCountdown() {
            timeLeft = 120; // Reset timer
            document.getElementById('otpTimer').innerText = `Time remaining: ${timeLeft}s`;
            document.getElementById('resendOtpBtn').disabled = true; // Disable resend button

            countdownInterval = setInterval(() => {
                timeLeft--;
                document.getElementById('otpTimer').innerText = `Time remaining: ${timeLeft}s`;

                if (timeLeft <= 0) {
                    clearInterval(countdownInterval);
                    document.getElementById('otpTimer').innerText = "OTP expired! Resend OTP?";
                    document.getElementById('resendOtpBtn').disabled = false; // Enable resend button
                }
            }, 1000);
        }

        document.getElementById('registerForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Stop form submission

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            const name = document.getElementById('name').value;
            const mobile = document.getElementById('mobile').value;

            if (!email.includes('@') || !email.includes('.')) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Please enter a valid email address!"
                });
                return;
            }

            if (password !== confirmPassword) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Passwords do not match!"
                });
                return;
            }

            const formData = new FormData();
            formData.append('email', email);
            formData.append('password', password);
            formData.append('confirmPassword', confirmPassword);
            formData.append('name', name);
            formData.append('mobile', mobile);

            fetch("<?php echo base_url('auth/register_user'); ?>", {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                                icon: "success",
                                title: "Registration Successful!",
                                text: "OTP sent to your email."
                            })
                            .then(() => {
                                document.getElementsByClassName('section1')[0].style.display = "none";
                                document.getElementsByClassName('section2')[0].style.display = "flex";
                                startCountdown(); // Start countdown timer after sending OTP
                            });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: data.message
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "There was an error with the request. Please try again later."
                    });
                });
        });

        function verifyOTP(event) {
            event.preventDefault();

            const otp = document.getElementById('otp').value;
            const otpRegex = /^\d{6}$/;

            if (!otpRegex.test(otp)) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Please enter a valid 6-digit OTP!"
                });
                return false;
            }

            const otpData = new FormData();
            otpData.append('email', document.getElementById('email').value);
            otpData.append('otp', otp);

            fetch("<?php echo base_url('auth/verify_otp'); ?>", {
                    method: 'POST',
                    body: otpData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                                icon: "success",
                                title: "OTP Verified!",
                                text: "Your OTP has been successfully verified."
                            })
                            .then(() => {
                                window.location.href = "<?php echo base_url('login'); ?>";
                            });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: data.message
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "There was an error with the request. Please try again later."
                    });
                });

            return false;
        }

        function resendOtp() {
            const email = document.getElementById('email').value.trim();

            if (!email) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Please enter your email to resend OTP!"
                });
                return;
            }

            const newOtp = new FormData();
            newOtp.append('email', email);

            fetch("<?php echo base_url('auth/resend_otp'); ?>", {
                    method: 'POST',
                    body: newOtp // ✅ Do NOT set 'Content-Type' for FormData
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data); // Debugging
                    if (data.success) {
                        Swal.fire({
                            icon: "success",
                            title: "OTP Resent!",
                            text: "A new OTP has been sent to your email."
                        }) .then(() => {
                            
                                startCountdown(); // Start countdown timer after sending OTP
                                document.getElementById('resendOtpBtn').disabled = true;

                            });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: data.message
                        });
                    }
                })
                .catch(error => {
                    console.error("Fetch error:", error);
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "There was an error resending OTP. Please try again later."
                    });
                });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>