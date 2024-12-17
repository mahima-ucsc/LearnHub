<?php include $this->resolve("partials/_header.php"); ?>

<head>
    <link rel="stylesheet" href="/assets/styles/User/Admin/admin_dashboard.css">
    <link rel="stylesheet" href="/assets/styles/User/Admin/user_managment.css">
    <link rel="stylesheet" href="/assets/styles/User/Admin/course_managment.css">
    <link rel="stylesheet" href="/assets/styles/User/my-courses.css">


</head>

<section class="admin-dashboard">
    <div class="admin-main-container">
        <!-- Sidebar -->
        <div class="admin-sidebar">
            <div class="admin-profile">
                <h3>Admin Panel</h3>
                <img src="/assets/images/user.jpeg" alt="Admin" class="profile-picture">
                <p>System Administrator</p>
            </div>

            <nav class="admin-nav">
                <ul>
                    <a href="?tab=dashboard">
                        <li class="content-tab" id="dashboardTab" onclick="loadTabContent('dashboard')">Dashboard</li>
                    </a>
                    <a href="?tab=user-managment">
                        <li class="content-tab" id="userManagementTab" onclick="loadTabContent('user')">User Management</li>
                    </a>
                    <a href="?tab=course-managment">
                        <li class="content-tab" id="courseManagementTab" onclick="loadTabContent('course')">Course Management</li>
                    </a>
                </ul>
            </nav>

        </div>

        <!-- Main Content -->
        <div id="main-container" class="admin-content">
            <?php
            $tab = $_GET['tab'] ?? 'dashboard'; // Default to 'dashboard'
            switch ($tab) {
                case 'user-managment':
                    include $this->resolve("User/Admin/user_managment.php");
                    break;
                case 'course-managment':
                    include $this->resolve("User/Admin/course_managment.php");
                    break;
                default:
                    include $this->resolve("User/Admin/dashboard.php");
            }
            ?>
        </div>
    </div>

    <script>
        function loadTabContent(tab) {
            localStorage.setItem('tab', tab);

            // Remove 'nav-active' from all tabs
            document.querySelectorAll('.content-tab').forEach(function(tabElement) {
                tabElement.classList.remove('nav-active');
            });

            // Add 'nav-active' to the current tab based on the passed parameter
            if (tab === 'dashboard') {
                document.getElementById('dashboardTab').classList.add('nav-active');
            } else if (tab === 'user') {
                document.getElementById('userManagementTab').classList.add('nav-active');
            } else if (tab === 'course') {
                document.getElementById('courseManagementTab').classList.add('nav-active');
            }
        }

        // Restore active tab on page load
        window.addEventListener('DOMContentLoaded', function() {
            const savedTab = localStorage.getItem('tab') || 'dashboard'; // Default to 'dashboard'

            // Call loadTabContent to set the active tab
            loadTabContent(savedTab);
        });

        // Restore active tab on page load
        window.addEventListener('DOMContentLoaded', function() {
            const savedTab = localStorage.getItem('tab') || 'dashboard'; // Default to 'dashboard' if no tab is saved

            // Call loadTabContent to set the active tab
            loadTabContent(savedTab);
        });
    </script>
</section>

<?php include $this->resolve("partials/_footer.php"); ?>