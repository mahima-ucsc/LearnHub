<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        </div>
        <canvas id="myChart" style="max-width: 1200px;max-height: 450px;"></canvas>
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

<?php
// Dummy data for the chart
$labels = ['January', 'February', 'March', 'April', 'May'];
$data = [10, 20, 15, 25, 30];

// Convert PHP arrays to JSON for use in JavaScript
$labelsJSON = json_encode($labels);
$dataJSON = json_encode($data);
?>

<script>
    // Get data from PHP
    const labels = <?php echo $labelsJSON; ?>;
    const data = <?php echo $dataJSON; ?>;

    // Chart.js configuration
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'line', // Type of chart: bar, line, pie, etc.
        data: {
            labels: labels, // Labels for the X-axis
            datasets: [{
                label: 'Sales Data', // Legend label
                data: data, // Data for the Y-axis 
                borderColor: '#FFC400', // Line color
                borderWidth: 2, // Line thickness
                pointBackgroundColor: '#FFC400', // Point fill color
                pointBorderColor: '#fff', // Point border color
                pointBorderWidth: 2, // Point border width
                pointRadius: 5, // Point size
                hitRadius: 50
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false // Hides the legend
                }
            },
            scales: {
                y: {
                    title: {
                        display: true,
                        text: 'Sales (in $)',
                        font: {
                            size: 14
                        }
                    },
                    beginAtZero: true,
                }
            }
        },
        plugins: {
            legend: {
                labels: {
                    font: {
                        size: 14,
                        family: 'Verdana'
                    },
                    color: '#333',
                    padding: 20,
                    boxWidth: 10,
                }
            }
        }
    });
</script>