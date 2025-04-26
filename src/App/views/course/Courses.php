<?php include $this->resolve("partials/_header.php"); ?>


<link rel="stylesheet" href="/assets/styles/Course/courses.css">
<!-- Loader -->
<?php include $this->resolve('components/loader.php'); ?>
<!-- course-hero Section -->
<section class="course-hero">
    <div class="course-container">
        <div class="course-hero-content">
            <h1>Find Your Perfect Course</h1>
            <p>Discover thousands of courses to start learning new skills, advance your career, or pursue your passion.</p>
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

        <form id="filterForm" method="GET" action="" onsubmit="showLoader()">
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
                    <span class="filter-label">Sort By:</span>
                    <select class="filter-select" name="sort">
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