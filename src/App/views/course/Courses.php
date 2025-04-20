<?php include $this->resolve("partials/_header.php"); ?>

<style>
    :root {
        --primary: #FFC400;
        --primary-dark: #e6b000;
        --primary-light: #fff0c2;
        --accent: #FF7849;
        --dark: #1A1A2E;
        --dark-2: #16213E;
        --gray-light: #f8f9fa;
        --gray: #e9ecef;
        --gray-dark: #6c757d;
        --white: #ffffff;
        --shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        --shadow-hover: 0 15px 35px rgba(0, 0, 0, 0.1);
        --radius: 12px;
        --radius-sm: 8px;
        --transition: all 0.3s ease;
        --success: #28a745;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        color: var(--dark);
        background-color: var(--gray-light);
        line-height: 1.6;
    }

    .course-container {
        max-width: 1280px;
        width: 100%;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* course-hero Section */
    .course-hero {
        background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary) 100%);
        padding: 80px 0;
        margin-bottom: 50px;
        position: relative;
        overflow: hidden;
    }

    .course-hero::before,
    .course-hero::after {
        content: '';
        position: absolute;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .course-hero::before {
        width: 300px;
        height: 300px;
        top: -100px;
        right: -100px;
    }

    .course-hero::after {
        width: 200px;
        height: 200px;
        bottom: -50px;
        left: -50px;
    }

    .course-hero-content {
        position: relative;
        z-index: 1;
        text-align: center;
        max-width: 800px;
        margin: 0 auto;
    }

    .course-hero h1 {
        font-size: 3rem;
        margin-bottom: 20px;
        color: var(--dark);
        font-weight: 700;
        line-height: 1.2;
    }

    .course-hero p {
        font-size: 1.1rem;
        margin-bottom: 30px;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .course-hero-stats {
        display: flex;
        justify-content: center;
        gap: 30px;
        margin-top: 30px;
        flex-wrap: wrap;
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 8px;
        background-color: rgba(255, 255, 255, 0.2);
        padding: 8px 16px;
        border-radius: 30px;
        font-weight: 500;
    }

    .stat-item i {
        color: var(--dark);
    }

    /* Search Section */
    .search-section {
        margin-bottom: 40px;
    }

    .search-course-container {
        display: flex;
        background: var(--white);
        border-radius: var(--radius);
        overflow: hidden;
        box-shadow: var(--shadow);
        margin-bottom: 20px;
    }

    .search-input {
        flex: 1;
        padding: 15px 20px;
        border: none;
        outline: none;
        font-size: 16px;
        font-family: inherit;
    }

    .search-btn {
        background-color: var(--primary);
        color: var(--dark);
        border: none;
        padding: 0 25px;
        font-weight: 500;
        cursor: pointer;
        transition: var(--transition);
        font-family: inherit;
    }

    .search-btn:hover {
        background-color: var(--primary-dark);
    }

    .filters {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-top: 20px;
    }

    .filter-group {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .filter-label {
        font-weight: 500;
        font-size: 14px;
        white-space: nowrap;
    }

    .filter-select {
        padding: 10px 15px;
        border-radius: var(--radius-sm);
        border: 1px solid var(--gray);
        background-color: var(--white);
        outline: none;
        transition: var(--transition);
        font-family: inherit;
        font-size: 14px;
        min-width: 150px;
    }

    .filter-select:focus {
        border-color: var(--primary);
    }

    .filter-actions {
        width: 100%;
        display: flex;
        justify-content: flex-end;
        margin-top: 15px;
    }

    .apply-filter-btn {
        background-color: var(--primary);
        color: var(--dark);
        border: none;
        border-radius: var(--radius-sm);
        padding: 10px 20px;
        font-weight: 500;
        cursor: pointer;
        transition: var(--transition);
        font-family: inherit;
    }

    .apply-filter-btn:hover {
        background-color: var(--primary-dark);
    }

    .active-filters {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 20px;
    }

    .filter-tag {
        background-color: var(--primary-light);
        color: var(--dark);
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .filter-tag button {
        background: none;
        border: none;
        cursor: pointer;
        color: var(--dark);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .results-summary {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        font-size: 15px;
    }

    .clear-btn {
        background: none;
        border: none;
        color: var(--primary-dark);
        font-weight: 500;
        cursor: pointer;
        transition: var(--transition);
        font-family: inherit;
    }

    .clear-btn:hover {
        color: var(--accent);
    }

    /* Courses Grid */
    .course-card-link {
        text-decoration: none;
        color: inherit;
        display: block;
        transition: var(--transition);
    }

    .course-card-link:hover {
        transform: translateY(-10px);
    }

    .course-card-link:hover .course-card {
        box-shadow: var(--shadow-hover);
    }

    .course-card-link:hover .course-image img {
        transform: scale(1.05);
    }

    .courses-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(292px, 1fr));
        gap: 25px;
        margin-bottom: 40px;
    }

    .course-card {
        background-color: var(--white);
        border-radius: var(--radius);
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: var(--transition);
        display: flex;
        flex-direction: column;
        position: relative;
    }

    .course-card:hover {
        box-shadow: var(--shadow-hover);
        transition: var(--transition);
    }

    .course-image {
        height: 180px;
        overflow: hidden;
        position: relative;
    }

    .course-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .course-card:hover .course-image img {
        transform: scale(1.05);
    }

    .course-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        background-color: var(--primary);
        color: var(--dark);
        font-size: 12px;
        font-weight: 600;
        padding: 5px 10px;
        border-radius: 20px;
        z-index: 1;
    }

    .course-location {
        position: absolute;
        top: 15px;
        right: 15px;
        background-color: rgba(0, 0, 0, 0.6);
        color: var(--white);
        font-size: 12px;
        font-weight: 600;
        padding: 5px 10px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        gap: 5px;
        z-index: 1;
    }

    /* Course Content */
    .course-content {
        padding: 20px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .course-content-header {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }

    .course-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 10px;
        line-height: 1.4;
    }

    .course-subject {
        background-color: rgba(220, 223, 53, 0.25);
        /* color: var(--white); */
        font-size: 12px;
        font-weight: 600;
        padding: 5px 10px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        gap: 5px;
        z-index: 1;
    }

    .course-description {
        font-size: 14px;
        color: var(--gray-dark);
        margin-bottom: 15px;
        line-height: 1.6;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .course-meta {
        margin-top: auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .course-instructor {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .instructor-avatar {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        object-fit: cover;
    }

    .instructor-name {
        font-size: 13px;
        font-weight: 500;
    }

    .course-rating {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 14px;
        font-weight: 600;
    }

    .course-rating i {
        color: var(--primary);
    }

    .course-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 20px;
        background-color: var(--gray-light);
        border-top: 1px solid var(--gray);
    }

    .course-price {
        font-weight: 600;
        font-size: 15px;
    }

    .onetime-payment-tag {
        color: rgb(58, 58, 58);
        font-weight: 300;
        font-size: 11px;
        display: block;
        margin-top: 3px;
    }


    .course-details {
        display: flex;
        gap: 15px;
        font-size: 13px;
        color: var(--gray-dark);
    }

    .course-detail {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .payment-type {
        font-size: 12px;
        font-weight: 400;
        color: var(--gray-dark);
    }

    .course-detail i.fa-money-bill {
        color: var(--success);
    }

    /* Responsive Adjustments */
    @media (max-width: 992px) {
        .course-hero h1 {
            font-size: 2.5rem;
        }

        .filters {
            flex-direction: column;
            align-items: flex-start;
        }

        .filter-group {
            width: 100%;
        }

        .filter-select {
            flex: 1;
            width: 100%;
        }
    }

    @media (max-width: 768px) {
        .course-hero {
            padding: 60px 0;
        }

        .course-hero h1 {
            font-size: 2rem;
        }

        .course-hero p {
            font-size: 1rem;
        }

        .courses-grid {
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        }

        .results-summary {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }
    }

    @media (max-width: 576px) {
        .course-hero {
            padding: 40px 0;
        }

        .course-hero h1 {
            font-size: 1.8rem;
        }

        .course-hero-stats {
            gap: 10px;
        }

        .stat-item {
            padding: 6px 12px;
            font-size: 0.9rem;
        }

        .courses-grid {
            grid-template-columns: 1fr;
        }

        .search-course-container {
            flex-direction: column;
        }

        .search-btn {
            width: 100%;
            padding: 12px;
        }

        .course-footer {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .course-details {
            width: 100%;
            justify-content: space-between;
        }
    }
</style>
</head>

<!-- Loader -->
<?php include $this->resolve('components/loader.php'); ?>
<!-- course-hero Section -->
<section class="course-hero">
    <div class="course-container">
        <div class="course-hero-content">
            <h1>Find Your Perfect Course</h1>
            <p>Discover thousands of courses to start learning new skills, advance your career, or pursue your passion.</p>
            <div class="course-hero-stats">
                <div class="stat-item">
                    <i class="fas fa-graduation-cap"></i>
                    <span>10,000+ Courses</span>
                </div>
                <div class="stat-item">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <span>1,500+ Instructors</span>
                </div>
                <div class="stat-item">
                    <i class="fas fa-users"></i>
                    <span>500K+ Students</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<div class="course-container">
    <!-- Search & Filter Section -->
    <section class="search-section">
        <form id="searchForm" method="GET" action="" onsubmit="showLoader()">
            <div class="search-course-container">
                <input type="text" name="s" class="search-input" placeholder="Search for courses..." value="<?php echo isset($_GET['s']) ? e($_GET['s']) : ''; ?>">
                <button type="submit" class="search-btn">
                    <i class="fas fa-search"></i> Search
                </button>
            </div>
        </form>

        <form id="filterForm" method="GET" action="">
            <!-- Hidden search term to preserve it when filtering -->
            <input type="hidden" name="s" value="<?php echo isset($_GET['s']) ? e($_GET['s']) : ''; ?>">
            <!-- Hidden page number to reset to page 1 when applying new filters -->
            <input type="hidden" name="p" value="1">

            <div class="filters">
                <div class="filter-group">
                    <span class="filter-label">Subject:</span>
                    <select class="filter-select" name="subject">
                        <option value="all" <?php echo (!isset($_GET['subject']) || $_GET['subject'] === 'all') ? 'selected' : ''; ?>>All Subjects</option>
                        <?php foreach ($subjects as $subject): ?>
                            <option value="<?php echo e($subject['subject_id']); ?>" <?php echo (isset($_GET['subject']) && $_GET['subject'] === e($subject["subject_id"])) ? 'selected' : ''; ?>>
                                <?php echo e($subject['subject_title']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="filter-group">
                    <span class="filter-label">Price:</span>
                    <select class="filter-select" name="price">
                        <option value="all" <?php echo (!isset($_GET['price']) || $_GET['price'] === 'all') ? 'selected' : ''; ?>>All Prices</option>
                        <option value="1000" <?php echo (isset($_GET['price']) && $_GET['price'] === 'under25') ? 'selected' : ''; ?>>Under RS.1000</option>
                        <option value="2000" <?php echo (isset($_GET['price']) && $_GET['price'] === 'under50') ? 'selected' : ''; ?>>Under Rs.2000</option>
                        <option value="3000" <?php echo (isset($_GET['price']) && $_GET['price'] === 'under100') ? 'selected' : ''; ?>>Under Rs.3000</option>
                    </select>
                </div>
                <div class="filter-group">
                    <span class="filter-label">Course type:</span>
                    <select class="filter-select" name="type">
                        <option value="all" <?php echo (!isset($_GET['type']) || $_GET['type'] === 'all') ? 'selected' : ''; ?>>Any type</option>
                        <option value="onetime" <?php echo (isset($_GET['type']) && $_GET['type'] === 'onetime') ? 'selected' : ''; ?>>One time payment</option>
                        <option value="recurring" <?php echo (isset($_GET['type']) && $_GET['type'] === 'recurring') ? 'selected' : ''; ?>>Monthly payment</option>
                    </select>
                </div>
                <div class="filter-group">
                    <span class="filter-label">Location:</span>
                    <select class="filter-select" name="location">
                        <option value="all" <?php echo (!isset($_GET['location']) || $_GET['location'] === 'all') ? 'selected' : ''; ?>>All Locations</option>
                        <?php foreach ($courseLocations as $location): ?>
                            <option value="<?php echo e($location['location']); ?>" <?php echo (isset($_GET['location']) && $_GET['location'] === e($location["location"])) ? 'selected' : ''; ?>>
                                <?php echo e($location['location']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="filter-group">
                    <span class="filter-label">Rating:</span>
                    <select class="filter-select" name="rating">
                        <option value="all" <?php echo (!isset($_GET['rating']) || $_GET['rating'] === 'all') ? 'selected' : ''; ?>>Any Rating</option>
                        <option value="4plus" <?php echo (isset($_GET['rating']) && $_GET['rating'] === '4plus') ? 'selected' : ''; ?>>4★ & above</option>
                        <option value="3plus" <?php echo (isset($_GET['rating']) && $_GET['rating'] === '3plus') ? 'selected' : ''; ?>>3★ & above</option>
                    </select>
                </div>
                <div class="filter-group">
                    <span class="filter-label">Sort By:</span>
                    <select class="filter-select" name="sort">
                        <option value="popular" <?php echo (!isset($_GET['sort']) || $_GET['sort'] === 'popular') ? 'selected' : ''; ?>>Most Popular</option>
                        <option value="newest" <?php echo (isset($_GET['sort']) && $_GET['sort'] === 'newest') ? 'selected' : ''; ?>>Newest First</option>
                        <option value="oldest" <?php echo (isset($_GET['sort']) && $_GET['sort'] === 'oldest') ? 'selected' : ''; ?>>Oldest First</option>
                        <option value="price_low" <?php echo (isset($_GET['sort']) && $_GET['sort'] === 'priceAsc') ? 'selected' : ''; ?>>Price: Low to High</option>
                        <option value="price_high" <?php echo (isset($_GET['sort']) && $_GET['sort'] === 'priceDesc') ? 'selected' : ''; ?>>Price: High to Low</option>
                    </select>
                </div>
                <div class="filter-actions">
                    <button type="submit" class="apply-filter-btn" onclick="showLoader()">Apply Filters</button>
                </div>
            </div>
        </form>

        <div class="active-filters" id="activeFilters">
            <?php
            $activeFilters = array();
            $params = array('category', 'price', 'location', 'duration', 'rating', 'sort');

            foreach ($params as $param) {
                if (isset($_GET[$param]) && $_GET[$param] !== 'all') {
                    $activeFilters[$param] = $_GET[$param];
                }
            }

            if (!empty($activeFilters)) {
                echo '<div class="filter-tags">';
                foreach ($activeFilters as $key => $value) {
                    echo '<div class="filter-tag">';
                    echo ucfirst($key) . ': ' . ucfirst($value);
                    echo '</div>';
                }
                echo '</div>';
            }
            ?>
        </div>
    </section>

    <!-- Results Summary -->
    <div class="results-summary">
        <p><span id="courseCount"><?php echo $courseCount; ?></span> courses found</p>
        <?php if (isset($_GET['s']) || (isset($_GET) && count($_GET) > 0 && !isset($_GET['p']))): ?>
            <a href="/courses" class="clear-btn" onclick="showLoader()">Clear All Filters</a>
        <?php endif; ?>
    </div>

    <!-- Courses Grid -->
    <section class="courses-grid" id="coursesGrid">
        <?php foreach ($courses as $course): ?>
            <a href="/courses/<?php echo $course['course_id']; ?>" class="course-card-link" onclick="showLoader()">
                <div class="course-card">
                    <div class="course-image">
                        <img src="<?php echo '/storage/uploads/courses/thumbnails/' . $course['thumbnail_url']; ?>" alt="<?php echo e($course['title']); ?>">
                        <div class="course-location">
                            <span>
                                <?php echo e($course['location']); ?>
                            </span>
                        </div>
                    </div>
                    <div class="course-content">
                        <div class="course-content-header">
                            <h3 class="course-title">
                                <?php echo e($course['title']); ?>
                            </h3>
                            <div class="course-subject">
                                <span>
                                    <?php echo e($course['subject']); ?>
                                </span>
                            </div>
                        </div>
                        <p class="course-description">
                            <?php echo e($course['description']); ?>
                        </p>
                        <div class="course-meta">
                            <div class="course-instructor">
                                <img src="/assets/images/pp_placeholder.jpg" alt="<?php echo e($course['first_name']); ?>" class="instructor-avatar">
                                <span class="instructor-name">
                                    <?php echo e($course['first_name'] . ' ' . $course['last_name']); ?>
                                </span>
                            </div>
                            <div class="course-rating">
                                <i class="fas fa-star"></i>
                                <span>5</span>
                                <span class="reviews">(10)</span>
                            </div>
                        </div>
                    </div>
                    <div class="course-footer">
                        <div class="course-price">
                            <!-- <?php echo e($course['price']); ?> -->
                            <?php if (isset($course['billing_type'])): ?>
                                <span>
                                    <?php echo $course['billing_type'] === 'onetime' ? 'Rs.' . e($course['price']) : '<i class="fas fa-money-bill" style="color: var(--success);"></i> Monthly payment'; ?>
                                </span>
                                <span class="onetime-payment-tag">
                                    <?php echo $course['billing_type'] === 'onetime' ? 'onetime payment' : ''; ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="course-details">
                            <div class="course-detail">
                                <i class="fas fa-clock"></i>
                                <span>3H</span>
                            </div>
                            <div class="course-detail">
                                <span>Grade 13</span>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </section>

    <?php include $this->resolve('components/pagination.php'); ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize any client-side functionality needed
        const clearFiltersBtn = document.getElementById('clearFilters');
        if (clearFiltersBtn) {
            clearFiltersBtn.addEventListener('click', function() {
                window.location.href = '<?php echo $_SERVER['PHP_SELF']; ?>';
                showLoader();
            });
        }
    });
</script>
<?php include $this->resolve("partials/_footer.php"); ?>