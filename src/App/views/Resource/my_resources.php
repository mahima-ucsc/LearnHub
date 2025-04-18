<?php include $this->resolve("partials/_header.php"); ?>

<head>
    <style>
        .resources-page {
            font-family: 'Inter', sans-serif;
            color: #171A1F;
            min-height: 100vh;
            padding: 20px;
            margin: 50px 0 0 50px;
        }

        .main-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .main-title {
            background-color: #fff;
            border-radius: 16px;
            padding: 30px;
            margin-bottom: 30px;
        }

        .main-title h1 {
            font-size: 32px;
            font-weight: 700;
            color: #1a1a1a;
            margin: 0;
        }

        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        /* User Management Specific Styles */
        .header-actions {
            display: flex;
            gap: 16px;
            align-items: center;
        }

        .search-form {
            display: flex;
            gap: 8px;
        }

        .search-input {
            padding: 8px 12px;
            font-size: 14px;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            min-width: 240px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: #FFC400;
            box-shadow: 0 0 4px rgba(255, 196, 0, 0.4);
        }

        .search-btn,
        .add-user-btn {
            padding: 8px 16px;
            font-size: 14px;
            font-weight: 500;
            color: #495057;
            background: #fff;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .add-user-btn {
            background: #FFC400;
            color: #2c3e50;
            border: none;
        }

        .search-btn:hover,
        .add-user-btn:hover {
            background: #FFD700;
            box-shadow: 0 2px 8px rgba(255, 196, 0, 0.3);
        }

        .table-container {
            background-color: white;
            border-radius: 16px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            overflow-x: auto;
        }

        .resources-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .resources-table th {
            background-color: #f8f9fa;
            padding: 16px;
            text-align: left;
            font-weight: 600;
            color: #565D6D;
            border-bottom: 1px solid #e9ecef;
            white-space: nowrap;
        }

        .resources-table td {
            padding: 16px;
            border-bottom: 1px solid #e9ecef;
            color: #2c3e50;
        }

        .resources-table tr:last-child td {
            border-bottom: none;
        }

        .resources-table tr:hover {
            background-color: #f8f9fa;
        }

        .resource-name {
            font-weight: 600;
            color: #1a1a1a;
        }

        .resource-type {
            display: inline-block;
            padding: 4px 8px;
            background-color: #e9ecef;
            border-radius: 4px;
            font-size: 15px;
            margin-left: 0px;
        }

        .resource-category {
            display: inline-block;
            padding: 4px 8px;
            background-color: #e9ecef;
            border-radius: 4px;
            font-size: 15px;
            margin-left: 0px;
        }

        .resource-price {
            color: #38a169;
            font-weight: 600;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .action-buttons a {
            text-decoration: none;
        }

        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.2s;
        }

        .btn-edit {
            background-color: #f0f2f5;
            color: #2c3e50;
        }

        .btn-edit:hover {
            background-color: #e9ecef;
        }

        .btn-delete {
            background-color: #fee2e2;
            color: #dc2626;
        }

        .btn-delete:hover {
            background-color: #fecaca;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .modal-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 90%;
            width: 400px;
        }

        .modal-header {
            margin-bottom: 1.5rem;
        }

        .modal-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: #2d3748;
            margin: 0;
        }

        .modal-body {
            margin-bottom: 1.5rem;
            color: #4a5568;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
        }

        .day-badge {
            display: inline-block;
            padding: 4px 8px;
            background-color: #fff3cd;
            color: #856404;
            border-radius: 4px;
            font-size: 12px;
            margin-left: 8px;
        }

        @media (max-width: 1024px) {

            .courses-table th:nth-child(2),
            .courses-table td:nth-child(2) {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .courses-page {
                padding: 15px;
                margin-left: 0;
            }

            .main-title {
                padding: 20px;
            }

            .main-title h1 {
                font-size: 28px;
            }

            .courses-table th:nth-child(3),
            .courses-table td:nth-child(3) {
                display: none;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
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