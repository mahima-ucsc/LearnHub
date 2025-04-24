<?php include $this->resolve('partials/_header.php'); ?>
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
<?php include $this->resolve('User/sidebar.php'); ?>
<div class="course-container">
    <h1 class="dashboard-title">Course Management</h1>

    <!-- Stats Cards -->
    <div class="stats-container">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-book"></i>
            </div>
            <div class="stat-value" id="totalCourses"><?php echo e($resourceCount); ?></div>
            <div class="stat-label">Total Resources</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="stat-value" id="totalRevenue">Rs. <?php echo e($revenue); ?></div>
            <div class="stat-label">Total Revenue</div>
        </div>
    </div>

    <!-- Courses Table -->
    <div class="table-container">
        <div class="table-header">
            <div class="search-container">
                <form>

                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search courses..." class="search-input" id="searchInput" name="s" value="<?php echo ($_GET['s']); ?>">
                    <input type="hidden" name="p" value="1">

                </form>
            </div>
            <form>
                <input type="hidden" name="p" value="1">
                <input type="hidden" name="s" value="<?= $_GET['s'] ?>">
                <select name="status">
                    <option value="all">All</option>
                    <option value="pending" <?= $_GET['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="approved" <?= $_GET['status'] == 'approved' ? 'selected' : '' ?>>Approved</option>
                    <option value="rejected" <?= $_GET['status'] == 'rejected' ? 'selected' : '' ?>>Rejected</option>
                </select>
                <button type="submit" class="">
                    Apply Filter
                </button>
            </form>
            <a href="/resource-managment">Clear Filters</a>
        </div>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="courseTableBody">
                    <!-- Courses will be added dynamically -->
                    <?php if (empty($resources)): ?>
                        <tr>
                            <td colspan="8">No Resource can be found</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($resources as $resource): ?>
                            <tr>
                                <td><?php echo e($resource['title']); ?></td>
                                <td><?php echo e($resource['username']) ?></td>
                                <td><?= $resource['is_free'] === 1 ? "Free" : e($resource['price']); ?></td>
                                <td><span class="course-status status-${course.status}"><?php echo e($resource['status']) ?></span></td>
                                <td style="display: flex; flex-wrap: nowrap;">
                                    <?php if (($resource['status'] == 'pending') || ($resource['status'] == 'rejected')): ?>
                                        <form method="POST" action="/resource-managment/approve/<?= e($resource['resource_id']); ?>" onsubmit="showLoader()">
                                            <button type="submit" class="action-btn btn-edit">
                                                <i class="fa-solid fa-circle-check"></i>
                                                Approve
                                            </button>
                                            <input type="hidden" name="approve" value="1" />
                                        </form>
                                    <?php else: ?>
                                        <form method="POST" action="/resource-managment/reject/<?= e($resource['resource_id']); ?>" onsubmit="showLoader()">
                                            <button type="submit" class="action-btn btn-delete">
                                                <i class="fas fa-trash"></i>
                                                Reject
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                    <button class="action-btn btn-delete" onclick="event.stopPropagation(); showModal('/resource-managment/delete/<?= e($resource['resource_id']); ?>')">
                                        <i class="fas fa-trash"></i>
                                        Delete
                                    </button>
                                    <button class="action-btn btn-view"
                                        onclick="window.location.href='/courses/<?php echo e($course['course_id']) ?>)'">
                                        <i class="fa-solid fa-eye"></i>
                                        view
                                    </button>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php include $this->resolve('components/pagination.php'); ?>

    </div>

    <?php include $this->resolve('components/delete_modal.php'); ?>

</div>

<script>
</script>
<?php include $this->resolve('partials/_footer.php'); ?>