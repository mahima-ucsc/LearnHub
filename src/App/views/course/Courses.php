<?php include $this->resolve("partials/_header.php"); ?>

<head>
    <link rel="stylesheet" href="/assets/styles/Course/courses.css">
    <link rel="stylesheet" href="/assets/styles/components/course-card.css">

</head>

<section class="courses-container">
    <form method="GET">
        <div class="search-container">
            <input name="s" type="text" class="course-search-bar" placeholder="Search for courses..." value="<?php echo e((string)$searchTerm); ?>">
            <button class="course-search-button" type="submit"><i class="fas fa-search"></i>
            </button>
            <select name="f" class="search-by">
                <option value="">Search By</option>
                <option value="course" <?php echo e((string)$searchBy === 'course' ? 'selected' : ''); ?>>Course</option>
                <option value="tutor" <?php echo e((string)$searchBy === 'tutor' ? 'selected' : ''); ?>>Tutor</option>
            </select>
        </div>
        <div class="course-result-container">
            <div class="left-course-container">
                <div class="filter-section">
                    <div class="filters">
                        <h3>Filters</h3>
                        <div class="date-updated" onclick="showDate()">
                            <h4>Date Updated <i class="fas fa-chevron-down chevron-icon"></i></h4>
                            <div class="date-dropdown">
                                <label><input type="radio" name="date" value="day"> Last Day</label>
                                <label><input type="radio" name="date" value="week"> Last Week</label>
                                <label><input type="radio" name="date" value="month"> Last Month</label>
                                <label><input type="radio" name="date" value="year"> Last Year</label>
                                <label><input type="radio" name="date" value="any"> Any Time</label>
                            </div>
                        </div>
                        <div class="filter-section">
                            <h4>Ratings</h4>
                            <div class="checkbox-group">
                                <label><input type="checkbox" name="ratings" value="5"> 5 stars</label>
                                <label><input type="checkbox" name="ratings" value="4"> 4 stars & up</label>
                                <label><input type="checkbox" name="ratings" value="3"> 3 stars & up</label>
                                <label><input type="checkbox" name="ratings" value="2"> 2 stars & up</label>
                                <label><input type="checkbox" name="ratings" value="1"> 1 stars & up</label>
                            </div>
                        </div>
                        <div class="filter-section">
                            <h4>Location</h4>
                            <div class="checkbox-group">
                                <label><input type="radio" name="location" value="colombo" <?php echo e((string)$location === 'colombo' ? 'checked' : ''); ?>> Colombo</label>
                                <label><input type="radio" name="location" value="kandy" <?php echo e((string)$location === 'kandy' ? 'checked' : ''); ?>> Kandy</label>
                                <label><input type="radio" name="location" value="gampaha" <?php echo e((string)$location === 'gampaha' ? 'checked' : ''); ?>> Gampaha</label>
                                <label><input type="radio" name="location" value="matara" <?php echo e((string)$location === 'matara' ? 'checked' : ''); ?>> Matara</label>
                            </div>
                        </div>
                        <div class="filter-section">
                            <h4>Price Range</h4>
                            <div class="price-range">
                                <input type="number" name="min_price" placeholder="Min">
                                <input type="number" name="max_price" placeholder="Max">
                            </div>
                        </div>
                        <div class="filter-btn">
                            <button type="submit">Apply Filters</button>
                        </div>
                    </div>
                </div>
            </div>
    </form>
    <div class="right-course-container">
        <div class="card-container">
            <!-- <h3>Search Results</h3> -->
            <!-- ..................... -->
            <?php if (empty($courses)): ?>
                <h3>No results...</h3>

            <?php else: ?>
                <?php foreach ($courses as $course): ?>
                    <div class="search-course-card">
                        <div class="course-card-header">
                            <img src="/assets/images/dm.jpg" alt="Web Development" class="course-image">
                            <h4 class="course-title"><?php echo ($course['title']); ?></h4>
                            <hr class="course-card-line" />
                        </div>
                        <div class="course-description">

                            <p><?php echo ($course['description']); ?></p>
                        </div>
                        <div class="course-info">
                            <div class="course-stat">
                                <p>
                                    <i class="fa fa-star icon"></i> 4.5
                                </p>
                                <p>
                                    <i class="fa fa-map-marker icon"></i>
                                    <?php echo ($course['location']); ?>
                                </p>
                                <p class="price">
                                    Rs. <?php echo ($course['price']); ?>/<?php echo ($course['pricing_period']); ?>
                                </p>
                            </div>
                            <div class="course-meta">
                                <div class="course-teacher">
                                    <img src="/assets/images/user.jpeg" alt="teacher" />
                                    <p><?php echo ($course['first_name']); ?> <?php echo ($course['last_name']); ?></p>
                                </div>
                                <div>
                                    <a href="/courses/<?php echo ($course['course_id']); ?>"> See More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="pagination-container">
            <?php if ($currentPage > 1) : ?>
                <a href="?<?php echo e($previousPageQuery); ?>" class="pagination-btn prev-btn">
                    <i class="fas fa-chevron-left"></i> Previous
                </a>
            <?php endif; ?>
            <div class="page-numbers">
                <?php foreach ($pageLinks as $pageNum => $query): ?>
                    <a href="?<?php echo e($query); ?>" class="<?php echo $pageNum + 1 === $currentPage ? "active-page" : "" ?>">
                        <?php echo ($pageNum + 1); ?>
                    </a>
                <?php endforeach; ?>
            </div>
            <?php if ($currentPage < $lastPage): ?>
                <a href="?<?php echo e($nextPageQuery); ?>" class="pagination-btn next-btn" onclick="changePage(1)">
                    Next <i class="fas fa-chevron-right"></i>
                </a>
            <?php endif; ?>
        </div>
    </div>
    <script>
        function showDate() {
            const date = document.querySelector(".date-dropdown");
            const chevron = document.querySelector('.chevron-icon');

            date.classList.toggle("show");
            chevron.classList.toggle('rotated');
        }
    </script>
    </div>
</section>

<?php include $this->resolve("partials/_footer.php"); ?>