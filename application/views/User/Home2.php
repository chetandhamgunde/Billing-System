<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <!-- Include Font Awesome CDN -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


    <link href="https://fonts.googleapis.com/css2?family=Andika:ital,wght@0,400;0,700;1,400;1,700&family=Cinzel+Decorative:wght@400;700;900&family=Merienda:wght@300..900&family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Yesteryear&display=swap" rel="stylesheet">
   <!-- AOS CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">

    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <!-- jQuery (necessary for Owl Carousel) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Owl Carousel JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <title>User-Home</title>

  <title>User-Home</title>

  <style>
    body {
      font-family: "Work Sans", serif;
      padding:0;
      margin:0;
    }

    .d-dark-color {
      color: #F68822;
    }

    .d-dark-bg-color {
      background-color: #F68822;
    }

    .d-light-color {
      color: #FF9500;
    }

    /* Parent container to maintain layout stability */
    .dish-thumbnails {
      display: flex;
      align-items: center;
      justify-content: start;
      overflow: hidden;
      flex-wrap: wrap;
      gap: 1rem;
    }

    .thali,
.current_thali {
  width: 6.5rem;
  height: 6.5rem;
  border-radius: 50%;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  object-fit: cover; /* Ensures consistent cropping */
  position: relative;
}

.current_thali {
  transform: scale(1.2);
  z-index: 1;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  border: 3px solid #ff7315;
  padding: 2px;
}

.thali {
  opacity: 0.8;
  transition: opacity 0.3s ease-in-out;
}

.thali:hover {
  transform: scale(1.1);
  opacity: 1;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}


    /* Animation for the dish image */
    @keyframes slide-in {
     
      
    
      0% {
        top: 60%;
        left: 80%;
        opacity: 0;
      }
      100% {
        top: 50%;
        left: 50%;
        opacity: 1;
      }
    }

    @keyframes slide-out {
      0% {
        top: 50%;
        left: 50%;
        opacity: 1;
      }

      100% {
        top: -20%;
        left: 40%;
        opacity: 0;
      }
    }

    /* Center and animate the large dish */
    .big_thali {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      animation-duration: 3s;
      animation-timing-function: ease-in-out;
    }

    /* Make the image responsive */
    .big_thali img {
      max-width: 100%;
      height: auto;
    }

    /* Responsiveness for the dish-thumbnails container */
    .dish-thumbnails {
      display: flex;
      flex-wrap: wrap;
      gap: 1rem;
      justify-content: center;
      align-items: center;
    }

    .dish-thumbnails img {
      width: 100%;
      max-width: 6.5rem;
      height: auto;
      margin: 0.5rem;
    }

    /* Make the left and right sections stack on smaller screens */
    @media (max-width: 768px) {
      .container .row {
        flex-direction: column;
      }

      .col-md-6,
      .col-lg-6 {
        width: 100%;
        margin-bottom: 2rem;
      }

      /* Ensure the images in the dish-thumbnails container are responsive */
      .dish-thumbnails {
        justify-content: center;
      }

      .big_thali {
        width: 70%;
        height: auto;
      }

      .Heading h2 {
        font-size: 1.5rem;
      }

      .fs-3 {
        font-size: 1.2rem;
      }

      .text-muted {
        font-size: 1rem;
      }

      .btn {
        font-size: 0.9rem;
        padding: 0.6rem 1rem;
      }
    }

    @media (max-width: 576px) {
      .Heading h2 {
        font-size: 1.2rem;
      }

      .fs-3 {
        font-size: 1rem;
      }

      .text-muted {
        font-size: 0.9rem;
      }

      .big_thali {
        width: 80%;
      }

      .btn {
        font-size: 0.8rem;
        padding: 0.5rem 0.8rem;
      }
    }

.row {
  height: 100%;
}

.col-lg-7, .col-lg-5 {
  height: 100%;
}

.thali-container {
  height: 100%;
}

.col-lg-5 {
  position: relative;
  padding-top: 50px; /* Adjust to ensure space for the line */
}


.curved-line1 {
  position: absolute;
  top: 0;
  left: 50%;
  transform: translateX(-50%);
  width: 100%;
  height: 100%;
  pointer-events: none; /* To allow interactions with other elements */
  z-index: 0;
}
@media (max-width: 1289px) {
  .curved-line1{
    display:none;
  }
}
  
    #bigDish {
  animation-timing-function: ease-in-out;
  animation-fill-mode: forwards;
}

#bigDish.slide-in {
  animation: slide-in 1s ease-in-out forwards;
}
.fade-out {
  opacity: 0;
  transition: opacity 0.5s ease-out;
}
/* Fade-in animation for both image and text */
.fade-in {
  opacity: 1;
  transition: opacity 0.5s ease-in;
}

#dishName, #dishDiscription {
  animation: none;  /* Default state, will be overwritten by JS */
}


.highlight-on-hover {
  width: 50px; /* Adjust as needed */
  height: 50px; /* Adjust as needed */
  border-radius: 50%; /* Circular shape */
  transition: all 0.3s ease-in-out; /* Smooth transition for effects */
  box-shadow: 0 0 0 0 rgba(0, 0, 0, 0); /* No shadow initially */
  transform: scale(1); /* Normal size */
  border:2px solid black;
}

.highlight-on-hover:hover {
  transform: scale(1.2); /* Slightly zoom the image */
  box-shadow: 0 0 15px rgba(255, 115, 21, 0.7); /* Highlight with a glowing shadow */
  border: 3px solid #ff7315; /* Optional: Border to highlight */
}

.bounce {
  animation: bounce 2s infinite;
}

