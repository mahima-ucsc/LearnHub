<?php include $this->resolve('partials/_header.php') ?>

<link rel="stylesheet" href="/assets/styles/User/Admin/admin_dashboard.css">

<?php include $this->resolve('User/sidebar.php'); ?>
<section class="dashboard">
    <div class="container dashboard-content">
        <div class="dashboard-text">
            <h1>Transform Your Knowledge Into Income</h1>
            <p>Create, sell, and manage your online courses with our powerful platform designed for educators.</p>
            <a href="#" class="btn btn-primary">Start Teaching Today</a>
        </div>
        <div class="dashboard-stats">
            <div class="stat-item">
                <h3><?php echo $stat['users']['teachers'] ?></h3>
                <p>Active Teachers</p>
            </div>
            <div class="stat-item">
                <h3>$10M+</h3>
                <p>Teacher Earnings</p>
            </div>
            <div class="stat-item">
                <h3><?php echo $stat['users']['students'] ?></h3>
                <p>Students Taught</p>
            </div>
        </div>
    </div>
</section>
<section class="dashboard-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Dashboard Overview</h2>
            <p>Track your performance and upcoming tasks</p>
        </div>

        <div class="quick-stats">
            <div class="stat-card">
                <i class="fas fa-users fa-2x" style="color: var(--theme-color)"></i>
                <div class="stat-value"><?php echo $stat['users']['students'] ?></div>
                <p>Active Students</p>
            </div>
            <div class="stat-card">
                <i class="fas fa-graduation-cap fa-2x" style="color: var(--theme-color)"></i>
                <div class="stat-value"><?php echo $stat['courses']; ?></div>
                <p>Active Courses</p>
            </div>
            <div class="stat-card">
                <i class="fas fa-star fa-2x" style="color: var(--theme-color)"></i>
                <div class="stat-value">4.8</div>
                <p>Average Rating</p>
            </div>
            <div class="stat-card">
                <i class="fas fa-dollar-sign fa-2x" style="color: var(--theme-color)"></i>
                <div class="stat-value">45K</div>
                <p>Total Earnings</p>
            </div>
        </div>
        <div class="dashboard-grid">
            <div class="chart-container">
                <h2 class="section-title">Performance Overview</h2>
                <div class="chart-filters" style="text-align: right; margin-bottom: 1rem;">
                    <select id="chart-period-filter" class="period-select">
                        <option value="7days">Last 7 Days</option>
                        <option value="1month">Last Month</option>
                        <option value="1year">Last Year</option>
                    </select>
                </div>
                <div class="chart-wrapper">
                    <canvas id="performanceChart"></canvas>
                </div>
            </div>
            <div class="insights-card">
                <h2 class="section-title">Key Insights</h2>
                <div class="insight-item">
                    <div class="insight-icon" style="background: var(--success)">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="insight-content">
                        <h3>Course Engagement</h3>
                        <p>85% increase in student interaction</p>
                        <div class="insight-trend">
                            <i class="fas fa-arrow-up"></i>
                            <span>12% vs last month</span>
                        </div>
                    </div>
                </div>
                <div class="insight-item">
                    <div class="insight-icon" style="background: var(--warning)">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="insight-content">
                        <h3>New Enrollments</h3>
                        <p>256 new students this week</p>
                        <div class="insight-trend trend-down">
                            <i class="fas fa-arrow-down"></i>
                            <span>3% vs last week</span>
                        </div>
                    </div>
                </div>
                <div class="insight-item">
                    <div class="insight-icon" style="background: var(--theme-color)">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="insight-content">
                        <h3>Revenue Growth</h3>
                        <p>$12,450 earned this month</p>
                        <div class="insight-trend">
                            <i class="fas fa-arrow-up"></i>
                            <span>8% vs last month</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="upcoming-tasks">
            <h2 class="section-title">Upcoming Tasks</h2>
            <div class="task-item">
                <div class="task-checkbox completed"></div>
                <div class="task-content">
                    <h4>Record JavaScript Basics Module</h4>
                    <span class="task-deadline">Due Tomorrow</span>
                </div>
            </div>
            <div class="task-item">
                <div class="task-checkbox"></div>
                <div class="task-content">
                    <h4>Review Student Projects</h4>
                    <span class="task-deadline">Due in 3 days</span>
                </div>
            </div>
            <div class="task-item">
                <div class="task-checkbox"></div>
                <div class="task-content">
                    <h4>Update Course Materials</h4>
                    <span class="task-deadline">Due in 5 days</span>
                </div>
            </div>
        </div>
        <div class="transactions-section">
            <div class="transactions-header">
                <h2 class="section-title">Recent Transactions</h2>
                <a href="/billing-and-payment" class="view-all-btn">View All</a>
            </div>
            <div class="transactions-list" id="transactionsList">
                <!-- Transactions will be populated by JavaScript -->
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Your Active Courses</h2>
            <p>Manage and track your course performance</p>
        </div>
        <div class="courses-grid">
            <div class="course-card">
                <div class="course-image">
                    <i class="fas fa-code fa-3x"></i>
                </div>
                <div class="course-content">
                    <h3 class="course-title">Advanced Web Development</h3>
                    <div class="course-meta">
                        <span><i class="fas fa-users"></i> 1,234 students</span>
                        <span><i class="fas fa-star"></i> 4.8</span>
                    </div>
                    <div class="course-price">$199.99</div>
                </div>
            </div>
        </div>
    </div>
