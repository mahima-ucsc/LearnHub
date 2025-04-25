<?php include $this->resolve('partials/_header.php') ?>

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
        --sidebar-width: 260px;
        --sidebar-collapsed-width: 0px;
        --header-height: 60px;
    }


    .user-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .menu-toggle {
        /* background: none; */
        background-color: #2ECC71;
        border: none;
        color: var(--text-dark);
        font-size: 1.2rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: auto 0;
        transition: transform 0.3s;
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }

    .menu-toggle:hover {
        background-color: var(--bg-light);
    }

    .menu-toggle.active {
        transform: rotate(180deg);
    }

    /* Main Content */
    .user-main-content {
        margin-left: 0;
        padding-top: calc(var(--header-height) + 2rem);
        transition: margin-left 0.3s ease;
        min-height: 100vh;
    }

    .user-main-content.shifted {
        margin-left: var(--sidebar-width);
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

    /* Users Table */
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

    .add-usr-btn {
        background-color: white;
        border: 1px solid #FFC400;
        border-radius: 20px;
        padding: 10px 20px;
        cursor: pointer;
    }

    .table-title {
        font-size: 1.25rem;
        color: var(--text-dark);
    }

    .filter-section {
        display: flex;
        gap: 16px;
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

    .user-info {
        display: flex;
        align-items: center;
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--theme-light);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        color: var(--theme-dark);
        font-weight: bold;
    }

    .user-details {
        display: flex;
        flex-direction: column;
    }

    .user-name {
        font-weight: 500;
    }

    .user-email {
        font-size: 0.85rem;
        color: var(--text-light);
    }

    .user-role {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 1rem;
        font-size: 0.85rem;
        font-weight: 500;
        background: var(--bg-light);
    }

    .role-admin {
        background: var(--theme-light);
        color: var(--theme-dark);
    }

    .role-teacher {
        background: rgba(46, 204, 113, 0.2);
        color: var(--success);
    }

    .role-student {
        background: rgba(52, 152, 219, 0.2);
        color: #3498db;
    }

    .action-btn {
        padding: 0.5rem;
        border-radius: 0.25rem;
        border: none;
        cursor: pointer;
        transition: background 0.3s;
    }

    .btn-delete {
        background: rgba(231, 76, 60, 0.1);
        color: var(--danger);
    }

    .btn-delete:hover {
        background: rgba(231, 76, 60, 0.2);
    }

    .pagination {
        display: flex;
        justify-content: flex-end;
        padding: 1rem 1.5rem;
        align-items: center;
    }

    .page-btn {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 0.25rem;
        cursor: pointer;
        transition: background 0.3s;
    }

    .page-btn:hover {
        background: var(--bg-light);
    }

    .active-page {
        background: var(--theme-color);
        color: var(--white);
    }

    .active-page:hover {
        background: var(--theme-dark);
    }


    /* Responsive */
    @media (max-width: 1024px) {
        .stats-container {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .table-responsive {
            overflow-x: auto;
        }

        .header-content {
            align-items: center;
        }


        .table-header {
            flex-direction: column;
            gap: 1rem;
        }

        .search-container {
            width: 100%;
        }

        .user-main-content.shifted {
            margin-left: 0;
        }

        .sidebar.active {
            left: 0;
            width: 100%;
        }
    }

    @media (max-width: 480px) {
        .stats-container {
            grid-template-columns: 1fr;
        }

        .btn {
            width: 100%;
        }

    }
</style>



<?php include $this->resolve('User/sidebar.php') ?>

<!-- Main Content -->
<main class="user-main-content" id="mainContent">

    <div class="user-container">
        <h1 class="dashboard-title">User Management</h1>

        <!-- Stats Cards -->
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-value" id="totalUsers"><?php echo ((int)$totalUsers['students'] + (int)$totalUsers['teachers']) ?></div>
                <div class="stat-label">Total Users</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-user-shield"></i>
                </div>
                <div class="stat-value" id="adminCount"><?php echo e($totalUsers['admin']); ?></div>
                <div class="stat-label">Admins</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-user-edit"></i>
                </div>
                <div class="stat-value" id="editorCount"><?php echo e($totalUsers['students']); ?></div>
                <div class="stat-label">Students</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-user"></i>
                </div>
                <div class="stat-value" id="regulartotalUsers"><?php echo e($totalUsers['teachers']); ?></div>
                <div class="stat-label">Teachers</div>
            </div>
        </div>

        <!-- Users Table -->
        <div class="table-container">
            <div class="table-header">
                <h2 class="table-title">Registered Users</h2>
                <button onclick="openPopup()" class="add-usr-btn">
                    <span class="menu-icon"><i class="fas fa-user-plus"></i></span>
                    Add User
                </button>
                <form method="GET" class="filter-form">
                    <div class="filter-section">
                        <select name="role" class="select-user-role">
                            <option value="all">Select user role</option>
                            <option value="student" <?= isset($_GET['role']) && $_GET['role'] == 'student' ? 'selected' : ''; ?>>Student</option>
                            <option value="teacher" <?= isset($_GET['role']) && $_GET['role'] == 'teacher' ? 'selected' : ''; ?>>Teacher</option>
                            <option value="admin" <?= isset($_GET['role']) && $_GET['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                        </select>
                        <div class="search-container">
                            <i class="fas fa-search"></i>
                            <input type="text" name="s" placeholder="Search users..." class="search-input" id="searchInput" value="<?php echo ($_GET['s']); ?>">
                        </div>
                    </div>
                </form>
            </div>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>User</th>
                            <th>Joined Date</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="userTableBody">
                        <?php foreach ($users as $user): ?>
                            <tr>

                                <td><?php echo e($user['user_id']) ?></td>
                                <td>
                                    <div class="user-info">
                                        <div class="user-avatar"><?php echo e($user['first_name'][0]); ?> <?php echo e($user['last_name'][0]); ?></div>
                                        <div class="user-details">
                                            <div class="user-name"><?php echo e($user['first_name']) ?> <?php echo e($user['last_name']) ?></div>
                                            <div class="user-email"><?php echo e($user['email']) ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td><?php echo formatDate($user['joined_date'], 'Y M j') ?></td>
                                <td>
                                    <span class="user-role role-<?php echo e($user['user_role']) ?>"><?php echo e($user['user_role']) ?></span>
                                </td>
                                <td>
                                    <?php if ($user['user_id'] != $_SESSION['user']): ?>
                                        <button class="action-btn btn-delete" data-id="<?php echo e($user['user_id']) ?>" onclick="event.stopPropagation();showModal('/user/delete/<?php echo e($user['user_id']) ?>')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
                <?php include $this->resolve('components/pagination.php'); ?>
            </div>
            <div class="pagination" id="pagination">
                <!-- Pagination will be added dynamically -->
            </div>
        </div>
    </div>
</main>
<script>
    const form = document.querySelector('.filter-form');
    document.querySelector(".select-user-role").addEventListener('change', () => {
        form.submit();
    });
</script>
<?php include $this->resolve('components/delete_modal.php'); ?>