@keyframes bounce {
  0%, 20%, 50%, 80%, 100% {
    transform: translateY(0);
  }
  40% {
    transform: translateY(-15px);
  }
  60% {
    transform: translateY(-10px);
  }
}
.slanted-div {
  width: 48%; /* Full width */
  height: 7%; /* 5% height of the viewport */
  background-color: rgb(250, 218, 147); /* Background color */
  background-color: grey; /* Background color */
  position: fixed; /* Sticks the div to the bottom of the screen */
  bottom: 0; /* Positions it at the bottom */
  left: 0; /* Starts from the left edge */
  transform: skewX(50deg); /* Slants the div along the X-axis */
  transform-origin: bottom; /* Ensures the slant starts from the bottom */
  border-top-right-radius:5px;
}
.slanted-div1 {
  width: 48%; /* Full width */
  height: 7%; /* 5% height of the viewport */
  background-color: rgb(250, 218, 147); /* Background color */
  background-color: grey;
  position: fixed; /* Sticks the div to the bottom of the screen */
  bottom: 0; /* Positions it at the bottom */
  right: 0; /* Starts from the left edge */
  transform: skewX(-50deg); /* Slants the div along the X-axis */
  transform-origin: bottom; /* Ensures the slant starts from the bottom */
  border-top-left-radius:5px;
}
.triangle {
      --r: 20px; /* border radius */

      width: 90px;
      aspect-ratio: 1/cos(30deg);
      --_g:calc(tan(60deg)*var(--r)) top var(--r),#000 98%,#0000 101%;
      -webkit-mask:
        conic-gradient(from 150deg at 50% calc(3*var(--r)/2 - 100%),#000 60deg,#0000 0)
         0 0/100% calc(100% - 3*var(--r)/2) no-repeat,
        radial-gradient(var(--r) at 50% calc(100% - 2*var(--r)),#000 98%,#0000 101%),
        radial-gradient(var(--r) at left  var(--_g)),
        radial-gradient(var(--r) at right var(--_g));
      clip-path: polygon(50% 100%,100% 0,0 0);
      background: rgb(250, 218, 147);
      background-color: grey;
    }
    .shutter {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
    
      background-color: white !important;
      z-index: 1000;
      display: flex;
      flex-direction: column;
      justify-content: center;
     
    }

    .shutter-center {
      text-align: center;
    }

    .shutter-center img {
      width: 350px;
      height: auto;
      margin-bottom: 70px;
    }

    .shutter-center p {
      font-size: 1.2rem;
      font-weight: bold;
      color: black;
      margin-bottom: 50px;
    }

    .shutter-bottom {
      position: absolute;
      bottom: 0;
      width: 100%;

      box-sizing: border-box;
      display: flex;
      flex-direction: column;
      align-items: center;
  
    }

    .shutter-bottom-center img {
      height: auto;
      border-radius: 10px;
    }

    .shutter-bottom-row {
      display: flex;
      justify-content: space-between;
      width: 100%;
    }

    .shutter-bottom-row img {
      width: 49%;
      height: auto;
      border-radius: 5px;
    }

    @keyframes closeShutter {
  0% {
    height: 100%; /* Full height */
    transform: scale(1); /* Normal size */
  }

  100% {
    height: 0%; /* Height becomes zero, content is fully hidden */
    transform: scale(1) translateY(-190%); /* Content shrunk and moved completely out of view */
  }
}


    .shutter.animate {
      animation: closeShutter 2s ease-in-out forwards;
    }

    .content {
      display: none;
     
    }
    

 /* style for menu */
 .menu-header a {
            text-decoration: none;
            /* Remove underline */
            color: #333;
            /* Default text color */
            padding: 8px 12px;
            /* Spacing around text */
            border: 2px solid transparent;
            /* Invisible border for consistent spacing */
            border-radius: 5px;
            /* Rounded corners */
            transition: all 0.3s ease;
            /* Smooth transition effect */
        }

        .menu-header a:hover {
            border-color: #ff5722;
            /* Border color on hover */
            background-color: #f5f5f5;
            /* Light background for hover effect */
            color: #ff5722;
            /* Change text color to match border */
        }

        .menu-header a.active {
            border-color: #4caf50 !important;
            /* Active state border color */
            background-color: #e8f5e9 !important;
            /* Light green background for active state */
            color: #4caf50 !important;
            /* Text color for active state */
        }

        .menu-header span {
            font-weight: bold;
            /* Make the text bold */
            color: #555;
            /* Slightly darker color */
        }

        .orange-div {
            background-color: #FF95004F;
            /* background-color: #FF9500; */
            position: absolute;
            width: 95%;
            height: 180px;
            border-radius: 10px !important;
        }

        .menu-card {
            background-color: #D9D9D940;
            color: white;
            border-radius: 20px;
            width: 17rem;
            position: relative;
            overflow: visible;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .menu-card-img {
            width: 290px;
            /* height: 270px; */
            object-fit: cover;
            margin-top: -135px;
            position: relative;
            margin-left: -10px !important;
        }

        @media(max-width:1245px) {
            .menu-card {
                width: 15rem;
            }

            .menu-card-img {
                width: 200px;
                height: 200px;
                margin-left: 0px !important;
            }
        }

        @media(max-width:991px) {
            .orange-div {
                display: none;
            }

            .menu-card {
                width: 17rem;
            }

            .menu-card-img {
                width: 270px;
                height: 250px;
            }
        }

        @media(max-width:1245px) {
            .menu-card {
                width: 15rem;
            }

            .menu-card-img {
                width: 200px;
                height: 200px;
            }
        }

        .menu-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .custom-border {
            border-bottom: none;
            border-width: 2px 2px 0px 2px;
            border-style: solid;
            border-color: #737373;
        }

        /* style for about us section */
        .about-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('<?php echo base_url() . 'assets/images/about.png' ?>') no-repeat center center;
            background-size: 100% 100%;
            z-index: -1;
        }

        .founder-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('<?php echo base_url() . 'assets/images/about.png' ?>') no-repeat center center;
            background-size: cover;
            transform: rotate(180deg);
            background-size: 100% 100%;
            z-index: -1;
        }

        .about-section::before {
            /* background-color:#FFD3A7; */
            /* background: linear-gradient(135deg, #FF9500, #E49F58, #FFD3A7, #EBAC6C);
            background: radial-gradient(circle, #FF9500, #E49F58, #FFD3A7, #EBAC6C); */


        }

        .founder-section::before {
            /* background-color:#FFD3A7; */
        }

        .hari_om_lobo {
            width: 350px;
            height: 350px;
            margin: 0 auto;
            position: relative;
        }

        @media (max-width: 1070px) {
            .hari_om_lobo {
                max-width: 350px;
                max-height: 350px;
            }
        }

        .founder-info {
            width: 70%;
            text-align: left;
        }

        @media (max-width: 868px) {
            .founder-info {
                width: 100%;
            }

            .about-section {
                flex-direction: column;
            }

            .about-section .col-md-5 {
                margin: 1rem auto;
            }

            .about-section .rounded-circle {
                width: 300px;
                height: 300px;
            }

            .hari_om_lobo {
                display:none;
            }

            /* Founder Section */
            .founder-section {
                flex-direction: column-reverse;
            }

            .founder-section::before {
                background: none; 
                background: linear-gradient(135deg, #FFD3A7, #EBAC6C);

            }

            .about-section::before {
                background: none !important; 
            }
        }

        /* style end for about us section */
        .card-title {
            font-family: Yesteryear;
        }

        .owner{
        max-width:100%;
          height:355px;
        }

        @media(max-width:767px){
          .owner{
            max-width:90%;
            margin-left:10%;
            height:255px;
          }

          #menu-container{
            padding:0 10%!important
          }
        }

        
@media (max-width: 768px) {
    .footer .input-group {
        justify-content: center;
    }

}
        
.footer-height {
    width: 55%;
}

@media(max-width:1460px) {
    .footer-height {
        width: 70%;
    }
}

@media(max-width:1100px) {
    .footer-height {
        width: 100%;
    }
}

/* Offer Section Enhancements */

/* OFFER CARDS */
.offer-card {
    background: rgba(255, 255, 255, 0.1);
    padding: 30px 30px 0 30px;
    border-radius: 15px;
    position: relative;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    transform: scale(0.98);
    border:1px solid #FF9500;
}

/* Glowing Badge */
.offer-badge {
    position: absolute;
    top: 0;
    right: 5%;
    background: linear-gradient(90deg, #FF4500, #FFD700);
    color: white;
    padding: 10px 20px;
    font-weight: bold;
    font-size: 1.2rem;
    border-bottom-right-radius: 12px;
    text-transform: uppercase;
    animation: glow 1.5s infinite alternate;
}

@media(max-width:1350px){
  .offer-badge {
    right: 0%;
  }
}

@keyframes glow {
    0% { box-shadow: 0 0 10px rgba(255, 69, 0, 0.8); }
    100% { box-shadow: 0 0 20px rgba(255, 215, 0, 1); }
}

/* Countdown Timer */
.countdown {
    font-size: 1.1rem;
    font-weight: 500;
    padding: 0px 10px;
    color:#fff;
}

.menu-header a.active {
    border-color: #F68822 !important;
    background-color:rgba(255, 149, 0, 0.78) !important;
    background-color:#FF9500 !important;
    color: #fff !important;
}

.custom-padding {
  padding-left: 3rem!important; /* Default (extra small to medium screens) */
}

@media (min-width: 1300px) { /* Large screens and above */
  .custom-padding {
    padding-left: 20rem !important; /* Bootstrap's "5" value */
  }
}

@keyframes floatAnimation {
        0% { transform: translateY(0px); }
        33% { transform: translatex(-10px); }
        66% { transform: translatex(10px); }
        100% { transform: translatex(0px); }
    }

    .offer-img {
        animation: floatAnimation 2s infinite ease-in-out;
    }

    @keyframes slideUp {
    0% { transform: translateY(500px); opacity: 0; }
    100% { transform: translateY(0); opacity: 1; }
}

.slide-in-text {
    animation: slideUp 1s ease-out forwards;
}

  </style>
</head>

<body>

  <!-- shuttter section -->
  <div class="shutter bg-light mt-0" style="
  background-image: url(<?php echo base_url() . 'assets/images/cuttlery.jpg' ?>);
  background-repeat: no-repeat; /* Ensures the background image doesn't repeat */
  background-size: cover; /* Optionally, makes the image cover the whole element */
  background-position: center; /* Optionally, centers the image */
  ">
    <div class="shutter-center mt-5">
      <img src="<?php echo base_url() . 'assets/images/hariom_dhabalogo.png' ?>" alt="Center Image">
      <p class="text-white" >Click here to start your <br>journey</p>
    </div>
    <div class="shutter-bottom">
      <div class="shutter-bottom-center d-flex justify-content-center mb-2 " style="cursor: pointer;" onclick="fun()">
          <div class="triangle bounce"></div> 
      </div>
      <div class="shutter-bottom-row">
        <div class="slanted-div"></div>
        <div class="slanted-div1"></div>
      </div>
    </div>
  </div>
  <!-- shuttter section ends-->

  <div class="container-fluid herosection big-dish custom-curve-container content p-0" style="overflow: hidden;">
    <?php $this->load->view('IncludeUser/CommonNavbar'); ?>
    <div class="row align-items-center w-100" style="
    background-image: url(<?php echo base_url() . 'assets/images/backhero.png' ?>);
    background-repeat: no-repeat; /* Ensures the background image doesn't repeat */
    background-size: cover; /* Optionally, makes the image cover the whole element */
    background-position: center; /* Optionally, centers the image */
    ">
      <!-- Left Section -->
      <div class="col-md-7 col-12 mb-4 mb-md-0 pt-lg-0 pt-5 custom-padding" data-aos="fade-right">
        <div class="ps-lg-5 ps-0">
          <div class="Heading">
            <div style="border-left: #ff7315 5px solid; padding-left: 15px;">
              <h2 class="d-dark-color fs-1 fw-bold m-0">HARI OM</h2>
              <h2 class="d-dark-color fs-1 fw-bold">DHABA</h2>
            </div>
          </div>
          <div id="dish">
            <p class="mt-3 fs-3 fw-bold text-black" id="dishName">Gujarati Thali</p>
            <p class="text-muted text-black mb-5" id="dishDiscription">
              Roti, Dal, Kadhi, Shaak, Rice, Farsan, Pickle, Chutneys, Papad, Salad, Dessert.
            </p>
          </div>
          <div class="d-flex justify-content-start align-items-center ps-2 mt-4 py-2 dish-thumbnails">
            <img src="<?php echo base_url() . 'assets/images/gujrathi1.webp' ?>" alt="Gujarati Thali" class="img-fluid rounded-circle mx-2 current_thali" data-name="Gujarati Thali" data-description="Roti, Dal, Kadhi, Shaak, Rice, Farsan, Pickle, Chutneys, Papad, Salad, Dessert, Chaas." data-image="<?php echo base_url() . 'assets/images/gujrathi1.webp' ?>" style="height:90px;width:90px;" />
            <img src="<?php echo base_url() . 'assets/images/pun.jpg' ?>" alt="Punjabi Thali" class="img-fluid rounded-circle mx-2 thali" data-name="Punjabi Thali" data-description="Naan, Paneer Butter Masala, Dal Makhani, Lassi, Salad, Rice, and Papad." data-image="<?php echo base_url() . 'assets/images/pun.jpg' ?>" style="height:90px;width:90px;" />
            <img src="<?php echo base_url() . 'assets/images/guh.webp' ?>" alt="South Indian Thali" class="img-fluid rounded-circle mx-2 thali" data-name="South Indian Thali" data-description="Idli, Dosa, Sambar, Coconut Chutney, Rasam, and Payasam." data-image="<?php echo base_url() . 'assets/images/guh.webp' ?>" style="height:90px;width:90px;" />
            <img src="<?php echo base_url() . 'assets/images/maha.jpg' ?>" alt="Maharashtrian Thali" class="img-fluid rounded-circle mx-2 thali" data-name="Maharashtrian Thali" data-description="Puran Poli, Bhakri, Sabzi, Amti, Rice, and Koshimbir." data-image="<?php echo base_url() . 'assets/images/maha.jpg' ?>" style="height:90px;width:90px;" />
          </div>
          <div class="mt-5 p-2">
            <button class="btn d-dark-bg-color btn-lg me-2 text-white py-1" onclick="location.href='<?php echo base_url() . 'User/Menu' ?>'">Explore</button>
            <button class="btn btn-outline-dark btn-lg py-1" onclick="location.href='<?php echo base_url() . 'User/TableBooking' ?>'">Book Table</button>
          </div>
        </div>
      </div>
      <!-- Right Section -->
      <div class="col-md-5 col-12 text-center d-flex justify-content-center position-relative" style="padding-top:7%;padding-bottom:7%;"  data-aos="fade-left">
        <!-- Second curve from left -->
        <!-- First curve from left -->
        <svg class="curved-line1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
          <path d="M 55,-20 A 30 30 0 1 0 115,60" stroke="#F68822" stroke-width="10" fill="transparent" />
        </svg>
        <div class="position-relative thali-container" style="width: 23rem; height: 23rem;">
          <!-- Plate Background -->
          <img src="<?php echo base_url() . 'assets/images/black_plate.png' ?>" alt="Wooden Plate" class="plate-background" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); height: 27rem; width: 27rem; z-index: 1;" />
          <!-- Dish Image -->
          <img src="<?php echo base_url() . 'assets/images/dish.png' ?>" alt="Gujarati Thali" id="bigDish" class="img-fluid rounded-circle big_thali" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); height: 19rem; width: 19rem; z-index: 2;" />
        </div>
      </div>
    </div>
  
  <!-- HeroSection Ends Here -->

        <!-- Best offers section starts -->
        <div class="container-fluid py-4 px-0" id="offer" style="background-color:#FF9500;
            background: radial-gradient(circle, #FF9500, #E49F58, #FFD3A7, #EBAC6C);
         background: linear-gradient(270deg, #FF9500, #E49F58, #EBAC6C, #EBAC6C);" >
    <div class="px-0" style="max-width: 92%; margin:auto;">
        <!-- OFFER HEADING -->
        <div class="text-center" data-aos="fade-down">
        <p class="mt-3 fs-3 fw-semibold d-inline ps-3 text-light" id="dishName" style="border-left: 3px solid #FFF">
          Our Best Deals
        </p>
    </div>
        
        <div id="offerCarousel" class="carousel slide mt-3" data-bs-ride="carousel">
            <!-- Indicators -->
            <div class="carousel-indicators" style="bottom:-40px;">
                <button type="button" data-bs-target="#offerCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#offerCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#offerCarousel" data-bs-slide-to="2"></button>
            </div>

            <!-- Slides -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="container">
                        <span class="offer-badge">LIMITED TIME OFFER</span>
                        <div class="row align-items-center">
                            <div class="col-md-4 text-center" data-aos="fade-left">
                                <img src="<?php echo base_url() . 'assets/images/best_offer_img.png' ?>" class="offer-img mt-5" alt="Fried Rice" style="max-width:80%;">
                            </div>
                            <div class="col-md-8 slide-in-text"  data-aos="fade-right">
                                <h2 class="text-start ms-2 text-uppercase text-light">Fried Rice Combo</h2>
                                <p class="fs-5 ms-2 text-light">The combination of traditional recipes combined with international recipes creates our newest menu.
                                </p>
                                
                                <p class="fs-4 my-0 mx-2 text-light">
                                    <span class="fw-bold fs-1 text-light" style="color: #FFD700;">Rs 150</span>
                                    <span class="text-danger text-decoration-line-through text-light">Rs 200</span>
                                </p>
                                <!-- Countdown Timer -->
                                <div class="countdown ps-2">
                                    Offer ends in: <span id="countdown"></span>
                                </div>
                                <div class="mx-2">
                                <button onclick="location.href='<?php echo base_url() . 'User/TableBooking' ?>'" class="btn btn-lg bg-light d-dark-bg-color rounded-pill mt-3 shadow">⚡ Book Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="container">
                        <span class="offer-badge">TODAY'S SPECIAL</span>
                        <div class="row align-items-center">
                            <div class="col-md-4 text-center" data-aos="fade-left">
                                <img src="<?php echo base_url() . 'assets/images/best_offer_img.png' ?>" class="offer-img mt-5" alt="Paneer Tikka" style="max-width:80%;">
                            </div>
                            <div class="col-md-8 slide-in-text" data-aos="fade-right">
                                <h2 class="text-start ms-2 text-light text-uppercase">Paneer Tikka Delight</h2>
                                <p class=" fs-5 ms-2 text-light">The combination of traditional recipes combined with international recipes creates our newest menu.</p>
                                <p class="fs-4 mx-2 ">
                                    <span class="fw-bold fs-1 text-light" style="color: #FFD700;">Rs 180</span>
                                    <span class="text-danger text-decoration-line-through text-light">Rs 250</span>
                                </p>
                                <div class="mx-2">
                                <button onclick="location.href='<?php echo base_url() . 'User/TableBooking' ?>'" class="btn btn-lg bg-light d-dark-bg-color rounded-pill mt-3 shadow">⚡ Book Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="container">
                        <span class="offer-badge">TODAY'S SPECIAL</span>
                        <div class="row align-items-center">
                            <div class="col-md-4 text-center" data-aos="fade-left">
                                <img src="<?php echo base_url() . 'assets/images/best_offer_img.png' ?>" class="offer-img mt-5" alt="Paneer Tikka" style="max-width:80%;">
                            </div>
                            <div class="col-md-8 slide-in-text3" data-aos="fade-right">
                                <h2 class="text-start ms-2 text-light text-uppercase">Paneer Tikka Delight</h2>
                                <p class=" fs-5 ms-2 text-light">The combination of traditional recipes combined with international recipes creates our newest menu.</p>
                                <p class="fs-4 mx-2 ">
                                    <span class="fw-bold fs-1 text-light" style="color: #FFD700;">Rs 180</span>
                                    <span class="text-danger text-decoration-line-through text-light">Rs 250</span>
                                </p>
                                <div class="mx-2">
                                <button onclick="location.href='<?php echo base_url() . 'User/TableBooking' ?>'" class="btn btn-lg bg-light d-dark-bg-color rounded-pill mt-3 shadow">⚡ Book Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#offerCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon d-none"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#offerCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon d-none"></span>
            </button>
        </div>
    </div>
</div>
<script>
    function startCountdown() {
    const endTime = new Date();
    endTime.setHours(endTime.getHours() + 3); // Offer expires in 3 hours

    function updateTimer() {
        const now = new Date();
        const diff = endTime - now;

        if (diff <= 0) {
            document.getElementById("countdown").innerText = "Offer Expired!";
            return;
        }

        const hours = Math.floor(diff / 3600000);
        const minutes = Math.floor((diff % 3600000) / 60000);
        const seconds = Math.floor((diff % 60000) / 1000);

        document.getElementById("countdown").innerText = `${hours}h ${minutes}m ${seconds}s`;
        setTimeout(updateTimer, 1000);
    }

    updateTimer();
}

startCountdown();

</script>
    <!-- Best offers section ends -->

    <!-- Explore Our Menu section starts -->
    <div class="text-center mt-5">
        <p class="fs-3 fw-semibold d-inline ps-3" id="dishName" style="border-left: 3px solid #FF9500">
            Explore Our Menu
        </p>
    </div>
   <!-- Menu Header -->
<div class="menu-header d-flex justify-content-center flex-wrap gap-2">
    <!-- Visible on larger screens -->
    <div class="d-none d-md-flex flex-wrap gap-3 justify-content-center my-4">
        <a href="#" class="active" onclick="filterMenu('All', this, event)">All</a>
        <a href="#" onclick="filterMenu('Starters', this, event)">Starters</a>
        <a href="#" onclick="filterMenu('Salads', this, event)">Salads</a>
        <a href="#" onclick="filterMenu('MainCourse', this, event)">Main Course</a>
        <a href="#" onclick="filterMenu('Desserts', this, event)">Desserts</a>
        <a href="#" onclick="filterMenu('Specialty', this, event)">Specialty</a>
        <a href="#" onclick="filterMenu('Rotis', this, event)">Rotis</a>
        <a href="#" onclick="filterMenu('Rice', this, event)">Rice</a>
    </div>

    <!-- Dropdown for smaller screens -->
    <div class="dropdown d-md-none w-100 text-center">
        <button class="btn dropdown-toggle" style="background-color:#F68822;" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Select Category
        </button>
        <ul class="dropdown-menu w-100 text-center">
            <li><a class="dropdown-item active" href="#" onclick="filterMenu('All', this, event)">All</a></li>
            <li><a class="dropdown-item" href="#" onclick="filterMenu('Starters', this, event)">Starters</a></li>
            <li><a class="dropdown-item" href="#" onclick="filterMenu('Salads', this, event)">Salads</a></li>
            <li><a class="dropdown-item" href="#" onclick="filterMenu('MainCourse', this, event)">Main Course</a></li>
            <li><a class="dropdown-item" href="#" onclick="filterMenu('Desserts', this, event)">Desserts</a></li>
            <li><a class="dropdown-item" href="#" onclick="filterMenu('Specialty', this, event)">Specialty</a></li>
            <li><a class="dropdown-item" href="#" onclick="filterMenu('Rotis', this, event)">Rotis</a></li>
            <li><a class="dropdown-item" href="#" onclick="filterMenu('Rice', this, event)">Rice</a></li>
        </ul>
    </div>
</div>

<section>
    <div class="container-fluid row justify-content-start" style="position:relative; padding:0px 50px;" id="menu-container" data-aos="fade-up">
        <!-- Dynamic Menu Items Will Be Injected Here -->
    </div>
    <div class="text-center">
        <button onclick="location.href='<?php echo base_url() . 'User/Menu' ?>'" class="btn d-dark-bg-color btn-lg me-2 text-white py-1">View More</button>
    </div>
</section>
     
    <br><br>
    <!-- Explore Our Menu section ends -->
    <section id="about-us">
        <div class="container-fluid my-5 rounded position-relative">
            <div class="container p-0">
                <!-- About Us Section -->
                <div class="row about-section text-white pt-4 rounded d-flex flex-wrap">
                    <div class="col-md-7 text-dark mt-3" data-aos="fade-left">
                        <p class="mt-3 fs-1 d-inline ps-3 " id="dishName" style="border-left: 3px solid #FF9500">
                            About Us
                        </p>  
                        <br><br>
                        <p class="fs-5">
                            Hari Om Dhaba was started by Harish Luthra in 1997. A few kms away from Nashik near
                            Gondgegaon
                            on
                            NH-3, Nashik.
                            Soon his efforts paid off and people started noticing the good quality and unique taste. A
                            long
                            drive and as well as
                            the benefit of the good food at the place is approximately 25kms away from Nashik.
                        </p>
                        <p class="fs-5">
                            We are renowned for our exquisite North Indian cuisine and delectable Parathas. Well-known
                            as
                            one of
                            the best
                            dhaba in Nashik, we envision creating a culinary sanctuary where every dish tells a story of
                            wholesome ingredients,
                            sustainable practices, and unmatched flavors.
                        </p>
                    </div>
                    <div class="col-md-5 text-center" data-aos="fade-right">
                        <div class="rounded-circle p-4 hari_om_lobo">
                            <img src="<?php echo base_url() . 'assets/images/hariom_dhabalogo.png' ?>" alt="Hari Om Dhaba Logo" class="img-fluid"
                                style="max-width: 100%; height: auto;">
                            <img src="<?php echo base_url() . 'assets/images/guarentee.png' ?>" alt="" style="position:absolute; right:-20px; width: 30%;">
                        </div>
                    </div>
                </div>

                <!-- Founder Section -->
                <div class="row founder-section text-white rounded d-flex flex-wrap">
                    <div class="col-md-5"  data-aos="fade-up">
                        <img src="<?php echo base_url() . 'assets/images/owner.png' ?>" alt="Harish Luthra" class="owner">
                    </div>
                    <div class="col-md-7 text-dark d-flex justify-content-end"  data-aos="fade-up">
                        <div class="founder-info">
                            <div class="mt-5 d-inline-block pe-3 text-start" style="border-right: 3px solid #FF9500;">
                                <p class="mt-5 fs-3 d-inline pe-3" id="dishName">
                                    <span class="fs-2">MEET OUR FOUNDER -</span> <br> Mr. Harish Luthra
                                </p>
                            </div>
                            <br><br>
                            <p class="fs-5">
                                Our aim is to provide good quality and satisfaction to our guests. Now we are one of the
                                best
                                veg restaurants in Nashik as well as very popular among the citizens of Nashik and
                                Mumbai.
                                We
                                will
                                continue to serve the people with good and quality food for years to come.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="text-center" data-aos="fade-up">
        <p class="mt-3 fs-3 fw-semibold d-inline ps-3" id="dishName" style="border-left: 3px solid #FF9500">
            Online Reservation
        </p>
        <p class="m-auto fs-5" style="max-width:600px;">In the world where technology meets taste, every craving becomes
            a journey, and
            every bite is an
            intelligent
            fusion of flavor and innovation</p>
        <?php  $this->load->view('User/Booking'); ?>

    </section>
      
    <section class="mt-5">
    <div class="text-center">
        <p class="mt-3 fs-3 fw-semibold d-inline ps-3" id="dishName" style="border-left: 3px solid #FF9500">
        Reviews
        </p>
        <p class="m-auto fs-5 mt-2" style="max-width:600px;">See What Our Client Say’s</p>
    </div>
    <div class="container-fluid mt-5" style="background: url('<?php echo base_url() . 'assets/images/client-background.jpg' ?>') no-repeat center center;
             background-size: 100% 100%;" data-aos="fade-up">
        <div class="container py-5">
            <div class="owl-carousel owl-theme">
                <div class="item">
                    <div class="card text-center shadow-lg mx-auto"
                        style="max-width: 22rem; border-radius: 15px; margin-top:100px; height:27rem;">
                        <div class="card-body" style="position:relative; top:-120px;">
                            <div class="d-flex justify-content-center mb-3">
                                <img src="<?php echo base_url() . 'assets/images/customer.png' ?>" alt="Customer Image" class="rounded-circle"
                                    style="width: 200px; height: 200px; object-fit: cover;">
                            </div>
                            <h5 class="card-title fs-2">Customer Review</h5>
                            <p class="card-text">
                                "The hospitality was exceptional. The staff went above and beyond to ensure our comfort.
                                The
                                rooms were clean, spacious, and well-maintained. Would definitely recommend this hotel
                                for a
                                relaxing getaway."
                            </p>
                            <div class="mb-3 fs-2">
                                <span class="d-light-color">&#9733;</span>
                                <span class="d-light-color">&#9733;</span>
                                <span class="d-light-color">&#9733;</span>
                                <span class="d-light-color">&#9733;</span>
                                <span class="d-light-color">&#9733;</span>
                            </div>
                            <hr class="d-light-color fw-bold m-2" style="height: 2px;">
                            <h6 class="fs-3">John Doe</h6>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="card text-center shadow-lg mx-auto"
                        style="max-width: 22rem; border-radius: 15px; margin-top:100px; height:27rem;">
                        <div class="card-body" style="position:relative; top:-120px;">
                            <div class="d-flex justify-content-center mb-3">
                                <img src="<?php echo base_url() . 'assets/images/customer.png' ?>" alt="Customer Image" class="rounded-circle"
                                    style="width: 200px; height: 200px; object-fit: cover;">
                            </div>
                            <h5 class="card-title fs-2">Customer Review</h5>
                            <p class="card-text">
                                "The hospitality was exceptional. The staff went above and beyond to ensure our comfort.
                                The
                                rooms were clean, spacious, and well-maintained. Would definitely recommend this hotel
                                for a
                                relaxing getaway."
                            </p>
                            <div class="mb-3 fs-2">
                                <span class="d-light-color">&#9733;</span>
                                <span class="d-light-color">&#9733;</span>
                                <span class="d-light-color">&#9733;</span>
                                <span class="d-light-color">&#9733;</span>
                                <span class="d-light-color">&#9733;</span>
                            </div>
                            <hr class="d-light-color fw-bold m-2" style="height: 2px;">
                            <h6 class="fs-3">John Doe</h6>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="card text-center shadow-lg mx-auto"
                        style="max-width: 22rem; border-radius: 15px; margin-top:100px; height:27rem;">
                        <div class="card-body" style="position:relative; top:-120px;">
                            <div class="d-flex justify-content-center mb-3">
                                <img src="<?php echo base_url() . 'assets/images/customer.png' ?>" alt="Customer Image" class="rounded-circle"
                                    style="width: 200px; height: 200px; object-fit: cover;">
                            </div>
                            <h5 class="card-title fs-2">Customer Review</h5>
                            <p class="card-text">
                                "The hospitality was exceptional. The staff went above and beyond to ensure our comfort.
                                The
                                rooms were clean, spacious, and well-maintained. Would definitely recommend this hotel
                                for a
                                relaxing getaway."
                            </p>
                            <div class="mb-3 fs-2">
                                <span class="d-light-color">&#9733;</span>
                                <span class="d-light-color">&#9733;</span>
                                <span class="d-light-color">&#9733;</span>
                                <span class="d-light-color">&#9733;</span>
                                <span class="d-light-color">&#9733;</span>
                            </div>
                            <hr class="d-light-color fw-bold m-2" style="height: 2px;">
                            <h6 class="fs-3">John Doe</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
    <?php $this->load->view('IncludeUser/CommonFooter'); ?>
</div>
 
    <!-- AOS JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
  initializePage();
  setupThumbnailClick();
  AOS.init({
    duration: 1500, // Animation duration in milliseconds
    easing: "ease-in-out", // Animation style
    once: false, // Repeats animation when scrolling up/down
    mirror: true, // Enables reverse animation on scroll up
  });
});

