<?php include $this->resolve('partials/_header.php'); ?>

<style>
    .withdrawal-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
    }

    .withdrawal-header {
        margin-bottom: 2rem;
    }

    .withdrawal-header h1 {
        color: #333;
        margin-bottom: 0.5rem;
    }

    .card {
        background: #ffffff;
        border-radius: 10px;
        padding: 2rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
    }

    .summary-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .summary-card {
        background: #ffffff;
        padding: 1.5rem;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .summary-card h3 {
        color: #666;
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
    }

    .summary-card .value {
        font-size: 1.5rem;
        font-weight: 600;
        color: #333;
    }

    .withdraw-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
        margin-top: 1.5rem;
    }

    .withdraw-form .form-group {
        margin-bottom: 1.5rem;
    }

    .withdraw-form label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
    }

    .withdraw-form small {
        display: block;
        color: #666;
        margin-top: 0.25rem;
    }

    .withdraw-info {
        background-color: #f8f9fa;
        padding: 1.5rem;
        border-radius: 8px;
    }

    .withdraw-info h3 {
        margin-bottom: 1rem;
        color: #333;
    }

    .withdraw-info ul {
        padding-left: 1.5rem;
    }

    .withdraw-info li {
        margin-bottom: 0.5rem;
    }

    .status-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 500;
    }

    .status-success {
        background-color: #d4edda;
        color: #28a745;
    }

    .status-pending {
        background-color: #fff3cd;
        color: #ffc107;
    }

    .status-failed {
        background-color: #f8d7da;
        color: #dc3545;
    }

    .filter-input {
        padding: 0.75rem;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 1rem;
        width: 100%;
    }

    .withdrawal-btn {
        padding: 0.75rem 1.5rem;
        background-color: #FFC400;
        color: #000;
        border: none;
        border-radius: 5px;
        font-size: 1rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .withdrawal-btn:hover {
        background-color: #e6b000;
    }

    .table-container {
        overflow-x: auto;
    }

    .filters {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .filter-input {
        padding: 0.75rem;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 1rem;
        width: 100%;
    }

    .withdraw-filter-btn {
        cursor: pointer;
        font-size: 15px;
        background-color: #FFC400;
        border: none;
    }



    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 1rem;
    }

    th,
    td {
        padding: 1rem;
        text-align: left;
        border-bottom: 1px solid #eee;
    }

    th {
        background-color: #f8f9fa;
        font-weight: 600;
    }

    @media (max-width: 768px) {
        .withdraw-container {
            grid-template-columns: 1fr;
        }

        .summary-cards {
            grid-template-columns: 1fr;
        }
    }

    .alert {
        padding: 1rem;
        border-radius: 5px;
        margin-bottom: 1.5rem;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
</style>

<!-- Include sidebar for users except students -->
<?php if (!empty($_SESSION['user']) && ($_SESSION['user_role'] == 'admin' || $_SESSION['user_role'] == 'teacher')): ?>
    <?php include $this->resolve('User/sidebar.php'); ?>
<?php endif; ?>

<section class="withdrawal-container">
    <div class="withdrawal-header">
        <h1>Withdraw Funds</h1>
        <p>Manage your earnings and request withdrawals</p>
    </div>

    <!-- Display success/error messages if any -->
    <?php if (!empty($_SESSION['success_message'])): ?>
        <div class="alert alert-success">
            <?= e($_SESSION['success_message']) ?>
        </div>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>

    <?php if (!empty($_SESSION['error_message'])): ?>
        <div class="alert alert-danger">
            <?= e($_SESSION['error_message']) ?>
        </div>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>

    <div class="summary-cards">
        <div class="summary-card">
            <h3>All-Time Revenue</h3>
            <div class="value">Rs. <?= e($revenue); ?></div>
        </div>
        <div class="summary-card">
            <h3>Withdrawn Amount</h3>
            <div class="value">Rs. <?= e($withdrawnAmount ?? 0); ?></div>
        </div>
        <div class="summary-card">
            <h3>Available Balance</h3>
            <div class="value">Rs. <?= e($availableBalance ?? ($revenue - ($withdrawnAmount ?? 0))); ?></div>
        </div>
    </div>

    <div class="card">
        <h2>Request a Withdrawal</h2>
        <div class="withdraw-container">
            <div class="withdraw-form">
                <form method="POST" action="/request-withdrawal">
                    <div class="form-group">
                        <label for="withdrawal-amount">Withdrawal Amount (Rs.)</label>
                        <input type="number" id="withdrawal-amount" name="amount" class="filter-input"
                            min="100" required>
                        <small>Minimum withdrawal: Rs. 100</small>
                    </div>
                    <div class="form-group">
                        <label for="bank-details">Bank Details</label>
                        <textarea id="bank-details" name="bank_details" class="filter-input" rows="3"
                            placeholder="Enter bank account details" required></textarea>
                    </div>
                    <button type="submit" class="withdrawal-btn">Request Withdrawal</button>
                </form>
            </div>
            <div class="withdraw-info">
                <h3>Withdrawal Information</h3>
                <ul>
                    <li>Withdrawals are processed within 3-5 business days</li>
                    <li>Minimum withdrawal amount: Rs. 100</li>
                    <li>Bank transfer fees may apply depending on your bank</li>
                    <li>Make sure your payment details are accurate</li>
                    <li>Contact support if you don't receive your funds within 7 business days</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="card">
        <h2>Withdrawal History</h2>
        <form method="GET" action="/wallet">
            <div class="filters">
                <select class="filter-input" id="status-filter" name="status">
                    <option value="all">All Statuses</option>
                    <option value="completed" <?= isset($_GET['status']) && $_GET['status'] == 'completed' ? 'selected' : '' ?>>Completed</option>
                    <option value="pending" <?= isset($_GET['status']) && $_GET['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="failed" <?= isset($_GET['status']) && $_GET['status'] == 'failed' ? 'selected' : '' ?>>Failed</option>
                </select>
                <input type="date" class="filter-input" id="date-filter" name="date" value="<?= isset($_GET['date']) && $_GET['date'] ? e($_GET['date']) : '' ?>">
                <button type="submit" class="withdraw-filter-btn">Apply Filter</button>
            </div>
            <a href="/billing-and-payment" class="clear-filter">Clear Filters</a>
        </form>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Date Requested</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($withdrawalHistory)): ?>
                        <?php foreach ($withdrawalHistory as $withdrawal): ?>
                            <tr>
                                <td><?= formatDate(e($withdrawal['created_date']), "Y-m-d"); ?></td>
                                <td>Rs. <?= e($withdrawal['amount']); ?></td>
                                <td>
                                    <?php if ($withdrawal['status'] == 'completed'): ?>
                                        <span class="status-badge status-success">Completed</span>
                                    <?php elseif ($withdrawal['status'] == 'pending'): ?>
                                        <span class="status-badge status-pending">Pending</span>
                                    <?php elseif ($withdrawal['status'] == 'failed'): ?>
                                        <span class="status-badge status-failed">Failed</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align: center;">No withdrawal history found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?php include $this->resolve('partials/_footer.php'); ?>