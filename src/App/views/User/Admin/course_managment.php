<section class="courses-page">
    <div class="main-container">
        <!-- <div class="main-title">
                        <h1>My Courses</h1>
                    </div> -->

        <div class="admin-header">
            <h1>Course Management</h1>
            <div class="header-actions">
                <div class="search-form">
                    <input type="text" class="search-input" id="searchInput" placeholder="Search users...">
                    <button class="search-btn" onclick="searchUsers()">Search</button>
                </div>
                <button class="add-user-btn" onclick="toggleModal()"><a href="/course/create" style="text-decoration: none;"> Add New Course </a></button>
            </div>
        </div>

        <div class="table-container">
            <table class="courses-table">
                <thead>
                    <tr>
                        <th>Course</th>
                        <th>Students</th>
                        <th>Time</th>
                        <th>Revenue</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($courses as $courseData): ?>
                        <tr onclick="window.location.href='/courses/my-courses/<?php echo e($courseData['course_id']) ?>';" style="cursor: pointer;">
                            <td>
                                <div class="course-name">
                                    <?php echo e($courseData['title']) ?>
                                    <span class="grade-badge">Grade <?php echo e($courseData['grade_id']) ?></span>
                                </div>
                            </td>
                            <td>
                                <span class="students-count">24 students</span>
                            </td>
                            <td>
                                <div class="time-slot">
                                    <i class="fas fa-clock"></i>
                                    <?php
                                    $start = date('g:i A', strtotime($courseData['start_time']));
                                    $end = date('g:i A', strtotime($courseData['end_time']));
                                    ?>
                                    <span><?php echo e($start) ?> - <?php echo e($end) ?></span>
                                    <span class="day-badge"><?php echo e($courseData['day']) ?></span>
                                </div>
                            </td>
                            <td>
                                <span class="revenue">Rs. <?php echo e($courseData['price'] * 24) ?></span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="/manage-course/edit/<?php echo e($courseData['course_id']); ?>" class="btn btn-edit">Edit</a>
                                    <button onclick="event.stopPropagation(); showModal('/manage-course/delete/<?php echo e($courseData['course_id']) ?>')" class="btn btn-delete">Delete</button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php include $this->resolve('modals/delete_modal.php'); ?>

</section>