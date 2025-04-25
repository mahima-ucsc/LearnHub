<?php include $this->resolve('partials/_header.php') ?>
<?php include $this->resolve('User/sidebar.php'); ?>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    :root {
        --primary: #FFC400;
        --primary-light: #FFD740;
        --primary-dark: #FFAB00;
        --text-dark: #333333;
        --text-light: #FFFFFF;
        --background: #F8F9FA;
        --card-bg: #FFFFFF;
        --border: #E0E0E0;
    }

    body {
        background-color: var(--background);
        margin: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: var(--text-dark);
    }

    .container {
        padding: 1.5rem;
        max-width: 1400px;
        margin: 0 auto;
        box-sizing: border-box;
    }

    .summary-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.25rem;
        margin-bottom: 2rem;
    }

    .card {
        background-color: var(--card-bg);
        border-radius: 8px;
        padding: 1.5rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .card-title {
        font-size: 1rem;
        color: #666;
        margin-bottom: 0.5rem;
    }

    .card-value {
        font-size: 1.8rem;
        font-weight: 600;
        color: var(--text-dark);
    }

    .card-change {
        display: block;
        font-size: 0.9rem;
        margin-top: 0.5rem;
    }

    .positive {
        color: #2E7D32;
    }

    .negative {
        color: #C62828;
    }

    .chart-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    @media (max-width: 768px) {
        .chart-container {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 576px) {
        .summary-cards {
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        }

        .container {
            padding: 1rem;
        }

        .card-value {
            font-size: 1.5rem;
        }
    }

    .chart-card {
        background-color: var(--card-bg);
        border-radius: 8px;
        padding: 1.5rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        height: auto;
        min-height: 400px;
    }

    .chart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .chart-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin: 0;
    }

    .chart-actions {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .chart-btn {
        background-color: transparent;
        border: 1px solid var(--border);
        border-radius: 4px;
        padding: 0.4rem 0.8rem;
        cursor: pointer;
        font-size: 0.9rem;
        transition: all 0.2s ease;
    }

    .chart-btn:hover {
        background-color: var(--primary-light);
        border-color: var(--primary);
        color: var(--text-dark);
    }

    .chart-btn.active {
        background-color: var(--primary);
        border-color: var(--primary);
        color: var(--text-light);
    }

    .chart-btn:focus {
        outline: 2px solid var(--primary-dark);
        outline-offset: 2px;
    }

    .period-selector {
        padding: 0.4rem;
        border: 1px solid var(--border);
        border-radius: 4px;
        font-size: 0.9rem;
    }

    canvas {
        width: 100% !important;
        max-height: 350px;
    }

    .large-chart {
        grid-column: 1 / -1;
    }

    .large-chart canvas {
        max-height: 450px;
    }

    footer {
        text-align: center;
        padding: 1.5rem;
        background-color: var(--card-bg);
        color: #666;
        font-size: 0.9rem;
        border-top: 1px solid var(--border);
        margin-top: 2rem;
    }

    /* New styles for revenue table */
    .revenue-table-container {
        background-color: var(--card-bg);
        border-radius: 8px;
        padding: 1.5rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        margin-bottom: 2rem;
        overflow-x: auto;
    }

    .date-range-selector {
        display: flex;
        gap: 1rem;
        align-items: center;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
    }

    .date-input {
        padding: 0.4rem 0.8rem;
        border: 1px solid var(--border);
        border-radius: 4px;
        font-size: 0.9rem;
    }

    .period-preset {
        display: flex;
        gap: 0.5rem;
    }

    .summary-metrics {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .metric-card {
        background-color: var(--background);
        border-radius: 6px;
        padding: 1rem;
        border-left: 3px solid var(--primary);
    }

    .metric-title {
        font-size: 0.9rem;
        color: #666;
        margin-bottom: 0.5rem;
    }

    .metric-value {
        font-size: 1.4rem;
        font-weight: 600;
    }
</style>
</head>

<div class="container">
    <div class="rate-card"
        data-withdrawal-rate="<?= e($WithdrawalRevenueRate); ?>"
        data-ad-rate="<?= e($adRevenueRate); ?>">
        <div class="revenue-table-container large-chart">
            <div class="chart-header">
                <h2 class="chart-title">Revenue by Time Period</h2>
                <div class="date-range-selector">
                    <div class="custom-date-range">
                        <input type="date" id="start-date" class="date-input" placeholder="Start Date">
                        <span>to</span>
                        <input type="date" id="end-date" class="date-input" placeholder="End Date">
                        <button id="apply-range" class="chart-btn">Apply</button>
                    </div>
                </div>
            </div>

            <div class="summary-metrics" id="period-metrics">
                <div class="metric-card">
                    <div class="metric-title">Period Total</div>
                    <div class="metric-value">Rs. </div>
                </div>
                <div class="metric-card">
                    <div class="metric-title">Withdrawal Revenue</div>
                    <div class="metric-value">Rs. </div>
                </div>
                <div class="metric-card">
                    <div class="metric-title">Ad Revenue</div>
                    <div class="metric-value">Rs. </div>
                </div>
                <div class="metric-card">
                    <div class="metric-title">Daily Average</div>
                    <div class="metric-value">Rs. </div>
                </div>
            </div>
            <div class="chart-header">
                <h2 class="chart-title">Revenue by Source</h2>
            </div>
            <canvas id="revenueDoughnutChart"></canvas>
        </div>
    </div>
</div>
<script>
    const withdrawalRate = document.querySelector(".rate-card").dataset.withdrawalRate;
    const adRate = document.querySelector(".rate-card").dataset.adRate;
    // Set default Chart.js colors
    Chart.defaults.color = '#666';
    Chart.defaults.font.family = "'Segoe UI', Tahoma, Geneva, Verdana, sans-serif";

    // Generate random data for demonstration
    function generateData(count, min, max) {
        return Array.from({
            length: count
        }, () => Math.floor(Math.random() * (max - min + 1) + min));
    }

    const withdrawalData = generateData(30, 300, 800);
    const advertisementData = generateData(30, 200, 700);

    // Revenue Doughnut Chart
    const doughnutCtx = document.getElementById('revenueDoughnutChart').getContext('2d');
    const doughnutChart = new Chart(doughnutCtx, {
        type: 'doughnut',
        data: {
            labels: ['Withdrawal Fees (10%)', 'Advertisement Revenue'],
            datasets: [{
                data: [withdrawalRate, adRate],
                backgroundColor: [
                    '#FFC400',
                    '#2196F3'
                ],
                borderColor: [
                    '#FFC400',
                    '#2196F3'
                ],
                borderWidth: 1,
                hoverOffset: 15
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `${context.label}: ${context.parsed}%`;
                        }
                    }
                }
            }
        }
    });

    // Data for revenue by date
    const revenueData = [];

    // Generate sample data for last 90 days
    const today = new Date();
    for (let i = 90; i >= 1; i--) {
        const date = new Date(today);
        date.setDate(date.getDate() - i);

        const withdrawalAmount = Math.floor(Math.random() * (800 - 300 + 1) + 300);
        const adAmount = Math.floor(Math.random() * (700 - 200 + 1) + 200);

        revenueData.push({
            date: date,
            formattedDate: date.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'short',
                day: 'numeric'
            }),
            withdrawal: withdrawalAmount,
            advertisement: adAmount,
            total: withdrawalAmount + adAmount
        });
    }

    // Function to update the revenue metrics based on selected date range
    function updateRevenueTable(days = 30) {
        const endDate = new Date();
        const startDate = new Date();
        startDate.setDate(endDate.getDate() - days);

        // Filter data based on date range
        const filteredData = revenueData.filter(item => {
            return item.date >= startDate && item.date <= endDate;
        });

        // Calculate summary metrics
        const totalWithdrawal = filteredData.reduce((sum, item) => sum + item.withdrawal, 0);
        const totalAd = filteredData.reduce((sum, item) => sum + item.advertisement, 0);
        const totalRevenue = totalWithdrawal + totalAd;
        const avgDailyRevenue = Math.round(totalRevenue / filteredData.length);

        // Populate summary metrics
        const metricsContainer = document.getElementById('period-metrics');
        metricsContainer.innerHTML = `
            <div class="metric-card">
                <div class="metric-title">Period Total</div>
                <div class="metric-value">Rs. ${totalRevenue.toLocaleString()}</div>
            </div>
            <div class="metric-card">
                <div class="metric-title">Withdrawal Revenue</div>
                <div class="metric-value">Rs. ${totalWithdrawal.toLocaleString()}</div>
            </div>
            <div class="metric-card">
                <div class="metric-title">Ad Revenue</div>
                <div class="metric-value">Rs. ${totalAd.toLocaleString()}</div>
            </div>
            <div class="metric-card">
                <div class="metric-title">Daily Average</div>
                <div class="metric-value">Rs. ${avgDailyRevenue.toLocaleString()}</div>
            </div>
        `;
    }

    // Initialize with 30 days data
    updateRevenueTable(30);

    // Handle period selection buttons
    const periodButtons = document.querySelectorAll('.chart-btn[data-days]');
    periodButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Remove active class from all buttons
            periodButtons.forEach(b => b.classList.remove('active'));
            // Add active class to clicked button
            button.classList.add('active');

            // Update metrics for selected period
            const days = parseInt(button.dataset.days, 10);
            updateRevenueTable(days);
        });
    });

    // Handle custom date range
    document.getElementById('apply-range').addEventListener('click', function() {
        const startDateInput = document.getElementById('start-date').value;
        const endDateInput = document.getElementById('end-date').value;

        if (startDateInput && endDateInput) {
            const startDate = new Date(startDateInput);
            const endDate = new Date(endDateInput);

            // Filter data based on custom date range
            const filteredData = revenueData.filter(item => {
                return item.date >= startDate && item.date <= endDate;
            });

            // Calculate summary metrics
            const totalWithdrawal = filteredData.reduce((sum, item) => sum + item.withdrawal, 0);
            const totalAd = filteredData.reduce((sum, item) => sum + item.advertisement, 0);
            const totalRevenue = totalWithdrawal + totalAd;
            const avgDailyRevenue = Math.round(totalRevenue / filteredData.length) || 0;

            // Populate summary metrics
            const metricsContainer = document.getElementById('period-metrics');
            metricsContainer.innerHTML = `
                <div class="metric-card">
                    <div class="metric-title">Period Total</div>
                    <div class="metric-value">Rs. ${totalRevenue.toLocaleString()}</div>
                </div>
                <div class="metric-card">
                    <div class="metric-title">Withdrawal Revenue</div>
                    <div class="metric-value">Rs. ${totalWithdrawal.toLocaleString()}</div>
                </div>
                <div class="metric-card">
                    <div class="metric-title">Ad Revenue</div>
                    <div class="metric-value">Rs. ${totalAd.toLocaleString()}</div>
                </div>
                <div class="metric-card">
                    <div class="metric-title">Daily Average</div>
                    <div class="metric-value">Rs. ${avgDailyRevenue.toLocaleString()}</div>
                </div>
            `;
            // Remove active class from preset buttons
            periodButtons.forEach(b => b.classList.remove('active'));
        } else {
            alert('Please select both start and end dates');
        }
    });
</script>

<?php include $this->resolve('partials/_footer.php') ?>