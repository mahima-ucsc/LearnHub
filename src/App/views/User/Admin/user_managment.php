<div class="user-content">
    <div class="user-header">
        <h1>User Management</h1>
        <div class="header-actions">
            <div class="search-form">
                <form id="searchForm">
                    <input type="text" name="s" class="search-input" id="searchInput" placeholder="Search users..." value="<?php echo ($_GET['s']); ?>">
                    <button class="search-btn" type="submit">Search</button>
                </form>
            </div>
            <button class="add-user-btn" onclick="toggleModal()">+ Add New User</button>
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
                    <th>User Role</th>
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
                        <td><?php echo $user['user_role']; ?></td>
                        <td>2024-01-15</td>
                        <td>
                            <button class="delete-btn" onclick="event.stopPropagation();showModal('/user/delete/<?php echo e($user['user_id']) ?>')">Delete</button>

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
            <form id="addUserForm" action="/admin/adduser" method="POST">
                <div class="form-group name-field">

                    <label for="first_name">First Name:</label>
                    <input type="text" id="first_name" name="first_name" required>

                    <label for="last_name">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="user_role">User Role:</label>
                    <select class="role-selection" name="user_role" id="role">
                        <option value="admin">Admin</option>
                        <option value="student">Student</option>
                        <option value="teacher">Teacher</option>
                    </select>
                </div>
                <button type="submit" class="add-user-btn">Add User</button>
            </form>
        </div>
    </div>
</div>
<?php include $this->resolve('modals/delete_modal.php'); ?>

<script>
    // Toggles the Add User Modal
    function toggleModal() {
        const modal = document.getElementById('addUserModal');
        modal.classList.toggle('show');
    }

    // Handles form submission
    function addUser(event) {
        event.preventDefault();
        const username = document.getElementById('username').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        console.log('User Added:', {
            username,
            email,
            password
        });

        // Close modal after submission
        toggleModal();
    }



    // Close modal on clicking outside or pressing Escape
    window.onclick = function(event) {
        const addUserModal = document.getElementById('addUserModal');
        if (event.target === addUserModal) {
            modal.classList.toggle('show');
        }
    };

    /* 
    Handle user search
    append new parameter to the end of the current parameters
    */
    document.getElementById('searchForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        const searchInput = document.getElementById('searchInput').value;

        // Parse the current URL and its search parameters
        const currentUrl = new URL(window.location.href);
        const params = currentUrl.searchParams;

        // Update or append the "s" parameter to the current search params
        params.set('s', searchInput);

        // Update the browser URL to include the new parameter without refreshing the page
        window.location.search = params.toString();
    });
</script>