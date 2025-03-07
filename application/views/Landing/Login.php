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
        .input-group, .form-select {
            box-shadow: 0px 4px 4px 0px #00000040;

        }

        .input:focus-within .input-group {
            box-shadow: 5px 4px 4px 0px #1D446E !important;

        }

        .loginbtn:hover {
            background-color: #0e253e !important;
        }
    </style>

</head>

<body style="background: linear-gradient(270deg, rgba(21, 61, 105, 0.5) 0%, #19416C 100%),
  url('<?php echo base_url('assets/images/image2.png'); ?>') no-repeat ; background-size: cover;">

    <div class="container" style="height: 100vh;">
        <div class="row align-items-center">
            <div class="col-md-8 mx-auto">
                <h1 class="text-white text-center">Login Here!</h1>
                <div class="form">
                    <form action="" method="post">

                        <div class="input-group mb-3 bg-white w-100 mx-auto mt-4 rounded-2 ">
                            <span class="input-group-text bg-white border-end-0 d-flex align-items-center">
                                <img src="<?php echo base_url() . 'assets/images/Login_user.png' ?>" alt="Icon" style="width: 30px; height: 30px;">
                            </span>
                            <div class="form-floating flex-grow-1">
                                <input type="text" class="form-control border-start-0 shadow-none" id="floatingInput" placeholder="Username">
                                <label for="floatingInput">Username</label>
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
                                <label for="floatingPass">Password</label>
                            </div>

                        </div>
                        <div class="mb-3 input-group mb-3 bg-white w-100 mx-auto mt-4 rounded-2">
                            <span class="input-group-text bg-white border-end-0 d-flex align-items-center">
                                <img src="<?php echo base_url() . 'assets/images/Login_user.png' ?>" alt="Icon" style="width: 30px; height: 30px;">
                            </span>
                            <select class="form-select shadow-none  p-3" aria-label="Default select example" id="UserType">
                                <option value="" selected disabled hidden style="color: #757575;">User Type</option>
                                <option value="User">User</option>
                                <option value="Vendor">Vendor</option>
                                <option value="Admin">Admin</option>

                            </select>

                            
                        </div>
                        <div class="d-flex flex-wrap justify-content-between mt-2">
                            <p class="text-white">New User ?<a href="<?php echo base_url() .'Landing/EmailVerification' ?>" class="fp mx-2 fw-bold" style="text-decoration: none;">SignUp</a></p>
                            <a href="<?php echo base_url() . 'Landing/NewPassword' ?>" class="fp" style="text-decoration: none;color:white;">Forgot Password?</a>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" style="background: #1D446E;" class="text-white p-2 rounded-2 w-25 fw-semibold loginbtn" onclick="handleLogin(event)">Sign In</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>



    <script>
        function handleLogin(event) {
            event.preventDefault();

            // Get the selected user type
            const userType = document.getElementById('UserType').value;

            // Check the selected user type and redirect accordingly
            if (userType === 'User') {
                window.location.href = '<?php echo base_url() . 'User/Dashboard' ?>';
            } else if (userType === 'Vendor') {
                window.location.href = '<?php echo base_url() . 'Vendor/Dashboard' ?>';
            }
            else if (userType === 'Admin') {
                window.location.href = '<?php echo base_url() . 'Admin/Dashboard' ?>';
            } else {
                alert('Please select a valid user type.');
            }
        }
    </script>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
        crossorigin="anonymous"></script>

</body>

</body>

</html>