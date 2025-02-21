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
        --header-height: 55px;
    }

    /* Toggle button */
    .menu-toggle {
        position: fixed;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 40px;
        height: 60px;
        background-color: black;
        color: var(--white);
        border: none;
        border-radius: 0 5px 5px 0;
        cursor: pointer;
        z-index: 901;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: left 0.3s ease;
    }

    .menu-toggle p {
        transform: rotate(-90deg);
    }

    .menu-toggle:hover {
        background-color: rgb(70, 70, 70);
    }

    .sidebar.active+.menu-toggle,
    .menu-toggle.active {
        left: calc(var(--sidebar-width));
    }

    /* Sidebar */
    .sidebar {
        position: fixed;
        left: calc(var(--sidebar-collapsed-width) - var(--sidebar-width));
        width: var(--sidebar-width);
        height: calc(100vh - var(--header-height));
        background: var(--white);
        box-shadow: var(--shadow);
        top: var(--header-height);
        transition: left 0.3s ease;
        z-index: 900;
        overflow-y: auto;
    }

    .sidebar.active {
        left: 0;
    }

    .sidebar-overlay {
        position: fixed;
        top: var(--header-height);
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 899;
        display: none;
    }

    .sidebar-overlay.active {
        display: block;
    }

    .sidebar-header {
        padding: 1.5rem;
        border-bottom: 1px solid var(--bg-light);
    }

    .sidebar-title {
        font-size: 1.2rem;
        color: var(--text-dark);
    }

    .sidebar-menu {
        padding: 1rem 0;
    }

    .sidebar-section {
        margin-bottom: 1rem;
    }

    .section-title {
        padding: 0.75rem 1.5rem;
        color: var(--text-light);
        font-size: 0.9rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .menu-item {
        padding: 0.75rem 1.5rem;
        display: flex;
        align-items: center;
        color: var(--text-dark);
        text-decoration: none;
        transition: all 0.3s;
    }

    .menu-item:hover {
        background-color: var(--bg-light);
        color: var(--theme-color);
    }

    .menu-item.active {
        background-color: var(--theme-light);
        color: var(--theme-dark);
        border-left: 4px solid var(--theme-color);
    }

    .menu-icon {
        margin-right: 1rem;
        width: 20px;
        text-align: center;
    }

    /* Add user popup */
    .popup-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .popup-container {
        background: white;
        border-radius: 12px;
        padding: 32px;
        width: 90%;
        max-width: 500px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        position: relative;
        animation: slideIn 0.3s ease-out;
    }

    @keyframes slideIn {
        from {
            transform: translateY(-20px);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .popup-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }

    .popup-title {
        font-size: 24px;
        font-weight: 600;
        color: #333;
        margin: 0;
    }

    .close-btn {
        background: none;
        border: none;
        font-size: 24px;
        color: #666;
        cursor: pointer;
        padding: 4px;
        transition: color 0.2s;
    }

    .close-btn:hover {
        color: #333;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #444;
    }

    .form-input {
        width: 100%;
        padding: 12px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 16px;
        transition: border-color 0.2s;
    }

    .form-input:focus {
        outline: none;
        border-color: #FFC400;
    }

    .form-select {
        width: 100%;
        padding: 12px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 16px;
        background-color: white;
        cursor: pointer;
    }

    .button-group {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 32px;
    }

    .btn {
        padding: 12px 24px;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-cancel {
        background: #f5f5f5;
        border: none;
        color: #666;
    }

    .btn-cancel:hover {
        background: #ebebeb;
    }

    .btn-submit {
        background: #FFC400;
        border: none;
        color: #000;
    }

    .btn-submit:hover {
        background: #ffcd2e;
        transform: translateY(-1px);
    }

    .error-message {
        color: #dc3545;
        font-size: 14px;
        margin-top: 4px;
        display: none;
    }

    /* Add this to replace Add user archor with button */
    .menu-item-btn {
        background-color: white;
        border: none;
        width: 100%;
        cursor: pointer;
    }

    @media (max-width: 768px) {
        .menu-toggle {
            display: flex;
        }

    }
</style>
<!-- Sidebar Overlay -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>
<button id="menuToggle" class="menu-toggle">
    <!-- <i class="fas fa-arrow-right"></i> -->
    <p>MENU</p>
</button>
<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <h3 class="sidebar-title">Admin Dashboard</h3>
    </div>
    <div class="sidebar-menu">
        <div class="sidebar-section">
            <h4 class="section-title">Main</h4>
            <a href="/" class="menu-item active">
                <span class="menu-icon"><i class="fas fa-tachometer-alt"></i></span>
                Dashboard
            </a>
        </div>

        <div class="sidebar-section">
            <h4 class="section-title">User Management</h4>
            <a href="/user-managment" class="menu-item">
                <span class="menu-icon"><i class="fas fa-users"></i></span>
                All Users
            </a>
            <button onclick="openPopup()" class="menu-item menu-item-btn">
                <span class="menu-icon"><i class="fas fa-user-plus"></i></span>
                Add User
            </button>
        </div>

        <div class="sidebar-section">
            <h4 class="section-title">Course Management</h4>
            <a href="/course-managment" class="menu-item">
                <span class="menu-icon"><i class="fas fa-book"></i></span>
                All Courses
            </a>
            <a href="/course/create" class="menu-item">
                <span class="menu-icon"><i class="fas fa-plus-circle"></i></span>
                Add Course
            </a>
        </div>

        <div class="sidebar-section">
            <h4 class="section-title">Transactions</h4>
            <a href="/billing-and-payment" class="menu-item">
                <span class="menu-icon"><i class="fas fa-money-bill-wave"></i></span>
                All Transactions
            </a>
            <a href="#" class="menu-item">
                <span class="menu-icon"><i class="fas fa-file-invoice-dollar"></i></span>
                Invoices
            </a>
            <a href="#" class="menu-item">
                <span class="menu-icon"><i class="fas fa-chart-line"></i></span>
                Revenue Reports
            </a>
        </div>

        <div class="sidebar-section">
            <h4 class="section-title">Support</h4>
            <a href="#" class="menu-item">
                <span class="menu-icon"><i class="fas fa-ticket-alt"></i></span>
                Tickets
            </a>
        </div>

        <div class="sidebar-section">
            <h4 class="section-title">Settings</h4>
            <a href="#" class="menu-item">
                <span class="menu-icon"><i class="fas fa-cog"></i></span>
                General Settings
            </a>
            <a href="#" class="menu-item">
                <span class="menu-icon"><i class="fas fa-lock"></i></span>
                Security
            </a>
        </div>
    </div>
</aside>
<!-- Add user popup -->
<section>

    <!-- Popup Overlay -->
    <div class="popup-overlay" id="addUserPopup">
        <div class="popup-container">
            <div class="popup-header">
                <h2 class="popup-title">Add New User</h2>
                <button class="close-btn" onclick="closePopup()">&times;</button>
            </div>

            <form id="addUserForm" action="/admin/adduser" method="POST">
                <div class="form-group">
                    <label class="form-label" for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" class="form-input" required>
                    <div class="error-message" id="nameError">Please enter a valid name</div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" class="form-input" required>
                    <div class="error-message" id="nameError">Please enter a valid name</div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">Email Address</label>
                    <input type="email" id="email" name="email" class="form-input" required>
                    <div class="error-message" id="emailError">Please enter a valid email address</div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="user_role">Role</label>
                    <select id="role" name="user_role" class="form-select" required>
                        <option value="">Select a role</option>
                        <option value="admin">Admin</option>
                        <option value="student">Student</option>
                        <option value="teacher">Teacher</option>
                    </select>
                    <div class="error-message" id="roleError">Please select a role</div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-input" required>
                    <div class="error-message" id="passwordError">Password must be at least 8 characters</div>
                </div>

                <div class="button-group">
                    <button type="busubtton" class="btn btn-cancel" onclick="closePopup()">Cancel</button>
                    <button type="submit" class="btn btn-submit">Add User</button>
                </div>
            </form>
        </div>
    </div>

</section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get sidebar elements
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        // Toggle sidebar when menu button is clicked
        if (menuToggle) {
            menuToggle.addEventListener('click', function() {
                sidebar.classList.toggle('active');
                menuToggle.classList.toggle('active');
                sidebarOverlay.classList.toggle('active');

                // Change icon based on sidebar state
                const icon = menuToggle.querySelector('i');
                if (sidebar.classList.contains('active')) {
                    icon.classList.remove('fa-arrow-right');
                    icon.classList.add('fa-arrow-left');
                } else {
                    icon.classList.remove('fa-arrow-left');
                    icon.classList.add('fa-arrow-right');
                }
            });
        }

        // Close sidebar when clicking overlay (mobile)
        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', function() {
                sidebar.classList.remove('active');
                menuToggle.classList.remove('active');
                sidebarOverlay.classList.remove('active');

                const icon = menuToggle.querySelector('i');
                icon.classList.remove('fa-arrow-left');
                icon.classList.add('fa-arrow-right');
            });
        }
    });

    // Add user popup
    function openPopup() {
        document.getElementById('addUserPopup').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closePopup() {
        document.getElementById('addUserPopup').style.display = 'none';
        document.body.style.overflow = 'auto';
        resetForm();
    }
    document.getElementById('addUserPopup').addEventListener('click', function(event) {
        if (event.target === this) {
            closePopup();
        }
    });
</script>