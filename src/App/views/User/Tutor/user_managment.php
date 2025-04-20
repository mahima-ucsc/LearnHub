<?php include $this->resolve('partials/_header.php') ?>

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
        --sidebar-width: 260px;
        --sidebar-collapsed-width: 0px;
        --header-height: 60px;
    }


    .user-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .menu-toggle {
        /* background: none; */
        background-color: #2ECC71;
        border: none;
        color: var(--text-dark);
        font-size: 1.2rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: auto 0;
        transition: transform 0.3s;
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }

    .menu-toggle:hover {
        background-color: var(--bg-light);
    }

    .menu-toggle.active {
        transform: rotate(180deg);
    }

    /* Main Content */
    .user-main-content {
        margin-left: 0;
        padding-top: calc(var(--header-height) + 2rem);
        transition: margin-left 0.3s ease;
        min-height: 100vh;
    }

    .user-main-content.shifted {
        margin-left: var(--sidebar-width);
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

    /* Users Table */
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

    .user-info {
        display: flex;
        align-items: center;
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--theme-light);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        color: var(--theme-dark);
        font-weight: bold;
    }

    .user-details {
        display: flex;
        flex-direction: column;
    }

    .user-name {
        font-weight: 500;
    }

    .user-email {
        font-size: 0.85rem;
        color: var(--text-light);
    }

    .user-role {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 1rem;
        font-size: 0.85rem;
        font-weight: 500;
        background: var(--bg-light);
    }

    .role-admin {
        background: var(--theme-light);
        color: var(--theme-dark);
    }

    .role-editor {
        background: rgba(46, 204, 113, 0.2);
        color: var(--success);
    }

    .role-user {
        background: rgba(52, 152, 219, 0.2);
        color: #3498db;
    }

    .action-btn {
        padding: 0.5rem;
        border-radius: 0.25rem;
        border: none;
        cursor: pointer;
        transition: background 0.3s;
    }

    .btn-delete {
        background: rgba(231, 76, 60, 0.1);
        color: var(--danger);
    }

    .btn-delete:hover {
        background: rgba(231, 76, 60, 0.2);
    }

    .pagination {
        display: flex;
        justify-content: flex-end;
        padding: 1rem 1.5rem;
        align-items: center;
    }

    .page-btn {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 0.25rem;
        cursor: pointer;
        transition: background 0.3s;
    }

    .page-btn:hover {
        background: var(--bg-light);
    }

    .active-page {
        background: var(--theme-color);
        color: var(--white);
    }

    .active-page:hover {
        background: var(--theme-dark);
    }

    /* Modal */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        align-items: center;
        justify-content: center;
        z-index: 1001;
    }

    .modal-content {
        background: var(--white);
        border-radius: 0.5rem;
        width: 400px;
        max-width: 90%;
        padding: 2rem;
        box-shadow: var(--shadow);
    }

    .modal-header {
        text-align: center;
        margin-bottom: 1.5rem;
    }

    .modal-title {
        color: var(--text-dark);
        font-size: 1.25rem;
    }

    .modal-body {
        text-align: center;
        margin-bottom: 1.5rem;
    }

    .modal-footer {
        display: flex;
        justify-content: center;
        gap: 1rem;
    }

    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 0.25rem;
        border: none;
        cursor: pointer;
        font-weight: 500;
        transition: background 0.3s;
    }

    .btn-primary {
        background: var(--theme-color);
        color: var(--white);
    }

    .btn-primary:hover {
        background: var(--theme-dark);
    }

    .btn-secondary {
        background: var(--text-light);
        color: var(--white);
    }

    .btn-secondary:hover {
        background: #555;
    }

    /* Toast Notification */
    .toast {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: var(--white);
        border-radius: 0.5rem;
        padding: 1rem;
        box-shadow: var(--shadow);
        display: flex;
        align-items: center;
        transform: translateY(100px);
        opacity: 0;
        transition: all 0.3s;
        z-index: 1002;
    }

    .toast.show {
        transform: translateY(0);
        opacity: 1;
    }

    .toast-icon {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 0.75rem;
    }

    .toast-success .toast-icon {
        background: rgba(46, 204, 113, 0.2);
        color: var(--success);
    }

    .toast-error .toast-icon {
        background: rgba(231, 76, 60, 0.2);
        color: var(--danger);
    }

    .toast-message {
        font-size: 0.9rem;
        color: var(--text-dark);
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .stats-container {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .table-responsive {
            overflow-x: auto;
        }

        .header-content {
            align-items: center;
        }

        .nav-menu {
            display: none;
        }

        .table-header {
            flex-direction: column;
            gap: 1rem;
        }

        .search-container {
            width: 100%;
        }

        .user-main-content.shifted {
            margin-left: 0;
        }

        .sidebar.active {
            left: 0;
            width: 100%;
        }
    }

    @media (max-width: 480px) {
        .stats-container {
            grid-template-columns: 1fr;
        }

        .modal-content {
            padding: 1.5rem;
        }

        .modal-footer {
            flex-direction: column;
            gap: 0.5rem;
        }

        .btn {
            width: 100%;
        }

    }
</style>



<?php include $this->resolve('User/sidebar.php') ?>

<!-- Main Content -->
<main class="user-main-content" id="mainContent">

    <div class="user-container">
        <h1 class="dashboard-title">User Management</h1>

        <!-- Stats Cards -->
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-value" id="totalUsers">--</div>
                <div class="stat-label">Total Users</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-user-shield"></i>
                </div>
                <div class="stat-value" id="adminCount">--</div>
                <div class="stat-label">Admins</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-user-edit"></i>
                </div>
                <div class="stat-value" id="editorCount">--</div>
                <div class="stat-label">Editors</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-user"></i>
                </div>
                <div class="stat-value" id="regularUserCount">--</div>
                <div class="stat-label">Regular Users</div>
            </div>
        </div>

        <!-- Users Table -->
        <div class="table-container">
            <div class="table-header">
                <h2 class="table-title">Registered Users</h2>
                <div class="search-container">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search users..." class="search-input" id="searchInput">
                </div>
            </div>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>User</th>
                            <th>Joined Date</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="userTableBody">
                        <!-- Table rows will be added dynamically -->
                    </tbody>
                </table>
            </div>
            <div class="pagination" id="pagination">
                <!-- Pagination will be added dynamically -->
            </div>
        </div>
    </div>
</main>

<!-- Delete Confirmation Modal -->
<div class="modal" id="deleteModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Delete User</h3>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to delete <span id="deleteUserName">this user</span>?</p>
            <p>This action cannot be undone.</p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" id="cancelDeleteBtn">Cancel</button>
            <button class="btn btn-primary" id="confirmDeleteBtn">Delete</button>
        </div>
    </div>
</div>

<!-- Toast Notification -->
<div class="toast" id="toast">
    <div class="toast-icon">
        <i class="fas fa-check"></i>
    </div>
    <div class="toast-message" id="toastMessage">Action completed successfully!</div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Variables for pagination
        // Sample data - in real application this would come from a database
        let users = [{
                id: 1,
                name: 'John Doe',
                email: 'john.doe@example.com',
                role: 'admin',
                joinedDate: '2023-01-15'
            },
            {
                id: 2,
                name: 'Jane Smith',
                email: 'jane.smith@example.com',
                role: 'editor',
                joinedDate: '2023-02-20'
            },
            {
                id: 3,
                name: 'Robert Johnson',
                email: 'robert.johnson@example.com',
                role: 'user',
                joinedDate: '2023-03-10'
            },
            {
                id: 4,
                name: 'Emily Brown',
                email: 'emily.brown@example.com',
                role: 'user',
                joinedDate: '2023-03-15'
            },
            {
                id: 5,
                name: 'Michael Wilson',
                email: 'michael.wilson@example.com',
                role: 'admin',
                joinedDate: '2023-04-05'
            },
            {
                id: 6,
                name: 'Sarah Taylor',
                email: 'sarah.taylor@example.com',
                role: 'editor',
                joinedDate: '2023-04-22'
            },
            {
                id: 7,
                name: 'David Miller',
                email: 'david.miller@example.com',
                role: 'user',
                joinedDate: '2023-05-08'
            },
            {
                id: 8,
                name: 'Emma Martinez',
                email: 'emma.martinez@example.com',
                role: 'user',
                joinedDate: '2023-05-30'
            },
            {
                id: 9,
                name: 'James Anderson',
                email: 'james.anderson@example.com',
                role: 'editor',
                joinedDate: '2023-06-12'
            },
            {
                id: 10,
                name: 'Olivia Thomas',
                email: 'olivia.thomas@example.com',
                role: 'user',
                joinedDate: '2023-06-25'
            },
            {
                id: 11,
                name: 'William Jackson',
                email: 'william.jackson@example.com',
                role: 'user',
                joinedDate: '2023-07-03'
            },
            {
                id: 12,
                name: 'Sophia White',
                email: 'sophia.white@example.com',
                role: 'admin',
                joinedDate: '2023-07-18'
            },
            {
                id: 13,
                name: 'Alexander Harris',
                email: 'alexander.harris@example.com',
                role: 'user',
                joinedDate: '2023-08-05'
            },
            {
                id: 14,
                name: 'Mia Clark',
                email: 'mia.clark@example.com',
                role: 'user',
                joinedDate: '2023-08-22'
            },
            {
                id: 15,
                name: 'Benjamin Lewis',
                email: 'benjamin.lewis@example.com',
                role: 'editor',
                joinedDate: '2023-09-10'
            },
            {
                id: 16,
                name: 'Charlotte Walker',
                email: 'charlotte.walker@example.com',
                role: 'user',
                joinedDate: '2023-09-28'
            },
            {
                id: 17,
                name: 'Daniel Hall',
                email: 'daniel.hall@example.com',
                role: 'user',
                joinedDate: '2023-10-15'
            },
            {
                id: 18,
                name: 'Amelia Allen',
                email: 'amelia.allen@example.com',
                role: 'admin',
                joinedDate: '2023-11-03'
            },
            {
                id: 19,
                name: 'Henry Young',
                email: 'henry.young@example.com',
                role: 'editor',
                joinedDate: '2023-11-20'
            },
            {
                id: 20,
                name: 'Ava King',
                email: 'ava.king@example.com',
                role: 'user',
                joinedDate: '2023-12-08'
            }
        ];

        const itemsPerPage = 5;
        let currentPage = 1;
        let filteredUsers = [...users];

        // Elements
        const userTableBody = document.getElementById('userTableBody');
        const pagination = document.getElementById('pagination');
        const searchInput = document.getElementById('searchInput');
        const deleteModal = document.getElementById('deleteModal');
        const deleteUserName = document.getElementById('deleteUserName');
        const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        const toast = document.getElementById('toast');
        const toastMessage = document.getElementById('toastMessage');

        // Dashboard counters
        const totalUsersElement = document.getElementById('totalUsers');
        const adminCountElement = document.getElementById('adminCount');
        const editorCountElement = document.getElementById('editorCount');
        const regularUserCountElement = document.getElementById('regularUserCount');

        // Update dashboard stats
        function updateDashboardStats() {
            const adminCount = users.filter(user => user.role === 'admin').length;
            const editorCount = users.filter(user => user.role === 'editor').length;
            const regularUserCount = users.filter(user => user.role === 'user').length;

            totalUsersElement.textContent = users.length;
            adminCountElement.textContent = adminCount;
            editorCountElement.textContent = editorCount;
            regularUserCountElement.textContent = regularUserCount;
        }

        // Initialize user table
        function renderUserTable() {
            // Filter users based on search input
            const searchTerm = searchInput.value.toLowerCase();
            filteredUsers = users.filter(user =>
                user.name.toLowerCase().includes(searchTerm) ||
                user.email.toLowerCase().includes(searchTerm)
            );

            // Calculate pagination
            const totalPages = Math.ceil(filteredUsers.length / itemsPerPage);
            if (currentPage > totalPages && totalPages > 0) {
                currentPage = totalPages;
            }

            const startIndex = (currentPage - 1) * itemsPerPage;
            const paginatedUsers = filteredUsers.slice(startIndex, startIndex + itemsPerPage);

            // Clear table
            userTableBody.innerHTML = '';

            // Render users
            paginatedUsers.forEach(user => {
                const row = document.createElement('tr');

                // Format date
                const joinedDate = new Date(user.joinedDate);
                const formattedDate = joinedDate.toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric'
                });

                // Get initials for avatar
                const initials = user.name.split(' ')
                    .map(name => name.charAt(0))
                    .join('')
                    .toUpperCase();

                row.innerHTML = `
                    <td>${user.id}</td>
                    <td>
                        <div class="user-info">
                            <div class="user-avatar">${initials}</div>
                            <div class="user-details">
                                <div class="user-name">${user.name}</div>
                                <div class="user-email">${user.email}</div>
                            </div>
                        </div>
                    </td>
                    <td>${formattedDate}</td>
                    <td>
                        <span class="user-role role-${user.role}">${user.role}</span>
                    </td>
                    <td>
                        <button class="action-btn btn-delete" data-id="${user.id}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                `;

                userTableBody.appendChild(row);
            });

            // Attach event listeners to delete buttons
            document.querySelectorAll('.btn-delete').forEach(btn => {
                btn.addEventListener('click', function() {
                    const userId = parseInt(this.getAttribute('data-id'));
                    const user = users.find(u => u.id === userId);

                    if (user) {
                        deleteUserName.textContent = user.name;
                        deleteModal.style.display = 'flex';

                        // Store the user ID for deletion
                        confirmDeleteBtn.setAttribute('data-id', userId);
                    }
                });
            });

            // Render pagination
            renderPagination(totalPages);
        }

        // Render pagination controls
        function renderPagination(totalPages) {
            pagination.innerHTML = '';

            // Previous button
            const prevBtn = document.createElement('div');
            prevBtn.classList.add('page-btn');
            prevBtn.innerHTML = '<i class="fas fa-chevron-left"></i>';
            prevBtn.addEventListener('click', () => {
                if (currentPage > 1) {
                    currentPage--;
                    renderUserTable();
                }
            });
            pagination.appendChild(prevBtn);

            // Page numbers
            for (let i = 1; i <= totalPages; i++) {
                const pageBtn = document.createElement('div');
                pageBtn.classList.add('page-btn');
                if (i === currentPage) {
                    pageBtn.classList.add('active-page');
                }
                pageBtn.textContent = i;
                pageBtn.addEventListener('click', () => {
                    currentPage = i;
                    renderUserTable();
                });
                pagination.appendChild(pageBtn);
            }

            // Next button
            const nextBtn = document.createElement('div');
            nextBtn.classList.add('page-btn');
            nextBtn.innerHTML = '<i class="fas fa-chevron-right"></i>';
            nextBtn.addEventListener('click', () => {
                if (currentPage < totalPages) {
                    currentPage++;
                    renderUserTable();
                }
            });
            pagination.appendChild(nextBtn);
        }

        // Search functionality
        searchInput.addEventListener('input', function() {
            currentPage = 1;
            renderUserTable();
        });

        // Modal functionality
        cancelDeleteBtn.addEventListener('click', function() {
            deleteModal.style.display = 'none';
        });

        confirmDeleteBtn.addEventListener('click', function() {
            const userId = parseInt(this.getAttribute('data-id'));

            // Delete user
            users = users.filter(user => user.id !== userId);

            // Hide modal
            deleteModal.style.display = 'none';

            // Show success toast
            toastMessage.textContent = `User successfully deleted`;
            toast.classList.add('toast-success');
            toast.classList.add('show');

            // Hide toast after 3 seconds
            setTimeout(() => {
                toast.classList.remove('show');
            }, 3000);

            // Update table and dashboard stats
            updateDashboardStats();
            renderUserTable();
        });

        // Click outside modal to close
        window.addEventListener('click', function(event) {
            if (event.target === deleteModal) {
                deleteModal.style.display = 'none';
            }
        });

        // Initialize dashboard and user table
        updateDashboardStats();
        renderUserTable();
    });
</script>
</body>

</html>