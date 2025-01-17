<?php include $this->resolve("partials/_header.php"); ?>

<head>
    <link rel="stylesheet" href="/assets/styles/User/my-courses.css">
</head>

<section class="courses-page">
    <div class="main-container">
        <div class="main-title">
            <h1>My Courses</h1>
        </div>

        <div class="admin-header">
            <div class="header-actions">
                <div class="search-form">
                    <input type="text" class="search-input" id="searchInput" placeholder="Search users...">
                    <button class="search-btn" onclick="searchUsers()">Search</button>
                </div>
                <?php if ($_SESSION['user_role'] === "admin" || $_SESSION['user_role'] === "teacher"): ?>
                    <button class="add-user-btn" onclick="toggleModal()"><a href="/course/create" style="text-decoration: none;"> Add New Course </a></button>
                <?php endif; ?>
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
                                    <a href="/manage-course/edit/<?php echo e($courseData['course_id']); ?>" onclick="event.stopPropagation();" class="btn btn-edit">Edit</a>
                                    <button onclick="event.stopPropagation(); showModal()" class="btn btn-delete">Delete</button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Delete confirmation modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Confirm Delete</h3>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this course? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button onclick="hideModal()" class="btn btn-cancel">Cancel</button>
                <form method="POST" action="/manage-course/delete/<?php echo e($courseData['course_id']) ?>">
                    <?php include $this->resolve("partials/_csrf.php"); ?>
                    <input type="hidden" name="_METHOD" value="DELETE" />
                    <button type="submit" class="btn btn-delete">Delete</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const modal = document.getElementById('deleteModal');

        function showModal() {
            modal.style.display = 'block';
            document.body.style.overflow = 'hidden';
        }

        function hideModal() {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target === modal) {
                hideModal();
            }
        }

        // Close modal on escape key press
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && modal.style.display === 'block') {
                hideModal();
            }
        });
    </script>
</section>
<?php include $this->resolve("partials/_footer.php"); ?>