<?php include $this->resolve('partials/_header.php'); ?>
<?php include $this->resolve('User/sidebar.php'); ?>

<style>
    :root {
        --theme-color: #FFC400;
        --theme-dark: #e6b000;
        --theme-light: #FFE082;
        --text-dark: #2C3E50;
        --text-light: #666;
        --bg-light: #f8f9fa;
        --success: #2ECC71;
        --warning: #F39C12;
        --danger: #E74C3C;
        --white: #ffffff;
        --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }


    .course-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 2rem;
    }

    .dashboard-title {
        margin-bottom: 2rem;
        color: var(--text-dark);
        border-left: 5px solid var(--theme-color);
        padding-left: 1rem;
    }

    /* Stats Cards */
    .stats-container {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: var(--white);
        border-radius: 0.5rem;
        padding: 1.5rem;
        box-shadow: var(--shadow);
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: var(--theme-light);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
    }

    .stat-icon i {
        color: var(--theme-dark);
        font-size: 1.5rem;
    }

    .stat-value {
        font-size: 1.75rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        color: var(--text-light);
        font-size: 0.9rem;
    }

    /* Table Styles */
    .table-container {
        background: var(--white);
        border-radius: 0.5rem;
        box-shadow: var(--shadow);
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .table-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 1.5rem;
        border-bottom: 1px solid var(--bg-light);
    }

    .table-title {
        font-size: 1.25rem;
        color: var(--text-dark);
    }

    .search-container {
        display: flex;
        align-items: center;
        background: var(--bg-light);
        border-radius: 2rem;
        padding: 0.5rem 1rem;
    }

    .search-input {
        border: none;
        background: transparent;
        outline: none;
        padding-left: 0.5rem;
        color: var(--text-dark);
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead {
        background: var(--bg-light);
    }

    th,
    td {
        padding: 1rem;
        text-align: left;
    }

    th {
        font-weight: 600;
        color: var(--text-dark);
    }

    tr:not(:last-child) {
        border-bottom: 1px solid var(--bg-light);
    }

    .course-status {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 1rem;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .status-active {
        background: rgba(46, 204, 113, 0.2);
        color: var(--success);
    }

    .status-draft {
        background: rgba(243, 156, 18, 0.2);
        color: var(--warning);
    }

    .action-btn {
        padding: 0.5rem;
        border-radius: 0.25rem;
        border: none;
        cursor: pointer;
        transition: background 0.3s;
        margin-right: 0.5rem;
    }

    .btn-edit {
        background: var(--theme-light);
        color: var(--theme-dark);
    }

    .btn-delete {
        background: rgba(231, 76, 60, 0.1);
        color: var(--danger);
    }

    .btn-view {
        background: rgba(40, 204, 113, 0.1);
        color: var(--success);
    }

    .btn-edit:hover {
        background: var(--theme-color);
    }

    .btn-delete:hover {
        background: rgba(231, 76, 60, 0.2);
    }


    @media (max-width: 1024px) {
        .stats-container {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .container {
            padding: 1rem;
        }

        .table-responsive {
            overflow-x: auto;
        }
    }

    @media (max-width: 480px) {
        .stats-container {
            grid-template-columns: 1fr;
        }
    }
</style>
<div class="course-container">
    <h1 class="dashboard-title">Manage your post</h1>

    <!-- Stats Cards -->
    <div class="stats-container">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-book"></i>
            </div>
            <div class="stat-value" id="totalCourses"><?php echo e($courseCount); ?></div>
            <div class="stat-label">Total Posts</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fa-solid fa-comment"></i>
            </div>
            <div class="stat-value" id="totalRevenue">
                <php echo e($revenue); ?>
            </div>
            <div class="stat-label">Total Comments</div>
        </div>
    </div>

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