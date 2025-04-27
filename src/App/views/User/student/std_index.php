<?php include $this->resolve('partials/_header.php') ?>
<link rel="stylesheet" href="/assets/styles/Course/courses.css">
<link rel="stylesheet" href="/assets/styles/User/Student/dashboard.css">

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
                        <?php foreach ($courses as $course): ?>
                            <a href="/courses/<?php echo e($course['course_id']); ?>" class="course-card-link">
                                <div class="course-card">

                                    <div class="course-image">
                                        <img src="/storage/uploads/courses/thumbnails/<?php echo e($course['thumbnail_url']) ?>" alt="">
                                        <span class="course-location"><?php echo e($course['day']) ?></span>
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
                                        <div class="course-time">
                                            <i class="fas fa-clock"></i>
                                            <span><?php echo e(date('h:i A', strtotime($course['start_time']))); ?> - <?php echo e(date('h:i A', strtotime($course['end_time']))); ?></span>
                                        </div>
                                        <div class="instructor-info">
                                            <div class="instructor-avatar">
                                                <i class="fas fa-user"></i>
                                            </div>
                                            <span><?php echo e($course['teacher']) ?></span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </section>
            <section class="recommended-section">
                <h2 class="section-title">Suggessions for you</h2>
                <div class="courses-grid">
                    <?php foreach ($suggestedCourses as $course): ?>
                        <a href="/courses/<?php echo e($course['course_id']); ?>" class="course-card-link">
                            <div class="course-card">

                                <div class="course-image">
                                    <img src="/storage/uploads/courses/thumbnails/<?php echo e($course['thumbnail_url']) ?>" alt="">
                                    <span class="course-location"><?php echo e($course['day']) ?></span>
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
                                    <div class="course-time">
                                        <i class="fas fa-clock"></i>
                                        <span><?php echo e(date('h:i A', strtotime($course['start_time']))); ?> - <?php echo e(date('h:i A', strtotime($course['end_time']))); ?></span>
                                    </div>
                                    <div class="instructor-info">
                                        <div class="instructor-avatar">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <span><?php echo e($course['teacher']) ?></span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                    <div class="courses-grid">
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
<?php include $this->resolve('partials/_footer.php') ?>