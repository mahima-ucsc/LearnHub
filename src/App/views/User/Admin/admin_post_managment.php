<?php include $this->resolve("partials/_header.php"); ?>

<link rel="stylesheet" href="/assets/styles/components/toast.css">

<style>
    :root {
        --primary: #FFC400;
        --primary-light: #FFE380;
        --primary-dark: #E6B000;
        --white: #FFFFFF;
        --black: #333333;
        --gray-100: #F9FAFB;
        --gray-200: #F3F4F6;
        --gray-300: #E5E7EB;
        --gray-400: #D1D5DB;
        --gray-500: #9CA3AF;
        --danger: #EF4444;
        --success: #10B981;
        --info: #3B82F6;
        --warning: #F59E0B;
        --text-primary: #111827;
        --text-secondary: #4B5563;
        --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        --shadow-md: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        --radius-sm: 0.25rem;
        --radius: 0.5rem;
        --radius-md: 0.75rem;
        --radius-lg: 1rem;
        --radius-full: 9999px;
    }

    .post-container {
        display: flex;
        min-height: 100vh;
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* Main Content Styles */
    .main-post-content {
        flex: 1;
        margin-left: 50px;
        padding: 24px;
    }

    .post-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 32px;
    }

    .post-header-title h1 {
        font-size: 24px;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 4px;
    }

    .post-header-subtitle {
        color: var(--text-secondary);
        font-size: 14px;
    }

    .post-header-actions {
        display: flex;
        gap: 12px;
        align-items: center;
    }

    .search-bar {
        display: flex;
        align-items: center;
        background-color: var(--white);
        border-radius: var(--radius-full);
        padding: 8px 16px;
        width: 300px;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--gray-300);
        transition: all 0.2s;
    }

    .search-bar:focus-within {
        box-shadow: 0 0 0 3px rgba(255, 196, 0, 0.3);
        border-color: var(--primary);
    }

    .search-bar input {
        border: none;
        outline: none;
        width: 100%;
        padding: 4px 8px;
        font-size: 14px;
        color: var(--text-primary);
    }

    .search-bar button {
        background: none;
        border: none;
        cursor: pointer;
        color: var(--gray-500);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 4px;
    }

    .search-bar button:hover {
        color: var(--primary);
    }

    .post-stats {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
        margin-bottom: 32px;
    }

    .post-stat-card {
        display: flex;
        flex-direction: column;
        background-color: var(--white);
        border-radius: var(--radius);
        padding: 24px;
        box-shadow: var(--shadow-sm);
        transition: all 0.2s ease;
        border: 1px solid var(--gray-200);
    }


    .post-stat-icon {
        width: 48px;
        height: 48px;
        border-radius: var(--radius);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        margin-bottom: 16px;
    }

    .icon-primary {
        background-color: var(--primary-light);
        color: var(--primary-dark);
    }

    .icon-info {
        background-color: #E1EFFE;
        color: #1E40AF;
    }

    .icon-success {
        background-color: #DCFCE7;
        color: #065F46;
    }

    .icon-warning {
        background-color: #FEF3C7;
        color: #92400E;
    }

    .post-stat-card h3 {
        font-size: 14px;
        color: var(--text-secondary);
        margin-bottom: 8px;
        font-weight: 500;
    }

    .post-stat-card .value {
        font-size: 28px;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 8px;
    }

    .post-stat-card {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        font-weight: 500;
    }

    .content-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }

    .content-title {
        font-size: 18px;
        font-weight: 600;
        color: var(--text-primary);
    }

    .filter-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
        background-color: var(--white);
        border-radius: var(--radius);
        padding: 12px 16px;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--gray-200);
    }

    .filter-options {
        display: flex;
        gap: 8px;
    }

    .filter-button {
        background-color: var(--gray-100);
        border: 1px solid var(--gray-300);
        padding: 8px 16px;
        border-radius: var(--radius-full);
        cursor: pointer;
        transition: all 0.2s;
        font-size: 13px;
        font-weight: 500;
        color: var(--text-secondary);
    }

    .filter-button:hover {
        background-color: var(--gray-200);
        color: var(--text-primary);
    }

    .filter-button.active {
        background-color: var(--primary);
        border-color: var(--primary);
        color: var(--black);
        font-weight: 600;
    }

    .sort-dropdown {
        background-color: var(--white);
        border: 1px solid var(--gray-300);
        padding: 8px 16px;
        border-radius: var(--radius);
        cursor: pointer;
        font-size: 13px;
        color: var(--text-secondary);
        outline: none;
    }

    .sort-dropdown:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(255, 196, 0, 0.3);
    }

    .posts-container {
        background-color: var(--white);
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--gray-200);
        overflow: hidden;
        margin-bottom: 24px;
    }

    .posts-table {
        width: 100%;
        border-collapse: collapse;
    }

    .posts-table th,
    .posts-table td {
        padding: 16px;
        text-align: left;
    }

    .posts-table th {
        background-color: var(--gray-100);
        font-weight: 600;
        color: var(--text-secondary);
        font-size: 13px;
        border-bottom: 1px solid var(--gray-200);
    }

    .posts-table tr {
        border-bottom: 1px solid var(--gray-200);
        transition: all 0.2s;
    }

    .posts-table tr:last-child {
        border-bottom: none;
    }

    .posts-table tr:hover {
        background-color: var(--gray-100);
    }

    .author {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .author img {
        width: 40px;
        height: 40px;
        border-radius: var(--radius-full);
        object-fit: cover;
    }

    .author-info {
        display: flex;
        flex-direction: column;
    }

    .author-name {
        font-weight: 600;
        color: var(--text-primary);
    }

    .author-type {
        font-size: 12px;
        color: var(--text-secondary);
    }

    .badge {
        display: inline-flex;
        align-items: center;
        padding: 4px 10px;
        border-radius: var(--radius-full);
        font-size: 12px;
        font-weight: 600;
        gap: 6px;
    }

    .badge.course {
        background-color: #E0F2FE;
        color: #0369A1;
    }

    .badge.requirement {
        background-color: #ECFDF5;
        color: #047857;
    }

    .post-title {
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 6px;
    }

    .post-excerpt {
        color: var(--text-secondary);
        font-size: 13px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .status {
        display: flex;
        align-items: center;
        gap: 6px;
        font-weight: 500;
        font-size: 13px;
    }

    .status.pending {
        color: var(--warning);
    }

    .status.pending .status-dot {
        width: 8px;
        height: 8px;
        background-color: var(--warning);
        border-radius: var(--radius-full);
        display: inline-block;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            opacity: 1;
            transform: scale(1);
        }

        50% {
            opacity: 0.5;
            transform: scale(1.2);
        }

        100% {
            opacity: 1;
            transform: scale(1);
        }
    }

    .action-buttons {
        display: flex;
        gap: 8px;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px;
        border-radius: var(--radius);
        border: none;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.2s;
        font-size: 13px;
        gap: 6px;
    }

    .btn-sm {
        padding: 6px;
        font-size: 12px;
    }

    .btn-text {
        padding: 8px 16px;
    }

    .btn-approve {
        background-color: #ECFDF5;
        color: var(--success);
    }

    .btn-approve:hover {
        background-color: #D1FAE5;
    }

    .btn-reject {
        background-color: #FEF2F2;
        color: var(--danger);
    }

    .btn-reject:hover {
        background-color: #FEE2E2;
    }

    .btn-preview {
        background-color: var(--primary-light);
        color: var(--primary-dark);
    }

    .btn-preview:hover {
        background-color: #FFD700;
    }

    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 24px;
        gap: 8px;
    }

    .page-item {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: var(--radius);
        background-color: var(--white);
        cursor: pointer;
        transition: all 0.2s;
        font-weight: 500;
        border: 1px solid var(--gray-300);
    }

    .page-item:hover {
        border-color: var(--primary);
        color: var(--primary-dark);
    }

    .page-item.active {
        background-color: var(--primary);
        color: var(--black);
        border-color: var(--primary);
        font-weight: 600;
    }

    .post-preview-modal {
        display: none;
        position: fixed;
        z-index: 100;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(4px);
    }

    .modal-content {
        background-color: var(--white);
        margin: 5% auto;
        padding: 32px;
        border-radius: var(--radius-lg);
        width: 70%;
        max-width: 800px;
        box-shadow: var(--shadow-md);
        position: relative;
        transition: all 0.3s ease-in-out;
        transform: scale(0.9);
        opacity: 0;
        animation: modalIn 0.3s forwards;
    }

    @keyframes modalIn {
        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    .close-modal {
        position: absolute;
        right: 24px;
        top: 24px;
        font-size: 24px;
        cursor: pointer;
        width: 32px;
        height: 32px;
        border-radius: var(--radius-full);
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: var(--gray-100);
        color: var(--text-secondary);
        transition: all 0.2s;
    }

    .close-modal:hover {
        background-color: var(--gray-200);
        color: var(--text-primary);
    }

    .modal-header {
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 1px solid var(--gray-200);
    }

    .modal-post-title {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 16px;
        color: var(--text-primary);
    }

    .modal-post-meta {
        display: flex;
        gap: 24px;
        margin-bottom: 24px;
    }

    .modal-post-meta div {
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--text-secondary);
        font-size: 14px;
    }

    .modal-post-content {
        margin-bottom: 32px;
        line-height: 1.6;
        color: var(--text-secondary);
        font-size: 15px;
    }

    .modal-post-content p {
        margin-bottom: 16px;
    }

    .modal-post-content strong {
        color: var(--text-primary);
        font-weight: 600;
    }

    .modal-actions {
        display: flex;
        justify-content: flex-end;
        gap: 16px;
    }

    .modal-actions .btn {
        padding: 10px 20px;
        font-size: 14px;
        font-weight: 600;
    }

    .btn-approve-lg {
        background-color: var(--success);
        color: white;
    }

    .btn-approve-lg:hover {
        background-color: #059669;
    }

    .btn-reject-lg {
        background-color: var(--danger);
        color: white;
    }

    .btn-reject-lg:hover {
        background-color: #DC2626;
    }

    .empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 48px;
        text-align: center;
        color: var(--text-secondary);
    }

    .empty-icon {
        font-size: 48px;
        color: var(--gray-400);
        margin-bottom: 16px;
    }

    .empty-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 8px;
        color: var(--text-primary);
    }

    .empty-description {
        max-width: 400px;
        margin-bottom: 24px;
    }

    /* Loading skeleton animation */
    @keyframes shimmer {
        to {
            background-position: right -200px top 0;
        }
    }

    .loading-skeleton {
        background: linear-gradient(to right, var(--gray-200) 8%, var(--gray-100) 18%, var(--gray-200) 33%);
        background-size: 800px 100px;
        animation: shimmer 2s infinite linear;
        border-radius: var(--radius);
    }


    /* Date badge */
    .date-badge {
        display: flex;
        flex-direction: column;
        align-items: center;
        background-color: var(--gray-100);
        border-radius: var(--radius);
        padding: 4px 8px;
        font-size: 12px;
        line-height: 1.2;
    }

    .date-day {
        font-weight: 700;
        color: var(--text-primary);
    }

    .date-month {
        font-size: 10px;
        color: var(--text-secondary);
        text-transform: uppercase;
    }

    @keyframes fadeOut {
        from {
            opacity: 1;
        }

        to {
            opacity: 0;
            transform: translateY(-10px);
        }
    }

    .row-fade-out {
        animation: fadeOut 0.5s forwards;
    }

    /* Responsive Styles */
    @media (max-width: 1200px) {
        .post-stats {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 1024px) {
        .sidebar {
            width: 80px;
        }

        .logo-text,
        .menu-item span,
        .menu-category,
        .user-info {
            display: none;
        }

        .main-post-content {
            margin-left: 80px;
        }

        .user-profile {
            justify-content: center;
            padding: 16px 0;
        }

        .logo {
            justify-content: center;
        }

        .menu-item {
            justify-content: center;
            padding: 16px 0;
        }
    }

    @media (max-width: 768px) {
        .post-stats {
            grid-template-columns: 1fr;
        }

        .search-bar {
            width: 200px;
        }

        .post-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 16px;
        }

        .post-header-actions {
            width: 100%;
        }

        .search-bar {
            width: 100%;
        }

        .posts-table th:nth-child(3),
        .posts-table td:nth-child(3),
        .posts-table th:nth-child(4),
        .posts-table td:nth-child(4) {
            display: none;
        }

        .modal-content {
            width: 90%;
            padding: 24px;
        }
    }

    @media (max-width: 576px) {
        .filter-bar {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }

        .filter-options {
            width: 100%;
            overflow-x: auto;
            padding-bottom: 8px;
        }

        .sort-dropdown {
            width: 100%;
        }

        .posts-table th:nth-child(5),
        .posts-table td:nth-child(5) {
            display: none;
        }

        .action-buttons {
            flex-direction: column;
        }
    }
