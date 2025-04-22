<?php include $this->resolve('partials/_header.php'); ?>

<head>
    <link rel="stylesheet" href="/assets/styles/User/payment.css">
</head>

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
        <div class="filters">
            <input type="text" class="filter-input" id="search" placeholder="Search transactions...">
            <select class="filter-input" id="status-filter">
                <option value="">All Statuses</option>
                <option value="success">Successful</option>
                <option value="pending">Pending</option>
                <option value="failed">Failed</option>
            </select>
            <input type="date" class="filter-input" id="date-filter">
        </div>

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
            <button class="page-button">1</button>
            <button class="page-button active">2</button>
            <button class="page-button">3</button>
            <button class="page-button">Next</button>
        </div>
    </div>
</section>

<?php include $this->resolve('partials/_footer.php'); ?>