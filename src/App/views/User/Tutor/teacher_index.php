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
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
        background-color: var(--bg-light);
        color: var(--text-dark);
        line-height: 1.6;
    }

    .container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* Header */
    .header {
        background: var(--white);
        padding: 1rem 0;
        box-shadow: var(--shadow);
        position: fixed;
        width: 100%;
        top: 0;
        z-index: 1000;
    }

    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logo {
        font-size: 1.5rem;
        font-weight: bold;
        color: var(--theme-color);
    }

    .nav-menu {
        display: flex;
        gap: 2rem;
    }

    .nav-link {
        color: var(--text-dark);
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s;
    }

    .nav-link:hover {
        color: var(--theme-color);
    }

    /* teacher-hero Section */
    .teacher-hero {
        padding: 8rem 0 4rem;
        background: linear-gradient(135deg, var(--theme-color) 0%, var(--theme-dark) 100%);
        color: var(--white);
    }

    .teacher-hero-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4rem;
        align-items: center;
    }

    .teacher-hero-text h1 {
        font-size: 3rem;
        margin-bottom: 1.5rem;
        line-height: 1.2;
    }

    .teacher-hero-text p {
        font-size: 1.2rem;
        margin-bottom: 2rem;
        opacity: 0.9;
    }

    .teacher-hero-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
        background: rgba(255, 255, 255, 0.1);
        padding: 2rem;
        border-radius: 1rem;
        backdrop-filter: blur(10px);
    }

    .stat-item {
        text-align: center;
    }

    .stat-item h3 {
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
    }

    /* Course Section */
    .section {
        padding: 4rem 0;
    }

    .section-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .section-title {
        font-size: 2rem;
        color: var(--text-dark);
        margin-bottom: 1rem;
    }

    .courses-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
    }

    .course-card {
        background: var(--white);
        border-radius: 1rem;
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
        box-shadow: var(--shadow);
    }

    .course-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    }

    .course-image {
        height: 200px;
        background: var(--theme-light);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--theme-dark);
    }

    .course-content {
        padding: 1.5rem;
    }

    .course-title {
        font-size: 1.2rem;
        margin-bottom: 1rem;
    }

    .course-meta {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1rem;
        color: var(--text-light);
    }

    .course-price {
        font-size: 1.25rem;
        color: var(--theme-color);
        font-weight: bold;
    }

    /* Features Section */
    .features {
        background: var(--white);
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
    }

    .feature-card {
        text-align: center;
        padding: 2rem;
        border-radius: 1rem;
        background: var(--bg-light);
        transition: transform 0.3s;
    }

    .feature-card:hover {
        transform: translateY(-5px);
    }

    .feature-icon {
        font-size: 2.5rem;
        color: var(--theme-color);
        margin-bottom: 1rem;
    }

    /* CTA Section */
    .cta {
        background: linear-gradient(135deg, var(--theme-dark) 0%, var(--theme-color) 100%);
        color: var(--white);
        text-align: center;
        padding: 4rem 0;
    }

    .btn {
        display: inline-block;
        padding: 1rem 2rem;
        border-radius: 2rem;
        text-decoration: none;
        font-weight: bold;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .btn-primary {
        background: var(--white);
        color: var(--theme-color);
    }

    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    /* Dashboard Grid Styles */

    .dashboard-section {
        padding: 4rem 0;
        background: var(--bg-light);
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
        margin-top: 2rem;
    }

    .insights-card {
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

    .insight-trend {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9rem;
        color: var(--success);
    }

    .trend-down {
        color: var(--danger);
    }

    .upcoming-tasks {
        background: var(--white);
        border-radius: 1rem;
        padding: 2rem;
        box-shadow: var(--shadow);
        margin-top: 64px;
    }

    .task-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem 0;
        border-bottom: 1px solid var(--bg-light);
    }

    .task-checkbox {
        width: 24px;
        height: 24px;
        border-radius: 6px;
        border: 2px solid var(--theme-color);
        cursor: pointer;
        position: relative;
        transition: background 0.3s;
    }

    .task-checkbox.completed {
        background: var(--theme-color);
    }

    .task-checkbox.completed::after {
        content: '✓';
        position: absolute;
        color: white;
        font-size: 14px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .task-content {
        flex: 1;
    }

    .task-content h4 {
        color: var(--text-dark);
        margin-bottom: 0.25rem;
    }

    .task-deadline {
        color: var(--text-light);
        font-size: 0.9rem;
    }

    .quick-stats {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: var(--white);
        padding: 1.5rem;
        border-radius: 1rem;
        box-shadow: var(--shadow);
        text-align: center;
        transition: transform 0.3s;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-value {
        font-size: 2rem;
        font-weight: bold;
        color: var(--theme-color);
        margin: 0.5rem 0;
    }

    /* Chart */
    .chart-container {
        background-color: white;
        border-radius: 1rem;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        min-height: 400px;
        padding: 25px;
    }

    .chart-wrapper {
        width: 100%;
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Transaction */
    .transactions-section {
        margin-top: 2rem;
        background: var(--white);
        border-radius: 1rem;
        padding: 2rem;
        box-shadow: var(--shadow);
    }

    .transactions-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .transactions-list {
        display: grid;
        gap: 1rem;
    }

    .transaction-item {
        display: flex;
        align-items: center;
        padding: 1rem;
        background: var(--bg-light);
        border-radius: 0.5rem;
        transition: transform 0.3s ease;
    }

    .transaction-item:hover {
        transform: translateX(5px);
    }

    .transaction-icon {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        flex-shrink: 0;
    }

    .transaction-details {
        flex: 1;
    }

    .transaction-info {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    .transaction-name {
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 0.25rem;
    }

    .transaction-course {
        font-size: 0.875rem;
        color: var(--text-light);
    }

    .transaction-amount {
        font-weight: 600;
        font-size: 1.125rem;
    }

    .amount-positive {
        color: var(--success);
    }

    .amount-negative {
        color: var(--danger);
    }

    .transaction-date {
        font-size: 0.875rem;
        color: var(--text-light);
    }

    .view-all-btn {
        padding: 0.5rem 1rem;
        background: var(--theme-light);
        color: var(--theme-dark);
        border-radius: 0.5rem;
        text-decoration: none;
        font-weight: 500;
        transition: background 0.3s ease;
    }

    .view-all-btn:hover {
        background: var(--theme-color);
        color: var(--white);
    }

    @media (max-width: 1024px) {
        .dashboard-grid {
            grid-template-columns: 1fr;
        }

        .quick-stats {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .container {
            padding: 0 15px;
        }

        .teacher-hero-content {
            grid-template-columns: 1fr;
            text-align: center;
            gap: 2rem;
        }

        .teacher-hero-text h1 {
            font-size: 2.5rem;
        }

        .teacher-hero-stats {
            grid-template-columns: repeat(2, 1fr);
        }

        .features-grid {
            grid-template-columns: 1fr;
        }

        .nav-menu {
            display: none;
        }

        .courses-grid {
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        }

        .dashboard-grid {
            grid-template-columns: 1fr;
        }

        .quick-stats {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 480px) {
        .teacher-hero {
            padding: 6rem 0 3rem;
        }

        .teacher-hero-text h1 {
            font-size: 2rem;
        }

        .teacher-hero-text p {
            font-size: 1rem;
        }

        .teacher-hero-stats {
            grid-template-columns: 1fr;
            padding: 1.5rem;
        }

        .section {
            padding: 2.5rem 0;
        }

        .section-title {
            font-size: 1.5rem;
        }

        .courses-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .feature-card {
            padding: 1.5rem;
        }

        .quick-stats {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .stat-card {
            padding: 1rem;
        }

        .stat-value {
            font-size: 1.75rem;
        }

        .insight-item {
            padding: 1rem;
            gap: 1rem;
        }

        .insight-icon {
            width: 40px;
            height: 40px;
            font-size: 1.25rem;
        }

        .transaction-item {
            flex-direction: column;
            align-items: flex-start;
        }

        .transaction-icon {
            margin-bottom: 0.75rem;
            margin-right: 0;
        }

        .transaction-info {
            flex-direction: column;
            width: 100%;
        }

        .transaction-amount {
            margin-top: 0.5rem;
        }
    }
</style>
<?php include $this->resolve('User/sidebar.php'); ?>
<section class="teacher-hero">
    <div class="container teacher-hero-content">
        <div class="teacher-hero-text">
            <h1>Transform Your Knowledge Into Income</h1>
            <p>Create, sell, and manage your online courses with our powerful platform designed for educators.</p>
            <a href="#" class="btn btn-primary">Start Teaching Today</a>
        </div>
        <div class="teacher-hero-stats">
            <div class="stat-item">
                <h3>50K+</h3>
                <p>Active Teachers</p>
            </div>
            <div class="stat-item">
                <h3>$10M+</h3>
                <p>Teacher Earnings</p>
            </div>
            <div class="stat-item">
                <h3>1M+</h3>
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
                <div class="stat-value">1,234</div>
                <p>Active Students</p>
            </div>
            <div class="stat-card">
                <i class="fas fa-graduation-cap fa-2x" style="color: var(--theme-color)"></i>
                <div class="stat-value">15</div>
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
                <a href="#" class="view-all-btn">View All</a>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
<script>
    // Add scroll effect for header
    window.addEventListener('scroll', () => {
        const header = document.querySelector('.header');
        if (window.scrollY > 50) {
            header.style.background = '#ffffff';
            header.style.boxShadow = '0 2px 10px rgba(0,0,0,0.1)';
        } else {
            header.style.background = '#ffffff';
            header.style.boxShadow = '0 2px 5px rgba(0,0,0,0.1)';
        }
    });

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
    const ctx = document.getElementById('performanceChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Student Engagement',
                data: [65, 78, 90, 85, 92, 88],
                borderColor: '#2ECC71',
                tension: 0.4,
                fill: false
            }, {
                label: 'Revenue ($K)',
                data: [35, 42, 48, 45, 55, 60],
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
            }
        }
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