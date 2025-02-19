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
        left: calc(var(--sidebar-width) - 40px);
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
            <a href="/tech" class="menu-item active">
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
            <a href="#" class="menu-item">
                <span class="menu-icon"><i class="fas fa-user-plus"></i></span>
                Add User
            </a>
            <a href="#" class="menu-item">
                <span class="menu-icon"><i class="fas fa-user-shield"></i></span>
                Roles & Permissions
            </a>
        </div>

        <div class="sidebar-section">
            <h4 class="section-title">Course Management</h4>
            <a href="#" class="menu-item">
                <span class="menu-icon"><i class="fas fa-book"></i></span>
                All Courses
            </a>
            <a href="#" class="menu-item">
                <span class="menu-icon"><i class="fas fa-plus-circle"></i></span>
                Add Course
            </a>
            <a href="#" class="menu-item">
                <span class="menu-icon"><i class="fas fa-clipboard-list"></i></span>
                Categories
            </a>
            <a href="#" class="menu-item">
                <span class="menu-icon"><i class="fas fa-star"></i></span>
                Reviews
            </a>
        </div>

        <div class="sidebar-section">
            <h4 class="section-title">Transactions</h4>
            <a href="#" class="menu-item">
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
            <a href="#" class="menu-item">
                <span class="menu-icon"><i class="fas fa-question-circle"></i></span>
                FAQ Management
            </a>
        </div>

        <div class="sidebar-section">
            <h4 class="section-title">Settings</h4>
            <a href="#" class="menu-item">
                <span class="menu-icon"><i class="fas fa-cog"></i></span>
                General Settings
            </a>
            <a href="#" class="menu-item">
                <span class="menu-icon"><i class="fas fa-palette"></i></span>
                Appearance
            </a>
            <a href="#" class="menu-item">
                <span class="menu-icon"><i class="fas fa-envelope"></i></span>
                Email Templates
            </a>
            <a href="#" class="menu-item">
                <span class="menu-icon"><i class="fas fa-lock"></i></span>
                Security
            </a>
        </div>
    </div>
</aside>

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
</script>