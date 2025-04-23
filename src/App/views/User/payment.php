<?php include $this->resolve('partials/_header.php'); ?>

<style>
    .payment-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
    }

    .payment-header {
        margin-bottom: 2rem;
    }

    .payment-header h1 {
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

    .table-container {
        overflow-x: auto;
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
        cursor: pointer;
    }

    th:hover {
        background-color: #eee;
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

    .invoice-link {
        color: #e6b000;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .invoice-link:hover {
        text-decoration: underline;
    }

    .payment-filter-btn {
        cursor: pointer;
        font-size: 15px;
        background-color: #FFC400;
        border: none;
    }

    .clear-filter {
        color: black;
    }

    .pagination {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        margin-top: 1rem;
        gap: 0.5rem;
    }

    .page-button {
        padding: 0.5rem 1rem;
        border: 1px solid #ddd;
        background: #ffffff;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .page-button:hover {
        background: #FFC400;
        border-color: #FFC400;
    }

    .page-button.active {
        background: #FFC400;
        border-color: #FFC400;
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

    @media (max-width: 768px) {
        .filters {
            grid-template-columns: 1fr;
        }

        .summary-cards {
            grid-template-columns: 1fr;
        }
    }
</style>

<!-- Include sidebar for users except students -->
<?php if (!empty($_SESSION['user']) && ($_SESSION['user_role'] == 'admin' || $_SESSION['user_role'] = 'teacher')): ?>
    <?php include $this->resolve('User/sidebar.php'); ?>
<?php endif; ?>

<section class="payment-container">
    <div class="payment-header">
        <h1>Billing & Payment History</h1>
        <p>View and manage your payment history</p>
    </div>

    <div class="summary-cards">
        <div class="summary-card">
            <h3>Total Revenue</h3>
            <div class="value">Rs. <?= e($revenue); ?></div>
        </div>
        <div class="summary-card">
            <h3>Active Courses</h3>
            <div class="value"><?= e($courseCount); ?></div>
        </div>
    </div>

    <div class="card">
        <form method="GET" action="/billing-and-payment">
            <div class="filters">
                <input type="text" class="filter-input" id="search" name="s" placeholder="Search transactions..." value="<?= isset($_GET['s']) && $_GET['s'] ? e($_GET['s']) : '' ?>">
                <select class="filter-input" id="status-filter" name="status">
                    <option value="all">All Statuses</option>
                    <option value="2" <?= isset($_GET['status']) && $_GET['status'] == 2 ? 'selected' : '' ?>>Successful</option>
                    <option value="0" <?= isset($_GET['status']) && $_GET['status'] == 0 ? 'selected' : '' ?>>Pending</option>
                    <option value="-2" <?= isset($_GET['status']) && $_GET['status'] == -2 ? 'selected' : '' ?>>Failed</option>
                    <option value="-1" <?= isset($_GET['status']) && $_GET['status'] == -1 ? 'selected' : '' ?>>Canceled</option>
                </select>
                <input type="date" class="filter-input" id="date-filter" name="date" value="<?= isset($_GET['date']) && $_GET['date'] ? e($_GET['date']) : '' ?>">
                <button type="submit" class="payment-filter-btn">Apply Filter</button>
            </div>
            <a href="/billing-and-payment" class="clear-filter">Clear Filters</a>
        </form>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Transaction ID</th>
                        <th>Course</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Invoice</th>
                    </tr>
                </thead>
                <tbody id="transaction-table">
                    <?php foreach ($paymentDetails as $payment): ?>
                        <tr>
                            <td><?= formatDate(e($payment['created_date']), "Y-m-d"); ?></td>
                            <td>TRX-<?= e($payment['payment_id']); ?></td>
                            <td><?= e($payment['title']); ?></td>
                            <td>Rs.<?= e($payment['amount']); ?></td>

                            <td>
                                <?php if ($payment['payment_status'] == 2): ?>
                                    <span class="status-badge status-success">Success</span>
                                <?php elseif ($payment['payment_status'] == 0): ?>
                                    <span class="status-badge status-pending">Pending</span>
                                <?php elseif ($payment['payment_status'] == -1): ?>
                                    <span class="status-badge status-canceled">Canceled</span>
                                <?php elseif ($payment['payment_status'] == -2): ?>
                                    <span class="status-badge status-failed">Failed</span>
                                <?php else: ?>
                                    <span class="status-badge">Unknown</span>
                                <?php endif; ?>
                            </td>
                            <td><a href="#" class="invoice-link"><i class="fas fa-download"></i> Download</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="pagination" id="pagination">
            <?php include $this->resolve('components/pagination.php'); ?>

        </div>
    </div>
</section>

<?php include $this->resolve('partials/_footer.php'); ?>