</section>
[]
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
<script>
    // Add animation for feature cards
    const featureCards = document.querySelectorAll('.feature-card');
    featureCards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-10px)';
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0)';
        });
    });

    // Add Chart.js initialization
    let performanceChart;
    const ctx = document.getElementById('performanceChart').getContext('2d');

    // Different datasets for different time periods
    const chartData = {
        '7days': {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            engagement: [62, 73, 68, 82, 76, 65, 88],
            revenue: [28, 32, 30, 35, 40, 25, 42]
        },
        '1month': {
            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
            engagement: [70, 82, 75, 88],
            revenue: [38, 42, 45, 60]
        },
        '1year': {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            engagement: [65, 78, 90, 85, 92, 88, 95, 91, 87, 94, 97, 99],
            revenue: [35, 42, 48, 45, 55, 60, 58, 63, 59, 68, 72, 80]
        }
    };

    // Function to create/update chart
    function updateChart(period) {
        const data = chartData[period];

        const config = {
            type: 'line',
            data: {
                labels: data.labels,
                datasets: [{
                    label: 'Student Engagement',
                    data: data.engagement,
                    borderColor: '#2ECC71',
                    tension: 0.4,
                    fill: false
                }, {
                    label: 'Revenue ($K)',
                    data: data.revenue,
                    borderColor: '#FFC400',
                    tension: 0.4,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                animation: {
                    duration: 500
                }
            }
        };

        // If chart exists, destroy it before creating a new one
        if (performanceChart) {
            performanceChart.destroy();
        }

        // Create new chart
        performanceChart = new Chart(ctx, config);
    }

    // Initialize chart with 7-day data
    document.addEventListener('DOMContentLoaded', function() {
        updateChart('7days');

        // Add event listener to the dropdown
        const periodSelect = document.getElementById('chart-period-filter');
        periodSelect.addEventListener('change', function() {
            updateChart(this.value);
        });

        // Also render transactions (keep your existing code)
        renderTransactions();
    });

    // Sample transaction data
    const transactions = [{
            id: 1,
            name: "John Doe",
            course: "Advanced Web Development",
            amount: 199.99,
            type: "income",
            date: "2024-02-17T10:30:00",
            icon: "fas fa-graduation-cap"
        },
        {
            id: 2,
            name: "Platform Fee",
            course: "Monthly Service Charge",
            amount: -45.00,
            type: "expense",
            date: "2024-02-16T15:45:00",
            icon: "fas fa-receipt"
        },
        {
            id: 3,
            name: "Sarah Smith",
            course: "JavaScript Fundamentals",
            amount: 149.99,
            type: "income",
            date: "2024-02-16T09:15:00",
            icon: "fas fa-graduation-cap"
        },
        {
            id: 4,
            name: "Marketing Expenses",
            course: "Facebook Ads",
            amount: -75.00,
            type: "expense",
            date: "2024-02-15T14:20:00",
            icon: "fas fa-ad"
        }
    ];

    // Function to format date
    function formatDate(dateString) {
        const date = new Date(dateString);
        const now = new Date();
        const diffTime = Math.abs(now - date);
        const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24));

        if (diffDays === 0) {
            return 'Today';
        } else if (diffDays === 1) {
            return 'Yesterday';
        } else {
            return date.toLocaleDateString('en-US', {
                month: 'short',
                day: 'numeric'
            });
        }
    }

    // Function to render transactions
    function renderTransactions() {
        const transactionsList = document.getElementById('transactionsList');
        transactionsList.innerHTML = transactions.map(transaction => `
        <div class="transaction-item">
            <div class="transaction-icon" style="background: ${transaction.type === 'income' ? 'rgba(46, 204, 113, 0.1)' : 'rgba(231, 76, 60, 0.1)'}; color: ${transaction.type === 'income' ? 'var(--success)' : 'var(--danger)'}">
                <i class="${transaction.icon}"></i>
            </div>
            <div class="transaction-details">
                <div class="transaction-info">
                    <div>
                        <div class="transaction-name">${transaction.name}</div>
                        <div class="transaction-course">${transaction.course}</div>
                    </div>
                    <div class="transaction-amount ${transaction.type === 'income' ? 'amount-positive' : 'amount-negative'}">
                        ${transaction.type === 'income' ? '+' : ''}$${Math.abs(transaction.amount).toFixed(2)}
                    </div>
                </div>
                <div class="transaction-date">${formatDate(transaction.date)}</div>
            </div>
        </div>
    `).join('');
    }

    // Initialize transactions
    document.addEventListener('DOMContentLoaded', renderTransactions);
</script>

<?php include $this->resolve('partials/_footer.php') ?>