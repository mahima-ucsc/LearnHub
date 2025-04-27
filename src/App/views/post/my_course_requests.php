<?php include $this->resolve("partials/_header.php"); ?>
<link rel="stylesheet" href="/assets/styles/Post/course-requests-new.css">
<link rel="stylesheet" href="/assets/styles/Post/my-course-requests.css">

<div class="container">
    <div class="search-section">
        <h3 class="subsection-title">My Course Requests</h3>
        <form class="search-form" id="searchForm" method="GET">
            <div class="search-input-group">
                <i class="fas fa-search"></i>
                <input type="text" name="s" class="search-input" id="searchInput" placeholder="Search by keyword..."
                    value="<?= isset($filter_s) ? $filter_s : ''; ?>">
            </div>
            <button type="submit" class="search-button">Search</button>
        </form>
        <form method="GET">
            <!-- Hidden search term to preserve it when filtering -->
            <input type="hidden" name="s" value="<?= $filter_s ? $filter_s : ''; ?>">
            <div class="filter-options">
                <div class="filter-group">
                    <label class="filter-label">Grade</label>
                    <select class="filter-select" name="grade">
                        <option value="all" <?= (!isset($filter_grade) || $filter_grade === 'all') ? 'selected' : ''; ?>>All Grades</option>
                        <?php foreach ($grades as $grade): ?>
                            <option value="<?= e($grade['grade_id']); ?>" <?= (isset($filter_grade) && $filter_grade === e($grade["grade_id"])) ? 'selected' : ''; ?>>
                                <?= e($grade['grade_name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">Subject</label>
                    <select class="filter-select" name="subject">
                        <option value="all" <?= (!isset($filter_subject) || $filter_subject === 'all') ? 'selected' : ''; ?>>All Subjects</option>
                        <?php foreach ($subjects as $subject): ?>
                            <option value="<?= e($subject['subject_id']); ?>" <?= (isset($filter_subject) && $filter_subject === e($subject["subject_id"])) ? 'selected' : ''; ?>>
                                <?= e($subject['subject_title']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">Sort By</label>
                    <select class="filter-select" id="sortFilter" name="sort">
                        <option value="recent" <?= (!isset($filter_sort) || $filter_sort === 'recent') ? 'selected' : ''; ?>>Most Recent</option>
                        <option value="oldest" <?= (!isset($filter_sort) || $filter_sort === 'oldest') ? 'selected' : ''; ?>>Oldest First</option>
                        <option value="popular" <?= (!isset($filter_sort) || $filter_sort === 'popular') ? 'selected' : ''; ?>>Most Popular</option>
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
            <a href="/course/request/" class="clear-btn" onclick="showLoader()">
                Clear Filters
            </a>

        </div>
        <div class="create-course-request-btn">
            <a href="/course/request/" class="btn btn-primary btn-my-requests">
                <i class="fas fa-user"></i> View All Course Requests
            </a>
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
                            <span class="status-tag <?php echo strtolower($request['status']); ?>">
                                <?php echo e(ucfirst($request['status'])); ?>
                            </span>
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
                        <?php if (isset($request['grade']) && $request['grade'] !== ''): ?>
                            <div class="detail-item">
                                <i class="fas fa-graduation-cap"></i>
                                <span>Grade <?php echo e($request['grade']); ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if (isset($request['subject']) && $request['subject'] !== ''): ?>
                            <div class="detail-item">
                                <i class="fas fa-book"></i>
                                <span><?php echo e($request['subject']); ?></span>
                            </div>
                        <?php endif; ?>
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
                        <div class="request-actions">
                            <a href="/course/request/edit/<?= $request['request_id'] ?>" class="edit-link">Edit</a>
                            <div>
                                <form
                                    action="/course/request/<?= $request['request_id'] ?>"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this request?');">
                                    <input type="hidden" name="_METHOD" value="DELETE">
                                    <button type="submit" class="delete-link">Delete</button>
                                </form>
                            </div>
                            <a href="/course/request/<?php echo e($request['request_id']); ?>" class="view-details">View Details</a>
                        </div>
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
            <a href="/course/request/create" class="btn btn-primary">Create Course Request</a>
        </div>
    </div>
</div>

<?php include $this->resolve("partials/_footer.php"); ?>