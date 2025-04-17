<?php include $this->resolve("partials/_header.php"); ?>


<style>
    :root {
        --primary: #FFC400;
        --primary-dark: #e6b000;
        --primary-light: #fff0c2;
        --dark: #1A1A2E;
        --gray: #e9ecef;
        --gray-dark: #6c757d;
        --gray-light: #f8f9fa;
        --white: #ffffff;
        --shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        --shadow-hover: 0 15px 35px rgba(0, 0, 0, 0.1);
        --radius: 12px;
        --transition: all 0.3s ease;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* Subsection Title */
    .subsection-title {
        font-size: 22px;
        font-weight: 600;
        margin-bottom: 25px;
        position: relative;
        display: inline-block;
    }

    .subsection-title:after {
        content: '';
        position: absolute;
        left: 0;
        bottom: -8px;
        width: 40px;
        height: 3px;
        background: var(--primary);
        border-radius: 3px;
    }

    /* Search Section */
    .search-section {
        margin-bottom: 40px;
        background-color: var(--white);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        padding: 25px;
    }

    .search-form {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
    }

    .search-input-group {
        flex: 1;
        position: relative;
    }

    .search-input-group i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gray-dark);
    }

    .search-input {
        width: 100%;
        padding: 12px 12px 12px 45px;
        border: 1px solid var(--gray);
        border-radius: var(--radius);
        font-size: 16px;
        transition: var(--transition);
    }

    .search-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px var(--primary-light);
    }

    .search-button {
        background-color: var(--primary);
        color: var(--dark);
        border: none;
        border-radius: var(--radius);
        padding: 0 25px;
        font-weight: 500;
        cursor: pointer;
        transition: var(--transition);
    }

    .search-button:hover {
        background-color: var(--primary-dark);
    }

    /* Filter section */

    .filter-options {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
    }

    .filter-group {
        flex: 1;
        min-width: 180px;
    }

    .filter-label {
        display: block;
        margin-bottom: 8px;
        font-size: 14px;
        font-weight: 500;
    }

    .filter-button {
        display: flex;
        align-items: flex-end;
        /* Align with the bottom of filters */
        margin-top: 26px;
        /* Match the spacing of filter groups */
    }

    .filter-button button {
        background-color: var(--primary);
        color: var(--dark);
        border: none;
        border-radius: var(--radius);
        padding: 10px 25px;
        height: 42px;
        /* Match height with filter selects */
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .filter-button button:hover {
        background-color: var(--primary-dark);
        transform: translateY(-2px);
    }

    .filter-button button i {
        font-size: 14px;
    }

    .filter-select {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid var(--gray);
        border-radius: var(--radius);
        font-size: 14px;
        background-color: var(--white);
    }

    .filter-select:focus {
        outline: none;
        border-color: var(--primary);
    }

    /* Request container */
    .request-container {
        margin-top: 50px;
    }

    .clear-filter {
        display: flex;
        justify-content: end;
        margin-bottom: 16px;
    }

    .clear-filter a {
        color: #FFC400;
    }

    .create-course-request-btn {
        display: flex;
        justify-content: end;
        margin-bottom: 18px;
    }

    .request-cards {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 25px;
        margin-bottom: 40px;
    }

    .request-card {
        background-color: var(--white);
        border-radius: var(--radius);
        padding: 25px;
        box-shadow: var(--shadow);
        transition: var(--transition);
    }

    .request-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-hover);
    }

    .request-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .requester {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .requester img {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        object-fit: cover;
    }

    .requester span {
        font-weight: 500;
    }

    .request-status {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 5px;
    }


    .time-posted {
        color: var(--gray-dark);
        font-size: 12px;
    }

    .request-title {
        font-size: 18px;
        margin-bottom: 15px;
        line-height: 1.4;
    }

    .request-details {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        margin-bottom: 15px;
    }

    .detail-item {
        display: flex;
        align-items: center;
        gap: 5px;
        background-color: var(--gray-light);
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 14px;
    }

    .detail-item i {
        color: var(--gray-dark);
    }

    .request-brief {
        color: var(--gray-dark);
        margin-bottom: 20px;
        font-size: 15px;
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .request-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid var(--gray);
        padding-top: 15px;
    }

    .proposals-count {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 14px;
        color: var(--gray-dark);
    }

    .view-details {
        color: var(--primary-dark);
        font-weight: 500;
        text-decoration: none;
        transition: var(--transition);
    }

    .view-details:hover {
        color: var(--primary);
    }

    /* Create Request CTA */
    .create-request-cta {
        background-color: var(--dark);
        color: var(--white);
        border-radius: var(--radius);
        padding: 40px;
        text-align: center;
        margin-bottom: 50px;
    }

    .create-request-cta h3 {
        font-size: 24px;
        margin-bottom: 15px;
    }

    .create-request-cta p {
        font-size: 16px;
        margin-bottom: 25px;
        color: rgba(255, 255, 255, 0.8);
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .btn {
        display: inline-block;
        padding: 12px 24px;
        font-size: 16px;
        font-weight: 500;
        border-radius: var(--radius);
        cursor: pointer;
        text-decoration: none;
        transition: var(--transition);
    }

    .btn-primary {
        background-color: var(--primary);
        color: var(--dark);
        border: none;
    }

    .btn-primary:hover {
        background-color: var(--primary-dark);
        transform: translateY(-3px);
    }

    /* Pagination */
    .pagination-course-container {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 15px;
        margin: 40px 0;
    }

    .pagination-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 10px 15px;
        background-color: var(--white);
        color: var(--dark);
        border-radius: var(--radius-sm);
        text-decoration: none;
        font-weight: 500;
        box-shadow: var(--shadow);
        transition: var(--transition);
    }

    .pagination-btn:hover {
        background-color: var(--gray);
        transform: translateY(-2px);
    }

    .pagination-btn i {
        margin: 0 5px;
    }

    .page-numbers {
        display: flex;
        gap: 8px;
    }

    .page-numbers a {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: var(--white);
        color: var(--dark);
        border-radius: var(--radius-sm);
        text-decoration: none;
        font-weight: 500;
        box-shadow: var(--shadow);
        transition: var(--transition);
    }

    .page-numbers a:hover:not(.active-page) {
        background-color: var(--gray);
        transform: translateY(-2px);
    }

    .page-numbers a.active-page {
        background-color: var(--primary);
        color: var(--dark);
    }

    /* Responsive adjustments */
    @media (max-width: 576px) {
        .pagination-course-container {
            flex-direction: column;
            gap: 10px;
        }

        .page-numbers {
            order: -1;
        }
    }



    /* Responsive adjustments */
    @media (max-width: 992px) {
        .request-cards {
            grid-template-columns: repeat(2, 1fr);
        }

        .search-form {
            flex-direction: column;
        }
    }

    @media (max-width: 768px) {
        .request-cards {
            grid-template-columns: 1fr;
        }

        .filter-options {
            flex-direction: column;
        }

        .create-request-cta {
            padding: 30px 20px;
        }
    }

    @media (max-width: 576px) {
        .request-details {
            gap: 10px;
        }

        .detail-item {
            padding: 4px 8px;
            font-size: 12px;
        }

        .subsection-title {
            font-size: 20px;
        }
    }
</style>

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