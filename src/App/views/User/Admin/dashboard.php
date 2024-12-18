<div class="dashboard">

    <!-- Header -->
    <div class="admin-header">
        <h1>Dashboard Overview</h1>
        <div class="date-range">
            <select>
                <option>Last 7 days</option>
                <option>Last 30 days</option>
                <option>Last 3 months</option>
                <option>Last year</option>
            </select>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="admin-stats-grid">
        <div class="stat-box">
            <h3>Total Users</h3>
            <div class="value"><?php echo ((int)$stat['users']['students'] + (int)$stat['users']['teachers']) ?></div>
            <div class="trend">↑ 12.5% Growth this month</div>
        </div>
        <div class="stat-box">
            <h3>Student Users</h3>
            <div class="value"><?php echo $stat['users']['students'] ?></div>
            <div class="trend">↑ 8.3% Growth this month</div>
        </div>
        <div class="stat-box">
            <h3>Teacher Users</h3>
            <div class="value"><?php echo $stat['users']['teachers'] ?></div>
            <div class="trend">↑ 15.2% Growth this month</div>
        </div>
        <div class="stat-box">
            <h3>Total Courses</h3>
            <div class="value"><?php echo $stat['courses']; ?></div>
            <div class="trend">↑ 5.7% Growth this month</div>
        </div>
        <div class="stat-box">
            <h3>Total Transactions</h3>
            <div class="value">Rs. 75800</div>
        </div>
    </div>

    <!-- Growth Chart -->
    <div class="chart-container">
        <div class="chart-header">
            <h2>User Growth Trend</h2>
            <div class="chart-legend">
                <span>Students</span>
                <span>Teachers</span>
            </div>
        </div>
        <svg class="chart-svg" viewBox="0 0 800 300">
            <!-- Grid Lines -->
            <line class="chart-grid" x1="50" y1="250" x2="750" y2="250" />
            <line class="chart-grid" x1="50" y1="200" x2="750" y2="200" />
            <line class="chart-grid" x1="50" y1="150" x2="750" y2="150" />
            <line class="chart-grid" x1="50" y1="100" x2="750" y2="100" />
            <line class="chart-grid" x1="50" y1="50" x2="750" y2="50" />

            <!-- Chart Line -->
            <path class="chart-line" d="M50,200 L185,180 L320,150 L455,120 L590,85 L725,50" />
            <path class="chart-area" d="M50,200 L185,180 L320,150 L455,120 L590,85 L725,50 L725,250 L50,250 Z" />

            <!-- Data Points -->
            <circle class="chart-dot" cx="50" cy="200" r="4" />
            <circle class="chart-dot" cx="185" cy="180" r="4" />
            <circle class="chart-dot" cx="320" cy="150" r="4" />
            <circle class="chart-dot" cx="455" cy="120" r="4" />
            <circle class="chart-dot" cx="590" cy="85" r="4" />
            <circle class="chart-dot" cx="725" cy="50" r="4" />
        </svg>
    </div>

    <!-- Recent Transactions -->
    <div class="chart-container">
        <div class="chart-header">
            <h2>Recent Transactions</h2>
            <button>View All</button>
        </div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Transaction ID</th>
                    <th>User</th>
                    <th>Course</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>#TRX-789456</td>
                    <td>John Doe</td>
                    <td>Advanced Web Development</td>
                    <td>Rs. 99.99</td>
                    <td><span class="status-badge status-active">Completed</span></td>
                    <td>2024-11-17</td>
                </tr>
                <tr>
                    <td>#TRX-789455</td>
                    <td>Jane Smith</td>
                    <td>UI/UX Design Basics</td>
                    <td>Rs. 79.99</td>
                    <td><span class="status-badge status-pending">Pending</span></td>
                    <td>2024-11-17</td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>

    <!-- Latest Users -->
    <div class="chart-container">
        <div class="chart-header">
            <h2>Latest Registered Users</h2>
            <button>View All</button>
        </div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Joined Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Alice Johnson</td>
                    <td>alice@example.com</td>
                    <td>Student</td>
                    <td>2024-11-17</td>
                    <td><span class="status-badge status-active">Active</span></td>
                </tr>
                <tr>
                    <td>Robert Wilson</td>
                    <td>robert@example.com</td>
                    <td>Teacher</td>
                    <td>2024-11-16</td>
                    <td><span class="status-badge status-pending">Pending</span></td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>
</div>