<?php include $this->resolve("partials/_header.php"); ?>


<style>
    :root {
        --primary: #FFC400;
        --primary-dark: #e6b000;
        --primary-light: #fff0c2;
        --accent: #FF7849;
        --dark: #1A1A2E;
        --gray-light: #f8f9fa;
        --gray: #e9ecef;
        --gray-dark: #6c757d;
        --white: #ffffff;
        --shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        --shadow-hover: 0 15px 35px rgba(0, 0, 0, 0.1);
        --radius: 12px;
        --radius-sm: 8px;
        --transition: all 0.3s ease;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
        background-color: var(--gray-light);
        color: var(--dark);
        line-height: 1.6;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    .page-header {
        text-align: center;
        margin-bottom: 40px;
        animation: fadeInDown 0.8s ease;
    }

    .page-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 10px;
        color: var(--dark);
        position: relative;
        display: inline-block;
    }

    .page-title:after {
        content: '';
        position: absolute;
        left: 50%;
        bottom: -10px;
        width: 60px;
        height: 4px;
        background: var(--primary);
        border-radius: 2px;
        transform: translateX(-50%);
    }

    .page-subtitle {
        font-size: 1.1rem;
        color: var(--gray-dark);
        max-width: 700px;
        margin: 0 auto;
        margin-top: 20px;
    }

    .card {
        background-color: var(--white);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        padding: 40px;
        margin-bottom: 30px;
        animation: fadeInUp 1s ease;
    }

    .section-title {
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid var(--gray);
        color: var(--dark);
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-group:last-child {
        margin-bottom: 0;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: var(--dark);
    }

    .form-control {
        width: 100%;
        padding: 14px 16px;
        font-size: 1rem;
        border: 2px solid var(--gray);
        border-radius: var(--radius-sm);
        background-color: var(--white);
        transition: var(--transition);
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 2px rgba(255, 196, 0, 0.05);
    }

    .form-control.error {
        border-color: #dc3545;
    }

    .textarea-control {
        height: 120px;
        resize: vertical;
    }

    .error-message {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 8px;
        display: none;
    }

    .hint-text {
        font-size: 0.875rem;
        color: var(--gray-dark);
        margin-top: 8px;
    }

    .module-list {
        margin-top: 20px;
    }

    .module-item {
        background: var(--gray-light);
        padding: 20px;
        border-radius: var(--radius);
        margin-bottom: 20px;
        animation: fadeIn 0.5s ease;
    }

    .module-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .module-title {
        font-weight: 600;
        font-size: 1.1rem;
    }

    .module-actions {
        display: flex;
        gap: 10px;
    }

    .btn {
        padding: 12px 24px;
        border-radius: var(--radius-sm);
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: var(--transition);
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn i {
        margin-right: 8px;
    }

    .btn-sm {
        padding: 8px 16px;
        font-size: 0.9rem;
    }

    .btn-primary {
        background-color: var(--primary);
        color: var(--dark);
        box-shadow: 0 4px 15px rgba(255, 196, 0, 0.3);
    }

    .btn-primary:hover {
        background-color: var(--primary-dark);
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(255, 196, 0, 0.4);
    }

    .btn-outline {
        background-color: transparent;
        border: 2px solid var(--gray);
        color: var(--gray-dark);
    }

    .btn-outline:hover {
        border-color: var(--primary);
        color: var(--primary-dark);
        transform: translateY(-3px);
    }

    .btn-danger {
        background-color: #dc3545;
        color: white;
    }

    .btn-danger:hover {
        background-color: #c82333;
        transform: translateY(-3px);
    }

    .btn-flat {
        background: transparent;
        padding: 8px;
        color: var(--gray-dark);
    }

    .btn-flat:hover {
        color: var(--primary-dark);
    }

    .form-row {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
    }

    .form-row .form-group {
        flex: 1;
        margin-bottom: 0;
    }

    .toggle-container {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 15px;
    }

    .toggle-switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 26px;
    }

    .toggle-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .toggle-slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: var(--gray);
        transition: var(--transition);
        border-radius: 34px;
    }

    .toggle-slider:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: var(--transition);
        border-radius: 50%;
    }

    input:checked+.toggle-slider {
        background-color: var(--primary);
    }

    input:checked+.toggle-slider:before {
        transform: translateX(24px);
    }

    .toggle-label {
        font-weight: 500;
    }

    .collapse-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
    }

    .collapse-content.show {
        max-height: 1000px;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 15px;
        margin-top: 40px;
    }

    .success-message {
        background-color: #d4edda;
        color: #155724;
        padding: 15px;
        border-radius: var(--radius-sm);
        margin-bottom: 30px;
        display: none;
        animation: fadeIn 0.5s ease;
    }

    .success-message a {
        color: #155724;
    }

    .active {
        display: block;
    }

    .back-button {
        margin-bottom: 20px;
    }

    .back-button a {
        color: #666;
        text-decoration: none;
        font-size: 16px;
    }

    .back-button a:hover {
        color: #333;
    }

    /* Attachment */
    .drop-zone {
        border: 2px dashed var(--gray);
        padding: 20px;
        text-align: center;
        cursor: pointer;
        margin-bottom: 15px;
        border-radius: var(--radius-sm);
        transition: var(--transition);
    }

    .drop-zone:hover {
        border-color: var(--primary);
        background-color: var(--primary-light);
    }

    .drop-zone i {
        font-size: 1.5rem;
        color: var(--primary-dark);
        margin-bottom: 10px;
        display: block;
    }

    .module-attachments-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .module-attachments-list li {
        display: flex;
        align-items: center;
        background: var(--gray-light);
        padding: 10px 15px;
        margin-bottom: 8px;
        border-radius: var(--radius-sm);
        border: 1px solid var(--gray);
    }

    .file-icon {
        margin-right: 10px;
        color: var(--primary-dark);
    }

    .file-name {
        flex: 1;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .file-size {
        margin: 0 15px;
        color: var(--gray-dark);
        font-size: 0.85rem;
    }

    .remove-file {
        background: transparent;
        border: none;
        color: var(--gray-dark);
        cursor: pointer;
        transition: var(--transition);
    }

    .remove-file:hover {
        color: #dc3545;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Media queries */
    @media (max-width: 768px) {
        .container {
            padding: 30px 15px;
        }

        .card {
            padding: 30px 20px;
        }

        .page-title {
            font-size: 2rem;
        }

        .form-row {
            flex-direction: column;
            gap: 0;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn {
            width: 100%;
        }
    }
</style>
</head>

<body>
    <div class="container">
        <div class="back-button">
            <a href="/courses/<?= $course['course_id'] ?>">
                <i class="fa-solid fa-arrow-left"></i> Go Back To Course</a>
        </div>
        <div class="page-header">
            <h1 class="page-title">Create Course Module</h1>
            <p class="page-subtitle">Create and customize course modules with detailed content, schedules, and attachments.</p>
        </div>

        <div id="successMessage" class="success-message <?= $_GET['m'] == 'success' ? 'active' : ''; ?>">
            Your module has been created successfully! You can create another module or <a href="/courses/<?= $course['course_id'] ?>">Go Back To Course</a>
        </div>

        <form id="createModuleForm" method="POST" enctype="multipart/form-data" action="/course/<?= $course['course_id']; ?>/module/create">
            <!-- Modules Card -->
            <div class="card">
                <h2 class="section-title">Module Details</h2>

                <div class="module-list">
                    <div id="moduleTemplate">
                        <div class="module-item">
                            <div class="module-content collapse-content show">
                                <div class="monthly-module-pricing">
                                    <?php if ($course['billing_type'] == "recurring"): ?>
                                        <div class="form-group">
                                            <label for="accessPeriod" class="form-label">Select Access Period*</label>
                                            <select name="accessPeriod" id="accessPeriod" class="form-control module-access-period">
                                                <option value="-1">Select Access Period</option>
                                                <?php if (!empty($courseSubPeriods)):
                                                    foreach ($courseSubPeriods as $period): ?>

                                                        <option value="<?= e($period['sub_period_id']) ?>"><?= e(substr($period['start_datetime'], 0, 10)) . ' - ' . e(substr($period['end_datetime'], 0, 10)); ?></option>
                                                    <?php endforeach;
                                                else: ?>

                                                    <option value="-2">'You haven\'t created any access period'</option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                        <div class="toggle-container">
                                            <label class="toggle-switch">
                                                <input type="checkbox" name="moduleAccessPeriod" class="module-access-period-checkbox">
                                                <span class="toggle-slider"></span>
                                            </label>
                                            <span class="toggle-label">Create Access Period</span>
                                        </div>
                                        <div class="module-access-period-input collapse-content">
                                            <div class="form-row">
                                                <div class="form-group">
                                                    <label class="form-label">Access Period Start Date*</label>
                                                    <input type="date" name="moduleAccessPeriodStartDate" class="form-control module-access-period-start-date">
                                                    <div class="error-message">Please enter a valid start date</div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Access Period End Date*</label>
                                                    <input type="date" name="moduleAccessPeriodEndDate" class="form-control module-access-period-end-date">
                                                    <div class="error-message">Please enter a valid end date</div>
                                                </div>
                                            </div>
                                            <div class="toggle-container">
                                                <label class="toggle-switch">
                                                    <input type="checkbox" name="moduleFreeTrial" class="module-free-trial-checkbox">
                                                    <span class="toggle-slider"></span>
                                                </label>
                                                <span class="toggle-label">Enable free trial period</span>
                                            </div>

                                            <div class="module-free-trial-input collapse-content">
                                                <div class="form-row">
                                                    <div class="form-group">
                                                        <label class="form-label">Free Trial Start Date*</label>
                                                        <input type="date" name="moduleFreeTrialStartDate" class="form-control module-free-trial-start-date">
                                                        <div class="error-message">Please enter a valid start date</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label">Free Trial End Date*</label>
                                                        <input type="date" name="moduleFreeTrialEndDate" class="form-control module-free-trial-end-date">
                                                        <div class="error-message">Please enter a valid end date</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group">
                                                    <label class="form-label">Price*</label>
                                                    <input type="number" name="price" class="form-control module-price-input" placeholder="Enter price (in Rs.)" step="0.01" min="0">
                                                </div>
                                            </div>
                                        </div>




                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Module Title*</label>
                                    <input type="text" name="moduleTitle" class="form-control module-title-input" placeholder="e.g., Introduction to React Hooks" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Module Description*</label>
                                    <textarea name="moduleDescription" class="form-control textarea-control module-description-input" placeholder="What will students learn in this module?"></textarea>
                                </div>



                                <div class="form-group">
                                    <label class="form-label">Module Attachments</label>
                                    <div class="module-attachments drop-zone">
                                        <p><i class="fas fa-cloud-upload-alt"></i> Drag files here or click to upload</p>
                                        <input type="file" name="moduleAttachments[]" class="module-file-input" multiple style="display: none;">
                                    </div>
                                    <ul class="module-attachments-list"></ul>
                                    <p class="hint-text">Upload any supporting materials for this module (PDFs, presentations, code samples, etc.)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="submit" class="btn btn-primary" id="createModuleBtn">
                    <i class="fas fa-check"></i> Create Module
                </button>
            </div>
        </form>
    </div>

    <script>
        addEventListener("DOMContentLoaded", () => {
            setTimeout(() => {
                const successMessage = document.getElementById("successMessage");
                if (successMessage) {
                    successMessage.classList.remove('active');
                }
            }, 6000);
        });
        document.addEventListener('DOMContentLoaded', function() {
            // Elements
            const form = document.getElementById('createModuleForm');
            const successMessage = document.getElementById('successMessage');
            const dropZone = document.querySelector('.module-attachments');
            const fileInput = document.querySelector('.module-file-input');
            const attachmentsList = document.querySelector('.module-attachments-list');
            const freeTrialCheckbox = document.querySelector('.module-free-trial-checkbox');
            const accessPeriodCheckbox = document.querySelector('.module-access-period-checkbox');
            const accessPeriodInputs = document.querySelector('.module-access-period-input');
            const freeTrialInputs = document.querySelector('.module-free-trial-input');
            const selectAccessPeriod = document.getElementById("accessPeriod");

            // Disable Create access periods if it already selected
            if (selectAccessPeriod) {
                selectAccessPeriod.addEventListener('change', function() {
                    if (this.value !== "-1" && this.value !== "-2") {
                        accessPeriodCheckbox.disabled = true;
                    } else {
                        accessPeriodCheckbox.disabled = false;
                    }
                });
            }
            // Toggle free trial inputs visibility when checkbox is clicked
            if (freeTrialCheckbox) {
                freeTrialCheckbox.addEventListener('change', function() {
                    if (this.checked) {
                        freeTrialInputs.classList.add('show');
                    } else {
                        freeTrialInputs.classList.remove('show');
                    }
                });
            }
            // Toggle access period inputs visibility when checkbox is clicked
            if (accessPeriodCheckbox) {
                accessPeriodCheckbox.addEventListener('change', function() {
                    if (this.checked) {
                        selectAccessPeriod.disabled = true;
                        accessPeriodInputs.classList.add('show');
                    } else {
                        selectAccessPeriod.disabled = false;
                        accessPeriodInputs.classList.remove('show');
                    }
                });
            }

            // Create DataTransfer object to manage files
            const dataTransfer = new DataTransfer();

            // Click on drop zone to trigger file input
            dropZone.addEventListener('click', () => {
                fileInput.click();
            });

            // Handle drag & drop events
            dropZone.addEventListener('dragover', (e) => {
                e.preventDefault();
                dropZone.style.borderColor = 'var(--primary)';
            });

            dropZone.addEventListener('dragleave', (e) => {
                e.preventDefault();
                dropZone.style.borderColor = 'var(--gray)';
            });

            dropZone.addEventListener('drop', (e) => {
                e.preventDefault();
                dropZone.style.borderColor = 'var(--gray)';
                handleFiles(e.dataTransfer.files);
            });

            // When files are selected via the file input
            fileInput.addEventListener('change', (e) => {
                handleFiles(e.target.files);
            });

            // Add files to DataTransfer and update the preview
            function handleFiles(files) {
                for (let i = 0; i < files.length; i++) {
                    dataTransfer.items.add(files[i]);
                }
                // Update the file input with our DataTransfer files
                fileInput.files = dataTransfer.files;
                renderPreview();
            }

            // Format file size in a readable way
            function formatFileSize(bytes) {
                if (bytes === 0) return '0 Bytes';
                const k = 1024;
                const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            }

            // Render the attachments preview
            function renderPreview() {
                // Clear the current list
                attachmentsList.innerHTML = '';

                // Create a preview for each file
                Array.from(fileInput.files).forEach((file, index) => {
                    const listItem = document.createElement('li');

                    // Add file icon
                    const icon = document.createElement('i');
                    icon.className = 'fas fa-file file-icon';
                    listItem.appendChild(icon);

                    // Add file name
                    const fileName = document.createElement('span');
                    fileName.textContent = file.name;
                    fileName.className = 'file-name';
                    listItem.appendChild(fileName);

                    // Add file size
                    const fileSize = document.createElement('span');
                    fileSize.textContent = formatFileSize(file.size);
                    fileSize.className = 'file-size';
                    listItem.appendChild(fileSize);

                    // Create a remove button for each file
                    const removeBtn = document.createElement('button');
                    removeBtn.innerHTML = '<i class="fas fa-times"></i>';
                    removeBtn.className = 'remove-file';
                    removeBtn.type = 'button';
                    removeBtn.addEventListener('click', () => removeFile(index));
                    listItem.appendChild(removeBtn);

                    attachmentsList.appendChild(listItem);
                });
            }

            // Remove a file from the DataTransfer list
            function removeFile(index) {
                // Create a new DataTransfer object and add back every file except the one to remove
                const newDataTransfer = new DataTransfer();
                Array.from(fileInput.files).forEach((file, i) => {
                    if (i !== index) {
                        newDataTransfer.items.add(file);
                    }
                });
                // Update our DataTransfer and file input
                dataTransfer.items.clear();
                Array.from(newDataTransfer.files).forEach(file => {
                    dataTransfer.items.add(file);
                });
                fileInput.files = dataTransfer.files;
                renderPreview();
            }
        });
    </script>

    <?php include $this->resolve("partials/_footer.php"); ?>