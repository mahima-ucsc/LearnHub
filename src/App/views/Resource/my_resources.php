<?php include $this->resolve("partials/_header.php"); ?>

<head>
    <link rel="stylesheet" href="/assets/styles/Resource/my-resources.css">

</head>

<section class="resources-page">
    <div class="main-container">
        <div class="main-title">
            <h1>My Resources</h1>
        </div>

        <div class="admin-header">
            <div class="header-actions">
                <div class="search-form">
                    <input type="text" class="search-input" id="searchInput" placeholder="Search resources...">
                    <button class="search-btn" onclick="searchResources()">Search</button>
                </div>
                <button class="add-user-btn" onclick="window.location.href='/resource/create'">
                    <a href="/resource/create" style="text-decoration: none;"> Add New Resource </a>
                </button>
            </div>
        </div>

        <div class="table-container">
            <table class="resources-table">
                <thead>
                    <tr>
                        <th>Resource</th>
                        <th>Type</th>
                        <th>Category</th>
                        <th>Price(Rs)</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($resources)): ?>
                        <?php foreach ($resources as $resource): ?>
                            <tr>
                                <td>
                                    <div class="resource-name">
                                        <?php echo htmlspecialchars($resource['title']); ?>
                                    </div>
                                </td>
                                <td>
                                    <span class="resource-type"><?php echo htmlspecialchars($resource['resource_type']); ?></span>
                                </td>
                                <td>
                                    <span class="resource-category"><?php echo htmlspecialchars($resource['category']); ?></span>
                                </td>
                                <td>
                                    <span class="resource-price"><?php echo htmlspecialchars($resource['price']); ?></span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="/resource/edit/<?php echo $resource['resource_id']; ?>" class="btn btn-edit">Edit</a>
                                        <button onclick="showDeleteModal(<?php echo $resource['resource_id']; ?>)" class="btn btn-delete">Delete</button>

                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">No resources found.</td>
                        </tr>
                    <?php endif; ?>
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
                Are you sure you want to delete this resource? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button onclick="hideModal()" class="btn btn-cancel">Cancel</button>
                <form id="deleteForm" method="POST" action="">
                    <?php include $this->resolve("partials/_csrf.php"); ?>
                    <input type="hidden" name="_METHOD" value="DELETE" />
                    <button type="submit" class="btn btn-delete">Delete</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const modal = document.getElementById('deleteModal');
        const deleteForm = document.getElementById('deleteForm');

        function showDeleteModal(resourceId) {
            deleteForm.action = `/resource/delete/${resourceId}`;
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

        function searchResources() {
            const searchInput = document.getElementById('searchInput').value.toLowerCase();
            const rows = document.querySelectorAll('.resources-table tbody tr');

            rows.forEach(row => {
                const resourceName = row.querySelector('.resource-name').textContent.toLowerCase();
                if (resourceName.includes(searchInput)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
</section>

<?php include $this->resolve("partials/_footer.php"); ?>