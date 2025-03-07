<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="icon" type="image/png" href="<?php echo base_url() . 'assets/images/hariom_dhabalogo.png' ?>">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/style.css' ?>">


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Include Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.12/dist/sweetalert2.min.css" rel="stylesheet">

    <title>Admin-Menus</title>

    <style>
        /* Gallery Items */
        .gallery-item {
            position: relative;
            overflow: hidden;
            border: 2px solid #ddd;
            border-radius: 10px;
            background: #f8f9fa;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .gallery-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
        }

        .gallery-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        .delete-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(255, 255, 255, 0.8);
            border: none;

            font-size: 1.2rem;
            color: #d9534f;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .delete-icon:hover {
            transform: scale(1.2);
        }

        /* Add Image Tile */
        .add-image-tile {
            cursor: pointer;
            height: 200px;
            transition: background 0.3s, transform 0.3s;
        }

        .add-image-tile:hover {
            background: #e9ecef;
            transform: translateY(-5px);
        }

        .add-icon {
            width: 60px;
            height: 60px;
        }
    </style>


</head>

<body class="show-sidebar bg-light">

    <!-- Sidebar -->
    <?php $this->load->view('IncludeAdmin/CommonSidebar'); ?>
    <!-- SIDEBAR END -->

    <main>
        <!-- Navbar -->
        <?php $this->load->view('IncludeAdmin/CommonNavbar'); ?>
        <!-- Navbar End -->


        <!-- Main Content Container -->
        <div class="site-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="container">
                        <!-- Gallery Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div style="border-left: #ff7315 5px solid;padding-left:5px;">
                                    <h2>Image Gallery</h2>
                                </div>
                            </div>
                        </div>


                        <div class="container mt-5">
                            <div class="row g-3" id="gallery">
                                <?php if (!empty($galleryImages)): ?>
                                    <?php foreach ($galleryImages as $image): ?>
                                      
                                        <div class="col-sm-6 col-md-4 col-lg-3">
                                            <div class="image-tile d-flex flex-column justify-content-center align-items-center border rounded bg-light h-100 position-relative">
                                                <!-- Delete Icon -->
                                                <button class="btn shadow-1 delete-btn position-absolute top-0 end-0 m-2" data-image-id="<?= $image->id ?>" aria-label="Delete Image">
                                                    <i class="bi bi-x-circle text-danger" style="font-size: 1.5rem;"></i>
                                                </button>
                                                <img src="<?= base_url('uploads/gallery/' . $image->ImageName); ?>" class="img-fluid" alt="Gallery Image">
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p>No images available.</p>
                                <?php endif; ?>


                                <!-- Add Image Section -->
                                <div class="col-sm-6 col-md-4 col-lg-3 ">
                                    <div class="add-image-tile d-flex flex-column justify-content-center align-items-center border rounded bg-light h-100 ">
                                        <div class="add-icon bg-primary text-white rounded-circle d-flex justify-content-center align-items-center">
                                            <i class="bi bi-plus fs-1"></i>
                                        </div>
                                        <p class="mt-2 text-muted">Click to add image</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <!-- SweetAlert2 JS -->
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.12/dist/sweetalert2.min.js"></script>
                    <!-- SCRIPT TO DELETE THE IMAGE -->
                    <script>
                        const addImageTile = document.querySelector('.add-image-tile');
                        addImageTile.addEventListener('click', () => {
                            const fileInput = document.createElement('input');
                            fileInput.type = 'file';
                            fileInput.accept = 'image/*';
                            fileInput.multiple = true; // Allow multiple images

                            fileInput.addEventListener('change', (event) => {
                                const files = event.target.files;
                                if (files.length > 0) {
                                    const formData = new FormData();

                                    Array.from(files).forEach(file => {
                                        formData.append('GalleryImages[]', file);
                                    });

                                    // Send images to backend
                                    fetch('<?php echo base_url() . "addGalleryImg"; ?>', {
                                            method: 'POST',
                                            body: formData
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data.status === 'success') {
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'Uploaded!',
                                                    text: 'Images uploaded successfully.',
                                                    timer: 1500,
                                                    showConfirmButton: false
                                                }).then(() => {
                                                    location.reload(); // Reload page after successful upload
                                                });
                                            } else {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Upload Failed!',
                                                    text: data.message || 'There was an issue uploading the images.',
                                                });
                                            }
                                        })
                                        .catch(error => {
                                            console.error("Upload error:", error);
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Error!',
                                                text: 'There was an error uploading the images.',
                                            });
                                        });
                                }
                            });

                            // Trigger file selection dialog
                            fileInput.click();
                        });
                    </script>



                    <!-- SCRIPT TO ADD IMAGE -->
                    <script>
                        document.addEventListener('DOMContentLoaded', () => {
                            // Handle delete button click
                            const deleteButtons = document.querySelectorAll('.delete-btn');

                            deleteButtons.forEach(button => {
                                button.addEventListener('click', (event) => {
                                    const targetButton = event.target.closest('.delete-btn');
                                    if (!targetButton) return;

                                    const imageId = targetButton.getAttribute('data-image-id');
                                    if (!imageId) {
                                        console.error("Image ID not found.");
                                        return;
                                    }

                                    Swal.fire({
                                        title: 'Are you sure?',
                                        text: 'You won\'t be able to revert this!',
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonText: 'Yes, delete it!',
                                        cancelButtonText: 'Cancel',
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            deleteImage(imageId, targetButton);
                                        }
                                    });
                                });
                            });

                            // Function to handle the delete request
                            function deleteImage(imageId, targetButton) {
                                fetch('<?php echo base_url() . 'deleteGalleryImg/'; ?>' + imageId, {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json'
                                        }
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.status === 'success') {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Deleted!',
                                                text: 'Your image has been deleted.',
                                                timer: 1500,
                                                showConfirmButton: false
                                            }).then(() => {
                                                location.reload(); // Reload page after deletion
                                            });
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Error!',
                                                text: 'There was a problem deleting the image.',
                                            });
                                        }
                                    })
                                    .catch(error => {
                                        console.error("Fetch error:", error);
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error!',
                                            text: 'There was an error deleting the image.',
                                        });
                                    });
                            }
                        });
                    </script>




                </div>
            </div>
        </div>
        </div>
    </main>

    <!-- Bootstrap JS (including jQuery and Popper.js for dropdown functionality) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Sidebar Toggler Script -->
    <script src="<?php echo base_url() . 'assets/js/main.js' ?>"></script>
</body>

</html>