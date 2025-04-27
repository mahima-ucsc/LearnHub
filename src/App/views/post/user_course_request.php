<?php include $this->resolve('partials/_header.php'); ?>
<?php include $this->resolve('User/sidebar.php'); ?>

<link rel="stylesheet" href="/assets/styles/Post/user_course_request.css">
<div class="course-container">
    <h1 class="dashboard-title">Manage your post</h1>

    <!-- Courses Table -->
    <div class="table-container">
        <div class="table-header">
            <h2 class="table-title">Your Posts</h2>
            <div class="search-container">
                <form>

                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search posts..." class="search-input" id="searchInput" name="s" value="<?php echo ($_GET['s']); ?>">
                </form>
            </div>
        </div>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Comments</th>
                        <th>Posted on</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="CourseTableBody">
                    <!-- Courses will be added dynamically -->
                    <?php if (empty($posts)): ?>
                        <tr>
                            <td colspan="8">No courses can be found</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($posts as $post): ?>
                            <tr>
                                <td><?php echo e($post['title']); ?></td>
                                <td><?php echo e(substr($post['description'], 0, 30) . (strlen($post['description']) > 30 ? '...' : '')); ?></td>
                                <td>42</td>
                                <td><?php echo e(formatDate($post["created_date"], 'F j, Y')); ?></td>
                                <td>
                                    <button class="action-btn btn-edit" onclick="window.location.href='/course/request/edit/<?php echo e($post['request_id']) ?>'">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn btn-delete" onclick="event.stopPropagation(); showModal('/course/request/<?php echo e($post['request_id']) ?>')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <button class="action-btn btn-view"
                                        onclick="window.location.href='/course/request/<?php echo e($post['request_id']) ?>'">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php include $this->resolve('components/delete_modal.php'); ?>

</div>

<script>
</script>
<?php include $this->resolve('partials/_footer.php'); ?>