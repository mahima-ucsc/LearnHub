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
            <a href="/course/<?php echo ($course['course_id']); ?>/module/create">
                <i class="fa-solid fa-plus"></i>
                Add Course Module
            </a>
        </li>
        <li>
            <a href="/courses/<?php echo ($course['course_id']); ?>/assignment/create">
                <i class="fa-solid fa-paperclip"></i>
                Create Assignment
            </a>
        </li>
        <li>
            <a href="/courses/<?php echo ($course['course_id']); ?>/participants">
                <i class="fa-solid fa-graduation-cap"></i>
                View Students
            </a>
        </li>
        <li>
            <a href="/course/edit/<?php echo e($course['course_id']); ?>">
                <i class="fa-solid fa-file-pen"></i>
                Edit Course
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