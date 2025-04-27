<?php include $this->resolve('partials/_header.php'); ?>
<link rel="stylesheet" href="/assets/styles/User/payment.css">

<!-- Include sidebar for users except students -->
<?php if (!empty($_SESSION['user']) && ($_SESSION['user_role'] == 'admin' || $_SESSION['user_role'] == 'teacher')): ?>
    <?php include $this->resolve('User/sidebar.php'); ?>
<?php endif; ?>

<section class="payment-container">
    <div class="payment-header">
        <h1>Billing & Payment History</h1>
        <p>View and manage your payment history</p>
    </div>

    <div class="summary-cards">
        <div class="summary-card">
            <h3>Total Transactions</h3>
            <div class="value">Rs. <?= e($transactions); ?></div>
        </div>
        <div class="summary-card">
            <h3>Total withdrawal</h3>
            <div class="value"><?= e($totalWithdrawal); ?></div>
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