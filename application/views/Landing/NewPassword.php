<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>



    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href=" <?php echo base_url() . 'assets/css/login.css' ?>">


    <style>
        .input-group,
        .form-select {
            box-shadow: 0px 4px 4px 0px #00000040;

        }

        .input:focus-within .input-group {
            box-shadow: 5px 4px 4px 0px #1D446E !important;

        }

        .loginbtn:hover {
            background-color: #0e253e !important;
        }
        /* Disabled button styling */
        #otpBtn.disabled {
            background-color: #1D446E;
            /* Gray color to indicate disabled */
            cursor: not-allowed;
        }

        /* Active button styling when inputs are filled */
        #otpBtn.active {
            background-color: #0e253e;
            /* Original color */
            cursor: pointer;
        }
    </style>

</head>

<body style="background: linear-gradient(270deg, rgba(21, 61, 105, 0.5) 0%, #19416C 100%),
  url('<?php echo base_url('assets/images/image2.png'); ?>') no-repeat ; background-size: cover;">

    <div class="container" style="height: 100vh;">
        <div class="row align-items-center">
            <div class="col-md-8 mx-auto">
                <div class="form" id="EmailForm">
                    <h1 class="text-white text-center">Enter Email!</h1>
                    <form action="" method="post">

                        <div class="input-group mb-3 bg-white w-100 mx-auto mt-4 rounded-2 ">
                            <span class="input-group-text bg-white border-end-0 d-flex align-items-center">
                                <img src="<?php echo base_url() . 'assets/images/Login_user.png' ?>" alt="Icon" style="width: 30px; height: 30px;">
                            </span>
                            <div class="form-floating flex-grow-1">
                                <input type="email" class="form-control border-start-0 shadow-none" id="floatingInput" placeholder="Username">
                                <label for="floatingInput">Email</label>
                            </div>
                        </div>



                        <div class="text-center mt-4">
                            <button type="submit" style="background: #1D446E;" class="text-white p-2 rounded-2 w-25 fw-semibold loginbtn" onclick="showOtpForm(event)">Send Otp</button>
                        </div>

                    </form>
                </div>


                <div class="form" id="OtpForm" style="display: none;">
                    <h1 class="text-white text-center mb-3">Enter Otp!</h1>
                    <form action="" method="post">
                        <div class="otp-field mb-4">
                            <input type="number" />
                            <input type="number" disabled />
                            <input type="number" disabled />
                            <input type="number" disabled />
                            <input type="number" disabled />
                            <input type="number" disabled />
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" id="otpBtn" class="text-white p-2 rounded-2 w-25 fw-semibold loginbtn" onclick="showNewPasswordForm(event)">Verify</button>
                        </div>
                    </form>
                    <p class="  text-center mt-2 text-white">
                        Didn't receive code? <a onclick="backToEmail()" id="resendLink" class="fw-bold">Request again</a>
                        <span id="timer" class="fw-bold text-white text-center"></span>
                    </p>
                </div>

                <div class="form" id="newPasswordForm" style="display: none;">
                    <h1 class="text-white text-center mb-3">New Password!</h1>
                    <form action="" method="post">

                        <div class="input-group mb-3 bg-white w-100 mx-auto mt-4 rounded-2">
                            <div class="input-group-prepend border-right-0 d-flex align-items-center">
                                <span class="input-group-text bg-white border-right-0 ">
                                    <img src="<?php echo base_url() . 'assets/images/Login_pass.png' ?>" alt="Icon" style="width: 30px; height: 30px;">
                                </span>
                            </div>
                            <div class="form-floating flex-grow-1">
                                <input type="pass" class="form-control border-left-0 shadow-none" id="floatingPass" placeholder="Password">
                                <label for="floatingPass">New Password</label>
                            </div>

                        </div>

                        <div class="input-group mb-3 bg-white w-100 mx-auto mt-4 rounded-2">
                            <div class="input-group-prepend border-right-0 d-flex align-items-center">
                                <span class="input-group-text bg-white border-right-0 ">
                                    <img src="<?php echo base_url() . 'assets/images/Login_pass.png' ?>" alt="Icon" style="width: 30px; height: 30px;">
                                </span>
                            </div>
                            <div class="form-floating flex-grow-1">
                                <input type="pass" class="form-control border-left-0 shadow-none" id="floatingPass" placeholder="Password">
                                <label for="floatingPass">Confirm Password</label>
                            </div>

                        </div>



                        <div class="text-center mt-4">
                            <button type="submit" style="background: #1D446E;" class="text-white p-2 rounded-2 w-25 fw-semibold loginbtn">Confirm</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>

    <script>
        function showOtpForm(event) {
            event.preventDefault();
            document.getElementById("EmailForm").style.display = "none";
            document.getElementById("OtpForm").style.display = "block";
        }

        function showNewPasswordForm(event) {
            event.preventDefault();
            document.getElementById("EmailForm").style.display = "none";
            document.getElementById("OtpForm").style.display = "none";
            document.getElementById("newPasswordForm").style.display = "block";
        }
    </script>

    <script>
        // Timer for OTP Resend
        let countdown;

        function startTimer() {
            let timeLeft = 30; // 30 seconds countdown
            const timerDisplay = document.getElementById("timer");
            const resendLink = document.getElementById("resendLink");
            resendLink.style.pointerEvents = "none"; // Disable link initially
            resendLink.style.color = "gray"; // Grey out link initially

            countdown = setInterval(() => {
                if (timeLeft <= 0) {
                    clearInterval(countdown);
                    timerDisplay.innerHTML = "";
                    resendLink.style.pointerEvents = "auto"; // Enable link
                    resendLink.style.color = "white"; // Reset link color
                } else {
                    timerDisplay.innerHTML = ` (${timeLeft}s)`;
                    timeLeft -= 1;
                }
            }, 1000);
        }
        startTimer();
    </script>

    <script>
        const inputs = document.querySelectorAll(".otp-field > input");
        const button = document.getElementById('otpBtn');

        window.addEventListener("load", () => inputs[0].focus());
        button.setAttribute("disabled", "disabled");

        inputs[0].addEventListener("paste", function(event) {
            event.preventDefault();

            const pastedValue = (event.clipboardData || window.clipboardData).getData(
                "text"
            );
            const otpLength = inputs.length;

            for (let i = 0; i < otpLength; i++) {
                if (i < pastedValue.length) {
                    inputs[i].value = pastedValue[i];
                    inputs[i].removeAttribute("disabled");
                    inputs[i].focus;
                } else {
                    inputs[i].value = ""; // Clear any remaining inputs
                    inputs[i].focus;
                }
            }
        });

        inputs.forEach((input, index1) => {
            input.addEventListener("keyup", (e) => {
                const currentInput = input;
                const nextInput = input.nextElementSibling;
                const prevInput = input.previousElementSibling;

                if (currentInput.value.length > 1) {
                    currentInput.value = "";
                    return;
                }

                if (
                    nextInput &&
                    nextInput.hasAttribute("disabled") &&
                    currentInput.value !== ""
                ) {
                    nextInput.removeAttribute("disabled");
                    nextInput.focus();
                }

                if (e.key === "Backspace") {
                    inputs.forEach((input, index2) => {
                        if (index1 <= index2 && prevInput) {
                            input.setAttribute("disabled", true);
                            input.value = "";
                            prevInput.focus();
                        }
                    });
                }

                button.classList.remove("active");
                button.setAttribute("disabled", "disabled");

                const inputsNo = inputs.length;
                if (!inputs[inputsNo - 1].disabled && inputs[inputsNo - 1].value !== "") {
                    button.classList.add("active");
                    button.removeAttribute("disabled");

                    return;
                }
            });
        });
    </script>







    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
        crossorigin="anonymous"></script>

</body>

</body>

</html>