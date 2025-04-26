<?php include $this->resolve('partials/_header.php') ?>
<link rel="stylesheet" href="/assets/styles/Course/courses.css">

<style>
    :root {
        --theme-color: #FFC400;
        --dark-theme: #FFB100;
        --text-dark: #333;
        --text-light: #666;
        --bg-light: #f5f5f5;
    }

    .main-content {
        padding: 2rem 5%;
        display: grid;
        grid-template-columns: 1fr 300px;
        gap: 2rem;
    }

    .std-hero {
        background: linear-gradient(45deg, var(--theme-color), var(--dark-theme));
        border-radius: 20px;
        padding: 3rem;
        color: white;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }

    .std-hero::after {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        transform: translate(50%, -50%);
    }

    .std-hero h1 {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }

    .std-hero p {
        font-size: 1.1rem;
        opacity: 0.9;
        max-width: 600px;
    }

    .achievement-badges {
        display: flex;
        gap: 1rem;
        margin-top: 1.5rem;
    }

    .badge {
        background: rgba(255, 255, 255, 0.2);
        padding: 0.5rem 1rem;
        border-radius: 15px;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .section-title {
        font-size: 1.5rem;
        color: var(--text-dark);
        margin-bottom: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .view-all {
        font-size: 0.9rem;
        color: var(--theme-color);
        text-decoration: none;
    }

    .explore-courses {
        display: inline-block;
        background: var(--theme-color);
        color: #fff;
        padding: 0.75rem 1.5rem;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 500;
        margin-top: 1rem;
        transition: all 0.3s ease;
        box-shadow: 0 3px 8px rgba(255, 196, 0, 0.3);
    }

    .explore-courses:hover {
        background: var(--dark-theme);
        transform: translateY(-3px);
        box-shadow: 0 5px 12px rgba(255, 177, 0, 0.4);
    }

    .explore-courses:active {
        transform: translateY(0);
        box-shadow: 0 2px 6px rgba(255, 177, 0, 0.4);
    }

    .progress-bar {
        width: 100%;
        height: 8px;
        background: #eee;
        border-radius: 4px;
        margin: 1rem 0;
        overflow: hidden;
    }

    .progress {
        height: 100%;
        background: var(--theme-color);
        border-radius: 4px;
        transition: width 0.3s ease;
    }

    .calendar {
        background: white;
        padding: 1.5rem;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .event {
        margin: 1rem 0;
        padding: 1rem;
        background: var(--bg-light);
        border-radius: 10px;
        transition: transform 0.3s;
        cursor: pointer;
    }

    .event:hover {
        transform: translateX(5px);
    }

    .event-date {
        color: var(--theme-color);
        font-weight: bold;
        margin-bottom: 0.5rem;
    }

    .event-meta {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-top: 0.5rem;
        font-size: 0.9rem;
        color: var(--text-light);
    }

    .learning-path {
        background: white;
        padding: 1.5rem;
        border-radius: 15px;
        margin-bottom: 2rem;
    }

    .path-progress {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-top: 1rem;
    }

    .milestone {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--bg-light);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-light);
        position: relative;
    }

    .milestone.completed {
        background: var(--theme-color);
        color: white;
    }

    .milestone::after {
        content: '';
        position: absolute;
        width: 100%;
        height: 2px;
        background: var(--bg-light);
        right: -100%;
        top: 50%;
        transform: translateY(-50%);
    }

    .milestone:last-child::after {
        display: none;
    }

    .quick-stats {
        display: flex;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: white;
        padding: 1.5rem;
        border-radius: 15px;
        flex: 1;
        text-align: center;
        transition: transform 0.3s;
        cursor: pointer;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        background: var(--bg-light);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        color: var(--theme-color);
    }

    .notification-panel {
        position: fixed;
        right: 2rem;
        top: 80px;
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        width: 300px;
        display: none;
        z-index: 1000;
    }

    .notification-item {
        padding: 1rem 0;
        border-bottom: 1px solid var(--bg-light);
        display: flex;
        gap: 1rem;
        align-items: start;
    }

    .notification-content {
        flex: 1;
    }

    .notification-time {
        font-size: 0.8rem;
        color: var(--text-light);
    }

    .enrolled-courses {
        margin-bottom: 2rem;
    }

    .course-progress-info {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--text-light);
        font-size: 0.9rem;
    }

    .time-remaining {
        display: flex;
        align-items: center;
        gap: 0.3rem;
        color: var(--theme-color);
    }

    .recommended-section {
        margin-bottom: 2rem;
    }

    .category-filter {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.5rem;
        overflow-x: auto;
        padding-bottom: 0.5rem;
    }

    .category-tag {
        padding: 0.5rem 1.5rem;
        background: white;
        border-radius: 20px;
        cursor: pointer;
        white-space: nowrap;
        transition: all 0.3s;
    }

    .category-tag.active {
        background: var(--theme-color);
        color: white;
    }

    .instructor-info {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-top: 1rem;
    }

    .instructor-avatar {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: var(--bg-light);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .calendar-navigation {
        display: flex;
        gap: 0.5rem;
    }

    .calendar-nav-btn {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: var(--bg-light);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background 0.3s;
    }

    .calendar-nav-btn:hover {
        background: var(--theme-color);
        color: white;
    }

    .feedback-section {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    .feedback-item {
        display: flex;
        gap: 1rem;
        padding: 1rem 0;
        border-bottom: 1px solid var(--bg-light);
    }

    .feedback-content {
        flex: 1;
    }

    .rating {
        color: var(--theme-color);
    }

    /* Quick access */
    .student-quick-access {
        margin-top: 2rem;
        background: white;
        padding: 1.5rem;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .student-access-item {
        display: flex;
        align-items: center;
        padding: 1rem;
        background: var(--bg-light);
        border-radius: 10px;
        margin-bottom: 1rem;
        transition: transform 0.3s, background 0.3s;
        cursor: pointer;
    }


    .student-resource-access {
        text-decoration: none;
        color: inherit;
    }

    .student-quick-access p {
        margin: 0.2rem 0 0;
        font-size: 0.9rem;
        color: var(--text-light);
    }

    .student-quick-access h3 {
        margin-bottom: 1.2rem;
    }

    .access-icon {
        background: var(--theme-color);
        color: white;
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
    }

    @media (max-width: 1024px) {
        .main-content {
            grid-template-columns: 1fr;
        }

        .search-bar {
            display: none;
        }
    }

    @media (max-width: 768px) {
        .achievement-badges {
            flex-wrap: wrap;
        }

        .quick-stats {
            flex-direction: column;
        }
    }
</style>

<section>
    <div class="main-content">
        <div class="left-content">
            <section class="std-hero">
                <h1>Welcome back, <?php echo e($userData["first_name"]); ?></h1>
                <p>You're making great progress. Keep up the momentum!</p>
            </section>

            <section class="enrolled-courses">
                <h2 class="section-title">
                    Your courses
                    <a href="/courses/mycourses" class="view-all">View All</a>
                </h2>
                <?php if (empty($courses)): ?>
                    <p>You have not registered for any course yet!</p>
                    <a href="/courses" class="explore-courses" onclick="showLoader();">You Explore courses here!</a>
                <?php else: ?>
                    <div class="courses-grid">
                        <?php
                        $limit = count($courses) >= 3 ? 3 : count($courses);
                        for ($i = 0; $i < $limit; $i++): ?>
                            <a href="/courses/<?php echo e($courses[$i]['course_id']); ?>" class="course-card-link">
                                <div class="course-card">

                                    <div class="course-image">
                                        <img src="/storage/uploads/courses/thumbnails/<?php echo e($courses[$i]['thumbnail_url']) ?>" alt="">
                                        <span class="course-location"><?php echo e($courses[$i]['day']) ?></span>
                                    </div>
                                    <div class="course-content">
                                        <div class="course-content-header">
                                            <h3 class="course-title">
                                                <?php echo e($courses[$i]['title']); ?>
                                            </h3>
                                            <div class="course-subject">
                                                <span>
                                                    <?php echo e($courses[$i]['subject']); ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="course-time">
                                            <i class="fas fa-clock"></i>
                                            <span><?php echo e(date('h:i A', strtotime($courses[$i]['start_time']))); ?> - <?php echo e(date('h:i A', strtotime($courses[$i]['end_time']))); ?></span>
                                        </div>
                                        <div class="instructor-info">
                                            <div class="instructor-avatar">
                                                <i class="fas fa-user"></i>
                                            </div>
                                            <span><?php echo e($courses[$i]['teacher']) ?></span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        <?php endfor; ?>
                    </div>
                <?php endif; ?>
            </section>
            <section class="recommended-section">
                <h2 class="section-title">Recommended for you</h2>
                <div class="category-filter">
                    <div class="category-tag <?= $_GET['category'] == 'All' ? 'active' : '' ?>">All</div>
                    <div class="category-tag <?= $_GET['category'] == 'Development' ? 'active' : '' ?>">Development</div>
                    <div class="category-tag <?= $_GET['category'] == 'Design' ? 'active' : '' ?>">Design</div>
                    <div class="category-tag <?= $_GET['category'] == 'Business' ? 'active' : '' ?>">Business</div>
                    <div class="category-tag <?= $_GET['category'] == 'Marketing' ? 'active' : '' ?>">Marketing</div>
                </div>
                <div class="courses-grid">
                    <div class="course-card">
                        <div class="course-image">
                            <i class="fas fa-code fa-2x" style="color: white;"></i>
                            <span class="course-tag">In Progress</span>
                        </div>
                        <div class="course-content">
                            <h3 class="course-title">Advanced Web Development</h3>
                            <div class="progress-bar">
                                <div class="progress" style="width: 75%;"></div>
                            </div>
                            <div class="course-progress-info">
                                <span>75% Complete</span>
                                <div class="time-remaining">
                                    <i class="fas fa-clock"></i>
                                    <span>2h remaining</span>
                                </div>
                            </div>
                            <div class="instructor-info">
                                <div class="instructor-avatar">
                                    <i class="fas fa-user"></i>
                                </div>
                                <span>Sarah Johnson</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="right-content">
            <div class="student-quick-access">
                <h3>Quick Access</h3>

                <a href="/resource/my-resources" class="student-resource-access">
                    <div class="student-access-item">
                        <div class="access-icon">
                            <i class="fas fa-file-alt fa-lg"></i>
                        </div>
                        <div>
                            <h4>My Resources</h4>
                            <p>Access your study materials</p>
                        </div>
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </a>

                <a href="/courserequest-managment" class="student-resource-access">
                    <div class="student-access-item">
                        <div class="access-icon">
                            <i class="fas fa-comment-alt fa-lg"></i>
                        </div>
                        <div>
                            <h4>My Posts</h4>
                            <p>View your course requests</p>
                        </div>
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </a>
                <a href="/courserequest-managment" class="student-resource-access">
                    <div class="student-access-item">
                        <div class="access-icon">
                            <i class="fa-solid fa-graduation-cap"></i>
                        </div>
                        <div>
                            <h4>My Courses</h4>
                            <p>View your courses</p>
                        </div>
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <form class="suggession-form" method="get"></form>
</section>
<script>
    // Get all category tags
    const categoryTags = document.querySelectorAll(".category-tag");
    const suggessionForm = document.querySelector(".suggession-form");

    // Add click event listener to each category tag
    categoryTags.forEach(tag => {
        tag.addEventListener("click", function() {
            categoryTags.forEach(t => t.classList.remove("active"));

            this.classList.add("active");

            // Clear previous input if exists
            const existingInput = suggessionForm.querySelector('input[name="category"]');
            if (existingInput) {
                existingInput.remove();
            }

            // Create and append hidden input with category value
            const hiddenInput = document.createElement("input");
            hiddenInput.type = "hidden";
            hiddenInput.name = "category";
            hiddenInput.value = this.innerText;
            suggessionForm.appendChild(hiddenInput);

            // Submit the form
            suggessionForm.submit();
        });
    });
</script>
<?php include $this->resolve('partials/_footer.php') ?>