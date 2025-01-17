<?php include $this->resolve("partials/_header.php"); ?>

<head>
  <link rel="stylesheet" href="/assets/styles/dashboard.css">
  <link rel="stylesheet" href="/assets/styles/User/Admin/user_managment.css">
  <link rel="stylesheet" href="/assets/styles/User/Admin/course_managment.css">
  <link rel="stylesheet" href="/assets/styles/User/Admin/help_and_support_management.css">
  <link rel="stylesheet" href="/assets/styles/User/my-courses.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
          <li id="dashboardTab" class="nav-active" onclick="showSection('adminContent', 'dashboardTab')">Dashboard</li>
          <li id="userManagementTab" onclick="showSection('userManagementContent', 'userManagementTab')">Manage Students</li>
          <li id="courseManagementTab" onclick="showSection('courseManagementContent', 'courseManagementTab')">Manage Courses</li>
          <li id="adManagementTab" onclick="showSection('adManagementContent', 'adManagementTab')">Manage Ads</li>
          <li id="helpAndSupportTab" onclick="showSection('helpAndSupportContent', 'helpAndSupportTab')">supports</li>
          <li>Transactions</li>
        </ul>
      </nav>

    </div>

    <!-- Main Content -->
    <div id="adminContent" class="admin-content">
      <!-- Header -->
      <div class="admin-header">
        <h1>Dashboard Overview</h1>
        <div class="date-range">
          <select>
            <option>Last 7 days</option>
            <option>Last 30 days</option>
            <option>Last 3 months</option>
            <option>Last year</option>
          </select>
        </div>
      </div>

      <!-- Stats Grid -->
      <div class="admin-stats-grid">
        <div class="stat-box">
          <h3>Total Students</h3>
          <div class="value">1,500</div>
          <div class="trend">↑ 12.5% Growth this month</div>
        </div>
        <div class="stat-box">
          <h3>Total Courses</h3>
          <div class="value">4</div>
        </div>
        <div class="stat-box">
          <h3>Total Earnings</h3>
          <div class="value">Rs. 175800</div>
        </div>
        <div class="stat-box">
          <h3>Earnings in the Last Month</h3>
          <div class="value">Rs. 75800</div>
        </div>
      </div>

      <!-- Growth Chart -->
      <div class="chart-container">
        <canvas id="myChart" style="max-width: 1200px;max-height: 450px;"></canvas>
      </div>

      <!-- Recent Transactions -->
      <div class="chart-container">
        <div class="chart-header">
          <h2>Recent Transactions</h2>
          <button>View All</button>
        </div>
        <table class="data-table">
          <thead>
            <tr>
              <th>Transaction ID</th>
              <th>User</th>
              <th>Course</th>
              <th>Amount</th>
              <th>Status</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>#TRX-789456</td>
              <td>John Doe</td>
              <td>Advanced Web Development</td>
              <td>Rs. 99.99</td>
              <td><span class="status-badge status-active">Completed</span></td>
              <td>2024-11-17</td>
            </tr>
            <tr>
              <td>#TRX-789455</td>
              <td>Jane Smith</td>
              <td>UI/UX Design Basics</td>
              <td>Rs. 79.99</td>
              <td><span class="status-badge status-pending">Pending</span></td>
              <td>2024-11-17</td>
            </tr>
            <!-- Add more rows as needed -->
          </tbody>
        </table>
      </div>

      <!-- Latest Users -->
      <div class="chart-container">
        <div class="chart-header">
          <h2>Latest Registered Users</h2>
          <button>View All</button>
        </div>
        <table class="data-table">
          <thead>
            <tr>
              <th>User</th>
              <th>Email</th>
              <th>Role</th>
              <th>Joined Date</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Alice Johnson</td>
              <td>alice@example.com</td>
              <td>Student</td>
              <td>2024-11-17</td>
              <td><span class="status-badge status-active">Active</span></td>
            </tr>
            <tr>
              <td>Robert Wilson</td>
              <td>robert@example.com</td>
              <td>Teacher</td>
              <td>2024-11-16</td>
              <td><span class="status-badge status-pending">Pending</span></td>
            </tr>
            <!-- Add more rows as needed -->
          </tbody>
        </table>
      </div>
    </div>

    <!-- 
        ***********************
        ***********************
        ****User Managment*****
        ***********************
        ***********************
        -->

    <div id="userManagementContent" class="user-managment-container" style="display: none;">
      <div class="user-content">
        <div class="user-header">
          <h1>User Management</h1>
          <div class="header-actions">
            <div class="search-form">
              <input type="text" class="search-input" id="searchInput-userManagement" placeholder="Search users...">
              <button class="search-btn" onclick="searchUsers()">Search</button>
            </div>
            <button class="add-user-btn" onclick="toggleModal()">Add New User</button>
          </div>
        </div>

        <!-- User Table -->
        <div class="user-table-container">
          <table class="data-table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Joined Date</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody id="userTableBody">
              <?php foreach ($users as $user) : ?>

                <tr>
                  <td><?php echo $user['user_id']; ?></td>
                  <td><?php echo $user['first_name']; ?> <?php echo $user['last_name']; ?></td>
                  <td><?php echo $user['email']; ?></td>
                  <td>2024-01-15</td>
                  <td>
                    <button class="delete-btn">Delete</button>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

        <div id="addUserModal" class="modal">
          <div class="modal-content">
            <span class="close" onclick="toggleModal()">&times;</span>
            <h2>Add New User</h2>
            <form id="addUserForm" onsubmit="addUser(event)">
              <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" required>
              </div>
              <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" required>
              </div>
              <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" required>
              </div>
              <button type="submit" class="add-user-btn">Add User</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- 
        ***********************
        ***********************
        ****Course Managment*****
        ***********************
        ***********************
        -->
    <div id="courseManagementContent" class="course-content-section" style="display: none;">
      <section class="courses-page">
        <div class="main-container">
          <!-- <div class="main-title">
            <h1>My Courses</h1>
          </div> -->

          <div class="admin-header">
            <h1>Course Management</h1>
            <div class="header-actions">
              <div class="search-form">
                <input type="text" class="search-input" id="searchInput-courseManagement" placeholder="Search users...">
                <button class="search-btn" onclick="searchUsers()">Search</button>
              </div>
              <button class="add-user-btn" onclick="toggleModal()"><a href="/course/create" style="text-decoration: none;"> Add New Course </a></button>
            </div>
          </div>

          <div class="table-container">
            <table class="courses-table">
              <thead>
                <tr>
                  <th>Course</th>
                  <th>Students</th>
                  <th>Time</th>
                  <th>Revenue</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($myCourses as $courseData): ?>
                  <tr onclick="window.location.href='/courses/my-courses/<?php echo e($courseData['course_id']) ?>';" style="cursor: pointer;">
                    <td>
                      <div class="course-name">
                        <?php echo e($courseData['title']) ?>
                        <span class="grade-badge">Grade <?php echo e($courseData['grade_id']) ?></span>
                      </div>
                    </td>
                    <td>
                      <span class="students-count">24 students</span>
                    </td>
                    <td>
                      <div class="time-slot">
                        <i class="fas fa-clock"></i>
                        <?php
                        $start = date('g:i A', strtotime($courseData['start_time']));
                        $end = date('g:i A', strtotime($courseData['end_time']));
                        ?>
                        <span><?php echo e($start) ?> - <?php echo e($end) ?></span>
                        <span class="day-badge"><?php echo e($courseData['day']) ?></span>
                      </div>
                    </td>
                    <td>
                      <span class="revenue">Rs. <?php echo e($courseData['price'] * 24) ?></span>
                    </td>
                    <td>
                      <div class="action-buttons">
                        <a href="/manage-course/edit/<?php echo e($courseData['course_id']); ?>" class="btn btn-edit">Edit</a>
                        <button onclick="showModal()" class="btn btn-delete">Delete</button>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Delete confirmation modal -->
        <div id="deleteModal" class="modal">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title">Confirm Delete</h3>
            </div>
            <div class="modal-body">
              Are you sure you want to delete this course? This action cannot be undone.
            </div>
            <div class="modal-footer">
              <button onclick="hideModal()" class="btn btn-cancel">Cancel</button>
              <form method="POST" action="/manage-course/delete/<?php echo e($courseData['course_id']) ?>">
                <?php include $this->resolve("partials/_csrf.php"); ?>
                <input type="hidden" name="_METHOD" value="DELETE" />
                <button type="submit" class="btn btn-delete">Delete</button>
              </form>
            </div>
          </div>
        </div>

      </section>
    </div>
    <!-- 
        ***********************
        ***********************
        ****Ad Managment*****
        ***********************
        ***********************
        -->
    <div id="adManagementContent" class="course-content-section" style="display: none;">
      <section class="courses-page">
        <div class="main-container">
          <!-- <div class="main-title">
            <h1>My Courses</h1>
          </div> -->

          <div class="admin-header">
            <h1>Advertisement</h1>
            <div class="header-actions">
              <div class="search-form">
                <input type="text" class="search-input" id="searchInput-advertisement" placeholder="Search ad...">
                <button class="search-btn" onclick="searchUsers()">Search</button>
              </div>
              <button class="add-user-btn" onclick="toggleModal()"><a href="/course/create" style="text-decoration: none;"> + Create new Ad </a></button>
            </div>
          </div>

          <div class="table-container">
            <table class="courses-table">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>No. of clicks</th>
                  <th>Published Date</th>
                  <th>Price</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <div class="course-name">
                      2024 A/L Physics
                    </div>
                  </td>
                  <td>
                    <span class="students-count">50</span>
                  </td>
                  <td>
                    <span class="">10/11/2024</span>
                  </td>
                  <td>
                    <span class="revenue">Rs. 1000</span>
                  <td>
                    <div class="action-buttons">
                      <button onclick="showModal()" class="btn btn-delete">Delete</button>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="course-name">
                      Combined Maths - Grade 12
                    </div>
                  </td>
                  <td>
                    <span class="students-count">50</span>
                  </td>
                  <td>
                    <span class="">10/11/2024</span>
                  </td>
                  <td>
                    <span class="revenue">Rs. 1800</span>
                  <td>
                    <div class="action-buttons">
                      <button onclick="showModal()" class="btn btn-delete">Delete</button>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="course-name">
                      Science class for grade 10
                    </div>
                  </td>
                  <td>
                    <span class="students-count">50</span>
                  </td>
                  <td>
                    <span class="">10/11/2024</span>
                  </td>
                  <td>
                    <span class="revenue">Rs. 2000</span>
                  <td>
                    <div class="action-buttons">
                      <button class="btn btn-delete">Delete</button>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>


        </div>

        <!-- Delete confirmation modal -->
        <div id="deleteModal" class="modal">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title">Confirm Delete</h3>
            </div>
            <div class="modal-body">
              Are you sure you want to delete this course? This action cannot be undone.
            </div>
            <div class="modal-footer">
              <button onclick="hideModal()" class="btn btn-cancel">Cancel</button>
              <form method="POST" action="/manage-course/delete/<?php echo e($courseData['course_id']) ?>">
                <?php include $this->resolve("partials/_csrf.php"); ?>
                <input type="hidden" name="_METHOD" value="DELETE" />
                <button type="submit" class="btn btn-delete">Delete</button>
              </form>
            </div>
          </div>
        </div>

      </section>
    </div>
    <!-- 
        ***********************
        ***********************
        ****help and supports**
        ***********************
        ***********************
        -->
    <div id="helpAndSupportContent" class="course-content-section" style="display: none;">
      <section class="help_and_support_section">
        <div class="main-container">
          <div class="admin-header">
            <h1>Help and Support</h1>
            <div class="header-actions">
              <div class="search-form">
                <input type="text" class="search-input" id="searchInput-helpAndSupport" placeholder="Search ad...">
                <button class="search-btn" onclick="searchUsers()">Search</button>
              </div>
            </div>
          </div>

          <div class="table-container">
            <table class="help-and-support-table">
              <thead>
                <tr>
                  <th> </th>
                  <th>User</th>
                  <th>date</th>
                  <th>time</th>
                  <th>title</th>
                  <th>status</th>
                </tr>
              </thead>
              <tbody>
                <tr onclick="window.location.href='/dashboard/help-and-support-review/:id'" style="cursor: pointer;">
                  <td>
                    <img src="/assets/images/user.jpeg" alt="Admin" class="profile-picture">
                  </td>
                  <td>
                    <div class="user-name">
                      Isuru naveen
                    </div>
                  </td>
                  <td>
                    <span class="date">10/11/2024</span>
                  </td>
                  <td>
                    <span class="time">11.12 pm</span>
                  </td>
                  <td>
                    <span class="title">my payment dose not work.</span>
                  <td>
                    <div class="status">seen</div>
                  </td>
                </tr>

                <tr onclick="window.location.href='/dashboard/help-and-support-review/:id'" style="cursor: pointer;">
                  <td>
                    <img src="/assets/images/user.jpeg" alt="Admin" class="profile-picture">
                  </td>
                  <td>
                    <div class="user-name">
                      Isuru naveen
                    </div>
                  </td>
                  <td>
                    <span class="date">10/11/2024</span>
                  </td>
                  <td>
                    <span class="time">11.12 pm</span>
                  </td>
                  <td>
                    <span class="title">my payment dose not work.</span>
                  <td>
                    <div class="status">seen</div>
                  </td>
                </tr>

                <tr onclick="window.location.href='/dashboard/help-and-support-review/:id'" style="cursor: pointer;">
                  <td>
                    <img src="/assets/images/user.jpeg" alt="Admin" class="profile-picture">
                  </td>
                  <td>
                    <div class="user-name">
                      Isuru naveen
                    </div>
                  </td>
                  <td>
                    <span class="date">10/11/2024</span>
                  </td>
                  <td>
                    <span class="time">11.12 pm</span>
                  </td>
                  <td>
                    <span class="title">my payment dose not work.</span>
                  <td>
                    <div class="status">seen</div>
                  </td>
                </tr>

              </tbody>
            </table>
          </div>
        </div>

        <!-- Delete confirmation modal -->
        <div id="deleteModal" class="modal">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title">Confirm Delete</h3>
            </div>
            <div class="modal-body">
              Are you sure you want to delete this course? This action cannot be undone.
            </div>
            <div class="modal-footer">
              <button onclick="hideModal()" class="btn btn-cancel">Cancel</button>
              <form method="POST" action="/manage-course/delete/<?php echo e($courseData['course_id']) ?>">
                <?php include $this->resolve("partials/_csrf.php"); ?>
                <input type="hidden" name="_METHOD" value="DELETE" />
                <button type="submit" class="btn btn-delete">Delete</button>
              </form>
            </div>
          </div>
        </div>

      </section>
    </div>


  </div>


  <?php
  // Dummy data for the chart
  $labels = ['January', 'February', 'March', 'April', 'May'];
  $data = [10, 20, 15, 25, 30];

  // Convert PHP arrays to JSON for use in JavaScript
  $labelsJSON = json_encode($labels);
  $dataJSON = json_encode($data);
  ?>

  <script>
    // Get data from PHP
    const labels = <?php echo $labelsJSON; ?>;
    const data = <?php echo $dataJSON; ?>;

    // Chart.js configuration
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
      type: 'line', // Type of chart: bar, line, pie, etc.
      data: {
        labels: labels, // Labels for the X-axis
        datasets: [{
          label: 'Sales Data', // Legend label
          data: data, // Data for the Y-axis 
          borderColor: '#FFC400', // Line color
          borderWidth: 2, // Line thickness
          pointBackgroundColor: '#FFC400', // Point fill color
          pointBorderColor: '#fff', // Point border color
          pointBorderWidth: 2, // Point border width
          pointRadius: 5, // Point size
          // tension: 0.4,
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>

  <script>
    // show add user
    function toggleModal() {
      const modal = document.getElementById('addUserModal');
      modal.style.display = modal.style.display === 'block' ? 'none' : 'block';
    }

    function showSection(contentId, activeTabId) {
      // Hide all content sections
      document.getElementById('adminContent').style.display = 'none';
      document.getElementById('userManagementContent').style.display = 'none';
      document.getElementById('courseManagementContent').style.display = 'none';
      document.getElementById('adManagementContent').style.display = 'none';
      document.getElementById('helpAndSupportContent').style.display = 'none';

      // Remove the 'nav-active' class from all tabs
      document.getElementById('dashboardTab').classList.remove('nav-active');
      document.getElementById('userManagementTab').classList.remove('nav-active');
      document.getElementById('courseManagementTab').classList.remove('nav-active');
      document.getElementById('adManagementTab').classList.remove('nav-active');
      document.getElementById('helpAndSupportTab').classList.remove('nav-active');

      // Display the selected content section
      document.getElementById(contentId).style.display = 'block';

      // Add the 'nav-active' class to the selected tab
      document.getElementById(activeTabId).classList.add('nav-active');
    }

    // Example of how to use the function:
    // showSection('adminContent', 'dashboardTab');

    window.onclick = function(event) {
      const modal = document.getElementById('addUserModal');
      if (event.target == modal) {
        modal.style.display = 'none';
      }
    }
    const modal = document.getElementById('deleteModal');

    function showModal() {
      modal.style.display = 'block';
      document.body.style.overflow = 'hidden';
    }

    function hideModal() {
      modal.style.display = 'none';
      document.body.style.overflow = 'auto';
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
      if (event.target === modal) {
        hideModal();
      }
    }

    // Close modal on escape key press
    document.addEventListener('keydown', function(event) {
      if (event.key === 'Escape' && modal.style.display === 'block') {
        hideModal();
      }
    });
  </script>
</section>

<?php include $this->resolve("partials/_footer.php"); ?>