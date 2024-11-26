<?php include $this->resolve("partials/_header.php"); ?>

<head>
    <link rel="stylesheet" href="/assets/styles/Course/course-info.css">

</head>

<section class="course-info-container">
    <div class="course-page-wrapper">
        <!-- <div class="student-sidebar">
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
        </div> -->
        <div class="main-content">
            <div class="course-header">
                <h1 class="course-info-title"> ICT 2026 A/L</h1>
                <div class="course-meta">
                    <div class="course-rating">★★★★★ 4.8 (256 reviews)</div>
                    <div class="course-info">
                        <span>Duration: 4 weeks</span> |
                        <span>Level: Grade 12</span> |
                        <span>Price: Rs. 1500</span>
                    </div>
                    <a href="/course/enroll" class="enroll-button">Register Now</a>
                </div>
            </div>
            <div class="teacher-section">
                <img src="/assets/images/user.jpeg" alt="John Doe" class="teacher-avatar">
                <div class="teacher-info">
                    <h3> Isuru Naveen</h3>
                    <p>Senior Developer with 10+ years of experience. Passionate about teaching and helping others master Python programming.</p>
                </div>
            </div>


            <div class="course-section">
                <h2 class="section-title">Course Description</h2>
                <p class="course-description">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eveniet ipsum eum voluptates? Impedit suscipit temporibus error voluptatum, explicabo, quis, earum iure natus deserunt voluptate numquam et accusamus magnam ipsa fugiat. Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe facere sapiente nisi distinctio temporibus. Dignissimos reprehenderit eligendi debitis aspernatur cupiditate vero error fugiat, corporis voluptatem natus, dolorem voluptatum! Magni, qui.
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