function setupThumbnailClick() {
  document.querySelector(".dish-thumbnails").addEventListener("click", function (event) {
    if (event.target.tagName === "IMG") {
      const clickedThumbnail = event.target;
      const bigDish = document.getElementById("bigDish");
      const dishName = document.getElementById("dishName");
      const dishDescription = document.getElementById("dishDiscription");
      const thumbnailsContainer = document.querySelector(".dish-thumbnails");

      // Clone the current image for the "slide-out" animation
      const tempDish = bigDish.cloneNode(true);
      tempDish.style.position = "absolute";
      tempDish.style.top = `${bigDish.offsetTop}px`;
      tempDish.style.left = `${bigDish.offsetLeft}px`;
      tempDish.style.width = `${bigDish.offsetWidth}px`;
      tempDish.style.height = `${bigDish.offsetHeight}px`;
      tempDish.style.animation = "slide-out 1s forwards";
      bigDish.parentNode.appendChild(tempDish);

      // Update the bigDish source and apply "slide-in" animation
      setTimeout(() => {
        bigDish.src = clickedThumbnail.getAttribute("data-image");
        bigDish.alt = clickedThumbnail.getAttribute("data-name");

        // Force re-triggering of the "slide-in" animation
        bigDish.classList.remove("slide-in");
        void bigDish.offsetWidth; // Reflow trick to restart CSS animation
        bigDish.classList.add("slide-in");
      }, 100);

      // Cleanup the temporary "slide-out" animation
      tempDish.addEventListener("animationend", () => {
        tempDish.remove();
      });

      // Add fade-out effect to text
      dishName.classList.add("fade-out");
      dishDescription.classList.add("fade-out");

      // Wait for fade-out to complete, then update text and fade it in
      setTimeout(() => {
        dishName.innerText = clickedThumbnail.getAttribute("data-name");
        dishDescription.innerText = clickedThumbnail.getAttribute("data-description");

        // Add fade-in effect
        dishName.classList.remove("fade-out");
        dishName.classList.add("fade-in");
        dishDescription.classList.remove("fade-out");
        dishDescription.classList.add("fade-in");
      }, 500);

      // Remove fade-in class after animation ends
      setTimeout(() => {
        dishName.classList.remove("fade-in");
        dishDescription.classList.remove("fade-in");
      }, 1000);

      // Manage active thumbnail class
      const currentThumbnail = document.querySelector(".current_thali");
      if (currentThumbnail) {
        currentThumbnail.classList.remove("current_thali");
        currentThumbnail.classList.add("thali");
      }
      clickedThumbnail.classList.add("current_thali");
      clickedThumbnail.classList.remove("thali");

      // Move the clicked thumbnail to the first position
      thumbnailsContainer.insertBefore(clickedThumbnail, thumbnailsContainer.firstChild);
    }
  });
}

