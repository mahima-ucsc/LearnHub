<?php include $this->resolve('partials/_header.php'); ?>
<link rel="stylesheet" href="/assets/styles/components/toast.css">

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

    .withdrawal-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 2rem;
    }

    .dashboard-title {
        margin-bottom: 2rem;
        color: var(--text-dark);
        border-left: 5px solid var(--theme-color);
        padding-left: 1rem;
    }

    /* Stats Cards */
    .stats-container {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: var(--white);
        border-radius: 0.5rem;
        padding: 1.5rem;
        box-shadow: var(--shadow);
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: var(--theme-light);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
    }

    .stat-icon i {
        color: var(--theme-dark);
        font-size: 1.5rem;
    }

    .stat-value {
        font-size: 1.75rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        color: var(--text-light);
        font-size: 0.9rem;
    }

    /* Table Styles */
    .table-container {
        background: var(--white);
        border-radius: 0.5rem;
        box-shadow: var(--shadow);
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .table-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 1.5rem;
        border-bottom: 1px solid var(--bg-light);
    }

    .table-title {
        font-size: 1.25rem;
        color: var(--text-dark);
    }

    .search-container {
        display: flex;
        align-items: center;
        background: var(--bg-light);
        border-radius: 2rem;
        padding: 0.5rem 1rem;
    }

    .search-input {
        border: none;
        background: transparent;
        outline: none;
        padding-left: 0.5rem;
        color: var(--text-dark);
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead {
        background: var(--bg-light);
    }

    th,
    td {
        padding: 1rem;
        text-align: left;
    }

    th {
        font-weight: 600;
        color: var(--text-dark);
    }

    tr:not(:last-child) {
        border-bottom: 1px solid var(--bg-light);
    }

    .withdrawal-status {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 1rem;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .status-completed {
        background: rgba(46, 204, 113, 0.2);
        color: var(--success);
    }

    .status-pending {
        background: rgba(243, 156, 18, 0.2);
        color: var(--warning);
    }

    .status-canceled {
        background: rgba(231, 76, 60, 0.2);
        color: var(--danger);
    }

    .action-btn {
        padding: 0.5rem;
        border-radius: 0.25rem;
        border: none;
        cursor: pointer;
        transition: background 0.3s;
        margin-right: 0.5rem;
    }

    .btn-complete {
        background: rgba(40, 204, 113, 0.1);
        color: var(--success);
    }

    .btn-cancel {
        background: rgba(231, 76, 60, 0.1);
        color: var(--danger);
    }

    .btn-view {
        background: rgba(52, 152, 219, 0.1);
        color: #3498db;
    }

    .btn-complete:hover {
        background: rgba(40, 204, 113, 0.2);
    }

    .btn-cancel:hover {
        background: rgba(231, 76, 60, 0.2);
    }

    .btn-view:hover {
        background: rgba(52, 152, 219, 0.2);
    }

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
        background-color: var(--white);
        margin: 10% auto;
        padding: 2rem;
        border-radius: 0.5rem;
        box-shadow: var(--shadow);
        width: 80%;
        max-width: 600px;
        position: relative;
    }

    .close-modal {
        color: var(--text-light);
        position: absolute;
        right: 1rem;
        top: 1rem;
        font-size: 1.5rem;
        font-weight: bold;
        cursor: pointer;
    }

    .close-modal:hover {
        color: var(--text-dark);
    }

    .detail-row {
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid var(--bg-light);
        display: flex;
    }

    .detail-label {
        font-weight: 600;
        color: var(--text-dark);
        width: 40%;
    }

    .detail-value {
        color: var(--text-light);
        width: 60%;
    }

    @media (max-width: 1024px) {
        .stats-container {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .withdrawal-container {
            padding: 1rem;
        }

        .table-responsive {
            overflow-x: auto;
        }
    }

    @media (max-width: 480px) {
        .stats-container {
            grid-template-columns: 1fr;
        }
    }
</style>
<?php include $this->resolve('Admin/sidebar.php'); ?>
<div class="withdrawal-container">
    <h1 class="dashboard-title">Withdrawal Management</h1>

    <!-- Stats Cards -->
    <div class="stats-container">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-money-bill-wave"></i>
            </div>
            <div class="stat-value" id="totalWithdrawals"><?php echo e($totalWithdrawals); ?></div>
            <div class="stat-label">Total Withdrawals</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="stat-value" id="totalAmountWithdrawn">Rs. <?php echo e($totalAmount); ?></div>
            <div class="stat-label">Total Amount</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-value" id="pendingWithdrawals"><?php echo e($pendingCount); ?></div>
            <div class="stat-label">Pending Withdrawals</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-value" id="completedWithdrawals"><?php echo e($completedCount); ?></div>
            <div class="stat-label">Completed Withdrawals</div>
        </div>
    </div>

    <!-- Withdrawals Table -->
    <div class="table-container">
        <div class="table-header">
            <h2 class="table-title">Teacher Withdrawal Requests</h2>
            <div class="search-container">
                <form>
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search by teacher..." class="search-input" id="searchInput" name="s" value="<?php echo isset($_GET['s']) ? e($_GET['s']) : ''; ?>">
                    <input type="hidden" name="p" value="1">
                </form>
            </div>
        </div>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Teacher</th>
                        <th>Amount</th>
                        <th>Date Requested</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="withdrawalTableBody">
                    <!-- Withdrawal requests will be added dynamically -->
                    <?php if (empty($withdrawalHistory)): ?>
                        <tr>
                            <td colspan="5">No withdrawal requests found</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($withdrawalHistory as $withdrawal): ?>
                            <tr
                                data-id="<?= $withdrawal['withdrawal_id']; ?>"
                                data-user="<?= $withdrawal['teacher_id']; ?>"
                                data-bank-details="<?= nl2br(e($withdrawal['bank_details'])); ?>">



                                <td id="username"><?php echo e($withdrawal['username']); ?></td>
                                <td id="amount">Rs. <?php echo e($withdrawal['amount']); ?></td>
                                <td id="date-requested"><?php echo e(formatDate($withdrawal['date_requested'], 'M d, Y')); ?></td>
                                <td id="status">
                                    <span class="withdrawal-status status-<?php echo e($withdrawal['status']); ?>">
                                        <?php echo ucfirst(e($withdrawal['status'])); ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if ($withdrawal['status'] === 'pending'): ?>
                                        <button class="action-btn btn-complete" data-id="<?= $withdrawal['withdrawal_id']; ?>" data-user="<?= $withdrawal['teacher_id']; ?>">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        <button class="action-btn btn-cancel" data-id="<?= $withdrawal['withdrawal_id']; ?>" data-user="<?= $withdrawal['teacher_id']; ?>">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    <?php endif; ?>
                                    <button class="action-btn btn-view">
                                        <i class="fa-solid fa-up-right-and-down-left-from-center"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php include $this->resolve('components/pagination.php'); ?>
    </div>
</div>
<!-- Withdrawal Details Modal -->
<div id="withdrawalDetailsModal" class="modal">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <h2>Withdrawal Request Details</h2>
        <div id="modalContent">
            <div class="detail-row">
                <span class="detail-label">Teacher:</span>
                <span id="modal-teacher" class="detail-value"></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Amount:</span>
                <span id="modal-amount" class="detail-value"></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Status:</span>
                <span id="modal-status" class="detail-value"></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Date Requested:</span>
                <span id="modal-date-requested" class="detail-value"></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Bank Details:</span>
                <span id="modal-bank-details" class="detail-value"></span>
            </div>
        </div>
    </div>
</div>
<script src="/assets/js/components/toast.js"></script>

<script>
    document.querySelectorAll(".btn-complete").forEach(btn => {
        btn.addEventListener('click', () => {
            console.log(btn.getAttribute('data-id'));
            const id = btn.getAttribute('data-id');
            const user = btn.getAttribute('data-user');
            handleApproveReject(id, user, 'complete');
        });
    });

    document.querySelectorAll(".btn-cancel").forEach(btn => {
        btn.addEventListener('click', () => {
            console.log(btn.getAttribute('data-id'));
            const id = btn.getAttribute('data-id');
            const user = btn.getAttribute('data-user');
            handleApproveReject(id, user, 'cancel');
        });
    });

    function handleApproveReject(id, user, type) {
        fetch(`/withdrawal/${type}/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `user=${user}`
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Server returned ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    console.log(data.res);

                    showToast("Success", `Withdrawal ${type} successfully.`, "success");
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                } else {
                    console.error("Failed to mark attendance");
                    showToast("Error", `Failed to ${type} Withdrawal.`, "error");
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                }

            })
            .catch(error => {
                console.log(`Error submitting withdrawal ${type}:`, error);

            });
    }

    document.querySelectorAll('.btn-view').forEach(btn => {
        btn.addEventListener('click', function() {
            const row = this.closest('tr');

            // Get data 
            const teacherName = row.querySelector("#username").textContent;
            const amount = row.querySelector("#amount").textContent;
            const dateRequested = row.querySelector("#date-requested").textContent;
            const status = row.querySelector("#status").textContent.trim();


            const withdrawalId = row.getAttribute('data-id');
            const teacherId = row.getAttribute('data-user');
            const bankDetails = row.getAttribute('data-bank-details');

            // Populate modal with data
            document.getElementById('modal-teacher').textContent = teacherName;
            document.getElementById('modal-amount').textContent = amount;
            document.getElementById('modal-status').textContent = status;
            document.getElementById('modal-date-requested').textContent = dateRequested;
            document.getElementById('modal-bank-details').innerHTML = bankDetails;

            // Show the modal
            document.getElementById('withdrawalDetailsModal').style.display = 'block';
        });
    });

    // Close modal when clicking the close button
    document.querySelector('.close-modal').addEventListener('click', function() {
        document.getElementById('withdrawalDetailsModal').style.display = 'none';
    });

    // Close modal when clicking outside the modal content
    window.addEventListener('click', function(event) {
        const modal = document.getElementById('withdrawalDetailsModal');
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
</script>

<?php include $this->resolve('partials/_footer.php'); ?>