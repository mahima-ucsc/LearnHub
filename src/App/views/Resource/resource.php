<?php include $this->resolve("partials/_header.php"); ?>

<head>
    <link rel="stylesheet" href="/assets/styles/Resource/resource.css">
</head>

<section class="resource-container">
    <div class="search-container">
        <input type="text" class="resource-search-bar" placeholder="Search for resource...">
        <button class="resource-search-button"><i class="fas fa-search"></i></button>
        <select name="search-by" class="search-by">
            <option value="">Search By</option>
            <option value="resource">Resource</option>
            <option value="tutor">Subject</option>
            <option value="tutor">User</option>
            <option value="tutor">Grade</option>
        </select>
    </div>
    <div class="resource-result-container">
        <div class="right-resource-container">
            <div class="resource-section">
                <div class="resource-add-btn">
                    <a href="resource/create" class="resource-add-link">
                        <button>Add Resources</button>
                    </a>
                </div>
                <!-- Resource Items -->
                <div class="resource-item">
                    <div class="resource-header">
                        <div class="resource-title-container">
                            <h4 class="resource-title">ICT A/L pastpaper book</h4>
                            <span class="resource-type">Book</span>

                        </div>
                        <div class="resource-price-container">
                            <span class="resource-price">Rs. 500</span>
                        </div>
                    </div>
                    <div class="resource-content">
                        <div class="resource-details">
                            <div class="resource-description">
                                <p>A/L ICT pastpaper book. It is in good quality. If you are interested please contact me using +12 345 6789</p>
                                <div class="resource-meta">
                                    <div class="resource-owner">
                                        <img src="/assets/images/user.jpeg" alt="owner">
                                        <span>Nadun Madusanka</span>
                                    </div>

                                    <a href="/resource/demo" class="see-more-btn">See More Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="resource-item">
                <div class="resource-header">
                    <div class="resource-title-container">
                        <h4 class="resource-title">ICT A/L pastpaper book</h4>
                        <span class="resource-type">Book</span>

                    </div>
                    <div class="resource-price-container">
                        <span class="resource-price">Rs. 500</span>
                    </div>
                </div>
                <div class="resource-content">
                    <div class="resource-details">
                        <div class="resource-description">
                            <p>A/L ICT pastpaper book. It is in good quality. If you are interested please contact me using +12 345 6789</p>
                            <div class="resource-meta">
                                <div class="resource-owner">
                                    <img src="/assets/images/user.jpeg" alt="owner">
                                    <span>Nadun Madusanka</span>
                                </div>

                                <a href="/resource/demo" class="see-more-btn">See More Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
</section>

<?php include $this->resolve("partials/_footer.php"); ?>