/* ---- SHUTTER FUNCTIONALITY ---- */
const shutter = document.querySelector(".shutter");
const content = document.querySelector(".content");
const shutterText = document.querySelector(".shutter-center");

function fun() {
  shutterText.style.opacity = "0"; // Hide text smoothly
  setTimeout(() => {
    shutterText.style.display = "none";
  }, 500);

  shutter.classList.add("animate");

  setTimeout(() => {
    shutter.style.display = "none";
    content.style.display = "block"; // ✅ Ensures content is displayed
    content.style.opacity = "1"; // ✅ Ensure visibility
    AOS.refresh(); // Refresh AOS animations after content is shown
  }, 1500);
}

function initializePage() {
  const hasVisited = sessionStorage.getItem("hasVisited");

  if (!hasVisited) {
    // First-time visit in session: Show shutter
    shutter.style.display = "block";
    content.style.display = "none"; // Hide content initially
    setTimeout(fun, 80000); // Start animation after short delay
    sessionStorage.setItem("hasVisited", "true");
  } else {
    // Hide shutter for returning visitors
    shutter.style.display = "none";
    shutterText.style.display = "none";
    content.style.display = "block"; // ✅ Show content immediately
    content.style.opacity = "1"; // ✅ Ensure visibility
    AOS.refresh(); // Refresh AOS animations after content is shown
  }
}

  </script>

  <!-- Bootstrap JS (including jQuery and Popper.js for dropdown functionality) -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
  function filterMenu(category, element, event) {
    event.preventDefault(); // Prevent default link behavior

    // Remove 'active' class from all menu items in both sections
    document.querySelectorAll(".menu-header a").forEach(item => item.classList.remove("active"));

    // Add 'active' class to the selected item
    element.classList.add("active");

    // Update dropdown button text for smaller screens
    const dropdownButton = document.querySelector(".dropdown-toggle");
    if (dropdownButton && element.classList.contains("dropdown-item")) {
        dropdownButton.textContent = element.textContent;
    }

    console.log(`Filtering for: ${category}`);
}