</style>
<?php include $this->resolve('User/sidebar.php') ?>

<div class="post-container">
    <!-- Main Content -->
    <div class="main-post-content">
        <div class="post-header">
            <div class="post-header-title">
                <h1>Pending Posts</h1>
                <div class="post-header-subtitle">Review and moderate user-submitted content</div>
            </div>
            <div class="post-header-actions">
                <div class="search-bar">
                    <button>
                        <i class="fas fa-search"></i>
                    </button>
                    <input type="text" placeholder="Search posts...">
                </div>
            </div>
        </div>

        <div class="post-stats">
            <div class="post-stat-card">
                <div class="post-stat-icon icon-primary">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <h3>Pending Posts</h3>
                <div class="value">15</div>
            </div>
            <div class="post-stat-card">
                <div class="post-stat-icon icon-success">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h3>Approved</h3>
                <div class="value">189</div>
            </div>
            <div class="post-stat-card">
                <div class="post-stat-icon icon-warning">
                    <i class="fas fa-times-circle"></i>
                </div>
                <h3>Rejected</h3>
                <div class="value">15</div>
            </div>
        </div>

        <div class="content-header">
            <h2 class="content-title">Posts awaiting review</h2>
        </div>

        <div class="filter-bar">
            <div class="filter-options">
                <button class="filter-button active">All Posts</button>
                <button class="filter-button">Courses</button>
                <button class="filter-button">Requirements</button>
                <button class="filter-button">Reviews</button>
            </div>
            <select class="sort-dropdown">
                <option>Newest First</option>
                <option>Oldest First</option>
                <option>Author Name (A-Z)</option>
                <option>Author Name (Z-A)</option>
            </select>
        </div>

        <div class="posts-container">
            <table class="posts-table">
                <thead>
                    <tr>
                        <th>Author</th>
                        <th>Post</th>
                        <th>Type</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($posts)): ?>
                        <tr>
                            <td colspan="8">No pending posts</td>
                        </tr>
                    <?php endif; ?>
                    <?php foreach ($posts as $post): ?>
                        <tr data-post-id="<?php echo e($post['request_id']); ?>">
                            <td>
                                <div class="author">
                                    <img src="/assets/images/user_placeholder.jpg" alt="Author">
                                    <div class="author-info">
                                        <div class="author-name"><?php echo e($post['author']); ?></div>
                                        <div class="author-type"><?php echo e($post['user_role']); ?></div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="post-title"><?php echo e($post['title']); ?></div>
                                <div class="post-excerpt"><?php echo e($post['description']); ?></div>
                            </td>
                            <td>
                                <div class="badge course"><?php echo e($post['subject']); ?></div>
                            </td>
                            <td>
                                <div class="date-badge">
                                    <div class="date-day"><?php echo e(formatDate($post['created_date'], 'j')); ?></div>
                                    <div class="date-month"><?php echo e(formatDate($post['created_date'], 'M')); ?></div>
                                </div>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-approve">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="btn btn-sm btn-reject">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <button class="btn btn-sm btn-preview">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="pagination">
            <div class="page-item">
                <i class="fas fa-chevron-left"></i>
            </div>
            <div class="page-item active">1</div>
            <div class="page-item">2</div>
            <div class="page-item">3</div>
            <div class="page-item">
                <i class="fas fa-chevron-right"></i>
            </div>
        </div>
    </div>
