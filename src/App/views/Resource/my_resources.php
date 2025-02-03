<?php include $this->resolve("partials/_header.php"); ?>


<head>
    <link rel="stylesheet" href="/assets/styles/Resource/my_resources.css">
    <link rel="stylesheet" href="/assets/styles/User/Admin/admin_dashboard.css">
    <link rel="stylesheet" href="/assets/styles/User/Admin/user_managment.css">
    <link rel="stylesheet" href="/assets/styles/User/Admin/course_managment.css">
    <link rel="stylesheet" href="/assets/styles/User/my-courses.css">
</head>

<section class="resource-container">
    <div class="my-resource-header">
        <h1>My Resources</h1>
        <p>Share your resources with the world</p>
    </div>
    <div class="resource-result-container">
        <div class="right-resource-container">

            <div class="resource-accordion">
                <div class="resource-add-btn">
                    <a href="/resource/create" class="resource-add-link">
                        <button>Add Resources</button>
                    </a>
                </div>
                <!-- Accordion Resource Items -->
                <div class="accordion-item">

                    <div class="accordion-header">

                        <div class="resource-title-container">
                            <h4 class="resource-title">ICT A/L pastpaper book</h4>
                            <span class="resource-type">Book</span>
                        </div>
                        <div class="resource-price-container">
                            <span class="resource-price">Rs. 500</span>
                        </div>
                    </div>
                    <div class="accordion-content">
                        <div class="accordion-details">

                            <div class="resource-description">
                                <p>A/L ICT pastpaper book. It is in good quality. If you are interested please contact me using +12 345 6789</p>
                                <div class="resource-meta">
                                    <div class="resource-owner">
                                        <img src="/assets/images/user.jpeg" alt="owner">
                                        <span>Nadun Madusanka</span>
                                    </div>

                                    <div class="resource-edit-btn">
                                        <a href="/resource/demo">
                                            <button>Edit</button>
                                        </a>
                                    </div>
                                    <div class="resource-delete-btn">
                                        <button onclick="event.stopPropagation();showModal('/resource/delete/5')">Delete</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Repeat similar structure for other resources -->
                <div class="accordion-item">
                    <div class="accordion-header">
                        <div class="resource-title-container">
                            <h4 class="resource-title">Grade 11 Science Practical Video series</h4>
                            <span class="resource-type">Video</span>
                        </div>
                        <div class="resource-price-container">
                            <span class="resource-price-free">Free</span>
                            <i class="fas fa-chevron-down accordion-icon"></i>
                        </div>
                    </div>
                    <div class="accordion-content">
                        <div class="accordion-details">
                            <div class="resource-description">
                                <p>This series include almost all the practicals in the grade 10 teachers guid. Send me a whatsapp message if you are interested. +12 345 6789</p>
                                <div class="resource-meta">
                                    <div class="resource-owner">
                                        <img src="/assets/images/user.jpeg" alt="owner">
                                        <span>Isuru Naveen</span>
                                    </div>
                                    <div class="resource-location">
                                        <i class="fa fa-map-marker"></i>
                                        <span>Colombo</span>
                                    </div>
                                    <div class="resource-edit-btn">
                                        <a href="/resource/demo">
                                            <button>Edit</button>
                                        </a>
                                    </div>
                                    <div class="resource-delete-btn">
                                        <button onclick="event.stopPropagation();showModal('/resource/delete/5')">Delete</button>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include $this->resolve('modals/delete_modal.php'); ?>



</section>

<?php include $this->resolve("partials/_footer.php"); ?>