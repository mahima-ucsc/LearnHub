<?php include $this->resolve('partials/_header.php') ?>

<?php include $this->resolve('User/sidebar.php'); ?>
<link rel="stylesheet" href="/assets/styles/User/Teacher/teacher_index.css">
<section class="teacher-hero">
    <div class="container teacher-hero-content">
        <div class="teacher-hero-text">
            <h1>Transform Your Knowledge Into Income</h1>
            <p>Create, sell, and manage your online courses with our powerful platform designed for you.</p>
            <a href="/advertisement/create" class="btn btn-primary">Boost your course!</a>
        </div>
    </div>
</section>
<section class="dashboard-section">
    <div class="container">
        <div class="section-header">
            <h2 class="teacher-section-title">Dashboard Overview</h2>
            <p>Track your performance and upcoming tasks</p>
        </div>

        <div class="quick-access-section">
            <h2 class="teacher-section-title">Quick Access</h2>
            <div class="quick-access-grid">
                <a href="/course/create" class="quick-access-card">
                    <div class="quick-access-icon">
                        <i class="fas fa-plus-circle"></i>
                    </div>
                    <h3>Create Course</h3>
                </a>
                <a href="/courses/mycourses" class="quick-access-card">
                    <div class="quick-access-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <h3>My Courses</h3>
                </a>
                <a href="/course/request" class="quick-access-card">
                    <div class="quick-access-icon">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <h3>View Posts</h3>
                </a>
                <a href="/advertisement/create" class="quick-access-card">
                    <div class="quick-access-icon">
                        <i class="fas fa-ad"></i>
                    </div>
                    <h3>Promote Course</h3>
                </a>
                <a href="/withdraw" class="quick-access-card">
                    <div class="quick-access-icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <h3>Withdraw Funds</h3>
                </a>
            </div>
        </div>
        <h2 class="teacher-section-title">Quick Statistics</h2>
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon icon-courses">
                        <i class="fas fa-book"></i>
                    </div>
                </div>
                <div class="stat-value"><?= e($courseCount); ?></div>
                <div class="stat-label">Active Courses</div>
            </div>
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon icon-users">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <div class="stat-value"><?= ($studentCount) ?></div>
                <div class="stat-label">Total Students</div>
            </div>
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon icon-revenue">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
                <div class="stat-value">Rs.<?= e($totalCoursePayments); ?></div>
                <div class="stat-label">Total Revenue</div>
            </div>
        </div>
        <div class="dashboard-grid">
            <div class="chart-container">
                <h2 class="teacher-section-title">Revenue By Course Type</h2>
                <div class="chart-wrapper">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
            <div class="insights-card">
                <h2 class="teacher-section-title">Revenue Insights</h2>
                <div class="insight-item">
                    <div class="insight-icon" style="background: var(--success)">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="insight-content">
                        <h3>Total Revenue</h3>
                        <p>Rs. <?= e($totalCoursePayments); ?></p>
                    </div>
                </div>
                <div class="insight-item">
                    <div class="insight-icon" style="background: var(--theme-color)">
                        <i class="fas fa-repeat"></i>
                    </div>
                    <div class="insight-content">
                        <h3>Recurring Course</h3>
                        <p class="recurring-revenue" data-recurring="<?= e($totalRecurringCoursePayments) ?>">Rs. <?= e($totalRecurringCoursePayments) ?></p>
                    </div>
                </div>
                <div class="insight-item">
                    <div class="insight-icon" style="background: var(--warning)">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="insight-content">
                        <h3>Onetime course</h3>
                        <p class="onetime-revenue" data-onetime="<?= e($totalOnetimeCoursePayments); ?>">Rs.<?= e($totalOnetimeCoursePayments); ?> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="ad-promo-section">
    <div class="container">
        <div class="section-header">
            <h2 class="teacher-section-title">Boost Your Course Visibility</h2>
            <p>Get more students and increase your earnings</p>
        </div>

        <div class="ad-promo-container">
            <div class="ad-promo-content">
                <div class="ad-promo-text">
                    <h3>Why Advertise Your Courses?</h3>
                    <ul class="ad-benefits-list">
                        <li>
                            <span class="ad-icon"><i class="fas fa-chart-line"></i></span>
                            <div>
                                <h4>Increase Visibility</h4>
                            </div>
                        </li>
                        <li>
                            <span class="ad-icon"><i class="fas fa-users"></i></span>
                            <div>
                                <h4>Reach More Students</h4>
                            </div>
                        </li>
                        <li>
                            <span class="ad-icon"><i class="fas fa-coins"></i></span>
                            <div>
                                <h4>Boost Your Revenue</h4>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="ad-promo-cta">
                    <h2>Create Your Advertisement now</h2>
                    <p>Start reaching more students today and grow your teaching business!</p>
                    <div class="cta-button-large">
                        <a href="/advertisement/create" class="btn btn-primary btn-lg">
                            <i class="fas fa-bullhorn"></i> Get Started
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('revenueChart').getContext('2d');

        const courseStat = {
            onetime: document.querySelector(".onetime-revenue").dataset.onetime,
            recurring: document.querySelector(".recurring-revenue").dataset.recurring,
        };

        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Onetime Payment', 'Recurring Courses'],
                datasets: [{
                    data: [courseStat.onetime, courseStat.recurring],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 159, 64, 0.8)'
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

<?php include $this->resolve('partials/_footer.php') ?>