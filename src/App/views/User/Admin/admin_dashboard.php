<?php include $this->resolve('User/sidebar.php'); ?>
<?php include $this->resolve("partials/_header.php"); ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        --header-height: 55px;
    }

    /* Layout */
    .dashboard-container {
        margin: 0 auto;
        transition: margin-left 0.3s ease;
        padding: 20px;
        max-width: 1200px;
    }

    .sidebar.active~.dashboard-container {
        margin-left: var(--sidebar-width);
    }

    /* Header Styles */
    .dashboard-header {
        margin-bottom: 24px;
        padding: 20px;
        border-radius: 8px;
    }

    .dashboard-title {
        font-size: 28px;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 8px;
    }

    .dashboard-subtitle {
        font-size: 16px;
        color: var(--text-light);
    }

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background-color: var(--white);
        border-radius: 12px;
        padding: 20px;
        box-shadow: var(--shadow);
        display: flex;
        flex-direction: column;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .stat-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: var(--white);
    }

    .icon-users {
        background-color: var(--theme-color);
    }

    .icon-courses {
        background-color: var(--success);
    }

    .icon-revenue {
        background-color: var(--warning);
    }

    .icon-requests {
        background-color: var(--danger);
    }

    .stat-value {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .stat-label {
        font-size: 14px;
        color: var(--text-light);
        margin-bottom: 8px;
    }

    .stat-trend {
        display: flex;
        align-items: center;
        font-size: 13px;
    }

    .trend-up {
        color: var(--success);
    }

    .trend-down {
        color: var(--danger);
    }

    .trend-icon {
        margin-right: 4px;
    }

    /* Section Styles */
    .dashboard-section {
        margin-bottom: 30px;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }

    .admin-section {
        font-size: 20px;
        font-weight: 600;
        color: var(--text-dark);
    }

    .section-action {
        color: var(--theme-color);
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        display: flex;
        align-items: center;
        justify-content: end;
    }

    .section-action i {
        margin-left: 5px;
    }

    /* Quick Links */
    .quick-links-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
    }

    .quick-link-card {
        background-color: var(--white);
        border-radius: 12px;
        padding: 20px;
        box-shadow: var(--shadow);
        text-align: center;
        transition: all 0.3s ease;
        text-decoration: none;
        color: var(--text-dark);
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .quick-link-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        color: var(--theme-color);
    }

    .quick-link-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: var(--theme-light);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: var(--theme-dark);
        margin-bottom: 12px;
        transition: all 0.3s ease;
    }

    .quick-link-card:hover .quick-link-icon {
        background-color: var(--theme-color);
        color: var(--white);
    }

    .quick-link-title {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .quick-link-desc {
        font-size: 13px;
        color: var(--text-light);
    }

    /* Dashboard Grid */
    .dashboard-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
        margin-bottom: 30px;
    }

    /* Insights Card */
    .insights-card {
        background: var(--white);
        border-radius: 1rem;
        padding: 2rem;
        box-shadow: var(--shadow);
    }

    .chart-container {
        background: var(--white);
        border-radius: 1rem;
        padding: 2rem;
        box-shadow: var(--shadow);
    }

    .insight-item {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        padding: 1.5rem;
        border-bottom: 1px solid var(--bg-light);
        transition: transform 0.3s;
    }

    .insight-item:hover {
        transform: translateX(5px);
    }

    .insight-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--white);
        font-size: 1.5rem;
    }

    .insight-content {
        flex: 1;
    }

    .insight-content h3 {
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
        color: var(--text-dark);
    }

    /* Recent Activity */
    .recent-activity {
        background-color: var(--white);
        border-radius: 12px;
        padding: 20px;
        box-shadow: var(--shadow);
    }

    .activity-item {
        padding: 12px 0;
        display: flex;
        align-items: center;
        border-bottom: 1px solid var(--bg-light);
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-icon {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        font-size: 14px;
    }

    .activity-icon.user {
        background-color: var(--theme-light);
        color: var(--theme-dark);
    }

    .activity-icon.course {
        background-color: #d1f7e6;
        color: var(--success);
    }

    .activity-icon.payment {
        background-color: #fff3cd;
        color: var(--warning);
    }

    .activity-icon.request {
        background-color: #f8d7da;
        color: var(--danger);
    }

    .activity-content {
        flex-grow: 1;
    }

    .activity-title {
        font-size: 15px;
        font-weight: 500;
        margin-bottom: 4px;
    }

    .activity-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .activity-text {
        font-size: 13px;
        color: var(--text-light);
    }

    .activity-time {
        font-size: 12px;
        color: var(--text-light);
    }

    /* Chart container */
    .chart-wrapper {
        height: 300px;
        position: relative;
    }

    /* Responsive adjustments */
    @media (max-width: 992px) {
        .dashboard-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: repeat(auto-fill, minmax(calc(50% - 10px), 1fr));
        }
    }

    @media (max-width: 480px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
    }
