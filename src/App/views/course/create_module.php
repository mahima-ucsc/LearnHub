<?php include $this->resolve("partials/_header.php"); ?>


<link rel="stylesheet" href="/assets/styles/Course/create_module.css">
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
                                            <option value="-1">Select Access period</option>
                                            <?php if (!empty($courseSubPeriods)):
                                                foreach ($courseSubPeriods as $period): ?>

                                                    <option value="<?= e($period['sub_period_id']) ?>"><?= e(substr($period['start_datetime'], 0, 10)) . ' - ' . e(substr($period['end_datetime'], 0, 10)); ?></option>
                                                <?php endforeach;
                                            else: ?>

                                                <option value="-2">'You haven't created any access period'</option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    <?php if (array_key_exists('accessPeriod', $errors)) : ?>
                                        <div class="error-message" id="courseGradeError">Please select select or create access period</div>
                                    <?php endif; ?>

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
                                                <?php if (array_key_exists('moduleAccessPeriodStartDate', $errors)) : ?>
                                                    <div class="error-message">
                                                        <?php echo e($errors['moduleAccessPeriodStartDate'][0]); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Access Period End Date*</label>
                                                <input type="date" name="moduleAccessPeriodEndDate" class="form-control module-access-period-end-date">
                                                <?php if (array_key_exists('moduleAccessPeriodEndDate', $errors)) : ?>
                                                    <div class="error-message">
                                                        <?php echo e($errors['moduleAccessPeriodEndDate'][0]); ?>
                                                    </div>
                                                <?php endif; ?>
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
                                                <?php if (array_key_exists('moduleFreeTrialStartDate', $errors)) : ?>
                                                    <div class="error-message">
                                                        <?php echo e($errors['moduleFreeTrialStartDate'][0]); ?>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="form-group">
                                                    <label class="form-label">Free Trial End Date*</label>
                                                    <input type="date" name="moduleFreeTrialEndDate" class="form-control module-free-trial-end-date">
                                                    <div class="error-message">Please enter a valid end date</div>
                                                </div>
                                                <?php if (array_key_exists('moduleFreeTrialEndDate', $errors)) : ?>
                                                    <div class="error-message">
                                                        <?php echo e($errors['moduleFreeTrialEndDate'][0]); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group">
                                                <label class="form-label">Price*</label>
                                                <input type="number" name="price" class="form-control module-price-input" placeholder="Enter price (in Rs.)" step="0.01" min="0">
                                            </div>
                                        </div>
                                        <?php if (array_key_exists('price', $errors)) : ?>
                                            <div class="error-message">
                                                <?php echo e($errors['price'][0]); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>




                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Module Title*</label>
                                <input type="text" name="moduleTitle" class="form-control module-title-input" placeholder="e.g., Introduction to React Hooks"
                                    value="<?= $oldFormData['moduleTitle'] ?? ''; ?>">
                            </div>
                            <?php if (array_key_exists('moduleTitle', $errors)) : ?>
                                <div class="error-message">
                                    <?php echo e($errors['moduleTitle'][0]); ?>
                                </div>
                            <?php endif; ?>

                            <div class="form-group">
                                <label class="form-label">Module Description*</label>
                                <textarea name="moduleDescription" class="form-control textarea-control module-description-input" placeholder="What will students learn in this module?"></textarea>
                            </div>
                            <?php if (array_key_exists('moduleDescription', $errors)) : ?>
                                <div class="error-message">
                                    <?php echo e($errors['moduleDescription'][0]); ?>
                                </div>
                            <?php endif; ?>



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