</script>

  <!-- Bootstrap JS (including jQuery and Popper.js for dropdown functionality) -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <!-- owl script -->
  <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 15,
            nav: true,
            dots: true,
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 1
                },
                768: {
                    items: 2
                },
                1200: {
                    items: 3
                }
            },
            navText: [
                '<i class="fas fa-chevron-left fa-2x"></i>',
                '<i class="fas fa-chevron-right fa-2x"></i>'
            ],
            dotsEach: true,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true
        });
    </script>
<script>
    const menuData = {
        All: [
            { title: "Punjabi Thali", description: "Lorem ipsum dolor sit amet.", price: 150, image: "plate.png" },
            { title: "Salad Bowl", description: "Fresh and healthy salad.", price: 120, image: "plate.png" },
            { title: "Salad Bowl", description: "Fresh and healthy salad.", price: 120, image: "plate.png" },
            { title: "Salad Bowl", description: "Fresh and healthy salad.", price: 120, image: "plate.png" },
            { title: "Salad Bowl", description: "Fresh and healthy salad.", price: 120, image: "plate.png" },
            { title: "Salad Bowl", description: "Fresh and healthy salad.", price: 120, image: "plate.png" },
            { title: "Salad Bowl", description: "Fresh and healthy salad.", price: 120, image: "plate.png" },
            { title: "Butter Naan", description: "Soft and buttery naan.", price: 50, image: "plate.png" },
        ],
        Starters: [
            { title: "Spring Rolls", description: "Crispy spring rolls.", price: 80, image: "plate.png" },
            { title: "Paneer Tikka", description: "Delicious paneer tikka.", price: 200, image: "plate.png" },
        ],
        Salads: [
            { title: "Caesar Salad", description: "Classic Caesar Salad.", price: 100, image: "plate.png" },
        ],
        MainCourse: [
            { title: "Biryani", description: "Flavorful biryani.", price: 250, image: "plate.png" },
        ],
        Desserts: [
            { title: "Gulab Jamun", description: "Sweet and tasty.", price: 90, image: "plate.png" },
        ],
        Specialty: [
            { title: "Special Thali", description: "Exclusive chef's special.", price: 300, image: "plate.png" },
        ],
        Rotis: [
            { title: "Tandoori Roti", description: "Freshly baked.", price: 30, image: "plate.png" },
        ],
        Rice: [
            { title: "Jeera Rice", description: "Aromatic rice.", price: 150, image: "plate.png" },
        ],
    };

    function filterMenu(category, element, event) {
        event.preventDefault();

        // Update active class
        document.querySelectorAll(".menu-header a").forEach(a => a.classList.remove("active"));
        element.classList.add("active");

        // Get the container
        const container = document.getElementById("menu-container");
        container.innerHTML = ""; // Clear existing items

        // Load the items dynamically
        const items = menuData[category] || [];
        if (items.length === 0) {
            container.innerHTML = "<p>No items available for this category.</p>";
            return;
        }

        // Divide items into rows of 4
        for (let i = 0; i < items.length; i += 4) {
            const rowItems = items.slice(i, i + 4);

            // Create a row
            const rowDiv = document.createElement('div');
            rowDiv.className = 'container-fluid row justify-content-start mt-2 mb-5';
            rowDiv.style = 'position:relative; padding:0px 50px;';

            // Add an orange divider for the row
            const orangeDiv = document.createElement('div');
            orangeDiv.className = 'orange-div custom-border p-3';
            rowDiv.appendChild(orangeDiv);

            // Add menu items to the row
            rowItems.forEach(item => {
                const colDiv = document.createElement('div');
                colDiv.className = 'col-lg-3 col-md-6 col-sm-12';
                colDiv.style = 'margin-top:130px;';

                colDiv.innerHTML = `
                    <div class="menu-card text-center m-auto pb-1">
                        <img src="<?php echo base_url() . 'assets/images/' ?>${item.image}" alt="${item.title}" class="rounded-circle mx-auto menu-card-img">
                        <div style="text-align:left;" class="px-4">
                            <h3 class="text-dark">${item.title}</h3>
                            <p class="text-dark my-1">${item.description}</p>
                            <p style="font-size: 1.8rem; font-weight: bold; color:#FF9500;">Rs-${item.price}</p>
                        </div>
                    </div>
                `;
                rowDiv.appendChild(colDiv);
            });

            // Append the row to the container
            container.appendChild(rowDiv);
        }
    }

    // Load all items initially
    document.addEventListener("DOMContentLoaded", () => {
        filterMenu('All', document.querySelector(".menu-header a.active"), new Event('click'));
    });
</script>


</body>

</html>
