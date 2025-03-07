<nav class="navbar navbar-expand-md mt-4 sticky-top" style="background-color: #005789;">
        <div class="container-fluid">
            <!-- <a class="navbar-brand " href="#">Logo</a> -->
            <button class="navbar-toggler bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon " span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 d-flex gap-2">
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="<?php echo base_url() . 'Vendor/Dashboard' ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url() . 'Vendor/AddService' ?>">Add Services</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link " href="<?php echo base_url() . 'Vendor/SafetyTips' ?>">Safety Prevention tips</a>
                    </li>

                    <li class="nav-item d-flex align-items-center ms-md-4">
                        <a href="<?php echo base_url() . 'Vendor/Profile' ?>"><img src="<?php echo base_url() . 'assets/images/Nav_profile_white.png' ?>" alt="Profile" style="width: 2.1rem; height: 2.1rem;"></a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>