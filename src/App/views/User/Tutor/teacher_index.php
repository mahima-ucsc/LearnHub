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

    .quick-access-section {
        margin-bottom: 2rem;
    }

    .quick-access-grid {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 1.5rem;
        margin-top: 1.5rem;
    }

    .quick-access-card {
        background: var(--white);
        border-radius: 1rem;
        padding: 1.5rem 1rem;
        text-align: center;
        box-shadow: var(--shadow);
        transition: all 0.3s ease;
        text-decoration: none;
        color: var(--text-dark);
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .quick-access-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        background: var(--theme-color);
        color: var(--white);
    }

    .quick-access-icon {
        font-size: 2rem;
        color: var(--theme-color);
        margin-bottom: 1rem;
    }

    .quick-access-card:hover .quick-access-icon {
        color: var(--white);
    }

    .quick-access-card h3 {
        font-size: 1rem;
        font-weight: 500;
    }

    @media (max-width: 1200px) {
        .quick-access-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 768px) {
        .quick-access-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 480px) {
        .quick-access-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Ad Promo Section Styles */
    .ad-promo-section {
        padding: 4rem 0;
        background: var(--bg-light);
        margin-bottom: 2rem;
    }

    .ad-promo-container {
        margin-top: 2rem;
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: var(--shadow);
        background: var(--white);
    }

    .ad-promo-content {
        display: grid;
        grid-template-columns: 3fr 2fr;
        gap: 2rem;
        padding: 2rem;
    }

    .ad-promo-text h3 {
        font-size: 1.5rem;
        color: var(--text-dark);
        margin-bottom: 1.5rem;
    }

    .ad-benefits-list {
        list-style: none;
        padding: 0;
        display: grid;
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .ad-benefits-list li {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
    }

    .ad-icon {
        background-color: var(--theme-color);
        color: var(--white);
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        flex-shrink: 0;
    }

    .ad-benefits-list h4 {
        margin: 0 0 0.5rem 0;
        color: var(--text-dark);
    }

    .ad-benefits-list p {
        margin: 0;
        color: var(--text-light);
        font-size: 0.95rem;
    }

    .ad-cta {
        margin-top: 1.5rem;
    }

    .ad-promo-stats {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.5rem;
        background: linear-gradient(135deg, var(--theme-color) 0%, var(--theme-dark) 100%);
        padding: 2rem;
        border-radius: 1rem;
        align-content: center;
    }

    .ad-stat-card {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(5px);
        border-radius: 1rem;
        padding: 1.5rem;
        text-align: center;
        transition: transform 0.3s;
        color: var(--white);
    }

    .ad-stat-card:hover {
        transform: translateY(-5px);
    }

    .ad-stat-value {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
    }

    .ad-stat-label {
        font-size: 1rem;
        opacity: 0.9;
    }

    .ad-promo-cta {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        background: linear-gradient(135deg, var(--theme-color) 0%, var(--theme-dark) 100%);
        padding: 2.5rem;
        border-radius: 1rem;
        color: var(--white);
    }

    .ad-promo-cta h2 {
        font-size: 1.8rem;
        margin-bottom: 1rem;
    }

    .cta-button-large {
        margin-top: 2rem;
    }

    .btn-lg {
        padding: 1.2rem 2.5rem;
        font-size: 1.2rem;
        border-radius: 2.5rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .btn-lg:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }

    /* Responsive styles */
    @media (max-width: 1024px) {
        .ad-promo-content {
            grid-template-columns: 1fr;
        }

        .ad-promo-stats {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 768px) {
        .ad-benefits-list {
            grid-template-columns: 1fr;
        }

        .ad-promo-stats {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 480px) {
        .ad-promo-section {
            padding: 2.5rem 0;
        }

        .ad-promo-content {
            padding: 1.5rem;
        }

        .ad-promo-stats {
            grid-template-columns: 1fr;
        }

        .ad-benefits-list li {
            flex-direction: column;
            text-align: center;
            align-items: center;
        }

        .ad-icon {
            margin-bottom: 0.5rem;
        }
    }
</style>
<?php include $this->resolve('User/sidebar.php'); ?>
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
            <h2 class="section-title">Dashboard Overview</h2>
            <p>Track your performance and upcoming tasks</p>
        </div>
        <div class="quick-access-section">
            <h2 class="section-title">Quick Access</h2>
            <div class="quick-access-grid">
                <a href="/course/create" class="quick-access-card">
                    <div class="quick-access-icon">
                        <i class="fas fa-plus-circle"></i>
                    </div>
                    <h3>Create Course</h3>
                </a>
                <a href="/course/my-courses" class="quick-access-card">
                    <div class="quick-access-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <h3>My Courses</h3>
                </a>
                <a href="/posts" class="quick-access-card">
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
        <div class="dashboard-grid">
            <div class="chart-container">
                <h2 class="section-title">Monthly Revenue</h2>
                <div class="chart-wrapper">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
            <div class="insights-card">
                <h2 class="section-title">Revenue Insights</h2>
                <div class="insight-item">
                    <div class="insight-icon" style="background: var(--success)">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="insight-content">
                        <h3>Total Revenue</h3>
                        <p>Rs. 45,000 earned this year</p>
                        <div class="insight-trend">
                            <i class="fas fa-arrow-up"></i>
                            <span>15% vs last year</span>
                        </div>
                    </div>
                </div>
                <div class="insight-item">
                    <div class="insight-icon" style="background: var(--theme-color)">
                        <i class="fas fa-crown"></i>
                    </div>
                    <div class="insight-content">
                        <h3>Top-Performing Course</h3>
                        <p>Advanced Web Development (Rs. 12,450)</p>
                        <div class="insight-trend">
                            <i class="fas fa-arrow-up"></i>
                            <span>20% of total revenue</span>
                        </div>
                    </div>
                </div>
                <div class="insight-item">
                    <div class="insight-icon" style="background: var(--warning)">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <div class="insight-content">
                        <h3>Revenue Forecast</h3>
                        <p>Expected to reach Rs. 60,000 by EOY</p>
                        <div class="insight-trend">
                            <i class="fas fa-arrow-up"></i>
                            <span>33% projected growth</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="ad-promo-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Boost Your Course Visibility</h2>
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

    // Add Chart.js initialization for revenue bar chart
    const ctx = document.getElementById('revenueChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Monthly Revenue (Rs.)',
                data: [3500, 4200, 4800, 5500, 6000, 7500, 8200, 7800, 8500, 9200, 8800, 9500],
                backgroundColor: [
                    'rgba(255, 196, 0, 0.8)', // Theme color
                ],
                borderColor: [
                    'rgba(230, 176, 0, 1)', // Theme dark
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: false,
                    text: 'Monthly Revenue'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Revenue (Rs.)'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Month'
                    }
                }
            }
        }
    });
</script>

<?php include $this->resolve('partials/_footer.php') ?>