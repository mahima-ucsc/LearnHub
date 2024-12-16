<?php include $this->resolve("partials/_header.php"); ?>

<head>
    <link rel="stylesheet" href="/assets/styles/Resource/resource.css">

</head>

<section class="resource-container">
    <div class="search-container">
        <input type="text" class="resource-search-bar" placeholder="Search for resource...">
        <button class="resource-search-button"><i class="fas fa-search"></i>
        </button>
        <select name="search-by" class="search-by">
            <option value="">Search By</option>
            <option value="resource">Resource</option>
            <option value="tutor">Subject</option>
            <option value="tutor">User</option>
            <option value="tutor">Grade</option>
        </select>
    </div>
    <div class="resource-result-container">
        <div class="left-resource-container">
            <div class="filter-section">

                <div class="filters">
                    <h3>Filters</h3>
                    <div class="date-updated" onclick="showDate()">
                        <h4>Date Updated <i class="fas fa-chevron-down chevron-icon"></i></h4>
                        <div class="date-dropdown">
                            <label><input type="radio" name="updated_date"> Last Day</label>
                            <label><input type="radio" name="updated_date"> Last Week</label>
                            <label><input type="radio" name="updated_date"> Last Month</label>
                            <label><input type="radio" name="updated_date"> Last Year</label>
                            <label><input type="radio" name="updated_date"> Any Time</label>
                        </div>
                    </div>
                    <div class="filter-section">
                        <h4>Location</h4>
                        <div class="checkbox-group">
                            <label><input type="checkbox"> Colombo</label>
                            <label><input type="checkbox"> Kandy</label>
                            <label><input type="checkbox"> Gampaha</label>
                            <label><input type="checkbox"> Matara</label>
                        </div>
                    </div>
                    <div class="filter-section">
                        <h4>Price Range</h4>
                        <div class="price-range">
                            <input type="number" placeholder="Min">
                            <input type="number" placeholder="Max">
                        </div>
                    </div>
                    <div class="filter-btn">
                        <button>Apply Filters</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="right-resource-container">
            <div class="resource-accordion">
                <!-- Accordion Resource Items -->
                <div class="accordion-item">
                    <div class="accordion-header">
                        <div class="resource-title-container">
                            <h4 class="resource-title">ICT A/L pastpaper book</h4>
                            <span class="resource-type">Book</span>
                        </div>
                        <div class="resource-price-container">
                            <span class="resource-price">Rs. 500</span>
                            <i class="fas fa-chevron-down accordion-icon"></i>
                        </div>
                    </div>
                    <div class="accordion-content">
                        <div class="accordion-details">
                            <img src="/assets/images/dm.jpg" alt="Web Development" class="resource-image">
                            <div class="resource-description">
                                <p>A/L ICT pastpaper book. It is in good quality. If you are interested please contact me using +12 345 6789</p>
                                <div class="resource-meta">
                                    <div class="resource-owner">
                                        <img src="/assets/images/user.jpeg" alt="owner">
                                        <span>Nadun Madusanka</span>
                                    </div>
                                    <div class="resource-location">
                                        <i class="fa fa-map-marker"></i>
                                        <span>Colombo</span>
                                    </div>
                                    <a href="/resource/demo" class="see-more-btn">See More Details</a>
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
                                    <a href="/resource/demo" class="see-more-btn">See More Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const accordionHeaders = document.querySelectorAll('.accordion-header');

            accordionHeaders.forEach(header => {
                header.addEventListener('click', () => {
                    const accordionItem = header.parentElement;
                    const accordionIcon = header.querySelector('.accordion-icon');

                    // Toggle active class
                    accordionItem.classList.toggle('active');

                    // Rotate chevron icon
                    accordionIcon.classList.toggle('rotated');
                });
            });
        });
    </script>
</section>

<?php include $this->resolve("partials/_footer.php"); ?>