<?php include $this->resolve("partials/_header.php"); ?>

<head>
    <link rel="stylesheet" href="/assets/styles/Course/course-info.css">

</head>

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
                    <p>Senior Developer with 10+ years of experience. Passionate about teaching and helping others master Python programming.</p>
                </div>
            </div>


            <div class="course-section">
                <h2 class="section-title">Course Description</h2>
                <p class="course-description">
                    <?php echo e($course['description']); ?>
                </p>
            </div>

            <div class="course-section">
                <h2 class="section-title">Course Modules</h2>
                <div class="module-list">
                    <!-- Module 1 -->
                    <div class="module-item">
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
                    </div>

                    <!-- Module 2 -->
                    <div class="module-item">
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
                    </div>

                    <!-- Module 3 -->
                    <div class="module-item">
                        <div class="module-header" onclick="toggleModule(2)">
                            <div class="module-title">
                                <h4>Advanced Python Concepts</h4>
                                <span class="module-duration">8 hours</span>
                            </div>
                            <div class="module-toggle">
                                <svg class="chevron-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </div>
                        </div>

                        <div class="module-content" id="module-2">
                            <div class="module-description">
                                <p>Explore advanced Python features including decorators, generators, context managers, and metaclasses.</p>
                            </div>

                            <div class="module-resources">
                                <h5>Resources</h5>
                                <ul>
                                    <li>
                                        <a href="#" class="resource-link">
                                            <span class="resource-icon">📄</span>
                                            Advanced Python PDF
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="resource-link">
                                            <span class="resource-icon">📄</span>
                                            Programming Exercises
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="student-sidebar">
            <div class="student-list-section">
                <h2 class="section-title">Course Participants</h2>
                <ul class="student-list">
                    <li class="student-item">
                        <img src="/assets/images/user.jpeg" alt="Student Avatar" class="student-avatar">
                        <div class="student-details">
                            <span class="student-name">Sachith Dhanushka</span>
                            <span class="student-registered-date">Registered: Nov 15, 2024</span>
                        </div>
                    </li>
                    <li class="student-item">
                        <img src="/assets/images/user.jpeg" alt="Student Avatar" class="student-avatar">
                        <div class="student-details">
                            <span class="student-name">Dinuka Sahan</span>
                            <span class="student-registered-date">Registered: Nov 10, 2024</span>
                        </div>
                    </li>
                    <li class="student-item">
                        <img src="/assets/images/user.jpeg" alt="Student Avatar" class="student-avatar">
                        <div class="student-details">
                            <span class="student-name">Isuru Naveen</span>
                            <span class="student-registered-date">Registered: Nov 5, 2024</span>
                        </div>
                    </li>
                </ul>
                <button class="see-more-students" onclick="window.location.href='/courses/my-courses/<?php echo e($course['course_id']); ?>/participant';">See All Participants</button>
            </div>
        </div>
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


    <script>
        function toggleModule(index) {
            const moduleContent = document.getElementById(`module-${index}`);
            const moduleItem = moduleContent.parentElement;
            const chevron = moduleItem.querySelector('.chevron-icon');

            moduleContent.classList.toggle('active');
            moduleItem.classList.toggle('expanded');
            chevron.classList.toggle('rotated');
        }
    </script>
</section>