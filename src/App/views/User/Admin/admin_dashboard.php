<?php include $this->resolve('User/sidebar.php'); ?>
<?php include $this->resolve("partials/_header.php"); ?>
<link rel="stylesheet" href="/assets/styles/User/Admin/admin_dashboard.css">




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
                    <p class="teacher-stat" data-teacher="<?php echo $stat['users']['teachers'] ?? 0; ?>">
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
            <a href="/course-managment" class="section-action">View All <i class="fas fa-arrow-right"></i></a>

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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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