<?php include $this->resolve('partials/_header.php'); ?>

<style>
    :root {
        --primary: #FFC400;
        --primary-light: #FFF3D0;
        --primary-dark: #DDA700;
        --text-dark: #2A2A2A;
        --text-medium: #555555;
        --text-light: #777777;
        --bg-light: #f8f9fa;
        --white: #FFFFFF;
        --success: #28a745;
        --warning: #ffc107;
        --danger: #dc3545;
        --border-radius: 12px;
        --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.06);
        --shadow-md: 0 5px 15px rgba(0, 0, 0, 0.08);
        --shadow-hover: 0 8px 25px rgba(0, 0, 0, 0.12);
        --transition: all 0.25s ease;
    }

    body {
        font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
        background-color: var(--bg-light);
        color: var(--text-dark);
        margin: 0;
        padding: 0;
        line-height: 1.6;
    }

    .dashboard {
        max-width: 1280px;
        margin: 0 auto;
        padding: 2rem 1.5rem;
    }

    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .dashboard-title {
        font-size: 2rem;
        font-weight: 700;
        color: var(--text-dark);
        margin: 0;
    }

    .user-profile {
        display: flex;
        align-items: center;
        gap: 1rem;
        background-color: var(--white);
        padding: 1rem 1.5rem;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-sm);
        margin-bottom: 20px;
    }

    .user-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid var(--primary);
    }

    .user-name {
        font-size: 1.25rem;
        font-weight: 600;
        margin: 0;
        color: var(--text-dark);
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(12, 1fr);
        gap: 1.5rem;
    }

    .card {
        background-color: var(--white);
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-sm);
        padding: 1.5rem;
        transition: var(--transition);
        height: 100%;
    }

    .card:hover {
        box-shadow: var(--shadow-hover);
        transform: translateY(-4px);
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--text-dark);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .card-icon {
        color: var(--primary);
        font-size: 1.5rem;
    }

    .attendance-card {
        grid-column: span 5;
    }

    .assignments-card {
        grid-column: span 7;
    }


    .chart-container {
        height: 250px;
        position: relative;
    }

    .stat-info {
        display: flex;
        justify-content: space-around;
        margin-top: 1rem;
    }

    .stat-item {
        text-align: center;
    }

    .stat-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary);
        margin: 0;
    }

    .stat-label {
        font-size: 0.875rem;
        color: var(--text-light);
        margin: 0;
    }

    .assignment-list {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .assignment-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        border-bottom: 1px solid #eee;
        transition: var(--transition);
    }

    .assignment-item:last-child {
        border-bottom: none;
    }

    .assignment-item:hover {
        background-color: var(--primary-light);
        border-radius: 8px;
    }

    .assignment-info {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .assignment-title {
        font-weight: 600;
        color: var(--text-dark);
        margin: 0;
    }

    .assignment-meta {
        color: var(--text-light);
        font-size: 0.875rem;
        display: flex;
        gap: 1rem;
    }

    .assignment-status {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .status-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 100px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .status-completed {
        background-color: rgba(40, 167, 69, 0.1);
        color: var(--success);
    }

    .status-pending {
        background-color: rgba(255, 193, 7, 0.1);
        color: var(--warning);
    }

    .assignment-grade {
        font-weight: 700;
        font-size: 1.125rem;
        padding: 0.5rem;
        border-radius: 8px;
        text-align: center;
        min-width: 45px;
    }


    .status-paid {
        background-color: rgba(40, 167, 69, 0.1);
        color: var(--success);
    }

    .progress-list {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
    }

    .progress-item {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .progress-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .progress-title {
        font-weight: 600;
        margin: 0;
    }

    .progress-value {
        font-weight: 700;
        color: var(--primary);
    }

    .progress-bar-bg {
        height: 8px;
        background-color: rgba(0, 0, 0, 0.05);
        border-radius: 100px;
        overflow: hidden;
    }

    .progress-bar-fill {
        height: 100%;
        background-color: var(--primary);
        border-radius: 100px;
        transition: width 1s ease;
    }

    @media (max-width: 992px) {
        .dashboard-grid {
            grid-template-columns: repeat(8, 1fr);
        }

        .attendance-card,
        .assignments-card {
            grid-column: span 8;
        }

    }

    @media (max-width: 768px) {
        .dashboard-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .dashboard-grid {
            grid-template-columns: 1fr;
        }

        .attendance-card,
        .assignments-card {
            grid-column: span 1;
        }
    }
</style>

<div class="dashboard">
    <div class="dashboard-header">
        <h1 class="dashboard-title">Student Performance</h1>
    </div>
    <div class="user-profile">
        <img src="<?= isset($user['profile_picture_url'])
                        ? $user['profile_picture_url'] :
                        "/assets/images/user_placeholder.jpg" ?>" alt="User Avatar" class="user-avatar">
        <div>
            <h2 class="user-name">Student Name: <?= $user['first_name'] . " " . $user['last_name']; ?></h2>
        </div>
    </div>

    <div class="dashboard-grid">
        <div class="card attendance-card"
            data-total-classes="<?= e($totalModules); ?>"
            data-attendance="<?= e($attendance); ?>">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-calendar-check card-icon"></i>
                    Attendance
                </h3>
            </div>
            <div class="chart-container">
                <canvas id="attendancePieChart"></canvas>
            </div>
            <div class="stat-info">
                <div class="stat-item">
                    <p class="stat-value"><?= e($attendance); ?></p>
                    <p class="stat-label">Modules Attended</p>
                </div>
                <div class="stat-item">
                    <p class="stat-value"><?= e($totalModules); ?></p>
                    <p class="stat-label">Total Modules</p>
                </div>
            </div>
        </div>

        <!-- Assignments & Grades Card -->
        <div class="card assignments-card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-tasks card-icon"></i>
                    Submitted Assignments & Grades
                </h3>
            </div>
            <div class="stat-info" style="margin-bottom: 1.5rem; border-bottom: 1px solid #eee; padding-bottom: 1rem;">
                <div class="stat-item">
                    <p class="stat-value"><?= count($studentSubmissions) ?></p>
                    <p class="stat-label">Submitted</p>
                </div>
                <div class="stat-item">
                    <p class="stat-value"><?= $totalAssignments ?? 0 ?></p>
                    <p class="stat-label">Total Assignments</p>
                </div>
                <div class="stat-item">
                    <?php
                    $totalAssignments = $totalAssignments ?? 0;
                    $submissionRate = ($totalAssignments > 0) ?
                        round((count($studentSubmissions) / $totalAssignments) * 100) : 0;
                    ?>
                    <p class="stat-value"><?= $submissionRate ?>%</p>
                    <p class="stat-label">Submission Rate</p>
                </div>
            </div>
            <ul class="assignment-list">
                <?php if (empty($studentSubmissions)): ?>
                    <li class="assignment-item">
                        No submissions
                    </li>
                <?php else: ?>
                    <?php foreach ($studentSubmissions as $submission): ?>
                        <li class="assignment-item">
                            <div class="assignment-info">
                                <h4 class="assignment-title"><?= e($submission['title']) ?></h4>
                                <div class="assignment-meta">
                                    <span>Due: <?= e(formatDate($submission['deadline'], 'F j, Y')) ?></span>
                                    <div class="assignment-status">
                                        <span class="status-badge status-completed"><?= e($submission['status']) ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="assignment-grade"><?= e($submission['grade']) ?></div>
                        </li>
                <?php endforeach;
                endif; ?>
            </ul>
        </div>
    </div>
</div>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Attendance Pie Chart
        const ctxPie = document.getElementById('attendancePieChart').getContext('2d');

        const attendanceData = document.querySelector('.attendance-card');
        // Calculate classes missed based on the stats
        const totalClasses = parseInt(attendanceData.dataset.totalClasses, 10);
        const classesAttended = parseInt(attendanceData.dataset.attendance, 10);
        const classesMissed = totalClasses - classesAttended;

        const attendancePieData = {
            labels: ['Modules Attended', 'Modules Missed'],
            datasets: [{
                data: [classesAttended, classesMissed],
                backgroundColor: [
                    '#FFC400',
                    '#f0f0f0'
                ],
                borderColor: [
                    '#DDA700',
                    '#d0d0d0'
                ],
                borderWidth: 1,
                hoverOffset: 10
            }]
        };

        const attendancePieChart = new Chart(ctxPie, {
            type: 'pie',
            data: attendancePieData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            font: {
                                size: 12
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const percentage = Math.round((value / totalClasses) * 100);
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        });

        // Initialize animations for progress bars
        const progressBars = document.querySelectorAll('.progress-bar-fill');
        progressBars.forEach(bar => {
            const width = bar.style.width;
            bar.style.width = '0%';
            setTimeout(() => {
                bar.style.width = width;
            }, 300);
        });
    });
</script>