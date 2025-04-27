<?php include $this->resolve("partials/_header.php"); ?>

<link rel="stylesheet" href="/assets/styles/Course/course_participant.css">
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
        </div>
    </div>

    <p>
        <?= e($stdCount); ?> Students
    </p>
    <!-- User Table -->
    <div class="user-table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
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
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td>No students</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
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