</div>

<!-- Post Preview Modal -->
<div id="postPreviewModal" class="post-preview-modal" style="display: none;">
    <div class="modal-content">
        <div class="close-modal">&times;</div>
        <div class="modal-header">
            <h2 class="modal-post-title"></h2>
            <div class="modal-post-meta"></div>
        </div>
        <div class="modal-post-content"></div>
        <div class="modal-actions">
            <button class="btn btn-approve-lg btn-text">
                <i class="fas fa-check"></i>
                <span>Approve Post</span>
            </button>
            <button class="btn btn-reject-lg btn-text">
                <i class="fas fa-times"></i>
                <span>Reject Post</span>
            </button>
        </div>
    </div>
</div>

<script src="/assets/js/components/toast.js"></script>

<script>
    const previewButtons = document.querySelectorAll('.btn-preview');
    const modal = document.getElementById('postPreviewModal');
    const closeModal = document.querySelector('.close-modal');
    const modalTitle = modal.querySelector('.modal-post-title');
    const modalMeta = modal.querySelector('.modal-post-meta');
    const modalContent = modal.querySelector('.modal-post-content');

    previewButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Get the parent row
            const row = button.closest('tr');
            const postId = row.dataset.postId;

            // Store post ID in the modal for reference
            modal.setAttribute('data-post-id', postId);

            // Extract data from the row
            const authorName = row.querySelector('.author-name').textContent;
            const postTitle = row.querySelector('.post-title').textContent;
            const postExcerpt = row.querySelector('.post-excerpt').textContent;
            const postType = row.querySelector('.badge').textContent;
            const dateDay = row.querySelector('.date-day').textContent;
            const dateMonth = row.querySelector('.date-month').textContent;
            const userRole = row.querySelector('.author-type').textContent;

            // Update modal content with real data
            modalTitle.textContent = postTitle;

            modalMeta.innerHTML = `
            <div>
                <i class="fas fa-user"></i>
                <span>${authorName}</span>
            </div>
            <div>
                <i class="fas fa-calendar"></i>
                <span>${dateDay} ${dateMonth}, 2025</span>
            </div>
            <div>
                <i class="fas fa-tag"></i>
                <span>${postType}</span>
            </div>
        `;

            modalContent.innerHTML = `
            <p>${postExcerpt}</p>
            <p><strong>Author Role:</strong> ${userRole}</p>
            <p>This is a preview of the post submitted by ${authorName}.</p>
        `;

            modal.style.display = 'block';
        });
    });

    closeModal.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    window.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });

    // Action Buttons Functionality
    const approveButtons = document.querySelectorAll('.btn-approve, .btn-approve-lg');
    const rejectButtons = document.querySelectorAll('.btn-reject, .btn-reject-lg');

    approveButtons.forEach(button => {
        button.addEventListener('click', () => {
            event.preventDefault();
            // Get the post ID
            let row = button.closest('tr');
            let postId;

            if (row) {
                // Button is in the table
                postId = row.dataset.postId;
            } else {
                // Button is in the modal
                postId = modal.getAttribute('data-post-id');
                // Find the corresponding row in the table
                row = document.querySelector(`tr[data-post-id="${postId}"]`);
            }


            // Send POST request to approve the post
            fetch('/approve-post', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        postId: postId
                    })
                })
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    }
                    throw new Error('Network response was not ok');
                })
                .then(data => {

                    if (data.success) {
                        showToast('Post Approved', 'The post has been approved and published successfully.', 'success');

                        // Close modal if open
                        if (modal) modal.style.display = 'none';

                        if (row) {
                            row.classList.add('row-fade-out');
                            setTimeout(() => row.remove(), 500);
                        }
                    } else {
                        showToast('Error', data.message || 'Failed to approve post.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Error', 'There was a problem approving the post. Please try again.', 'error');
                });
        });
    });

    rejectButtons.forEach(button => {
        button.addEventListener('click', () => {
            event.preventDefault();
            // Get the post ID
            let row = button.closest('tr');
            let postId;

            if (row) {
                // Button is in the table
                postId = row.dataset.postId;
            } else {
                // Button is in the modal
                postId = modal.getAttribute('data-post-id');
                // Find the corresponding row in the table
                row = document.querySelector(`tr[data-post-id="${postId}"]`);
            }

            // Send POST request to reject the post
            fetch('/reject-post', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        postId: postId
                    })
                })
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    }
                    throw new Error('Network response was not ok');
                })
                .then(data => {
                    if (data.success) {
                        showToast('Post Rejected', 'The post has been rejected and the author has been notified.', 'error');
                        if (modal) modal.style.display = 'none';
                        if (row) {
                            row.classList.add('row-fade-out');
                            setTimeout(() => row.remove(), 500);
                        }
                    } else {
                        showToast('Error', data.message || 'Failed to reject post.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Error', 'There was a problem rejecting the post. Please try again.', 'error');
                });
        });
    });

    // Filter and Sort Functionality
    const filterButtons = document.querySelectorAll('.filter-button');

    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            filterButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
            // Here you would add filtering logic
        });
    });
</script>

<?php include $this->resolve("partials/_footer.php"); ?>