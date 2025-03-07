<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <link rel="icon" type="image/png" href="<?php echo base_url() . 'assets/images/hariom_dhabalogo.png' ?>">
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
  <scrip src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/homestyle.css'); ?>">
    <title>Hari-Om-Dhaba Home</title>

    <style>
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
          display: none;
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

      .offer-img{
        max-width:300px; 
        max-height:300px;
      }

      @media(max-width: 992px){
        .offer-img{
          padding-right:50px;
        }
      }

      @media(max-width: 767px){
        .offer-img{
          width:170px; 
          height:170px;
          padding-right:0px;
        }
      }

      /* style end for about us section */
     
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
      <p class="text-white">Click here to start your <br>journey</p>
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

  <div class="container-fluid herosection big-dish custom-curve-container content p-0 " style="overflow: hidden;">
    <?php $this->load->view('IncludeUser/CommonNavbar'); ?>
    <div class="row align-items-center w-100 p-0 m-0" style="
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
      <div class="col-md-5 col-12 text-center d-flex justify-content-center position-relative " style="padding-top:10%;padding-bottom:10%;" data-aos="fade-left">
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
            background: linear-gradient(270deg, #FF9500, #E49F58, #EBAC6C, #EBAC6C);">
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
          </div>

          <!-- Slides -->
          <div class="carousel-inner">
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
      async function fetchOffers() {
        try {
          const response = await fetch('<?php echo base_url() . 'user/get_offers/' ?>');
          const result = await response.json();

          if (result.status === 'success') {
            const offers = result.data;
            const carouselIndicators = document.querySelector('.carousel-indicators');
            const carouselInner = document.querySelector('.carousel-inner');

            offers.forEach((offer, index) => {
              const validUpto = new Date(offer.validUpto);
              const today = new Date();
              discountedPrice = offer.price - (offer.price * offer.discount / 100)
              const countdownId = `countdown${index}`;

              const slideHTML = `
                        <div class="carousel-item ${index === 0 ? 'active' : ''}">
                            <div class="container">
                             
                                <div class="row align-items-center">
                                    <div class="col-md-4 text-center" data-aos="fade-left">
                                        <img src="<?php echo base_url() . 'uploads/images/' ?>${offer.image}" class="offer-img mt-0 rounded-circle" alt="<?php echo base_url() . 'uploads/images/' ?>${offer.image}">
                                    </div>
                                    <div class="col-md-8 slide-in-text" data-aos="fade-right">
                                        <h2 class="text-start ms-2 text-uppercase text-light" style="height:30px; overflow:hidden;">${offer.offerName}</h2>
                                        <p class="fs-5 ms-2 text-light" style="height:60px; overflow:hidden;">${offer.offerDesc}</p>
                                        <p class="fs-4 my-0 mx-2 text-light" style="height:50px; overflow:hidden;">
                                            <span class="fw-bold fs-1 text-light" style="color: #FFD700;">Rs ${discountedPrice}</span>
                                            <span class="text-danger text-decoration-line-through text-light">Rs ${offer.price}</span>
                                        </p>
                                        <div class="countdown ps-2">
                                            Offer ends in: <span id="${countdownId}">Loading...</span>
                                        </div>
                                        <div class="d-flex justify-content-start mx-2">
                                            <a href="https://www.swiggy.com/city/nashik/hari-om-dhabha-panchavati-indira-nagar-rest68941/search?q=${encodeURIComponent(offer.offerName)}" target="_blank" class="btn-lg btn-warning text-dark rounded-pill mt-3 shadow d-flex align-items-center   justify-content-center px-3 py-2 text-decoration-none">
                                                <img src="https://upload.wikimedia.org/wikipedia/commons/1/13/Swiggy_logo.png" alt="Swiggy" style="width: 18px; height: 18px; margin-right: 5px;">
                                                Swiggy
                                            </a>
                                            <a href="https://www.zomato.com/nashik/hari-om-dhaba-college-road/order/search?query=${encodeURIComponent(offer.offerName)}" target="_blank" class="btn-lg btn-light text-dark rounded-pill mt-3 shadow ms-2 d-flex align-items-center justify-content-center px-3 py-2 text-decoration-none">
                                                <img src="https://upload.wikimedia.org/wikipedia/commons/7/75/Zomato_logo.png" alt="Zomato" style="width: 18px; height: 18px; margin-right: 5px;">
                                                Zomato
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;

              carouselInner.insertAdjacentHTML('beforeend', slideHTML);
              carouselIndicators.insertAdjacentHTML('beforeend', `
                        <button type="button" data-bs-target="#offerCarousel" data-bs-slide-to="${index}" class="${index === 0 ? 'active' : ''}"></button>
                    `);

              startCountdown(validUpto, countdownId);
            });
          } else {
            console.error('No offers found.');
          }
        } catch (error) {
          console.error('Error fetching offers:', error);
        }
      }

      function startCountdown(endTime, elementId) {
    function updateTimer() {
        const now = new Date();
        const diff = endTime - now;

        if (diff <= 0) {
            document.getElementById(elementId).innerText = "Offer Expired!";
            return;
        }

        const days = Math.floor(diff / (1000 * 60 * 60 * 24));
        const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));

        document.getElementById(elementId).innerText = `${days}d ${hours}h ${minutes}m`;
        setTimeout(updateTimer, 1000);
    }

    updateTimer();
}

      // Call fetchOffers on page load
      fetchOffers();
    </script>

    <!-- Best offers section ends -->
    <style>
@media (max-width: 767px) { 
  #menu-container .col-sm-12 {
    flex: 0 0 48%; /* ✅ Set width to 48% for 2 cards per row */
    max-width: 48%; /* ✅ Prevents overflow */
    padding: 0px !important; /* ✅ Adds spacing between cards */
  }

  #menu-container .menu-card {
    width: 100% !important; /* ✅ Ensures each card fits in its column */
    margin-bottom: 10px; /* ✅ Adds spacing below cards */
    padding:0 !important;
    height:250px;
  }

  #menu-container .row {
    justify-content: center !important; /* ✅ Centers items if fewer than 2 */
    gap: 10px; /* ✅ Adds spacing between items */
  }
}

@media (max-width: 766px) {
    #menu-container {
        padding: 0 0 !important;
        width:100% !important;
        margin:auto !important;
    }

    #menu-container .menu-card {
      height:180px;
  }
}

</style>

    <!-- Explore Our Menu section starts -->
    <div class="text-center mt-5 mb-3">
      <p class="fs-3 fw-semibold d-inline ps-3" id="dishName" style="border-left: 3px solid #FF9500">
        Explore Our Menu
      </p>
    </div>
    <!-- Menu Header -->
     <div class="container-fluid">
    <div class="menu-header d-flex justify-content-center flex-wrap gap-2">
      <!-- Visible on larger screens -->
      <div class="d-none d-md-flex flex-wrap gap-3 justify-content-center my-4">
        <a href="#" class="active" onclick="filterMenu('All', this,event)">All</a>
        <?php foreach ($categories as $category): ?>
          <a href="#" onclick="filterMenu(<?php echo $category['id']; ?>, this,event)">
            <?php echo $category['name']; ?>
          </a>
        <?php endforeach; ?>
      </div>
      </div>
    <!-- Dropdown for smaller screens -->
    <div class="d-md-none w-50 m-auto text-center">
  <select id="categorySelect" class="form-select" style="border-color:#F68822;" onchange="filterMenu(this.value)">
    <option selected disabled>Select Category</option>
    <?php foreach ($categories as $category): ?>
      <option value="<?php echo $category['id']; ?>">
        <?php echo $category['name']; ?>
      </option>
    <?php endforeach; ?>
  </select>
</div>

<script>
 function filterMenu(categoryId) {
  // Ensure a valid category is selected
  if (!categoryId) return;

  // Your existing code to filter the menu based on categoryId
  console.log("Selected Category ID:", categoryId);
  // ...
}
</script>

    </div>
      
    <section class="p-1">
      <div class="container-fluid row justify-content-center p-0 m-0" style="position:relative; padding:0px 0px;" id="menu-container" data-aos="fade-up">
        <!-- Dynamic Menu Items Will Be Injected Here -->
      </div>
      <div class="text-center mt-5">
        <button onclick="location.href='<?php echo base_url() . 'User/Menu' ?>'" class="btn d-dark-bg-color btn-lg me-2 text-white py-1">View More</button>
      </div>
    </section>
    
    <style>
      .menu-card-img2{
        height: 125px;
      }

      .menu-top{
        margin-top: 150px !important;
      }
      
      .menu-text{
        padding: 0px 30px;
      }

      @media(max-width:992px){
        .menu-card-img2{
          margin-top:50px;
        }
      }

      @media(max-width:1244px){
        .menu-card-img2{
          height: 80px;
        }
      }

      @media(max-width:767px){
        .menu-card-img2{
          height: 60px;
          margin-top:0px;
        }

        .menu-card-img {
        height: 190px !important;
        }

        .menu-text{
        padding: 0px 5px;
      }
      }

      .orange-div{
        left:0;
      }
    </style>
    <script>
      const baseUrl = "<?php echo base_url(); ?>"; // Store base_url in JS variable
      const menusData = <?php echo json_encode($menus); ?>;

      function checkScreenSize() {
        return window.innerWidth >= 992 || window.innerWidth <= 767;
      }

      let isLargeScreen = checkScreenSize(); // Initial check

      // Listen for window resize event
      window.addEventListener("resize", () => {
        let newIsLargeScreen = checkScreenSize();

        if (newIsLargeScreen !== isLargeScreen) {
          location.reload(); // Reload the page when breakpoint is crossed
        }

        isLargeScreen = newIsLargeScreen; // Update the value
      });

      function filterMenu(categoryId, element, event = null) {
        if (event) event.preventDefault();

        // Remove "active" class from all category links
        document.querySelectorAll(".d-none a, .dropdown-item").forEach(a => a.classList.remove("active"));
        if (element) element.classList.add("active");

        const container = document.getElementById("menu-container");
        container.innerHTML = ""; // Clear previous items

        // Filter menu items and limit to 8 max
        let filteredItems = categoryId === 'All' ? menusData : menusData.filter(item => item.category_id == categoryId);
        filteredItems = filteredItems.slice(0, 8); // Ensure only 8 items max

        if (filteredItems.length === 0) {
    container.innerHTML = `
        <div id="noItemsMessage" class="text-center mt-3 p-3" style="max-width: 70%; font-size:1.3rem;">
          <div style="font-size: 5rem;">😞</div>      
        <strong>Oops! No Dishes Available</strong> <br>  
            We're sorry, but there are no dishes available in this category at the moment.  
            Our chefs are working hard to bring you the best flavors.  
           
            <br>
            <br>
            Don't worry! You can still explore other delicious options from our menu  or click on <strong>View More</strong> to explore our entire menu.  
          
        </div>
    `;
    return;
  }


        if (isLargeScreen) {
          for (let i = 0; i < filteredItems.length; i += 4) {
            const rowItems = filteredItems.slice(i, i + 4);

            const rowDiv = document.createElement('div');
            rowDiv.className = 'container-fluid row justify-content-start p-0 mt-2';
            rowDiv.style = 'position:relative; padding:0px 0px !important; width:100%;';

            const orangeDiv = document.createElement('div');
            orangeDiv.className = 'orange-div custom-border';
            rowDiv.appendChild(orangeDiv);

            rowItems.forEach(item => {
              const colDiv = document.createElement('div');
              colDiv.className = 'col-lg-3 col-md-4 col-sm-12 menu-top'; //media 
              //media needed in below second line and also for heading and paragraph
              colDiv.innerHTML = `
                <div class="menu-card text-center h-100 m-auto pb-1">
                  <div class=" menu-card-img2"> 
                    <img src="${baseUrl}uploads/menu/${item.image}" alt="${item.name}" class="rounded-circle mx-auto img-fluid menu-card-img">
                  </div>
                  <div style="text-align:left;" class="menu-text">
                    <h3 class="text-dark" style="max-height:100px; overflow:hidden;">${truncateDescription(item.name)}</h3>

                    <p style="font-size: 1.5rem; font-weight: bold; color:#FF9500;">${item.price} RS</p>
                  </div>
                </div>
              `;

              rowDiv.appendChild(colDiv);
            });

            container.appendChild(rowDiv);
          }
        } else {
          for (let i = 0; i < filteredItems.length; i += 3) {
            const rowItems = filteredItems.slice(i, i + 3);

            const rowDiv = document.createElement('div');
            rowDiv.className = 'container-fluid row justify-content-start p-0 mt-2';
            rowDiv.style = 'position:relative; padding:0px 0px !important; width:100%;';

            const orangeDiv = document.createElement('div');
            orangeDiv.className = 'orange-div custom-border';
            rowDiv.appendChild(orangeDiv);

            rowItems.forEach(item => {
              const colDiv = document.createElement('div');
              colDiv.className = 'col-lg-3 col-md-4 col-sm-12';
              colDiv.style = 'margin-top:120px;';

              colDiv.innerHTML = `
                <div class="menu-card text-center m-auto pb-1">
                  <div class="menu-card-img2">
                    <img src="${baseUrl}uploads/menu/${item.image}" alt="${item.name}" class="rounded-circle mx-auto img-fluid menu-card-img" >
                  </div>
                  <div style="text-align:left;" class="menu-text">
                    <h3 class="text-dark" style="max-height:100px; overflow:hidden;">${truncateDescription(item.name)}</h3>
  
                    <p style="font-size: 1.8rem; font-weight: bold; color:#FF9500;">Rs:${item.price}</p>
                  </div>
                </div>
              `;

              rowDiv.appendChild(colDiv);
            });

            container.appendChild(rowDiv);
          }
        }
      }

      document.addEventListener("DOMContentLoaded", () => {
        const activeElement = document.querySelector(".d-none a.active");
        if (activeElement) {
          filterMenu('All', activeElement);
        }
      });

      function truncateDescription(description) {
        let words = description.split(" ");
        return words.length >= 20 ? words.slice(0, 19).join(" ") + "..." : description;
      }
    </script>
    <!-- Explore Our Menu section ends -->
    <section id="about-us">
      <div class="container-fluid my-5 rounded position-relative">
        <div class="container p-0">
          <!-- About Us Section -->
          <div class="row about-section text-white pt-4 rounded d-flex flex-wrap">
            <div class="col-md-7 text-dark mt-3">
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
            <div class="col-md-5 text-center">
              <div class="rounded-circle p-4 hari_om_lobo">
                <img src="<?php echo base_url() . 'assets/images/hariom_dhabalogo.png' ?>" alt="Hari Om Dhaba Logo" class="img-fluid"
                  style="max-width: 100%; height: auto;">
                <img src="<?php echo base_url() . 'assets/images/guarentee.png' ?>" alt="" style="position:absolute; right:-20px; width: 30%;">
              </div>
            </div>
          </div>

          <!-- Founder Section -->
          <div class="row founder-section text-white rounded d-flex flex-wrap">
            <div class="col-md-5">
              <img src="<?php echo base_url() . 'assets/images/owner.png' ?>" alt="Harish Luthra" class="owner">
            </div>
            <div class="col-md-7 text-dark d-flex justify-content-end">
              <div class="founder-info">
                <div class="mt-5 d-inline-block ps-3 text-start" style="border-left: 3px solid #FF9500;">
                  <p class="mt-5 fs-3 d-inline pe-3" id="dishName">
                    <span class="fs-2">MEET OUR FOUNDER </span> <br> <span class="fw-bolder">Mr. Harish Luthra</span>
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

    <div class="text-center">
      <p class="mt-3 fs-3 fw-semibold d-inline ps-3" id="dishName" style="border-left: 3px solid #FF9500">
        Online Reservation
      </p>
      <p class="m-auto fs-5" style="max-width:600px;">In the world where technology meets taste, every craving becomes
        a journey, and
        every bite is an
        intelligent
        fusion of flavor and innovation</p>
      <?php $this->load->view('User/Booking'); ?>

      </section>

      <section class="mt-5">
  <div class="text-center">
    <p class="mt-3 fs-3 fw-semibold d-inline ps-3" id="dishName" style="border-left: 3px solid #FF9500">Reviews</p>
    <p class="m-auto fs-5 mt-2" style="max-width:600px;">See What Our Client Say’s</p>
  </div>
  <div class="container-fluid mt-5" style="background: url('assets/images/client-background.jpg') no-repeat center center; background-size: 100% 100%;">
    <div class="container py-5">
      <div class="owl-carousel owl-theme" id="reviewCarousel">
        <!-- Reviews will be dynamically generated here -->
      </div>
    </div>
  </div>
</section>

<script>
  document.addEventListener("DOMContentLoaded", async function () {
    const reviewContainer = document.getElementById("reviewCarousel");

    if (!reviewContainer) {
      console.error("Error: #reviewCarousel element not found!");
      return;
    }

    const fetchReviews = async () => {
      try {
        const response = await fetch("<?php echo base_url(); ?>getFeedbacks");
        if (!response.ok) throw new Error("Failed to fetch reviews");

        const result = await response.json();
        if (result.status === "success") {
          return result.data.map(review => ({
            name: review.name,
            review: review.comment,
            rating: parseInt(review.rating),
            image: "<?php echo base_url(); ?>uploads/images/" + review.image
          }));
        }
        return [];
      } catch (error) {
        console.error("Error fetching reviews:", error);
        return [];
      }
    };

    const displayReviews = async () => {
      const reviews = await fetchReviews();
      reviewContainer.innerHTML = ""; // Clear previous content

      if (reviews.length === 0) {
        reviewContainer.innerHTML = "<p class='text-center'>No reviews available.</p>";
        return;
      }

      reviews.forEach((review) => {
        const stars = Array(5)
          .fill('<span class="d-light-color">☆</span>')
          .map((star, index) => (index < review.rating ? '<span class="d-light-color">★</span>' : star))
          .join("");

        const reviewCard = `
          <div class="item">
            <div class="card text-center shadow-lg mx-auto" style="max-width: 22rem; border-radius: 15px; margin-top:100px; height:27rem;">
              <div class="card-body" style="position:relative; top:-120px;">
                <div class="d-flex justify-content-center mb-3">
                  <img src="${review.image}" 
     alt="Customer Image" 
     class="rounded-circle" 
     style="width: 200px; height: 200px; object-fit: cover;"
     onerror="this.onerror=null; this.src='<?php echo base_url(); ?>assets/images/profile.jpg';">

                </div>
                <h5 class="card-title fs-2">Customer Review</h5>
                <p class="card-text" style="height:143px;">"${review.review}"</p>
                <div class="mb-3 fs-2">${stars}</div>
                <hr class="d-light-color fw-bold m-2" style="height: 2px;">
                <h6 class="fs-3">${review.name}</h6>
              </div>
            </div>
          </div>
        `;
        reviewContainer.innerHTML += reviewCard;
      });

      // Destroy Owl Carousel if it's already initialized
      if ($(".owl-carousel").hasClass("owl-loaded")) {
        $(".owl-carousel").trigger("destroy.owl.carousel");
        $(".owl-carousel").removeClass("owl-loaded");
      }

      // Initialize Owl Carousel
      $("#reviewCarousel").owlCarousel({
        loop: true,
        margin:20,
        nav: true,
        dots: true,
        autoplay: true,
        autoplayTimeout: 3000,
        responsive: {
          0: { items: 1 },
          768: { items: 2 },
          1200: { items: 3 }
        }
      });
    };

    await displayReviews();
  });
</script>




    <section id="gallery" class="container my-5">
    <div class="text-center py-3">
        <p class="mt-3 fs-3 fw-semibold d-inline ps-3" id="dishName" style="border-left: 3px solid #FF9500">
            Our Gallery
        </p>
    </div>
    <div class="container">
        <div class="gallery" id="gallery-container">
            <!-- Dynamic content will be injected here -->
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        fetch('<?php echo base_url('getImages'); ?>')
            .then(response => response.json())
            .then(data => {
                const galleryContainer = document.getElementById('gallery-container');
                let htmlContent = '';

                if (data.length > 0) {
                    data.forEach(image => {
                      console.log(image)
                        const imageClass = Math.random() < 0.5 ? 'wide' : 'tall'; // Random class for layout
                        htmlContent += `
                            <div class="gallery-item ${imageClass}">
                                <img src="<?php echo base_url('uploads/gallery/'); ?>${image.ImageName}" alt="<?php echo base_url('uploads/gallery/'); ?>${image.image_name}">
                            </div>
                        `;
                    });
                } else {
                    htmlContent = '<p class="text-center">No images available in the gallery.</p>';
                }

                galleryContainer.innerHTML = htmlContent;
            })
            .catch(error => {
                console.error('Error fetching gallery images:', error);
            });
    });
</script>

</section>
<style>
/* Gallery Grid */
/* Gallery Grid */
.gallery {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-auto-rows: 220px;
    gap: 15px; /* Perfect spacing */
}

/* Default Image Style */
.gallery-item {
    position: relative;
    overflow: hidden;
    border-radius: 10px; /* Smooth edges */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Soft shadow effect */
    transition: transform 0.3s ease-in-out;
}

.gallery-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Hover Effect */
.gallery-item:hover {
    transform: scale(1.01);
}

/* Special Layout */
.wide {
    grid-column: span 2;
}

.tall {
    grid-row: span 2;
}

/* Responsive Design */
@media (max-width: 768px) {
    .gallery {
        grid-template-columns: repeat(2, 1fr); /* Adjust to 2 columns */
        grid-auto-rows: 180px;
    }
    .wide, .tall {
        grid-column: span 1;
        grid-row: span 1;
    }
}

</style>
    <div id="footer">
    <?php $this->load->view('IncludeUser/CommonFooter'); ?>
    </div>
</div>
 

    <!-- AOS JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
      document.addEventListener("DOMContentLoaded", function() {
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
        document.querySelector(".dish-thumbnails").addEventListener("click", function(event) {
          if (event.target.tagName === "IMG") {
            const clickedThumbnail = event.target;
            const bigDish = document.getElementById("bigDish");
            const dishName = document.getElementById("dishName");
            const dishDescription = document.getElementById("dishDiscription");
            const thumbnailsContainer = document.querySelector(".dish-thumbnails");

            // Clone the current image for the "slide-out" animation
            const tempDish = bigDish.cloneNode(true);
            tempDish.style.position = "absolute";
            tempDish.style.top = bigDish.offsetTop + "px";
            tempDish.style.left = bigDish.offsetLeft + "px";
            tempDish.style.width = bigDish.offsetWidth + "px";
            tempDish.style.height = bigDish.offsetHeight + "px";
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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  
</body>

</html>