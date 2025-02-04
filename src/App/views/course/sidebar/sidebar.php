<style>
    /* Sidebar Styles */
    .sidebar {
        height: 100%;
        width: 300px;
        position: fixed;
        top: 0;
        left: -300px;
        background-color: white;
        overflow-x: hidden;
        transition: 0.3s;
        padding-top: 20px;
        z-index: 1000;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    }

    .sidebar-header {
        color: #333;
        text-align: center;
        font-size: 14px;
        margin-bottom: 20px;
        padding: 20px 0;
    }

    .sidebar-header h2 {
        margin: 0;
    }

    .sidebar-menu {
        list-style-type: none;
        padding: 0;
    }

    .sidebar-menu li {
        padding: 10px 20px;
        text-align: left;
    }

    .sidebar-menu li a {
        color: #333;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px;
        transition: 0.3s;
        border-radius: 5px;
    }

    .sidebar-menu li a:hover {
        background-color: #ffc400;
    }

    /* Main content */
    .main-content {
        margin-left: 0;
        transition: margin-left 0.3s;
        padding: 20px;
    }

    /* Toggle button styles */
    .toggle-btn {
        width: 40px;
        height: 40px;
        background: #ffc400;
        border: none;
        cursor: pointer;
        position: fixed;
        top: 50%;
        left: 0;
        transform: translateY(-50%);
        z-index: 999;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 0 5px 5px 0;
        transition: left 0.3s, background-color 0.3s;
    }

    .toggle-btn:hover {
        background: #e6b000;
    }

    /* Arrow icon */
    .arrow-icon {
        border: solid white;
        border-width: 0 3px 3px 0;
        display: inline-block;
        padding: 4px;
        transition: transform 0.3s;
    }

    /* Sidebar open state */
    .sidebar.open {
        left: 0;
    }

    .sidebar.open+.toggle-btn {
        left: 300px;
    }

    .sidebar.open+.toggle-btn .arrow-icon {
        transform: rotate(135deg);
        /* Left arrow */
    }

    /* Default state (right arrow) */
    .arrow-icon {
        transform: rotate(-45deg);
    }

    @media screen and (max-width: 768px) {
        .sidebar {
            width: 100%;
            left: -100%;
        }

        .sidebar.open+.toggle-btn {
            left: 100%;
        }
    }

    @media screen and (max-width: 480px) {
        .sidebar {
            width: 25%;
            left: -25%;
            height: 100vh;
        }

        .sidebar.open+.toggle-btn {
            left: 25%;
        }

        .toggle-btn {
            top: 20%;
        }
    }
</style>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <h2>Manage Course</h2>
    </div>
    <ul class="sidebar-menu">
        <li>
            <a href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z" />
                </svg>
                Add Course Module
            </a>
        </li>
        <li>
            <a href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z" />
                    <polyline points="14 2 14 8 20 8" />
                </svg>
                Add Resources
            </a>
        </li>
        <!-- <hr style="width: 80%; margin: auto;"> -->
        <li>
            <a href="/courses/<?php echo ($course['course_id']); ?>/assignment/create">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                </svg>
                Create Assignment
            </a>
        </li>
        <li>
            <a href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z" />
                    <line x1="4" y1="22" x2="4" y2="15" />
                </svg>
                Review Assignments
            </a>
        </li>
        <li>
            <a href="/courses/<?php echo ($course['course_id']); ?>/participants">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                    <circle cx="9" cy="7" r="4" />
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                </svg>
                View Students
            </a>
        </li>
        <li>
            <a href="/manage-course/edit/<?php echo e($course['course_id']); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z" />
                    <circle cx="12" cy="12" r="3" />
                </svg>
                Update Course
            </a>
        </li>

    </ul>
</div>

<!-- Single toggle button with rotating arrow -->
<button class="toggle-btn" id="toggle-btn">
    <i class="arrow-icon"></i>
</button>

<script>
    // Get elements
    const toggleBtn = document.getElementById("toggle-btn");
    const sidebar = document.getElementById("sidebar");

    // Toggle sidebar
    toggleBtn.addEventListener("click", () => {
        sidebar.classList.toggle("open");
    });
</script>