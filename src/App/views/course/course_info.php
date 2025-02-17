<?php include $this->resolve("partials/_header.php"); ?>
<?php include $this->resolve("course/sidebar/sidebar.php"); ?>

<link rel="stylesheet" href="/assets/styles/Course/course-info.css">

<style>

</style>
<section class="course-info-container">
    <div class="course-page-wrapper">
        <div class="main-content">
            <div class="course-header">
                <h1 class="course-info-title"><?php echo e($course['title']); ?></h1>
                <div class="course-meta">
                    <div class="course-rating">★★★★★ 4.8 (256 reviews)</div>
                    <div class="course-info">
                        <span>Duration: <?php echo e($course['duration']); ?> weeks</span> |
                        <span>Level: <?php echo e($course['grade_id']); ?></span> |
                        <span>Price: Rs. <?php echo e($course['price']); ?></span>
                    </div>
                    <a href="/course/enroll" class="enroll-button">Enroll Now</a>
                </div>
            </div>
            <div class="teacher-section">
                <img src="/assets/images/user.jpeg" alt="John Doe" class="teacher-avatar">
                <div class="teacher-info">
                    <h3> <?php echo e($user['first_name']); ?> <?php echo e($user['last_name']); ?></h3>
                    <p><?php echo e($user['description']); ?></p>
                </div>
            </div>


            <div class="course-section">
                <h2 class="section-title">Course Description</h2>
                <p class="course-description">
                    <?php echo e($course['description']); ?>
                </p>
            </div>

            <div class="course-section">
                <h2 class="section-title">Current Content</h2>
                <p class="course-description">
                    <?php echo e($course['description']); ?>
                </p>
            </div>
            <div class="course-section">
                <h2 class="section-title">Past Content</h2>
                <div class="period-list">
                    <div class="period-item">
                        <div class="period-header">
                            <div class="period-title">
                                <h4>2024 Jan 01 - 2024 Jan 31</h4>
                            </div>
                            <div class="period-toggle">
                                <svg class="chevron-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </div>
                        </div>

                        <div class="period-content">
                            <h3>modules</h3>
                        </div>
                    </div>
                    <div class="period-item">
                        <div class="period-header">
                            <div class="period-title">
                                <h4>2024 Feb 01 - 2024 Feb 28</h4>
                            </div>
                            <div class="period-toggle">
                                <svg class="chevron-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </div>
                        </div>

                        <div class="period-content">
                            <h3>modules</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="course-section">
                <h2 class="section-title">Course Modules</h2>
                <div class="module-list">
                    <!-- Module 1 -->
                    <!-- <div class="module-item">
                        <div class="module-header" onclick="toggleModule(0)">
                            <div class="module-title">
                                <h4>Introduction to Python Programming</h4>
                                <span class="module-duration">4 hours</span>
                            </div>
                            <div class="module-toggle">
                                <svg class="chevron-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </div>
                        </div>

                        <div class="module-content" id="module-0">
                            <div class="module-description">
                                <p>Learn the fundamentals of Python programming including variables, data types, control structures, and basic syntax. This module provides a solid foundation for beginners.</p>
                            </div>

                            <div class="module-resources">
                                <h5>Resources</h5>
                                <ul>
                                    <li>
                                        <a href="#" class="resource-link">
                                            <span class="resource-icon">📄</span>
                                            Python Basics Handbook
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="resource-link">
                                            <span class="resource-icon">📄</span>
                                            Practice Exercises PDF
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="module-assignment">
                                <h5>Assignment</h5>
                                <div class="assignment-details">
                                    <p>Create a simple calculator program using Python that can perform basic arithmetic operations.</p>
                                    <div class="assignment-meta">
                                        <span class="deadline">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <polyline points="12 6 12 12 16 14"></polyline>
                                            </svg>
                                            Deadline: December 31, 2024
                                        </span>
                                    </div>
                                    <form class="assignment-upload" action="/submit-assignment" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="module_id" value="1">
                                        <div class="file-upload">
                                            <input type="file" name="assignment_file" id="assignment-1" required>
                                            <label for="assignment-1" class="file-label">
                                                Choose File
                                            </label>
                                        </div>
                                        <button type="submit" class="submit-assignment">Submit Assignment</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <!-- Module 2 -->
                    <!-- <div class="module-item">
                        <div class="module-header" onclick="toggleModule(1)">
                            <div class="module-title">
                                <h4>Object-Oriented Programming in Python</h4>
                                <span class="module-duration">6 hours</span>
                            </div>
                            <div class="module-toggle">
                                <svg class="chevron-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </div>
                        </div>

                        <div class="module-content" id="module-1">
                            <div class="module-description">
                                <p>Master object-oriented programming concepts including classes, objects, inheritance, and polymorphism in Python.</p>
                            </div>

                            <div class="module-resources">
                                <h5>Resources</h5>
                                <ul>
                                    <li>
                                        <a href="#" class="resource-link">
                                            <span class="resource-icon">📄</span>
                                            OOP Concepts Guide
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="resource-link">
                                            <span class="resource-icon">📄</span>
                                            Code Examples
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="module-assignment">
                                <h5>Assignment</h5>
                                <div class="assignment-details">
                                    <p>Design and implement a simple banking system using OOP principles.</p>
                                    <div class="assignment-meta">
                                        <span class="deadline">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <polyline points="12 6 12 12 16 14"></polyline>
                                            </svg>
                                            Deadline: January 15, 2025
                                        </span>
                                    </div>
                                    <div class="assignment-submitted">
                                        <span class="success-message">✓ Assignment submitted</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <!-- asfffff -->
                    <?php foreach ($modules as $module): ?>
                        <div class="module-item">
                            <div class="module-header" onclick="toggleModule(<?php echo e($module['module_id']); ?>)">
                                <div class="module-title">
                                    <h4><?php echo e($module['title']); ?></h4>
                                    <span class="module-duration">8 hours</span>
                                </div>
                                <div class="module-toggle">
                                    <svg class="chevron-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </div>
                            </div>

                            <div class="module-content" id="module-<?php echo e($module['module_id']); ?>">
                                <div class="module-description">
                                    <p><?php echo e($module['description']); ?></p>
                                </div>

                                <div class="module-resources">
                                    <h5>Resources</h5>
                                    <ul>
                                        <?php foreach ($moduleResources[$module['module_id']] as $resource): ?>
                                            <li>
                                                <a href="/course/<?php echo e($course['course_id']) ?>/module/<?php echo e($module['module_id']) ?>/resource/<?php echo e($resource['resource_id']) ?>" class="resource-link">
                                                    <span class="resource-icon">📄</span>
                                                    <?php echo e($resource['resource_path']) ?>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <!-- Assignments -->
                <div class="course-assignments">
                    <h2 class="section-title">Assignments</h2>

                    <?php foreach ($assignments as $item): ?>
                        <div class="assignment-item">
                            <div class="assignment-header" onclick="toggleAssignment(this)">
                                <h5><?php echo e($item['title']); ?>
                                    <span class="chevron-icon">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="6 9 12 15 18 9"></polyline>
                                        </svg>
                                    </span>
                                </h5>
                            </div>

                            <div class="assignment-content">
                                <div class="assignment-details">
                                    <p onclick="window.location.href='/courses/<?php echo e($course['course_id']); ?>/assignment/<?php echo e($item['assignment_id']); ?>'" style="cursor: pointer;"><?php echo e($item['instruction']); ?></p>
                                    <div class="assignment-meta">
                                        <span class="deadline">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <polyline points="12 6 12 12 16 14"></polyline>
                                            </svg>
                                            <?php echo e($item['deadline']); ?>
                                        </span>
                                    </div>
                                    <?php foreach ($assignmentsResources[$item['assignment_id']] as $resource): ?>
                                        <ul>
                                            <li>
                                                <a href="/assignment/<?php echo e($item['assignment_id']) ?>/resource/<?php echo e($resource['resource_id']) ?>" class="resource-link">
                                                    <span class="resource-icon">📄</span>
                                                    <?php echo e($resource['resource_path']) ?>
                                                </a>
                                            </li>
                                        </ul>
                                    <?php endforeach; ?>
                                    <form class="assignment-upload" action="/submit-assignment" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="module_id" value="1">
                                        <div class="file-upload">
                                            <input type="file" name="assignment_file" id="assignment-1" required>
                                            <label for="assignment-1" class="file-label">
                                                Choose File
                                            </label>
                                        </div>
                                        <button type="submit" class="submit-assignment" onclick="preventDefault();">Submit Assignment</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <!-- Assignment Item 1 -->
                    <div class="assignment-item">
                        <div class="assignment-header" onclick="toggleAssignment(this)">
                            <h5>Assignment 1: Basic Calculator Program
                                <span class="chevron-icon">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </span>
                            </h5>
                        </div>

                        <div class="assignment-content">
                            <div class="assignment-details">
                                <p>Create a simple calculator program using Python that can perform basic arithmetic operations.</p>
                                <div class="assignment-meta">
                                    <span class="deadline">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <polyline points="12 6 12 12 16 14"></polyline>
                                        </svg>
                                        Deadline: December 31, 2024
                                    </span>
                                </div>
                                <form class="assignment-upload" action="/submit-assignment" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="module_id" value="1">
                                    <div class="file-upload">
                                        <input type="file" name="assignment_file" id="assignment-1" required>
                                        <label for="assignment-1" class="file-label">
                                            Choose File
                                        </label>
                                    </div>
                                    <button type="submit" class="submit-assignment">Submit Assignment</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Assignment Item 2 -->
                    <div class="assignment-item">
                        <div class="assignment-header" onclick="toggleAssignment(this)">
                            <h5>Assignment 2: Banking System
                                <span class="chevron-icon">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </span>
                            </h5>
                        </div>

                        <div class="assignment-content">
                            <div class="assignment-details">
                                <p>Design and implement a simple banking system using OOP principles.</p>
                                <div class="assignment-meta">
                                    <span class="deadline">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <polyline points="12 6 12 12 16 14"></polyline>
                                        </svg>
                                        Deadline: January 15, 2025
                                    </span>
                                </div>
                                <div class="assignment-submitted">
                                    <span class="success-message">✓ Assignment submitted</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if (isset($_SESSION['user_role'])): ?>
            <?php if ($_SESSION['user_role'] === "teacher" || $_SESSION['user_role'] === "admin"): ?>

                <!-- <div class="course-section course-participant">
                    <h3>Course Participants</h3>
                    <div class="participant-dropdown">
                        <div class="participant-dropdown-content" id="participant-list">
                            <ul class="participant-list">
                                <li class="participant-item">
                                    <img src="/assets/images/user.jpeg" alt="User 1" class="participant-avatar">
                                    <span class="participant-name">Sachith Dhanushka</span>
                                </li>
                                <li class="participant-item">
                                    <img src="/assets/images/user.jpeg" alt="User 2" class="participant-avatar">
                                    <span class="participant-name">Dinuka Sahan</span>
                                </li>
                                <li class="participant-item">
                                    <img src="/assets/images/user.jpeg" alt="User 3" class="participant-avatar">
                                    <span class="participant-name">Isuru Naveen</span>
                                </li>
                                <li class="participant-item">
                                    <img src="/assets/images/user.jpeg" alt="User 4" class="participant-avatar">
                                    <span class="participant-name">Amanda Perera</span>
                                </li>
                                <li class="participant-item">
                                    <img src="/assets/images/user.jpeg" alt="User 1" class="participant-avatar">
                                    <span class="participant-name">Sachith Dhanushka</span>
                                </li>
                                <li class="participant-item">
                                    <img src="/assets/images/user.jpeg" alt="User 2" class="participant-avatar">
                                    <span class="participant-name">Dinuka Sahan</span>
                                </li>
                                <li class="participant-item">
                                    <img src="/assets/images/user.jpeg" alt="User 3" class="participant-avatar">
                                    <span class="participant-name">Isuru Naveen</span>
                                </li>
                                <li class="participant-item">
                                    <img src="/assets/images/user.jpeg" alt="User 4" class="participant-avatar">
                                    <span class="participant-name">Amanda Perera</span>
                                </li>
                                <button class="view-all-button" onclick="window.location.href = '/courses/<?php echo ($course['course_id']); ?>/participants'">View All</button>
                            </ul>
                        </div>
                        <button class="participant-dropdown-button" onclick="toggleParticipantList()">
                            View Participants <i class="fas fa-chevron-down dropdown-chevron"></i>
                        </button>
                    </div>
                </div> -->
            <?php endif; ?>
        <?php endif; ?>

    </div>
    <div>

    </div>
    <div class="course-section">
        <h2 class="section-title">Course Resources</h2>
        <ul class="resource-list">
            <li class="resource-item">
                <div class="resource-icon">📚</div>
                <p>Course Textbook</p>
            </li>
            <li class="resource-item">
                <div class="resource-icon">💻</div>
                <p>Coding Examples</p>
            </li>
            <li class="resource-item">
                <div class="resource-icon">🎥</div>
                <p>Video Tutorials</p>
            </li>
            <li class="resource-item">
                <div class="resource-icon">📝</div>
                <p>Practice Quizzes</p>
            </li>
        </ul>
    </div>

    <!-- Review Section -->
    <div class="course-section reviews-section">
        <h2 class="section-title">Student Reviews</h2>
        <div class="reviews-summary">
            <div class="overall-rating">
                <div class="rating-number">4.8</div>
                <div class="rating-stars">
                    <span class="star active">★</span>
                    <span class="star active">★</span>
                    <span class="star active">★</span>
                    <span class="star active">★</span>
                    <span class="star half-active">★</span>
                </div>
                <div class="rating-text">256 Total Reviews</div>
            </div>
            <div class="rating-breakdown">
                <div class="rating-bar">
                    <span class="rating-label">5 Stars</span>
                    <div class="progress-bar">
                        <div class="progress" style="width: 65%"></div>
                    </div>
                    <span class="rating-percentage">65%</span>
                </div>
                <div class="rating-bar">
                    <span class="rating-label">4 Stars</span>
                    <div class="progress-bar">
                        <div class="progress" style="width: 25%"></div>
                    </div>
                    <span class="rating-percentage">25%</span>
                </div>
                <div class="rating-bar">
                    <span class="rating-label">3 Stars</span>
                    <div class="progress-bar">
                        <div class="progress" style="width: 8%"></div>
                    </div>
                    <span class="rating-percentage">8%</span>
                </div>
                <div class="rating-bar">
                    <span class="rating-label">2 Stars</span>
                    <div class="progress-bar">
                        <div class="progress" style="width: 2%"></div>
                    </div>
                    <span class="rating-percentage">2%</span>
                </div>
            </div>
        </div>

        <div class="reviews-list">
            <?php
            $reviews = [
                [
                    'name' => 'Sachith Dhanushka',
                    'date' => 'November 20, 2024',
                    'rating' => 5,
                    'comment' => 'Absolutely amazing course! The instructor explains complex Python concepts in a very clear and understandable way. The assignments are challenging but help reinforce the learning.',
                    'avatar' => '/assets/images/user.jpeg'
                ],
                [
                    'name' => 'Dinuka Sahan',
                    'date' => 'November 15, 2024',
                    'rating' => 4,
                    'comment' => 'Great introduction to Python programming. The modules are well-structured, and the resources are helpful. Would recommend for beginners.',
                    'avatar' => '/assets/images/user.jpeg'
                ],
                [
                    'name' => 'Isuru Naveen',
                    'date' => 'November 10, 2024',
                    'rating' => 5,
                    'comment' => 'Comprehensive course that covers everything from basics to advanced Python concepts. The OOP module was particularly enlightening.',
                    'avatar' => '/assets/images/user.jpeg'
                ]
            ];

            foreach ($reviews as $review): ?>
                <div class="review-item">
                    <div class="review-header">
                        <img src="<?php echo htmlspecialchars($review['avatar']); ?>" alt="<?php echo htmlspecialchars($review['name']); ?>" class="review-avatar">
                        <div class="review-meta">
                            <span class="review-name"><?php echo htmlspecialchars($review['name']); ?></span>
                            <span class="review-date"><?php echo htmlspecialchars($review['date']); ?></span>
                        </div>
                        <div class="review-rating">
                            <?php
                            for ($i = 1; $i <= 5; $i++) {
                                echo $i <= $review['rating']
                                    ? '<span class="star active">★</span>'
                                    : '<span class="star">★</span>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="review-body">
                        <p><?php echo htmlspecialchars($review['comment']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>


    <script src="/assets/js/courses/course-info.js" defer></script>
    <!-- TODO: Move this script to course-info.js. Do not use inline functions -->
    <script>
        function toggleModule(index) {
            const moduleContent = document.getElementById(`module-${index}`);
            const moduleItem = moduleContent.parentElement;
            const chevron = moduleItem.querySelector('.chevron-icon');

            moduleContent.classList.toggle('active');
            moduleItem.classList.toggle('expanded');
            chevron.classList.toggle('rotated');
        }

        function toggleParticipantList() {
            const participantList = document.getElementById('participant-list');
            participantList.classList.toggle('active');

            document.querySelector('.dropdown-chevron').classList.toggle('rotated');
        }

        function viewAllParticipants() {
            alert('Redirecting to view all participants...');
            // Add logic here to redirect or display all participants
        }

        function viewAllParticipants() {
            // Redirect to a page or open a modal displaying all participants
            window.location.href = '/course/participants';
        }

        function toggleAssignment(headerElement) {
            const assignmentItem = headerElement.closest('.assignment-item');
            const content = assignmentItem.querySelector('.assignment-content');
            const chevron = headerElement.querySelector('.chevron-icon');

            content.classList.toggle('active');
            chevron.classList.toggle('rotated');
        }
    </script>
</section>

<?php include $this->resolve("partials/_footer.php"); ?>