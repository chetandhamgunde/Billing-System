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
    </style>

</head>

<body style="background: linear-gradient(270deg, rgba(21, 61, 105, 0.5) 0%, #19416C 100%),
  url('<?php echo base_url('assets/images/image2.png'); ?>') no-repeat ; background-size: cover;">

    <div class="container" style="height: 100vh;">
        <div class="row align-items-center">
            <div class="col-md-8 mx-auto">
                <h1 class="text-white text-center">Register Here!</h1>

                <form action="" method="post">
                    <div class="mb-3 input-group mb-3 bg-white w-100 mx-auto mt-4 rounded-2">
                        <span class="input-group-text bg-white border-end-0 d-flex align-items-center">
                            <img src="<?php echo base_url() . 'assets/images/Login_user.png' ?>" alt="Icon" style="width: 30px; height: 30px;">
                        </span>
                        <select class="form-select shadow-none  p-3" aria-label="Default select example" id="UserType" onchange="toggleForm()">
                            <option value="" selected disabled hidden>Register As</option>
                            <option value="User">User</option>
                            <option value="Vendor">Vendor</option>


                        </select>


                    </div>
                    <div class="form" id="UserForm">


                        <div class="input-group mb-3 bg-white w-100 mx-auto mt-4 rounded-2 ">
                            <span class="input-group-text bg-white border-end-0 d-flex align-items-center">
                                <img src="<?php echo base_url() . 'assets/images/Login_user.png' ?>" alt="Icon" style="width: 30px; height: 30px;">
                            </span>
                            <div class="form-floating flex-grow-1">
                                <input type="text" class="form-control border-start-0 shadow-none" name="name" id="floatingInput" placeholder="Enter Your Name">
                                <label for="floatingInput">Name</label>
                            </div>
                        </div>
                        <div class="input-group mb-3 bg-white w-100 mx-auto mt-4 rounded-2">
                            <div class="input-group-prepend border-right-0 d-flex align-items-center">
                                <span class="input-group-text bg-white border-right-0 ">
                                    <img src="<?php echo base_url() . 'assets/images/Login_pass.png' ?>" alt="Icon" style="width: 30px; height: 30px;">
                                </span>
                            </div>
                            <div class="form-floating flex-grow-1">
                                <input type="tel" class="form-control border-left-0 shadow-none" name="contact" id="floatingPhone" placeholder="Enter Your Contact Number">
                                <label for="floatingPhone">Contact</label>
                            </div>

                        </div>
                        <div class="input-group mb-3 bg-white w-100 mx-auto mt-4 rounded-2 ">
                            <span class="input-group-text bg-white border-end-0 d-flex align-items-center">
                                <img src="<?php echo base_url() . 'assets/images/Login_user.png' ?>" alt="Icon" style="width: 30px; height: 30px;">
                            </span>
                            <div class="form-floating flex-grow-1">
                                <input type="text" class="form-control border-start-0 shadow-none" name="username" id="floatingUsername" placeholder="Enter Your Username">
                                <label for="floatingUsername">Username</label>
                            </div>
                        </div>

                        <div class="input-group mb-3 bg-white w-100 mx-auto mt-4 rounded-2">
                            <div class="input-group-prepend border-right-0 d-flex align-items-center">
                                <span class="input-group-text bg-white border-right-0 ">
                                    <img src="<?php echo base_url() . 'assets/images/Login_pass.png' ?>" alt="Icon" style="width: 30px; height: 30px;">
                                </span>
                            </div>
                            <div class="form-floating flex-grow-1">
                                <input type="pass" class="form-control border-left-0 shadow-none" id="floatingPass" placeholder="Enter Your Password">
                                <label for="floatingPass">Password</label>
                            </div>

                        </div>


                    </div>

                    <div class="form" id="VendorForm" style="display: none;">

                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="input-group mb-3 bg-white w-100 mx-auto  rounded-2 ">
                                    <span class="input-group-text bg-white border-end-0 d-flex align-items-center">
                                        <img src="<?php echo base_url() . 'assets/images/Login_user.png' ?>" alt="Icon" style="width: 30px; height: 30px;">
                                    </span>
                                    <div class="form-floating flex-grow-1">
                                        <input type="text" class="form-control border-start-0 shadow-none" id="floatingInput1" placeholder="Enter your name">
                                        <label for="floatingInput1">Enter Your Name</label>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3 bg-white w-100 mx-auto  rounded-2">
                                    <div class="input-group-prepend border-right-0 d-flex align-items-center">
                                        <span class="input-group-text bg-white border-right-0 ">
                                            <img src="<?php echo base_url() . 'assets/images/email.png' ?>" alt="Icon" style="width: 30px; height: 30px;">
                                        </span>
                                    </div>
                                    <div class="form-floating flex-grow-1">
                                        <input type="pass" class="form-control border-left-0 shadow-none" id="floatingInput2" placeholder="Enter your email">
                                        <label for="floatingInput2">Email</label>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3 bg-white w-100 mx-auto  rounded-2 ">
                                    <span class="input-group-text bg-white border-end-0 d-flex align-items-center">
                                        <img src="<?php echo base_url() . 'assets/images/Shop.png' ?>" alt="Icon" style="width: 30px; height: 30px;">
                                    </span>
                                    <div class="form-floating flex-grow-1">
                                        <input type="text" class="form-control border-start-0 shadow-none" id="floatingInput3" placeholder="Enter your name">
                                        <label for="floatingInput3">Enter Shop Name</label>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3 bg-white w-100 mx-auto  rounded-2 ">
                                    <span class="input-group-text bg-white border-end-0 d-flex align-items-center">
                                        <img src="<?php echo base_url() . 'assets/images/Landmark.png' ?>" alt="Icon" style="width: 30px; height: 30px;">
                                    </span>
                                    <div class="form-floating flex-grow-1">
                                        <input type="text" class="form-control border-start-0 shadow-none" id="floatingInput4" placeholder="">
                                        <label for="floatingInput4">Enter Nearest Landmark</label>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="input-group mb-3 bg-white w-100 mx-auto  rounded-2 ">
                                    <span class="input-group-text bg-white border-end-0 d-flex align-items-center">
                                        <img src="<?php echo base_url() . 'assets/images/City.png' ?>" alt="Icon" style="width: 30px; height: 30px;">
                                    </span>
                                    <div class="form-floating flex-grow-1">
                                        <input type="text" class="form-control border-start-0 shadow-none" id="floatingInput5" placeholder="">
                                        <label for="floatingInput5">Enter City/District</label>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3 bg-white w-100 mx-auto  rounded-2 ">
                                    <span class="input-group-text bg-white border-end-0 d-flex align-items-center">
                                        <img src="<?php echo base_url() . 'assets/images/Village.png' ?>" alt="Icon" style="width: 30px; height: 30px;">
                                    </span>
                                    <div class="form-floating flex-grow-1">
                                        <input type="text" class="form-control border-start-0 shadow-none" id="floatingInput6" placeholder="">
                                        <label for="floatingInput6">Enter Village</label>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3 bg-white w-100 mx-auto  rounded-2 ">
                                    <span class="input-group-text bg-white border-end-0 d-flex align-items-center">
                                        <img src="<?php echo base_url() . 'assets/images/United states of america.png' ?>" alt="Icon" style="width: 30px; height: 30px;">
                                    </span>
                                    <div class="form-floating flex-grow-1">
                                        <input type="text" class="form-control border-start-0 shadow-none" id="floatingInput7" placeholder="">
                                        <label for="floatingInput7">Enter State</label>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3 bg-white w-100 mx-auto  rounded-2 ">
                                    <span class="input-group-text bg-white border-end-0 d-flex align-items-center">
                                        <img src="<?php echo base_url() . 'assets/images/Pin.png' ?>" alt="Icon" style="width: 30px; height: 30px;">
                                    </span>
                                    <div class="form-floating flex-grow-1">
                                        <input type="text" class="form-control border-start-0 shadow-none" id="floatingInput8" placeholder="">
                                        <label for="floatingInput8">Enter Pincode</label>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3 bg-white w-100 mx-auto  rounded-2 ">
                                    <span class="input-group-text bg-white border-end-0 d-flex align-items-center">
                                        <img src="<?php echo base_url() . 'assets/images/Login_user.png' ?>" alt="Icon" style="width: 30px; height: 30px;">
                                    </span>
                                    <div class="form-floating flex-grow-1">
                                        <input type="text" class="form-control border-start-0 shadow-none" id="floatingInput9" placeholder="">
                                        <label for="floatingInput9">Enter Your Username</label>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3 bg-white w-100 mx-auto  rounded-2 ">
                                    <span class="input-group-text bg-white border-end-0 d-flex align-items-center">
                                        <img src="<?php echo base_url() . 'assets/images/Login_pass.png' ?>" alt="Icon" style="width: 30px; height: 30px;">
                                    </span>
                                    <div class="form-floating flex-grow-1">
                                        <input type="text" class="form-control border-start-0 shadow-none" id="floatingInput10" placeholder="">
                                        <label for="floatingInput10">Enter Your Password</label>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3 bg-white w-100 mx-auto  rounded-2 ">
                                    <span class="input-group-text bg-white border-end-0 d-flex align-items-center">
                                        <img src="<?php echo base_url() . 'assets/images/Upload.png' ?>" alt="Icon" style="width: 30px; height: 30px;">
                                    </span>
                                    <div class="form-floating flex-grow-1">
                                        <input type="file" class="form-control border-start-0 shadow-none" id="floatingInput11" placeholder="">
                                        <label for="floatingInput11">Enter Your Addhar</label>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3 bg-white w-100 mx-auto  rounded-2 ">
                                    <span class="input-group-text bg-white border-end-0 d-flex align-items-center">
                                        <img src="<?php echo base_url() . 'assets/images/Upload.png' ?>" alt="Icon" style="width: 30px; height: 30px;">
                                    </span>
                                    <div class="form-floating flex-grow-1">
                                        <input type="file" class="form-control border-start-0 shadow-none" id="floatingInput12" placeholder="">
                                        <label for="floatingInput12">Enter Your Shop Certificate</label>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="mt-2">
                        <p class="text-white">Already Have Account ?<a href="<?php echo base_url() . 'Landing/login' ?>" class="fp mx-2 fw-semibold" style="text-decoration: none;">SignIn</a></p>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" style="background: #1D446E;" class="text-white p-2 rounded-2 w-25 fw-semibold loginbtn" onclick="handleRegister(event)">Sign Up</button>
                    </div>

                </form>
            </div>


        </div>

    </div>
    </div>


    <script>
        function toggleForm() {
            const userType = document.getElementById("UserType").value;
            const userForm = document.getElementById("UserForm");
            const vendorForm = document.getElementById("VendorForm");

            if (userType === "User") {
                userForm.style.display = "block";
                vendorForm.style.display = "none";
            } else if (userType === "Vendor") {
                vendorForm.style.display = "block";
                userForm.style.display = "none";
            } else {
                userForm.style.display = "none";
                vendorForm.style.display = "none";
            }
        }
    </script>


    <script>
        function handleRegister(event) {
            event.preventDefault();

            // Get the selected user type
            const userType = document.getElementById('UserType').value;

            // Check the selected user type and redirect accordingly
            if (userType === 'User') {
                window.location.href = '<?php echo base_url() . 'User/Dashboard' ?>';
            } else if (userType === 'Vendor') {
                window.location.href = '<?php echo base_url() . 'Vendor/Dashboard' ?>';
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