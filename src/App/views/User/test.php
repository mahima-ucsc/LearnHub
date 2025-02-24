<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Management Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
        }

        .container {
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

        .course-status {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .status-active {
            background: rgba(46, 204, 113, 0.2);
            color: var(--success);
        }

        .status-draft {
            background: rgba(243, 156, 18, 0.2);
            color: var(--warning);
        }

        .action-btn {
            padding: 0.5rem;
            border-radius: 0.25rem;
            border: none;
            cursor: pointer;
            transition: background 0.3s;
            margin-right: 0.5rem;
        }

        .btn-edit {
            background: var(--theme-light);
            color: var(--theme-dark);
        }

        .btn-delete {
            background: rgba(231, 76, 60, 0.1);
            color: var(--danger);
        }

        .btn-edit:hover {
            background: var(--theme-color);
        }

        .btn-delete:hover {
            background: rgba(231, 76, 60, 0.2);
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
            z-index: 1000;
        }

        .modal-content {
            background: var(--white);
            border-radius: 0.5rem;
            padding: 2rem;
            width: 400px;
            max-width: 90%;
        }

        .modal-header {
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .modal-footer {
            margin-top: 1.5rem;
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
        }

        @media (max-width: 1024px) {
            .stats-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .container {
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
</head>

<body>
    <div class="container">
        <h1 class="dashboard-title">Course Management</h1>

        <!-- Stats Cards -->
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-book"></i>
                </div>
                <div class="stat-value" id="totalCourses">0</div>
                <div class="stat-label">Total Courses</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-value" id="totalStudents">0</div>
                <div class="stat-label">Total Students</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="stat-value" id="totalRevenue">$0</div>
                <div class="stat-label">Total Revenue</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-star"></i>
                </div>
                <div class="stat-value" id="averageRating">0.0</div>
                <div class="stat-label">Average Rating</div>
            </div>
        </div>

        <!-- Courses Table -->
        <div class="table-container">
            <div class="table-header">
                <h2 class="table-title">Your Courses</h2>
                <div class="search-container">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search courses..." class="search-input" id="searchInput">
                </div>
            </div>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Students</th>
                            <th>Lessons</th>
                            <th>Rating</th>
                            <th>Price</th>
                            <th>Revenue</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="courseTableBody">
                        <!-- Courses will be added dynamically -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal" id="deleteModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Delete Course</h3>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this course?</p>
                <p>This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button class="action-btn btn-edit" id="cancelDelete">Cancel</button>
                <button class="action-btn btn-delete" id="confirmDelete">Delete</button>
            </div>
        </div>
    </div>

    <script>
        // Sample course data
        let courses = [{
                id: 1,
                title: "Complete Web Development Bootcamp",
                students: 1250,
                rating: 4.8,
                price: 99.99,
                status: "active",
                revenue: 124875.00,
                lessons: 180
            },
            {
                id: 2,
                title: "Advanced JavaScript Masterclass",
                students: 850,
                rating: 4.9,
                price: 79.99,
                status: "active",
                revenue: 67991.50,
                lessons: 120
            },
            {
                id: 3,
                title: "Python for Data Science",
                students: 950,
                rating: 4.7,
                price: 89.99,
                status: "active",
                revenue: 85490.50,
                lessons: 150
            },
            {
                id: 4,
                title: "iOS App Development with Swift",
                students: 320,
                rating: 4.6,
                price: 129.99,
                status: "draft",
                revenue: 41596.80,
                lessons: 200
            }
        ];

        // Update dashboard stats
        function updateDashboardStats() {
            const totalCourses = courses.length;
            const totalStudents = courses.reduce((sum, course) => sum + course.students, 0);
            const totalRevenue = courses.reduce((sum, course) => sum + course.revenue, 0);
            const averageRating = courses.reduce((sum, course) => sum + course.rating, 0) / courses.length;

            document.getElementById('totalCourses').textContent = totalCourses;
            document.getElementById('totalStudents').textContent = totalStudents.toLocaleString();
            document.getElementById('totalRevenue').textContent = `$${totalRevenue.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
            document.getElementById('averageRating').textContent = averageRating.toFixed(1);
        }

        // Render courses table
        function renderCourses() {
            const courseTableBody = document.getElementById('courseTableBody');
            courseTableBody.innerHTML = '';

            courses.forEach(course => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${course.title}</td>
                    <td>${course.students.toLocaleString()}</td>
                    <td>${course.lessons}</td>
                    <td>${course.rating}</td>
                    <td>$${course.price}</td>
                    <td>$${course.revenue.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}</td>
                    <td><span class="course-status status-${course.status}">${course.status}</span></td>
                    <td>
                        <button class="action-btn btn-edit" onclick="editCourse(${course.id})">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="action-btn btn-delete" onclick="showDeleteModal(${course.id})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                `;
                courseTableBody.appendChild(row);
            });
        }

        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const filteredCourses = courses.filter(course =>
                course.title.toLowerCase().includes(searchTerm)
            );

            const courseTableBody = document.getElementById('courseTableBody');
            courseTableBody.innerHTML = '';

            filteredCourses.forEach(course => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${course.title}</td>
                    <td>${course.students.toLocaleString()}</td>
                    <td>${course.lessons}</td>
                    <td>${course.rating}</td>
                    <td>$${course.price}</td>
                    <td>$${course.revenue.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}</td>
                    <td><span class="course-status status-${course.status}">${course.status}</span></td>
                    <td>
                        <button class="action-btn btn-edit" onclick="editCourse(${course.id})">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="action-btn btn-delete" onclick="showDeleteModal(${course.id})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                `;
                courseTableBody.appendChild(row);
            });
        });

        // Delete modal functionality
        const deleteModal = document.getElementById('deleteModal');
        let courseToDelete = null;

        function showDeleteModal(courseId) {
            courseToDelete = courseId;
            deleteModal.style.display = 'flex';
        }

        function hideDeleteModal() {
            deleteModal.style.display = 'none';
            courseToDelete = null;
        }

        function deleteCourse() {
            if (courseToDelete) {
                courses = courses.filter(course => course.id !== courseToDelete);
                hideDeleteModal();
                renderCourses();
                updateDashboardStats();
            }
        }

        function editCourse(courseId) {
            // Placeholder for edit functionality
            console.log(`Editing course ${courseId}`);
            alert('Edit functionality would be implemented here');
        }

        // Event listeners for modal buttons
        document.getElementById('cancelDelete').addEventListener('click', hideDeleteModal);
        document.getElementById('confirmDelete').addEventListener('click', deleteCourse);

        // Close modal when clicking outside
        window.addEventListener('click', (e) => {
            if (e.target === deleteModal) {
                hideDeleteModal();
            }
        });

        // Initialize the dashboard
        document.addEventListener('DOMContentLoaded', () => {
            renderCourses();
            updateDashboardStats();
        });
    </script>
</body>

</html>