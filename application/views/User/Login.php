<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hari-om-Dhaba Login</title>
    <link rel="icon" type="image/png" href="<?php echo base_url() . 'assets/images/hariom_dhabalogo.png' ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .text-center {
            max-width: 100%;
        }

        .form-control {
            background-color: #FFB864;
        }

        .form-control {
            background-color: #FFEFDC;
        }

        .login-form {
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

        .login-form {
            display: block;
            width: 430px;
            padding: 10px 10px 50px 10px;
            position: relative;
            left: 100px;
            /* top: -50px; */
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
            cursor: pointer;
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
        function togglePassword() {
            const passwordInput = document.getElementById("password");
            const eyeIcon = document.getElementById("eye-icon");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <Section class="back-img" style="background-image: url('<?php echo base_url(); ?>assets/images/cuttlery.jpg');">
        <div>
        </div>
        <div class="login-form">
            <h2 class="text-center mb-4" style="color:#FF9312;">Login Here!!</h2>
            <form action="<?php echo base_url() . 'Home2' ?>">
                <div class="input-with-icon">
                    <img src="<?php echo base_url(); ?>assets/images/Mask group.png" alt="">
                    <input type="text" placeholder="Email" class="form-control"
                        name="email" id="email" required>
                </div>
                <br>
                <div class="input-with-icon"> <img src="<?php echo base_url(); ?>assets/images/Mask group (1).png" alt="">
                    <input type="password" placeholder="Password" class="form-control" id="password" name="password" required>
                    <i class="fa fa-eye toggle-icon" id="eye-icon" onclick="togglePassword()"></i>
                </div>

                <a href="<?php echo base_url() . 'forget' ?>" class="text-decoration-underline float-end mt-" style="color:#FF9312;">Forget
                    Password?</a><br><br>
                <input type="submit" value="Sign In" class="btn btn-lg">
                <p class="text-center text-light">Don't have an account? <a href="<?php echo base_url() . 'register' ?>"
                        class="text-bolder text-decoration-underline" style="color:#FF9312;">Sign up</a></p>
            </form>
        </div>
    </Section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script>
        document.querySelector('form').onsubmit = function(event) {
            event.preventDefault(); // Prevent form from submitting the traditional way

            var username = document.getElementById('email').value;
            console.log(username)
            var password = document.getElementById('password').value;
            console.log(password)
            // Perform AJAX request to login the user
            var formData = new FormData();
            formData.append('username', username);
            formData.append('password', password);

            fetch("<?php echo base_url('auth/login'); ?>", {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
    if (data.success) {
        Swal.fire({
            title: 'Success!',
            text: data.message,
            icon: 'success',
            timer: 1000, // Automatically closes after 2 seconds
            showConfirmButton: false, // Hide the "OK" button
            allowOutsideClick: false,
            allowEscapeKey: false,
            willClose: () => {
                let redirectURL = (data.info && data.info.email === 'shubhambhapkar0@gmail.com') 
                    ? "<?php echo base_url() . 'admin/dashboard' ?>" 
                    : "<?php echo base_url() . 'Home' ?>";
                window.location.href = redirectURL;
            }
        });
    } else {
        Swal.fire('Error!', data.message, 'error');
    }
})

                .catch(error => {
                    Swal.fire('Error!', 'Something went wrong, please try again.', 'error');
                });
        };
    </script>
</body>

</html>