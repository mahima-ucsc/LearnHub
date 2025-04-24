<?php include $this->resolve("partials/_header.php"); ?>


<link rel="stylesheet" href="/assets/styles/Course/courses.css">
<!-- Loader -->
<?php include $this->resolve('components/loader.php'); ?>
<!-- course-hero Section -->
<style>
    .mycourses-hero {
        display: flex;
        justify-content: center;
        margin-top: 50px;
    }
</style>

<!-- Main Content -->
<div class="course-container">
    <section class="mycourses-hero">
        <h1>My Course</h1>
    </section>
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

    </section>

    <!-- Results Summary -->
    <div class="results-summary">
        <p><span id="courseCount"><?php echo $courseCount; ?></span> courses found</p>
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