</style>


<div class="dashboard-container">
    <header class="dashboard-header">
        <h1 class="dashboard-title">Admin Dashboard</h1>
        <p class="dashboard-subtitle">Welcome back! Here's what's happening with your platform.</p>
    </header>

    <!-- Stats overview -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-header">
                <div class="stat-icon icon-users">
                    <i class="fas fa-users"></i>
                </div>
            </div>
            <div class="stat-value"><?= ($totalUsers) ?></div>
            <div class="stat-label">Total Users</div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div class="stat-icon icon-courses">
                    <i class="fas fa-book"></i>
                </div>
            </div>
            <div class="stat-value"><?= e($totalCourses); ?></div>
            <div class="stat-label">Active Courses</div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div class="stat-icon icon-revenue">
                    <i class="fas fa-chart-line"></i>
                </div>
            </div>
            <div class="stat-value">Rs.<?= e($totalRevenue); ?></div>
            <div class="stat-label">Total Revenue</div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div class="stat-icon icon-requests">
                    <i class="fas fa-clipboard-list"></i>
                </div>
            </div>
            <div class="stat-value">18</div>
            <div class="stat-label">Pending Requests</div>
        </div>
    </div>

    <!-- User Distribution & Stats Section -->
    <div class="dashboard-grid">
        <!-- User Distribution Pie Chart -->
        <div class="chart-container">
            <h2 class="admin-section">User Distribution</h2>
            <div class="chart-wrapper">
                <canvas id="userDistributionChart"></canvas>
            </div>
        </div>
        <div class="insights-card">
            <h2 class="admin-section">User Statistics</h2>
            <div class="insight-item">
                <div class="insight-icon" style="background: rgba(54, 162, 235, 0.2); color: rgba(54, 162, 235, 1)">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <div class="insight-content">
                    <h3>Students</h3>
                    <p class="student-stat" data-student="<?php echo $stat['users']['students'] ?? 0; ?>">
                        <?php echo $stat['users']['students'] ?? 0; ?> students
                    </p>
                </div>
            </div>
            <div class="insight-item">
                <div class="insight-icon" style="background: rgba(46, 204, 113, 0.2); color: #2ECC71">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <div class="insight-content">
                    <h3>Teachers</h3>
                    <p class="teacher-stat" data-teacher="<?php echo $stat['users']['teacher'] ?? 0; ?>">
                        <?php echo $stat['users']['teachers'] ?? 0; ?> teachers
                    </p>
                </div>
            </div>
            <div class="insight-item">
                <div class="insight-icon" style="background: rgba(255, 159, 64, 0.2); color: rgba(255, 159, 64, 1)">
                    <i class="fas fa-user-shield"></i>
                </div>
                <div class="insight-content">
                    <h3>Administrators</h3>
                    <p class="admin-stat" data-admin="<?php echo $stat['users']['admin'] ?? 0; ?>">
                        <?php echo $stat['users']['admin'] ?? 0; ?> administrators
                    </p>
                </div>
            </div>
            <a href="/user-managment" class="section-action">View All <i class="fas fa-arrow-right"></i></a>

        </div>
    </div>
    <div class="dashboard-grid">
        <!-- Course Distribution Pie Chart -->
        <div class="chart-container">
            <h2 class="admin-section">Course Distribution</h2>
            <div class="chart-wrapper">
                <canvas id="courseDistributionChart"></canvas>
            </div>
        </div>
        <div class="insights-card">
            <h2 class="admin-section">Course Statistics</h2>
            <div class="insight-item">
                <div class="insight-icon" style="background: rgba(54, 162, 235, 0.2); color: rgba(54, 162, 235, 1)">
                    <i class="fas">1</i>
                </div>
                <div class="insight-content">
                    <h3>Onetime</h3>
                    <p class="onetime-course" data-onetime="<?= e($courseCountByType['onetime'] ?? 0) ?>"><?= e($courseCountByType['onetime'] ?? 0) ?> Onetime payment courses</p>
                </div>
            </div>
            <div class="insight-item">
                <div class="insight-icon" style="background: rgba(46, 204, 113, 0.2); color: #2ECC71">
                    <i class="fa-solid fa-repeat"></i>
                </div>
                <div class="insight-content">
                    <h3>Recurring</h3>
                    <p class="recurring-course" data-recurring="<?= e($courseCountByType['recurring'] ?? 0) ?>"><?= e($courseCountByType['recurring'] ?? 0) ?> Recurring payment courses</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Links Section -->
    <section class="dashboard-section">
        <div class="section-header">
            <h2 class="admin-section">Quick Access</h2>
        </div>

        <div class="quick-links-grid">
            <a href="/user-managment" class="quick-link-card">
                <div class="quick-link-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h3 class="quick-link-title">User Management</h3>
                <p class="quick-link-desc">Manage all system users</p>
            </a>

            <a href="/course-managment" class="quick-link-card">
                <div class="quick-link-icon">
                    <i class="fas fa-book"></i>
                </div>
                <h3 class="quick-link-title">Courses</h3>
                <p class="quick-link-desc">View and manage courses</p>
            </a>

            <a href="/post-managment" class="quick-link-card">
                <div class="quick-link-icon">
                    <i class="fa-solid fa-file"></i>
                </div>
                <h3 class="quick-link-title">Course Requests</h3>
                <p class="quick-link-desc">Review pending requests</p>
            </a>

            <a href="/advertisement-managment" class="quick-link-card">
                <div class="quick-link-icon">
                    <i class="fas fa-ad"></i>
                </div>
                <h3 class="quick-link-title">Advertisements</h3>
                <p class="quick-link-desc">Manage platform ads</p>
            </a>

            <a href="/resource-managment" class="quick-link-card">
                <div class="quick-link-icon">
                    <i class="fa-solid fa-square-share-nodes"></i>
                </div>
                <h3 class="quick-link-title">Resources</h3>
                <p class="quick-link-desc">Manage learning resources</p>
            </a>

            <a href="/withdrawal-managment" class="quick-link-card">
                <div class="quick-link-icon">
                    <i class="fa-solid fa-wallet"></i>
                </div>
                <h3 class="quick-link-title">Withdrawal Requests</h3>
                <p class="quick-link-desc">Handle payment withdrawals</p>
            </a>
        </div>
    </section>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // User Distribution Pie Chart
        const userDistributionCtx = document.getElementById('userDistributionChart').getContext('2d');

        const userStats = {
            students: document.querySelector(".student-stat").dataset.student,
            teachers: document.querySelector(".teacher-stat").dataset.teacher,
            admin: document.querySelector(".admin-stat").dataset.admin
        };

        new Chart(userDistributionCtx, {
            type: 'pie',
            data: {
                labels: ['Students', 'Teachers', 'Administrators'],
                datasets: [{
                    data: [userStats.students, userStats.teachers, userStats.admin],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.8)', // Blue for students
                        'rgba(46, 204, 113, 0.8)', // Green for teachers
                        'rgba(255, 159, 64, 0.8)' // Orange for admins
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Course Distribution Pie chart
        const courseDistributionCtx = document.getElementById('courseDistributionChart').getContext('2d');

        const courseStat = {
            onetime: document.querySelector(".onetime-course").dataset.onetime,
            recurring: document.querySelector(".recurring-course").dataset.recurring
        };

        new Chart(courseDistributionCtx, {
            type: 'pie',
            data: {
                labels: ['Onetime', 'Recurring'],
                datasets: [{
                    data: [courseStat.onetime, courseStat.recurring],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.8)', // Blue for students
                        'rgba(255, 159, 64, 0.8)' // Orange for admins
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    });
</script>

<?php include $this->resolve("partials/_footer.php"); ?>