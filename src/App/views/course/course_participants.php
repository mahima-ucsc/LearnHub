<?php include $this->resolve("partials/_header.php"); ?>

<link rel="stylesheet" href="/assets/styles/Course/course_participant.css">
<style>
    .user-data {
        cursor: pointer;
    }
</style>
<div class="user-content">
    <div class="user-header">
        <h1>Course Participants</h1>
        <div class="header-actions">
            <div class="search-form">
                <form id="searchForm">
                    <input type="text" name="s" class="search-input" id="searchInput" placeholder="Search student..." value="<?php echo ($_GET['s']); ?>">
                    <button class="search-btn" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
            </div>
            <button class="add-user-btn" onclick="toggleModal()">+ Add New Student</button>
            <?php if (array_key_exists('email', $errors)) : ?>
                <div style="color: red; text-align:center">
                    <?php echo e($errors['email']); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <p>
        <?= e($stdCount); ?> Students
    </p>
    <!-- User Table -->
    <div class="user-table-container">
        <table class="data-table">
            <?php if ($isParticipant || $isTeacher): ?>
                <th>Student name</th>
                <tbody id="userTableBody">
                    <?php if (!empty($students)): ?>
                        <?php foreach ($students as $std) : ?>
                            <tr>
                                <td><?php echo $std['username']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td>No students</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            <?php else: ?>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="userTableBody">
                    <?php if (!empty($students)): ?>
                        <?php foreach ($students as $std) : ?>
                            <tr data-id="<?= e($std['user_id']); ?>"
                                class="user-data">

                                <td><?php echo $std['user_id']; ?></td>
                                <td><?php echo $std['username']; ?></td>
                                <td><?php echo $std['email']; ?></td>
                                <td>
                                    <button class="delete-btn" onclick="event.stopPropagation();showModal('participants/remove/<?php echo $std['user_id']; ?>')">Remove</button>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td>No students</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            <?php endif; ?>
        </table>
    </div>

    <div id="addUserModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="toggleModal()">&times;</span>
            <h2>Add New Student to the Course</h2>
            <form id="addUserForm" action="participants/add" method="POST">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <button type="submit" class="add-user-btn">Add Student</button>
            </form>
        </div>
    </div>
</div>
<?php include $this->resolve('components/delete_modal.php'); ?>

<script>
    const rows = document.querySelectorAll(".user-data");

    rows.forEach(row => {
        row.addEventListener('click', () => {
            const userId = row.dataset.id;
            window.location.href = `participants/${userId}`
        })
    })
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
</script>