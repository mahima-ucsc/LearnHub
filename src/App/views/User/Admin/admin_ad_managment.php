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

    .badge {
        display: inline-flex;
        align-items: center;
        padding: 4px 10px;
        border-radius: var(--radius-full);
        font-size: 12px;
        font-weight: 600;
        gap: 6px;
    }

    .badge.banner {
        background-color: #E0F2FE;
        color: #0369A1;
    }

    .badge.sidebar {
        background-color: #ECFDF5;
        color: #047857;
    }

    .badge.popup {
        background-color: #FEF3C7;
        color: #92400E;
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

    .ad-preview {
        margin-top: 16px;
        border: 1px dashed var(--gray-300);
        padding: 16px;
        border-radius: var(--radius);
        background-color: var(--gray-100);
        text-align: center;
    }

    .ad-preview img {
        max-width: 100%;
        height: auto;
        max-height: 300px;
        object-fit: contain;
    }

    .ad-details {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin-top: 16px;
    }

    .ad-detail-item {
        display: flex;
        flex-direction: column;
    }

    .ad-detail-label {
        font-size: 12px;
        color: var(--text-secondary);
    }

    .ad-detail-value {
        font-weight: 600;
        color: var(--text-primary);
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

    /* Responsive styles */
    @media (max-width: 1200px) {
        .post-stats {
            grid-template-columns: repeat(2, 1fr);
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
    }
</style>
<?php include $this->resolve('User/sidebar.php') ?>

<div class="post-container">
    <!-- Main Content -->
    <div class="main-post-content">
        <div class="post-header">
            <div class="post-header-title">
                <h1>Pending Advertisements</h1>
                <div class="post-header-subtitle">Review and approve advertiser submissions</div>
            </div>
            <div class="post-header-actions">
                <div class="search-bar">
                    <button>
                        <i class="fas fa-search"></i>
                    </button>
                    <input type="text" placeholder="Search advertisements...">
                </div>
            </div>
        </div>

        <div class="post-stats">
            <div class="post-stat-card">
                <div class="post-stat-icon icon-primary">
                    <i class="fas fa-clock"></i>
                </div>
                <h3>Pending Ads</h3>
                <div class="value">12</div>
            </div>
            <div class="post-stat-card">
                <div class="post-stat-icon icon-success">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h3>Active Ads</h3>
                <div class="value">45</div>
            </div>
            <div class="post-stat-card">
                <div class="post-stat-icon icon-info">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <h3>Revenue (This Month)</h3>
                <div class="value">$3,250</div>
            </div>
            <div class="post-stat-card">
                <div class="post-stat-icon icon-warning">
                    <i class="fas fa-times-circle"></i>
                </div>
                <h3>Rejected Ads</h3>
                <div class="value">8</div>
            </div>
        </div>

        <div class="content-header">
            <h2 class="content-title">Advertisements pending review</h2>
        </div>

        <div class="filter-bar">
            <div class="filter-options">
                <button class="filter-button active">All</button>
                <button class="filter-button">Pending</button>
                <button class="filter-button">Approved</button>
                <button class="filter-button">Rejected</button>
            </div>
            <select class="sort-dropdown">
                <option>Newest First</option>
                <option>Oldest First</option>
                <option>Company Name (A-Z)</option>
                <option>Price (High to Low)</option>
                <option>Price (Low to High)</option>
            </select>
        </div>

        <div class="posts-container">
            <table class="posts-table">
                <thead>
                    <tr>
                        <th>Advertiser</th>
                        <th>Ad Details</th>
                        <th>Status</th>
                        <th>Package</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
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

<!-- Advertisement Preview Modal -->
<div id="adPreviewModal" class="post-preview-modal" style="display: none;">
    <div class="modal-content">
        <div class="close-modal">&times;</div>
        <div class="modal-header">
            <h2 class="modal-post-title"></h2>
            <div class="modal-post-meta"></div>
        </div>
        <div class="modal-post-content">
            <div class="ad-preview">
                <img src="" alt="Advertisement Preview" id="thumbnailImg">
            </div>
            <div class="ad-details">
                <div class="ad-detail-item">
                    <span class="ad-detail-label">Status</span>
                    <span class="ad-detail-value" id="adStatus"></span>
                </div>
                <div class="ad-detail-item">
                    <span class="ad-detail-label">Package</span>
                    <span class="ad-detail-value" id="adPackage"></span>
                </div>
                <div class="ad-detail-item">
                    <span class="ad-detail-label">Price</span>
                    <span class="ad-detail-value" id="adPrice"></span>
                </div>
                <div class="ad-detail-item">
                    <span class="ad-detail-label">Submitted On</span>
                    <span class="ad-detail-value" id="adSubmittedDate"></span>
                </div>
            </div>
            <p class="ad-description" id="adDescription"></p>
        </div>
        <div class="modal-actions">
            <button class="btn btn-approve-lg btn-text">
                <i class="fas fa-check"></i>
                <span>Approve Advertisement</span>
            </button>
            <button class="btn btn-reject-lg btn-text">
                <i class="fas fa-times"></i>
                <span>Reject Advertisement</span>
            </button>
        </div>
    </div>
</div>

<script src="/assets/js/components/toast.js"></script>

<script>
    // The data provided in PHP array format converted to JavaScript object
    const advertisementData = <?php echo json_encode($advertisements); ?>;

    // Function to render the advertisements table
    function renderAdvertisements(advertisements) {
        const tableBody = document.querySelector('.posts-table tbody');

        // Clear existing table content
        tableBody.innerHTML = '';

        // Check if no advertisements
        if (advertisements.length === 0) {
            tableBody.innerHTML = '<tr><td colspan="6">No pending advertisements</td></tr>';
            return;
        }

        // Loop through advertisements and create table rows
        advertisements.forEach(ad => {
            const row = document.createElement('tr');
            row.setAttribute('data-ad-id', ad.advertisement_id);
            row.setAttribute('data-thumbnail', ad.thumbnail_url);

            // Add HTML content for the row
            row.innerHTML = `
      <td>
        <div class="author">
          <div class="author-info">
            <div class="author-name">${ad.user_name || ''}</div>
          </div>
        </div>
      </td>
      <td>
        <div class="post-title">${ad.title || ''}</div>
        <div class="post-excerpt">${ad.description || ''}</div>
      </td>
      <td>
        <div class="status ${(ad.status).toLowerCase()}">
          ${ad.status}
        </div>
      </td>
      <td>
        ${ad.package}
      </td>
      <td>
        Rs. ${ad.price || '0'}
      </td>
      <td>
        <div class="action-buttons">
        ${ad.status != 'approved' ? '<button class="btn btn-sm btn-approve"><i class="fas fa-check"></i></button>': ''}
        ${ad.status != 'rejected' ? ' <button class="btn btn-sm btn-reject"><i class="fas fa-times"></i></button>': ''}
          <button class="btn btn-sm btn-preview">
            <i class="fas fa-eye"></i>
          </button>
        </div>
      </td>
    `;

            tableBody.appendChild(row);
        });

        // Re-attach event listeners to new buttons
        attachEventListeners();
    }

    // Function to attach event listeners to buttons
    function attachEventListeners() {
        // Preview buttons
        document.querySelectorAll('.btn-preview').forEach(button => {
            button.addEventListener('click', () => {
                const row = button.closest('tr');
                const adId = row.dataset.adId;
                const modal = document.getElementById('adPreviewModal');

                // Find the ad data
                const ad = advertisementData.find(item => item.advertisement_id == adId);
                if (!ad) return;

                // Store ad ID in the modal for reference
                modal.setAttribute('data-ad-id', adId);

                // Update modal content
                modal.querySelector('.modal-post-title').textContent = ad.title;
                modal.querySelector('.modal-post-meta').innerHTML = `
                        <div>
                        <i class="fas fa-building"></i>
                        <span>${ad.user_name}</span>
                        </div>
                    `;

                document.getElementById('thumbnailImg').src =
                    `/storage/uploads/advertisement/thumbnail/${ad.thumbnail_url}`;

                document.getElementById('adStatus').textContent = ad.status;
                document.getElementById('adPackage').textContent = ad.package;
                document.getElementById('adPrice').textContent = `Rs. ${ad.price}`;
                document.getElementById('adSubmittedDate').textContent =
                    new Date(ad.start_date).toLocaleDateString('en-US', {
                        day: '2-digit',
                        month: 'short',
                        year: 'numeric'
                    });
                document.getElementById('adDescription').textContent = ad.description;

                modal.style.display = 'block';
            });
        });
        // Close priview
        const closeModalBtn = document.querySelector('.close-modal');
        if (closeModalBtn) {
            closeModalBtn.addEventListener('click', () => {
                document.getElementById('adPreviewModal').style.display = 'none';
            });
        }

        // Close modal when clicking outside
        window.addEventListener('click', (event) => {
            const modal = document.getElementById('adPreviewModal');
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });

        // Approve buttons
        document.querySelectorAll('.btn-approve').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const row = this.closest('tr');
                const adId = row.dataset.adId;
                handleApproveReject(adId, true);
            });
        });

        // Reject buttons
        document.querySelectorAll('.btn-reject').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const row = this.closest('tr');
                const adId = row.dataset.adId;
                handleApproveReject(adId, false);
            });
        });

        // Filter button functionality
        document.querySelectorAll('.filter-button').forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                document.querySelectorAll('.filter-button').forEach(btn => {
                    btn.classList.remove('active');
                });

                this.classList.add('active');

                const status = this.textContent.trim().toLowerCase();

                filterAdvertisements(status);
            });
        });
    }

    // Function to filter advertisements by status
    function filterAdvertisements(status) {
        let filteredAds;

        if (status === 'all') {
            filteredAds = advertisementData;
        } else {
            filteredAds = advertisementData.filter(ad => ad.status.toLowerCase() === status);
        }

        renderAdvertisements(filteredAds);
    }

    // Function to handle approve/reject actions
    function handleApproveReject(adId, isApprove) {
        // Find the row associated with this ad ID
        const row = document.querySelector(`tr[data-ad-id="${adId}"]`);
        const endpoint = isApprove ? '/approve-advertisement' : '/reject-advertisement';
        // Add loading state
        if (row) {
            row.classList.add('loading');
        }
        fetch(endpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    adId: adId
                })
            })
            .then(response => {
                if (response.ok) return response.json();
                throw new Error('Network response was not ok');
            })
            .then(data => {
                if (data.success) {
                    console.log(data);

                    showToast(
                        isApprove ? 'Advertisement Approved' : 'Advertisement Rejected',
                        isApprove ?
                        'The advertisement has been approved and will now be displayed on the site.' :
                        'The advertisement has been rejected and the advertiser has been notified.',
                        isApprove ? 'success' : 'error'
                    );

                    // Add fade-out animation and update UI
                    if (row) {
                        row.style.opacity = '0';
                        row.style.transition = 'opacity 0.5s';
                        setTimeout(() => row.remove(), 500);
                    }

                    // Close modal if open
                    const modal = document.getElementById('adPreviewModal');
                    if (modal.style.display === 'block') modal.style.display = 'none';

                    // Update the data list to reflect changes
                    const index = advertisementData.findIndex(ad => ad.advertisement_id == adId);
                    if (index !== -1) {
                        advertisementData[index].status = isApprove ? 'approved' : 'rejected';
                    }
                } else {
                    console.log(data);
                    showToast('Error', data.message || `Failed to ${isApprove ? 'approve' : 'reject'} advertisement.`, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error', `There was a problem ${isApprove ? 'approving' : 'rejecting'} the advertisement. Please try again.`, 'error');
                // Remove loading state if failed
                if (row) {
                    row.classList.remove('loading');
                }
            });
    }

    // Initialize the table with the data
    document.addEventListener('DOMContentLoaded', () => {
        if (typeof advertisementData !== 'undefined' && advertisementData.length > 0) {
            renderAdvertisements(advertisementData);
            attachEventListeners();

            // Add modal action buttons event listeners
            document.querySelector('.btn-approve-lg').addEventListener('click', function() {
                const modal = document.getElementById('adPreviewModal');
                const adId = modal.getAttribute('data-ad-id');
                handleApproveReject(adId, true);
            });

            document.querySelector('.btn-reject-lg').addEventListener('click', function() {
                const modal = document.getElementById('adPreviewModal');
                const adId = modal.getAttribute('data-ad-id');
                handleApproveReject(adId, false);
            });

            updateStatistics();

            updateStatistics();
        } else {
            // No data is available
            const tableBody = document.querySelector('.posts-table tbody');
            tableBody.innerHTML = '<tr><td colspan="6">No advertisements data available</td></tr>';
        }
    });
    // Update statistics
    function updateStatistics() {
        if (!advertisementData) return;

        const pendingCount = advertisementData.filter(ad => ad.status.toLowerCase() === 'pending').length;
        const approvedCount = advertisementData.filter(ad => ad.status.toLowerCase() === 'approved').length;
        const rejectedCount = advertisementData.filter(ad => ad.status.toLowerCase() === 'rejected').length;

        document.querySelector('.post-stat-card:nth-child(1) .value').textContent = pendingCount;
        document.querySelector('.post-stat-card:nth-child(2) .value').textContent = approvedCount;
        document.querySelector('.post-stat-card:nth-child(4) .value').textContent = rejectedCount;
    }
</script>

<?php include $this->resolve("partials/_footer.php"); ?>