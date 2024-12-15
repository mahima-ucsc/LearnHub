<div class="user-content">
    <div class="user-header">
        <h1>User Management</h1>
        <div class="header-actions">
            <div class="search-form">
                <input type="text" class="search-input" id="searchInput" placeholder="Search users...">
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
<?php include $this->resolve('modals/delete_modal.php'); ?>

<!-- <script>
    // Toggles the Add User Modal
    function toggleModal() {
        const modal = document.getElementById('addUserModal');
        modal.style.display = modal.style.display === 'block' ? 'none' : 'block';
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
            addUserModal.style.display = 'none';
        }
    };
    document.addEventListener('keydown', function(event) {
        const addUserModal = document.getElementById('addUserModal');
        if (event.key === 'Escape' && addUserModal.style.display === 'block') {
            hideModal();
        }
    });
</script> -->