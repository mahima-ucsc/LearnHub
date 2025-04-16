<?php include $this->resolve('partials/_header.php') ?>

<link rel="stylesheet" href="/assets/styles/User/Admin/admin_dashboard.css">

<?php include $this->resolve('User/sidebar.php'); ?>
<section class="dashboard-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Dashboard Overview</h2>
            <p>Track Website performance</p>
        </div>

        <div class="quick-stats">
            <div class="stat-card">
                <i class="fas fa-users fa-2x" style="color: var(--theme-color)"></i>
                <div class="stat-value"><?php echo (int)$stat['users']['students'] + (int)$stat['users']['teachers'] +  (int)$stat['users']['admin']; ?></div>
                <p>Active Users</p>
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
        <div class="dashboard-grid">
            <!-- User Distribution Pie Chart -->
            <div class="chart-container">
                <h2 class="section-title">User Distribution</h2>
                <div class="chart-wrapper" style="height: 300px; position: relative;">
                    <canvas id="userDistributionChart"></canvas>
                </div>
            </div>
            <div class="insights-card">
                <h2 class="section-title">User Statistics</h2>
                <div class="insight-item">
                    <div class="insight-icon" style="background: rgba(54, 162, 235, 0.2); color: rgba(54, 162, 235, 1)">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <div class="insight-content">
                        <h3>Students</h3>
                        <p><?php echo $stat['users']['students'] ?? 0; ?> students</p>
                    </div>
                </div>
                <div class="insight-item">
                    <div class="insight-icon" style="background: rgba(46, 204, 113, 0.2); color: #2ECC71">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <div class="insight-content">
                        <h3>Teachers</h3>
                        <p><?php echo $stat['users']['teachers'] ?? 0; ?> teachers</p>
                    </div>
                </div>
                <div class="insight-item">
                    <div class="insight-icon" style="background: rgba(255, 159, 64, 0.2); color: rgba(255, 159, 64, 1)">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <div class="insight-content">
                        <h3>Administrators</h3>
                        <p><?php echo $stat['users']['admin'] ?? 0; ?> administrators</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- TODO: Add bar chart for transaction where it shows money in and out for each month -->
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

    // Performance graph
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

        renderTransactions();
    });

    document.addEventListener('DOMContentLoaded', function() {
        // User Distribution Pie Chart
        const userStats = {
            students: <?php echo $stat['users']['students'] ?? 0; ?>,
            teachers: <?php echo $stat['users']['teachers'] ?? 0; ?>,
            admin: <?php echo $stat['users']['admin'] ?? 0; ?>
        };

        const userDistributionCtx = document.getElementById('userDistributionChart').getContext('2d');
        userLabels = ['Students', 'Teachers', 'Administrators']
        userData = [userStats.students, userStats.teachers, userStats.admin]
        userBackgroundColor = [
            'rgba(54, 162, 235, 0.8)', // Blue for students
            '#2ECC71', // Teal for teachers
            'rgba(255, 159, 64, 0.8)' // Orange for admins
        ]
        createPieChart(userDistributionCtx, userLabels, userData, userBackgroundColor)
    });


    // Create pie chart
    function createPieChart(ctx, labels, data, backgroundColor) {
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: backgroundColor,
                    borderColor: backgroundColor,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = Math.round((value / total) * 100);
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });
    }

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