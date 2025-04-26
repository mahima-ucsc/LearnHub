<?php include $this->resolve("partials/_header.php"); ?>
<link rel="stylesheet" href="/assets/styles/Post/course-requests-new.css">

<div class="container">
    <div class="search-section">
        <h3 class="subsection-title">Find Course Requests</h3>
        <form class="search-form" id="searchForm" method="GET">
            <div class="search-input-group">
                <i class="fas fa-search"></i>
                <input type="text" name="s" class="search-input" id="searchInput" placeholder="Search by keyword..."
                    value="<?php echo isset($_GET['s']) ? e($_GET['s']) : ''; ?>">
            </div>
            <button type="submit" class="search-button">Search</button>
        </form>
        <form method="GET">
            <!-- Hidden search term to preserve it when filtering -->
            <input type="hidden" name="s" value="<?php echo isset($_GET['s']) ? e($_GET['s']) : ''; ?>">
            <div class="filter-options">
                <div class="filter-group">
                    <label class="filter-label">Grade</label>
                    <select class="filter-select" name="grade">
                        <option value="all" <?php echo (!isset($_GET['grade']) || $_GET['grade'] === 'all') ? 'selected' : ''; ?>>All Grades</option>
                        <?php foreach ($grades as $grade): ?>
                            <option value="<?php echo e($grade['grade_id']); ?>" <?php echo (isset($_GET['grade']) && $_GET['grade'] === e($grade["grade_id"])) ? 'selected' : ''; ?>>
                                <?php echo e($grade['grade_name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">Subject</label>
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
                    <label class="filter-label">Budget Range</label>
                    <select class="filter-select" id="budgetFilter">
                        <option value="">Any Budget</option>
                        <option value="low">Under $200</option>
                        <option value="medium">$200-$500</option>
                        <option value="high">Over $500</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">Sort By</label>
                    <select class="filter-select" id="sortFilter" name="sort">
                        <option value="recent">Most Recent</option>
                        <option value="oldest">Oldest First</option>
                        <option value="popular">Most Popular</option>
                        <option value="budget">Highest Budget</option>
                    </select>
                </div>
                <div class="filter-button">
                    <button type="submit">
                        Apply Filters
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="request-container">
        <div class="clear-filter">
            <?php if (isset($_GET['s']) || (isset($_GET) && count($_GET) > 0 && !isset($_GET['p']))): ?>
                <a href="/course/request/" class="clear-btn" onclick="showLoader()">
                    Clear Filters
                </a>
            <?php endif; ?>

        </div>
        <div class="create-course-request-btn">
            <a href="/course/request/create" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i>
                Create Course Request
            </a>
        </div>
        <div class="request-cards" id="requestCards">
            <?php foreach ($courseRequests as $request): ?>
                <div class="request-card">
                    <div class="request-header">
                        <div class="requester">
                            <img src="/assets/images/user_placeholder.jpg" alt="Requester">
                            <span><?php echo e($request['author']); ?></span>
                        </div>
                        <div class="request-status">
                            <!-- <span class="time-posted">Posted 2 days ago</span> -->
                            <span class="time-posted">
                                <?= e(
                                    $request["updated_date"] === $request["created_date"] ?
                                        "Posted on " . formatDate($request["created_date"], 'F j, Y') :
                                        "Edited on " . formatDate($request["updated_date"], 'F j, Y')
                                ) ?>
                            </span>

                        </div>
                    </div>
                    <h4 class="request-title"><?php echo e($request['title']); ?></h4>
                    <div class="request-details">
                        <div class="detail-item">
                            <i class="fas fa-graduation-cap"></i>
                            <span>Grade <?php echo e($request['grade']); ?></span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-book"></i>
                            <span>
                                <?php echo e($request['subject']); ?>
                            </span>
                        </div>
                        <div class="detail-item">
                            <i class="fa-solid fa-location-dot"></i>
                            <span>
                                <?php echo e($request['location']); ?>
                            </span>
                        </div>
                    </div>
                    <p class="request-brief">
                        <?php echo e(substr($request['description'], 0, 100) . (strlen($request['description']) > 100 ? '...' : '')); ?>
                    </p>
                    <div class="request-footer">
                        <span class="proposals-count"><i class="fas fa-user-tie"></i> <?php echo e($request['comments_count']); ?> comments</span>
                        <a href="/course/request/<?php echo e($request['request_id']); ?>" class="view-details">View Details</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="pagination-course-container">
            <?php if ($currentPage > 1) : ?>
                <a href="?<?php echo e($previousPageQuery); ?>" class="pagination-btn prev-btn" onclick="showLoader()">
                    <i class="fas fa-chevron-left"></i> Previous
                </a>
            <?php endif; ?>
            <div class="page-numbers">
                <?php foreach ($pageLinks as $pageNum => $query): ?>
                    <a href="?<?php echo e($query); ?>" class="<?php echo $pageNum + 1 === $currentPage ? "active-page" : "" ?>" onclick="showLoader()">
                        <?php echo ($pageNum + 1); ?>
                    </a>
                <?php endforeach; ?>
            </div>
            <?php if ($currentPage < $lastPage): ?>
                <a href="?<?php echo e($nextPageQuery); ?>" class="pagination-btn next-btn" onclick="showLoader();changePage(1)">
                    Next <i class="fas fa-chevron-right"></i>
                </a>
            <?php endif; ?>
        </div>

        <div class="create-request-cta">
            <h3>Have a specific learning need?</h3>
            <p>Create a course request and get custom proposals from our expert tutors</p>
            <a href="#" class="btn btn-primary">Create Course Request</a>
        </div>
    </div>
</div>


<?php include $this->resolve("partials/_footer.php"); ?>